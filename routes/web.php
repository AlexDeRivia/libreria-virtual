<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LibroController as AdminLibroController;
use App\Http\Controllers\Admin\AutorController as AdminAutorController;
use App\Http\Controllers\Admin\NacionalidadController as AdminNacionalidadController;
use App\Http\Controllers\Admin\EjemplarController as AdminEjemplarController;
use App\Http\Controllers\Admin\IdiomaController as AdminIdiomaController;
use App\Http\Controllers\Admin\PaisController as AdminPaisController;
use App\Http\Controllers\Admin\ProvinciaController as AdminProvinciaController;
use App\Http\Controllers\Admin\PreferenciaEnvioController as AdminPreferenciaEnvioController;
use App\Http\Controllers\Admin\UsuarioController as AdminUsuarioController;
use App\Http\Controllers\Admin\EspecialidadController as AdminEspecialidadController;
use App\Http\Controllers\Admin\PedidoController as AdminPedidoController;
use App\Http\Controllers\Cliente\HomeController as ClienteHomeController;
use App\Http\Controllers\Cliente\PedidoController as ClientePedidoController;
use App\Http\Controllers\Cliente\PerfilController as ClientePerfilController;
use App\Http\Controllers\Encargado\HomeController as EncargadoHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\Rol\Admin;
use App\Http\Middleware\Rol\Cliente;
use App\Http\Middleware\Rol\Encargado;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'app.home')->name('home');
Route::view('/nosotros', 'app.nosotros')->name('nosotros');
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{id}', [CatalogoController::class, 'show'])->name('catalogo.show');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'mostrarFormulario')->name('login');
    Route::post('/login', 'login')->middleware('throttle:5,1')->name('login.auth');
    Route::post('/logout', 'logout')->name('logout.auth');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'mostrarFormulario')->name('register');
    Route::post('/register', 'store')->middleware('throttle:5,1')->name('register.store');
    Route::get('/cargar-provincias', 'cargarProvincias')->name('cargar.provincias');
    Route::get('/cargar-especialidades', 'cargarEspecialidades')->name('cargar.especialidades');
});

