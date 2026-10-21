<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PublicDemoAccessTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        if (getenv('DB_DATABASE') !== 'libreria_virtual_test' || ! in_array(getenv('DB_HOST'), ['127.0.0.1', 'localhost'], true)) {
            throw new \RuntimeException('Estas pruebas requieren DB_DATABASE=libreria_virtual_test en MySQL local.');
        }

        parent::setUp();
    }

    public function test_each_public_role_opens_its_real_area_without_a_password(): void
    {
        config(['demo.public_access' => true]);

        foreach (['cliente' => '/cliente', 'especialista' => '/cliente', 'envios' => '/encargado', 'admin' => '/admin'] as $role => $area) {
            $this->post("/demo/entrar/{$role}")->assertRedirect($area);
            $this->assertSame(config("demo.roles.{$role}.email"), auth('usuarios')->user()->email);
            $this->get($area)->assertOk();
        }
    }

    public function test_public_access_is_opt_in_and_only_accepts_seeded_role_accounts(): void
    {
        config(['demo.public_access' => false]);
        $this->post('/demo/entrar/admin')->assertNotFound();
        $this->get('/login')->assertOk()->assertSee('Ingresa a tu biblioteca');

        config(['demo.public_access' => true]);
        $this->get('/')->assertOk()->assertSee('Explora los cuatro roles');
        $this->get('/login')->assertOk()->assertSee('Entrar como administración');
        $this->post('/demo/entrar/inexistente')->assertNotFound();

        $admin = Usuario::where('email', 'admin@example.test')->firstOrFail();
        $admin->update(['rol_id' => 2]);
        $this->post('/demo/entrar/admin')->assertStatus(503);
    }

    public function test_public_demo_prevents_new_personal_accounts(): void
    {
        config(['demo.public_access' => true]);
        $this->get('/register')->assertRedirect(route('home').'#explorar-demo');
        $this->post('/register', [])->assertForbidden();
    }

    public function test_reset_refuses_an_unapproved_database(): void
    {
        config(['demo.public_access' => true, 'demo.reset_database' => 'otra_base']);
        $this->artisan('demo:reset')->assertExitCode(1);
    }

    public function test_reset_refuses_accounts_outside_the_seeded_demo(): void
    {
        config(['demo.public_access' => true, 'demo.reset_database' => 'libreria_virtual_test']);
        Usuario::where('email', 'cliente@example.test')->firstOrFail()->replicate()
            ->fill(['email' => 'visitante@example.test'])
            ->save();

        $this->artisan('demo:reset')->assertExitCode(1);
        $this->assertDatabaseHas('usuarios', ['email' => 'visitante@example.test']);
    }
}
