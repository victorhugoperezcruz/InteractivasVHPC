<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
	public function handle(Request $request, Closure $next, string $role): Response
	{
		if (! Auth::check()) {
			return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta sección.');
		}

		$user = Auth::user();

		if ($user->role !== $role) {
			if ($user->role === 'admin') {
				return redirect()->route('torneos.index')->with('error', 'No tienes permiso para acceder a esa sección.');
			}
			if ($role === 'admin') {
				return redirect()->route('torneos.index')->with('error', 'Acceso denegado. Esta sección es solo para administradores.');
			}
			return redirect()->route('torneos.index')->with('error', 'No tienes el rol necesario para realizar esta acción.');
		}

		return $next($request);
	}
}