Route::middleware(Admin::class)->group(function () {

    Route::controller(AdminHomeController::class)->group(function () {
        Route::get('/admin', 'home')->name('admin.home');
        Route::get('/admin/perfil', 'perfil')->name('admin.perfil');
    });

    Route::controller(AdminLibroController::class)->group(function () {
        Route::get('/admin/libros', 'index')->name('admin.libros');
        Route::get('/admin/libros/create', 'create')->name('admin.libros.create');
        Route::post('/admin/libros', 'store')->name('admin.libros.store');
        Route::get('/admin/libros/{libro}', 'show')->name('admin.libros.show');
        Route::get('/admin/libros/{libro}/edit', 'edit')->name('admin.libros.edit');
        Route::put('/admin/libros/{libro}', 'update')->name('admin.libros.update');
        Route::delete('/admin/libros/{libro}', 'destroy')->name('admin.libros.destroy');
    });

    Route::controller(AdminPedidoController::class)->group(function () {
        Route::get('/admin/pedidos', 'index')->name('admin.pedidos');
        Route::get('/admin/pedidos/{id}', 'show')->name('admin.pedidos.show');
    });

    Route::controller(AdminUsuarioController::class)->group(function () {
        Route::get('/admin/usuarios', 'index')->name('admin.usuarios');
    });
    
    Route::controller(AdminAutorController::class)->group(function () {
        Route::get('/admin/autores', 'index')->name('admin.autores');
        Route::get('/admin/autores/create', 'create')->name('admin.autores.create');
        Route::post('/admin/autores', 'store')->name('admin.autores.store');
        Route::get('/admin/autores/{autor}', 'show')->name('admin.autores.show');
        Route::get('/admin/autores/{autor}/edit', 'edit')->name('admin.autores.edit');
        Route::put('/admin/autores/{autor}', 'update')->name('admin.autores.update');
        Route::delete('/admin/autores/{autor}', 'destroy')->name('admin.autores.destroy');
    });

    Route::controller(AdminNacionalidadController::class)->group(function () {
        Route::get('/admin/nacionalidades', 'index')->name('admin.nacionalidades');
        Route::get('/admin/nacionalidades/create', 'create')->name('admin.nacionalidades.create');
        Route::post('/admin/nacionalidades', 'store')->name('admin.nacionalidades.store');
        Route::get('/admin/nacionalidades/{nacionalidad}', 'show')->name('admin.nacionalidades.show');
        Route::get('/admin/nacionalidades/{nacionalidad}/edit', 'edit')->name('admin.nacionalidades.edit');
        Route::put('/admin/nacionalidades/{nacionalidad}', 'update')->name('admin.nacionalidades.update');
        Route::delete('/admin/nacionalidades/{nacionalidad}', 'destroy')->name('admin.nacionalidades.destroy');
    });

    Route::controller(AdminPaisController::class)->group(function () {
        Route::get('/admin/paises', 'index')->name('admin.paises');
        Route::get('/admin/paises/create', 'create')->name('admin.paises.create');
        Route::post('/admin/paises', 'store')->name('admin.paises.store');
        Route::get('/admin/paises/{pais}', 'show')->name('admin.paises.show');
        Route::get('/admin/paises/{pais}/edit', 'edit')->name('admin.paises.edit');
        Route::put('/admin/paises/{pais}', 'update')->name('admin.paises.update');
        Route::delete('/admin/paises/{pais}', 'destroy')->name('admin.paises.destroy');
    });

    Route::controller(AdminProvinciaController::class)->group(function () {
        Route::get('/admin/provincias', 'index')->name('admin.provincias');
        Route::get('/admin/provincias/create', 'create')->name('admin.provincias.create');
        Route::post('/admin/provincias', 'store')->name('admin.provincias.store');
        Route::get('/admin/provincias/{provincia}', 'show')->name('admin.provincias.show');
        Route::get('/admin/provincias/{provincia}/edit', 'edit')->name('admin.provincias.edit');
        Route::put('/admin/provincias/{provincia}', 'update')->name('admin.provincias.update');
        Route::delete('/admin/provincias/{provincia}', 'destroy')->name('admin.provincias.destroy');
    });

    Route::controller(AdminIdiomaController::class)->group(function () {
        Route::get('/admin/idiomas', 'index')->name('admin.idiomas');
        Route::get('/admin/idiomas/create', 'create')->name('admin.idiomas.create');
        Route::post('/admin/idiomas', 'store')->name('admin.idiomas.store');
        Route::get('/admin/idiomas/{idioma}', 'show')->name('admin.idiomas.show');
        Route::get('/admin/idiomas/{idioma}/edit', 'edit')->name('admin.idiomas.edit');
        Route::put('/admin/idiomas/{idioma}', 'update')->name('admin.idiomas.update');
        Route::delete('/admin/idiomas/{idioma}', 'destroy')->name('admin.idiomas.destroy');
    });

    Route::controller(AdminEjemplarController::class)->group(function () {
        Route::get('/admin/ejemplares', 'index')->name('admin.ejemplares');
        Route::get('/admin/ejemplares/create', 'create')->name('admin.ejemplares.create');
        Route::post('/admin/ejemplares', 'store')->name('admin.ejemplares.store');
        Route::get('/admin/ejemplares/{ejemplar}', 'show')->name('admin.ejemplares.show');
        Route::get('/admin/ejemplares/{ejemplar}/edit', 'edit')->name('admin.ejemplares.edit');
        Route::put('/admin/ejemplares/{ejemplar}', 'update')->name('admin.ejemplares.update');
        Route::delete('/admin/ejemplares/{ejemplar}', 'destroy')->name('admin.ejemplares.destroy');
    });

    Route::controller(AdminEspecialidadController::class)->group(function () {
        Route::get('/admin/especialidades', 'index')->name('admin.especialidades');
        Route::get('/admin/especialidades/create', 'create')->name('admin.especialidades.create');
        Route::post('/admin/especialidades', 'store')->name('admin.especialidades.store');
        Route::get('/admin/especialidades/{especialidad}', 'show')->name('admin.especialidades.show');
        Route::get('/admin/especialidades/{especialidad}/edit', 'edit')->name('admin.especialidades.edit');
        Route::put('/admin/especialidades/{especialidad}', 'update')->name('admin.especialidades.update');
        Route::delete('/admin/especialidades/{especialidad}', 'destroy')->name('admin.especialidades.destroy');
    });

    Route::controller(AdminPreferenciaEnvioController::class)->group(function () {
        Route::get('/admin/preferenciasEnvio', 'index')->name('admin.preferenciasEnvio');
        Route::get('/admin/preferenciasEnvio/create', 'create')->name('admin.preferenciasEnvio.create');
        Route::post('/admin/preferenciasEnvio', 'store')->name('admin.preferenciasEnvio.store');
        Route::get('/admin/preferenciasEnvio/{preferencia_envio}', 'show')->name('admin.preferenciasEnvio.show');
        Route::get('/admin/preferenciasEnvio/{preferencia_envio}/edit', 'edit')->name('admin.preferenciasEnvio.edit');
        Route::put('/admin/preferenciasEnvio/{preferencia_envio}', 'update')->name('admin.preferenciasEnvio.update');
        Route::delete('/admin/preferenciasEnvio/{preferencia_envio}', 'destroy')->name('admin.preferenciasEnvio.destroy');
    });
});

