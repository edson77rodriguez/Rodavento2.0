<?php

use App\Http\Controllers\Auth\RolController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\T_habilidadController;
use App\Http\Controllers\DuracionController;
use App\Http\Controllers\Estado_actividadController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\T_MantenimientoController;
use App\Http\Controllers\Estado_equipoController;
use App\Http\Controllers\AreaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\AsignarGuiaController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\Asignar_actividadesController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MantenimientoController;



Route::resource('equipos', EquipoController::class);
Route::resource('materiales', MaterialController::class);
Route::resource('mantenimientos', MantenimientoController::class);



Route::resource('roles', RolePermissionController::class);

Route::get('/roles-permissions', [RolePermissionController::class, 'showAssignForm'])->name('assign.form');
Route::post('/roles-permissions', [RolePermissionController::class, 'assignPermissions'])->name('assign.permissions');
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/roles-permissions', [RolePermissionController::class, 'showAssignForm'])->name('assign.form');
    Route::post('/roles-permissions', [RolePermissionController::class, 'assignPermissions'])->name('assign.permissions');
});


Route::get('/', function () {
    return view('welcome');
});

// Registrar las rutas de autenticación
Auth::routes();

// Agrupar las rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
    Route::get('/assign-user-roles', [UserRoleController::class, 'assignRoles']);
// Ruta para el menú de CRUDs
Route::get('/GDS', [DashboardController::class, 'showCrudMenu'])->name('crud.menu');
Route::get('/GDG', [DashboardController::class, 'showGuias'])->name('guia.menu');
Route::get('/GDA', [DashboardController::class, 'showActividades'])->name('actividad.menu');
    Route::get('/GDE', [DashboardController::class, 'showequipos'])->name('equipos.menu');
    Route::get('/GDAC', [DashboardController::class, 'gestiondeareas'])->name('areas.menu');
    Route::get('encargados/asignar/{user}', [EncargadoController::class, 'asignarVista'])->name('encargados.asignar');
    Route::post('encargados/asignar/{user}', [EncargadoController::class, 'asignarArea'])->name('encargados.asignar.area');
    Route::get('/encargados/asignar/{userId}', [EncargadoController::class, 'showAsignarArea'])->name('encargados.asignar');
    Route::get('supervisores/asignar/{user}', [SupervisorController::class, 'asignarVista'])->name('supervisores.asignar');
    Route::post('supervisores/asignar/{user}', [SupervisorController::class, 'asignarArea'])->name('supervisores.asignar.area');
    Route::get('/supervisores/asignar/{userId}', [SupervisorController::class, 'showAsignarArea'])->name('supervisores.asignar');
    Route::resource('supervisores', SupervisorController::class);

// Rutas para la gestión de roles


// Rutas para la gestión de permisos
Route::resource('permissions', PermissionController::class);
    // Rutas de recursos
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('homes', HomeController::class);
     // Gestión de Roles
     Route::prefix('roles')->group(function () {
        Route::get('/', [RolController::class, 'index'])->name('roles.index');
        Route::get('/create', [RolController::class, 'create'])->name('roles.create');
        Route::post('/', [RolController::class, 'store'])->name('roles.store');
        Route::get('/{id}/edit', [RolController::class, 'edit'])->name('roles.edit');
        Route::put('/{id}', [RolController::class, 'update'])->name('roles.update');
        Route::delete('/{id}', [RolController::class, 'destroy'])->name('roles.destroy');
    });
     // Gestión de Usuarios
     Route::resource('users', UserController::class);
     Route::resource('encargados', EncargadoController::class);

    Route::resource('roles', RolController::class);
    Route::resource('direcciones', DireccionController::class);
    Route::resource('t_habilidades', T_habilidadController::class);
    Route::resource('duraciones', DuracionController::class);
    Route::resource('e_actividades', Estado_actividadController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('t_mantenimientos', T_MantenimientoController::class);
    Route::resource('e_equipos', Estado_equipoController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('habilidades', HabilidadController::class);
    Route::resource('actividades', ActividadController::class);
    Route::resource('asignar_actividades', Asignar_actividadesController::class);

Route::resource('asignar_guias', AsignarGuiaController::class);
   // Ruta protegida solo para Administrador
Route::get('/admin', function () {
    return view('admin.dashboard');


})->name('admin.dashboard');






// Ruta protegida solo para Supervisor
Route::get('/supervisor', function () {
    return view('supervisor.dashboard');
})->name('supervisor.dashboard')->middleware(CheckRole::class . ':Supervisor');





});

