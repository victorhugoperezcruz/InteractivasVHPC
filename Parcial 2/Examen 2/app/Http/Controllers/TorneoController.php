<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TorneoController extends Controller
{
	public function index(Request $request): View
	{
		$busqueda = $request->query('buscar');

		$query = Torneo::withCount('inscripciones')
			->where('estado', 'abierto')
			->where('fecha', '>', now())
			->orderBy('fecha', 'asc');

		if ($busqueda) {
			$query->where(function ($q) use ($busqueda) {
				$q->where('nombre', 'like', '%' . $busqueda . '%')
					->orWhere('juego_deporte', 'like', '%' . $busqueda . '%');
			});
		}

		$torneos = $query->get()->filter(function (Torneo $torneo) {
			return $torneo->cupos_disponibles > 0;
		})->values();

		return view('torneos.index', compact('torneos', 'busqueda'));
	}

	public function show(Torneo $torneo): View
	{
		$torneo->load(['inscripciones.user', 'participantes']);

		$yaInscrito = false;
		if (auth()->check()) {
			$yaInscrito = auth()->user()->estaInscritoEn($torneo);
		}

		return view('torneos.show', compact('torneo', 'yaInscrito'));
	}
}
