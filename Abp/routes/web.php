<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\Tipo_RecursoController;




Route::get('/', function () {
    return view('welcome');
});

// Registrar las rutas de autenticación
Auth::routes();

// Agrupar las rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Rutas de recursos
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('cargos', CargoController::class);
    Route::resource('homes', HomeController::class);
    Route::resource('roles', RolController::class);
    Route::resource('estados', EstadoController::class);
    Route::resource('tipos', Tipo_RecursoController::class);





});
