<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rol; // Importa el modelo Rol

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verifica si el usuario tiene un rol y si el rol coincide
            if ($user->rol && $user->rol->nom_rol === $role) {
                return $next($request);
            }

            // Para depuración
            \Log::info('Rol de usuario no coincide: ' . ($user->rol ? $user->rol->nom_rol : 'Sin rol'));
        }

        // Si no tiene acceso, redirige o muestra un error
        return redirect('/no-autorizado');
    }
}
