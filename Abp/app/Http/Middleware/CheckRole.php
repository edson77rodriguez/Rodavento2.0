<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Verifica si el usuario tiene el rol requerido
            if (Auth::user()->rol->nom_rol === $role) {
                return $next($request);
            }
        }

        // Si no tiene acceso, redirige o muestra un error
        return redirect('/no-autorizado');
    }
}
