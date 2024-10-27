<?php

use App\Http\Controllers\Auth\RolController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\T_habilidadController;
use App\Http\Controllers\DuracionController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;


Route::get('/', function () {
    return view('welcome');
});

// Registrar las rutas de autenticación
Auth::routes();

// Agrupar las rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
  
// Ruta para el menú de CRUDs
Route::get('/GDS', [DashboardController::class, 'showCrudMenu'])->name('crud.menu');
    // Rutas de recursos
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('homes', HomeController::class);
    Route::resource('roles', RolController::class);

    Route::resource('roles', RolController::class);
   



   // Ruta protegida solo para Administrador
Route::get('/admin', function () {
    return view('admin.dashboard');
    Route::resource('direcciones', DireccionController::class);
    Route::resource('t_habilidades', T_habilidadController::class);
    Route::resource('duraciones', DuracionController::class);

})->name('admin.dashboard')->middleware(CheckRole::class . ':Administrador');






// Ruta protegida solo para Supervisor
Route::get('/supervisor', function () {
    return view('supervisor.dashboard');
})->name('supervisor.dashboard')->middleware(CheckRole::class . ':Supervisor');

});

