<?php

use App\Http\Controllers\Auth\RolController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tipo_RecursoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Registrar las rutas de autenticación
Auth::routes();

// Agrupar las rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Ruta para el menú de CRUDs
Route::get('/GDS', [DashboardController::class, 'showCrudMenu'])->name('crud.menu');
    // Rutas de recursos
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('cargos', CargoController::class);
    Route::resource('homes', HomeController::class);
    Route::resource('roles', RolController::class);
    Route::resource('estados', EstadoController::class);
    Route::resource('tipos', Tipo_RecursoController::class);

    Route::resource('roles', RolController::class);
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
    Route::get('/ventas', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/clientes', [ClientController::class, 'index'])->name('clients.index');






});
