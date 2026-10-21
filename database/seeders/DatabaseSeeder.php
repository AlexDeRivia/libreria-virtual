<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PaisSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(NacionalidadSeeder::class);
        $this->call(PreferenciaEnvioSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(TipoTarjetaSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(AutorSeeder::class);
        $this->call(IdiomaSeeder::class);
        $this->call(EstadoPedidoSeeder::class);
        $this->call(EstadoEnvioSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(UsuarioEspecialidadSeeder::class);
        $this->call(LibroSeeder::class);
        $this->call(LibroEspecialidadSeeder::class);
        $this->call(LibroAutorSeeder::class);
        $this->call(EjemplarSeeder::class);
        if (config('demo.public_access')) {
            $this->call(PublicDemoOrderSeeder::class);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
