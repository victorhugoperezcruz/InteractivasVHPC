<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
	public function handle(Request $request, Closure $next): Response
	{
		if (! Auth::check()) {
			return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al panel de administración.');
		}

		if (Auth::user()->role !== 'admin') {
			return redirect()->route('torneos.index')->with('error', 'Acceso denegado. Esta sección es solo para administradores.');
		}

		return $next($request);
	}
}
