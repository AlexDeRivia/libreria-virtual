<?php

namespace Tests\Feature;

use App\Models\Autor;
use App\Models\Ejemplar;
use App\Models\Especialidad;
use App\Models\Idioma;
use App\Models\Libro;
use App\Models\Pedido;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RecoveryWorkflowTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        if (getenv('DB_DATABASE') !== 'libreria_virtual_test' || ! in_array(getenv('DB_HOST'), ['127.0.0.1', 'localhost'], true)) {
            throw new \RuntimeException('Las pruebas de recuperación requieren DB_DATABASE=libreria_virtual_test en MySQL local.');
        }

        parent::setUp();
    }

    private function usuario(string $email): Usuario
    {
        return Usuario::query()->where('email', $email)->firstOrFail();
    }

    private function ejemplarDisponible(): Ejemplar
    {
        return Ejemplar::query()->where('stock', '>=', 3)->firstOrFail();
    }

    public function test_registration_rejects_staff_roles_and_creates_a_customer_cart(): void
    {
        $data = [
            'email' => 'nuevo@example.test',
            'password' => 'ContrasenaDePrueba123!',
            'password_2' => 'ContrasenaDePrueba123!',
            'nombres' => 'Nuevo',
            'apellidos' => 'Cliente',
            'telefono' => '900000099',
            'pais_id' => 1,
            'provincia_id' => 2,
            'localidad' => 'Demo',
            'direccion' => 'Calle de ejemplo',
            'codigo_postal' => '00000',
            'rol_id' => 1,
        ];

        $this->post('/register', $data)->assertSessionHasErrors('rol_id');
        $this->assertDatabaseMissing('usuarios', ['email' => $data['email']]);

        $data['rol_id'] = 3;
        $this->post('/register', $data)->assertSessionHasErrors('especialidades');
        $specialtyId = Especialidad::query()->firstOrFail()->id;
        $data['especialidades'] = [$specialtyId, $specialtyId];
        $this->post('/register', $data)->assertSessionHasErrors('especialidades.0');
        $this->assertDatabaseMissing('usuarios', ['email' => $data['email']]);

        unset($data['especialidades']);
        $data['rol_id'] = 2;
        $this->post('/register', $data)->assertRedirect(route('cliente.home'));
        $user = $this->usuario($data['email']);
        $this->assertDatabaseHas('pedidos', ['usuario_id' => $user->id, 'estado_pedido_id' => 1]);
        $this->assertAuthenticatedAs($user, 'usuarios');
    }

    public function test_login_uses_the_customer_guard(): void
    {
        $user = Usuario::create([
            'email' => 'login@example.test',
            'password' => Hash::make('ContrasenaDePrueba123!'),
            'nombres' => 'Login',
            'apellidos' => 'Demo',
            'telefono' => '900000098',
            'pedido_1_clic' => false,
            'rol_id' => 2,
            'pais_id' => 1,
            'provincia_id' => 2,
            'localidad' => 'Demo',
            'direccion' => 'Calle de ejemplo',
            'codigo_postal' => '00000',
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'ContrasenaDePrueba123!',
        ])->assertRedirect(route('cliente.home'));
        $this->assertAuthenticatedAs($user, 'usuarios');
    }

    public function test_api_user_uses_the_same_guard(): void
    {
        $this->getJson('/api/user')->assertUnauthorized();
        $user = $this->usuario('cliente@example.test');
        $this->actingAs($user, 'usuarios');
        $this->getJson('/api/user')->assertOk()->assertJsonPath('email', $user->email);
    }

    public function test_each_role_can_open_its_home_and_unknown_roles_are_denied(): void
    {
        $this->actingAs($this->usuario('admin@example.test'), 'usuarios');
        $this->get('/admin')->assertOk();
        $this->get('/admin/pedidos')->assertOk();
        foreach (['usuarios', 'autores', 'nacionalidades', 'idiomas', 'especialidades', 'paises', 'provincias', 'preferenciasEnvio'] as $section) {
            $this->get("/admin/{$section}")->assertOk();
        }

        $this->actingAs($this->usuario('especialista@example.test'), 'usuarios');
        $this->get('/cliente')->assertOk();
        $this->get('/cliente?query=Demo')->assertOk();
        $this->get('/admin')->assertRedirect(route('cliente.home'));

        $this->actingAs($this->usuario('envios@example.test'), 'usuarios');
        $this->get('/encargado')->assertOk();
        $this->get('/cliente')->assertRedirect(route('encargado.home'));

        $rol = Rol::create(['rol' => 'Desconocido']);
        $user = $this->usuario('cliente2@example.test');
        $user->rol_id = $rol->id;
        $user->save();
        $this->actingAs($user, 'usuarios');
        $this->get('/admin')->assertForbidden();
        $this->get('/cliente')->assertForbidden();
        $this->get('/encargado')->assertForbidden();
    }

    public function test_client_can_browse_and_update_only_their_own_profile(): void
    {
        $client = $this->usuario('cliente@example.test');
        $other = $this->usuario('cliente2@example.test');
        $this->actingAs($client, 'usuarios');

        $this->get('/cliente')->assertOk();
        $this->get('/cliente/pedido')->assertOk()->assertSee('Pedido de demostración');
        $this->get('/cliente/perfil')->assertOk();
        $this->get('/cliente/tarjetas/create')->assertNotFound();

        $data = ['nombres' => 'Actualizado', 'apellidos' => 'Demo', 'telefono' => '900000001', 'rol_id' => 2];
        $this->put("/cliente/perfil/editar/{$other->id}", $data)->assertForbidden();
        $this->put("/cliente/perfil/editar/{$client->id}", array_replace($data, ['rol_id' => 1]))->assertSessionHasErrors('rol_id');
        $this->put("/cliente/perfil/editar/{$client->id}", $data)->assertRedirect(route('cliente.perfil'));
        $this->assertDatabaseHas('usuarios', ['id' => $client->id, 'nombres' => 'Actualizado', 'rol_id' => 2]);
    }

    public function test_cart_checkout_and_invoice_are_scoped_to_the_customer(): void
    {
        $client = $this->usuario('cliente@example.test');
        $other = $this->usuario('cliente2@example.test');
        $ejemplar = $this->ejemplarDisponible();
        $stock = $ejemplar->stock;
        $this->actingAs($client, 'usuarios');

        $this->post('/cliente/pedido/add', ['id' => $ejemplar->id, 'cantidad' => 2])
            ->assertRedirect(route('cliente.pedido'));
        $this->assertDatabaseHas('ejemplares', ['id' => $ejemplar->id, 'stock' => $stock - 2]);
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $linea = $pedido->lineaPedidos()->firstOrFail();

        $this->post('/cliente/pedido', [
            'preferencia_envio_id' => 1,
            'empaquetado' => 0,
            'costo_envio' => 0,
        ])->assertRedirect(route('cliente.compras'));
        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id, 'estado_pedido_id' => 2, 'costo_envio' => 1]);
        $this->assertDatabaseHas('pedidos', ['usuario_id' => $client->id, 'estado_pedido_id' => 1]);
        $this->get("/cliente/factura/{$pedido->id}")->assertOk();

        $this->actingAs($other, 'usuarios');
        $this->get("/cliente/factura/{$pedido->id}")->assertNotFound();
        $this->delete("/cliente/pedido/{$linea->id}")->assertNotFound();
        $this->assertDatabaseHas('linea_pedidos', ['id' => $linea->id]);
    }

    public function test_cart_rejects_invalid_quantity_and_foreign_line_updates(): void
    {
        $client = $this->usuario('cliente@example.test');
        $other = $this->usuario('cliente2@example.test');
        $ejemplar = $this->ejemplarDisponible();
        $stock = $ejemplar->stock;
        $this->actingAs($client, 'usuarios');

        $this->post('/cliente/pedido/add', ['id' => $ejemplar->id, 'cantidad' => -1])
            ->assertSessionHasErrors('cantidad');
        $this->assertDatabaseHas('ejemplares', ['id' => $ejemplar->id, 'stock' => $stock]);
        $this->post('/cliente/pedido/add', ['id' => $ejemplar->id, 'cantidad' => 1]);
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $linea = $pedido->lineaPedidos()->firstOrFail();

        $this->actingAs($other, 'usuarios');
        $this->put('/cliente/pedido', ['id' => $linea->id, 'accion' => 'mas'])->assertNotFound();
        $this->assertDatabaseHas('linea_pedidos', ['id' => $linea->id, 'cantidad' => 1]);
    }

    public function test_one_click_cart_action_and_removal_restore_stock(): void
    {
        $client = $this->usuario('cliente@example.test');
        $client->pedido_1_clic = true;
        $client->save();
        $ejemplar = $this->ejemplarDisponible();
        $stock = $ejemplar->stock;
        $this->actingAs($client, 'usuarios');

        $this->get('/cliente')->assertSee('1 Clic');
        $this->post('/cliente/pedido/clic', ['ejemplar_id' => $ejemplar->id, 'cantidad' => 2])->assertRedirect();
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $linea = $pedido->lineaPedidos()->where('ejemplar_id', $ejemplar->id)->firstOrFail();
        $this->assertSame(2, $linea->cantidad);
        $this->assertDatabaseHas('ejemplares', ['id' => $ejemplar->id, 'stock' => $stock - 2]);

        $this->delete("/cliente/pedido/{$linea->id}")->assertRedirect(route('cliente.pedido'));
        $this->assertDatabaseMissing('linea_pedidos', ['id' => $linea->id]);
        $this->assertDatabaseHas('ejemplares', ['id' => $ejemplar->id, 'stock' => $stock]);
    }

    public function test_gift_order_requires_an_address_and_empty_orders_cannot_checkout(): void
    {
        $client = $this->usuario('cliente@example.test');
        $this->actingAs($client, 'usuarios');
        $this->post('/cliente/pedido', ['preferencia_envio_id' => 1, 'empaquetado' => 0])
            ->assertSessionHasErrors('pedido');

        $ejemplar = $this->ejemplarDisponible();
        $this->post('/cliente/pedido/add', ['id' => $ejemplar->id, 'cantidad' => 1]);
        $this->post('/cliente/pedido', ['preferencia_envio_id' => 1, 'empaquetado' => 1])
            ->assertSessionHasErrors('direccion_adicional');

        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $this->post('/cliente/pedido', [
            'preferencia_envio_id' => 1,
            'empaquetado' => 1,
            'direccion_adicional' => 'Dirección ficticia',
            'mensaje' => 'Regalo de demostración',
        ])->assertRedirect(route('cliente.compras'));
        $this->assertDatabaseHas('direcciones', ['id' => $pedido->id, 'direccion' => 'Dirección ficticia']);
    }

    public function test_admin_can_manage_books_and_staff_can_mark_orders_delivered(): void
    {
        $admin = $this->usuario('admin@example.test');
        $author = Autor::query()->firstOrFail();
        $specialty = Especialidad::query()->firstOrFail();
        $this->actingAs($admin, 'usuarios');
        $this->get('/admin/libros')->assertOk();
        $this->get('/admin/libros/create')->assertOk();

        $data = [
            'isbn' => 'DEMO-ISBN-001',
            'titulo' => 'Libro de demostración',
            'resumen' => 'Contenido de prueba',
            'autor_id' => [$author->id],
            'es_principal' => [$author->id],
            'especialidad_id' => [$specialty->id],
        ];
        $this->post('/admin/libros', $data)->assertRedirect(route('admin.libros'));
        $book = Libro::query()->where('isbn', $data['isbn'])->firstOrFail();
        $this->get("/admin/libros/{$book->id}")->assertOk();
        $this->get("/admin/libros/{$book->id}/edit")->assertOk();
        $data['titulo'] = 'Libro actualizado';
        $this->put("/admin/libros/{$book->id}", $data)->assertRedirect(route('admin.libros'));
        $this->assertDatabaseHas('libros', ['id' => $book->id, 'titulo' => 'Libro actualizado']);
        $this->delete("/admin/libros/{$book->id}")->assertRedirect(route('admin.libros'));
        $this->assertDatabaseMissing('libros', ['id' => $book->id]);

        $client = $this->usuario('cliente@example.test');
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $pedido->estado_pedido_id = 2;
        $pedido->save();
        $staff = $this->usuario('envios@example.test');
        $this->actingAs($staff, 'usuarios');
        $this->get('/encargado')->assertOk();
        $this->post("/encargado/despachar/{$pedido->id}", [
            'fecha_probable_llegada' => now()->addDays(3)->toDateString(),
        ])->assertRedirect();
        $this->post("/encargado/entregar/{$pedido->id}")->assertRedirect();
        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id, 'estado_pedido_id' => 3, 'entregado' => 1]);
    }

    public function test_admin_can_manage_copies_without_deleting_ordered_copies(): void
    {
        $admin = $this->usuario('admin@example.test');
        $book = Libro::query()->firstOrFail();
        $language = Idioma::query()->firstOrFail();
        $this->actingAs($admin, 'usuarios');
        $this->get('/admin/ejemplares')->assertOk();
        $this->get('/admin/ejemplares/create')->assertOk();

        $data = [
            'libro_id' => $book->id,
            'idioma_id' => $language->id,
            'numero_ejemplar' => 'DEMO-999',
            'precio' => 25,
            'stock' => 4,
        ];
        $this->post('/admin/ejemplares', $data)->assertRedirect(route('admin.ejemplares'));
        $copy = Ejemplar::query()->where('numero_ejemplar', 'DEMO-999')->firstOrFail();
        $this->get("/admin/ejemplares/{$copy->id}")->assertOk();
        $this->get("/admin/ejemplares/{$copy->id}/edit")->assertOk();
        $data['precio'] = 30;
        $this->put("/admin/ejemplares/{$copy->id}", $data)->assertRedirect(route('admin.ejemplares'));
        $this->assertDatabaseHas('ejemplares', ['id' => $copy->id, 'precio' => 30]);

        $client = $this->usuario('cliente@example.test');
        $this->actingAs($client, 'usuarios');
        $this->post('/cliente/pedido/add', ['id' => $copy->id, 'cantidad' => 1]);
        $this->actingAs($admin, 'usuarios');
        $this->delete("/admin/ejemplares/{$copy->id}")->assertSessionHasErrors('ejemplar');
        $this->assertDatabaseHas('ejemplares', ['id' => $copy->id]);
    }
}
