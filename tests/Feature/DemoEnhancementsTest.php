<?php

namespace Tests\Feature;

use App\Models\Ejemplar;
use App\Models\Envio;
use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DemoEnhancementsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        if (getenv('DB_DATABASE') !== 'libreria_virtual_test' || ! in_array(getenv('DB_HOST'), ['127.0.0.1', 'localhost'], true)) {
            throw new \RuntimeException('Estas pruebas requieren DB_DATABASE=libreria_virtual_test en MySQL local.');
        }

        parent::setUp();
    }

    private function user(string $email): Usuario
    {
        return Usuario::query()->where('email', $email)->firstOrFail();
    }

    public function test_visitors_can_browse_but_cannot_add_to_cart(): void
    {
        $this->get('/catalogo')->assertOk()->assertSee('La ciudad y los perros');
        $this->get('/catalogo?query=La ciudad')->assertOk()->assertSee('La ciudad y los perros');
        $this->get('/catalogo?query%5B%5D=x')->assertOk();
        $this->get('/catalogo/1')->assertOk()->assertSee('La ciudad y los perros');
        $this->get('/catalogo/999999')->assertNotFound();
        $this->post('/cliente/pedido/add', ['id' => 1, 'cantidad' => 1])->assertRedirect(route('login'));
        $this->get('/')->assertOk()->assertSee('Explorar catálogo');
    }

    public function test_abandoned_cart_releases_stock_after_thirty_minutes(): void
    {
        $client = $this->user('cliente@example.test');
        $copy = Ejemplar::query()->where('stock', '>=', 3)->firstOrFail();
        $initialStock = $copy->stock;
        $this->actingAs($client, 'usuarios');
        $this->post('/cliente/pedido/add', ['id' => $copy->id, 'cantidad' => 2])->assertRedirect(route('cliente.pedido'));
        $this->assertDatabaseHas('ejemplares', ['id' => $copy->id, 'stock' => $initialStock - 2]);

        $this->get('/catalogo')->assertOk();
        $this->assertDatabaseHas('ejemplares', ['id' => $copy->id, 'stock' => $initialStock - 2]);

        $this->travel(31)->minutes();
        $this->get('/catalogo')->assertOk();
        $this->assertDatabaseHas('ejemplares', ['id' => $copy->id, 'stock' => $initialStock]);
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $this->assertSame(0, $pedido->lineaPedidos()->count());

        $this->get('/catalogo')->assertOk();
        $this->assertDatabaseHas('ejemplares', ['id' => $copy->id, 'stock' => $initialStock]);
        $this->post('/cliente/pedido', ['preferencia_envio_id' => 1, 'empaquetado' => 0])
            ->assertSessionHasErrors('pedido');
    }

    public function test_order_has_simulated_tracking_and_delivery_remains_visible(): void
    {
        $client = $this->user('cliente@example.test');
        $this->actingAs($client, 'usuarios');
        $copy = Ejemplar::query()->where('stock', '>=', 1)->firstOrFail();
        $this->post('/cliente/pedido/add', ['id' => $copy->id, 'cantidad' => 1]);
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $this->post('/cliente/pedido', ['preferencia_envio_id' => 1, 'empaquetado' => 0])
            ->assertRedirect(route('cliente.compras'));

        $pedido->refresh();
        $this->assertNotNull($pedido->envio_id);
        $envio = Envio::query()->findOrFail($pedido->envio_id);
        $this->assertSame('En preparación', $envio->estado->estado);
        $this->get('/cliente/compras')->assertOk()->assertSee($envio->nro_tracking);

        $staff = $this->user('envios@example.test');
        $this->actingAs($staff, 'usuarios');
        $this->get("/encargado/pedidos/{$pedido->id}")->assertOk()->assertSee($copy->libro->titulo);
        $eta = now()->addDays(3)->toDateString();
        $this->post("/encargado/despachar/{$pedido->id}", ['fecha_probable_llegada' => $eta])->assertRedirect();
        $this->assertSame('En camino', $envio->fresh()->estado->estado);
        $this->assertSame($eta, $envio->fresh()->fecha_probable_llegada);
        $this->actingAs($client, 'usuarios');
        $this->get('/cliente/compras')->assertOk()->assertSee('En camino')->assertSee($eta);
        $this->get("/admin/pedidos/{$pedido->id}")->assertRedirect(route('cliente.home'));
        $this->actingAs($staff, 'usuarios');
        $this->post("/encargado/entregar/{$pedido->id}")->assertRedirect();
        $this->assertDatabaseHas('pedidos', [
            'id' => $pedido->id,
            'estado_pedido_id' => 3,
            'entregado' => 1,
            'fecha_llegada' => now()->toDateString(),
        ]);
        $this->assertSame('Entregado', $envio->fresh()->estado->estado);

        $this->get('/encargado')->assertOk()->assertSee($envio->nro_tracking)->assertSee('Entregado');
        $this->get("/encargado/pedidos/{$pedido->id}")->assertOk()->assertSee('Entregado');

        $this->actingAs($client, 'usuarios');
        $this->get('/cliente/compras')->assertOk()->assertSee('Entregado')->assertSee($envio->nro_tracking);
        $this->get("/cliente/factura/{$pedido->id}")->assertOk()->assertSee($envio->nro_tracking);
        $this->actingAs($this->user('cliente2@example.test'), 'usuarios');
        $this->get("/cliente/factura/{$pedido->id}")->assertNotFound();

        $this->actingAs($this->user('admin@example.test'), 'usuarios');
        $this->get("/admin/pedidos/{$pedido->id}")->assertOk()->assertSee($copy->libro->titulo)->assertSee($envio->nro_tracking);

        $stockAfterPurchase = $copy->fresh()->stock;
        $this->travel(31)->minutes();
        $this->get('/catalogo')->assertOk();
        $this->assertSame($stockAfterPurchase, $copy->fresh()->stock);
    }

    public function test_delivery_requires_dispatch_and_dispatch_date_cannot_be_past(): void
    {
        $client = $this->user('cliente@example.test');
        $this->actingAs($client, 'usuarios');
        $copy = Ejemplar::query()->where('stock', '>=', 1)->firstOrFail();
        $this->post('/cliente/pedido/add', ['id' => $copy->id, 'cantidad' => 1]);
        $pedido = Pedido::query()->where('usuario_id', $client->id)->where('estado_pedido_id', 1)->firstOrFail();
        $this->post('/cliente/pedido', ['preferencia_envio_id' => 1, 'empaquetado' => 0]);

        $this->actingAs($this->user('envios@example.test'), 'usuarios');
        $this->post("/encargado/entregar/{$pedido->id}")->assertSessionHasErrors('envio');
        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id, 'estado_pedido_id' => 2, 'entregado' => 0]);
        $this->post("/encargado/despachar/{$pedido->id}", [
            'fecha_probable_llegada' => now()->subDay()->toDateString(),
        ])->assertSessionHasErrors('fecha_probable_llegada');

        $this->post("/encargado/despachar/{$pedido->id}", [
            'fecha_probable_llegada' => now()->addDays(3)->toDateString(),
        ])->assertRedirect();
        $this->post("/encargado/despachar/{$pedido->id}", [
            'fecha_probable_llegada' => now()->addDays(3)->toDateString(),
        ])->assertSessionHasErrors('envio');
        $this->post("/encargado/entregar/{$pedido->id}")->assertRedirect();
        $this->post("/encargado/entregar/{$pedido->id}")->assertNotFound();
    }
}