Route::middleware(Cliente::class)->group(function () {

    Route::controller(ClienteHomeController::class)->group(function () {
        Route::get('/cliente', 'home')->name('cliente.home');
        Route::get('/cliente/ejemplar/{id}', 'ejemplar')->name('cliente.ejemplar');
        Route::get('/cliente/pedido', 'pedido')->name('cliente.pedido');
        Route::get('/cliente/compras', 'compras')->name('cliente.compras');
        Route::get('/cliente/factura/{id}', 'factura')->name('cliente.factura');
    });

    Route::controller(ClientePerfilController::class)->group(function () {
        Route::get('/cliente/perfil', 'index')->name('cliente.perfil');
        Route::get('/cliente/perfil/editar/', 'edit')->name('cliente.perfil.edit');
        Route::put('/cliente/perfil/editar/{usuario}', 'update')->name('cliente.perfil.update');
        Route::get('/cliente/perfil/especialidades', 'especialidades')->name('cliente.perfil.especialidades');
        Route::post('/cliente/perfil/especialidades', 'updateEspecialidades')->name('cliente.perfil.especialidades.update');
    });

    Route::controller(ClientePedidoController::class)->group(function () {
        Route::post('/cliente/pedido/clic', 'clic')->name('cliente.pedido.clic');
        Route::post('/cliente/pedido/add', 'add')->name('cliente.pedido.add');
        Route::post('/cliente/pedido', 'pay')->name('cliente.pedido.pay');
        Route::put('/cliente/pedido', 'update')->name('cliente.pedido.update');
        Route::delete('/cliente/pedido/{id}', 'destroy')->name('cliente.pedido.destroy');
    });
});

Route::middleware(Encargado::class)->group(function () {

    Route::controller(EncargadoHomeController::class)->group(function () {
        Route::get('/encargado', 'home')->name('encargado.home');
        Route::get('/encargado/pedidos/{id}', 'show')->name('encargado.pedidos.show');
        Route::post('/encargado/despachar/{id}', 'despachar')->name('encargado.despachar');
        Route::post('/encargado/entregar/{id}', 'entregar')->name('encargado.entregar');
    });
});

