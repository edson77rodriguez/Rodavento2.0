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
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Asignar_EquipoController;


Route::get('/', function () {
    return view('welcome');
});
// En routes/web.php, asegúrate de que el middleware se aplique correctamente si es necesario
Route::middleware(['auth', 'check_if_approved'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    

});
Route::post('/users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
Route::post('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::patch('/users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
Route::resource('admin/users', UserController::class);
Route::get('users/index2', [UserController::class, 'index2'])->name('admin.users.index2');
// Authentication Routes
Auth::routes();

// Awaiting approval route
Route::get('/awaiting-approval', function () {
    return view('auth.awaiting-approval');
})->name('awaiting-approval');

// Grouping Routes that Require Authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('/assign-user-roles', [UserRoleController::class, 'assignRoles']);

    // CRUD Menu Routes
    Route::get('/GDS', [DashboardController::class, 'showCrudMenu'])->name('crud.menu');
    Route::get('/GDG', [DashboardController::class, 'showGuias'])->name('guia.menu');
    Route::get('/GDA', [DashboardController::class, 'showActividades'])->name('actividad.menu');
    Route::get('/GDE', [DashboardController::class, 'showequipos'])->name('equipos.menu');
    Route::get('/GDAC', [DashboardController::class, 'gestiondeareas'])->name('areas.menu');

    // Encargados Routes
    Route::resource('encargados', EncargadoController::class);
    Route::get('encargados/asignar/{user}', [EncargadoController::class, 'asignarVista'])->name('encargados.asignar');
    Route::post('encargados/asignar/{user}', [EncargadoController::class, 'asignarArea'])->name('encargados.asignar.area');

    // Supervisores Routes
    Route::resource('supervisores', SupervisorController::class);
    Route::get('supervisores/asignar/{user}', [SupervisorController::class, 'asignarVista'])->name('supervisores.asignar');
    Route::post('supervisores/asignar/{user}', [SupervisorController::class, 'asignarArea'])->name('supervisores.asignar.area');

    // Resource Routes
    Route::resources([
        'equipos' => EquipoController::class,
        'materiales' => MaterialController::class,
        'mantenimientos' => MantenimientoController::class,
        'roles' => RolController::class,
        'direcciones' => DireccionController::class,
        't_habilidades' => T_habilidadController::class,
        'duraciones' => DuracionController::class,
        'e_actividades' => Estado_actividadController::class,
        'categorias' => CategoriaController::class,
        't_mantenimientos' => T_MantenimientoController::class,
        'e_equipos' => Estado_equipoController::class,
        'areas' => AreaController::class,
        'habilidades' => HabilidadController::class,
        'actividades' => ActividadController::class,
        'asignar_actividades' => Asignar_actividadesController::class,
        'asignar_guias' => AsignarGuiaController::class,
        'asignar_equipos' => Asignar_EquipoController::class,

        'users' => UserController::class,
    ]);
    // Roles and Permissions
    Route::get('/roles-permissions', [RolePermissionController::class, 'showAssignForm'])->name('assign.form');
    Route::post('/roles-permissions', [RolePermissionController::class, 'assignPermissions'])->name('assign.permissions');
    
    Route::middleware(['role:admin'])->group(function() {
        Route::resource('permissions', PermissionController::class);
    });

    // Admin and Supervisor Dashboards
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/supervisor', function () {
        return view('supervisor.dashboard');
    })->name('supervisor.dashboard')->middleware(CheckRole::class . ':Supervisor');
});

