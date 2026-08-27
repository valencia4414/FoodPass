<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Verificar si el usuario tiene al menos uno de los roles autorizados
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
            if ($role === 'admin' && $user->isAdmin()) {
                return $next($request);
            }
            if (($role === 'restaurante' || $role === 'operador_restaurante') && $user->isRestaurante()) {
                return $next($request);
            }
            if ($role === 'beneficiario' && $user->isBeneficiario()) {
                return $next($request);
            }
            if ($role === 'cliente' && $user->isCliente()) {
                return $next($request);
            }
        }

        // Si no cumple con el rol
        if ($request->expectsJson()) {
            return response()->json(['message' => 'No autorizado. Permisos insuficientes.'], 403);
        }

        return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}
