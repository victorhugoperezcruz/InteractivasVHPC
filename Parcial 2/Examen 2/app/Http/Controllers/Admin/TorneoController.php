<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTorneoRequest;
use App\Http\Requests\UpdateTorneoRequest;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TorneoController extends Controller
{
	public function index(): View
	{
		$torneos = Torneo::withCount('inscripciones')->orderBy('fecha', 'asc')->get();

		return view('admin.torneos.index', compact('torneos'));
	}

	public function create(): View
	{
		return view('admin.torneos.create');
	}

	public function store(StoreTorneoRequest $request): RedirectResponse
	{
		$torneo = Torneo::create($request->validated());

		return redirect()->route('admin.torneos.index')->with('success', 'Torneo «' . $torneo->nombre . '» creado correctamente.');
	}

	public function edit(Torneo $torneo): View
	{
		$torneo->loadCount('inscripciones');

		return view('admin.torneos.edit', compact('torneo'));
	}

	public function update(UpdateTorneoRequest $request, Torneo $torneo): RedirectResponse
	{
		$torneo->update($request->validated());

		return redirect()->route('admin.torneos.index')->with('success', 'Torneo «' . $torneo->nombre . '» actualizado correctamente.');
	}

	public function destroy(Torneo $torneo): RedirectResponse
	{
		$nombre = $torneo->nombre;
		$torneo->delete();

		return redirect()->route('admin.torneos.index')->with('success', 'Torneo «' . $nombre . '» eliminado correctamente junto con sus inscripciones.');
	}

	public function inscritos(Torneo $torneo): View
	{
		$torneo->load(['inscripciones.user']);
		$inscripciones = $torneo->inscripciones()->with('user')->orderBy('created_at', 'asc')->get();

		return view('admin.torneos.inscritos', compact('torneo', 'inscripciones'));
	}

	public function expulsar(Torneo $torneo, int $inscripcion): RedirectResponse
	{
		$inscripcion = $torneo->inscripciones()->where('id', $inscripcion)->first();

		if (! $inscripcion) {
			return redirect()->route('admin.torneos.inscritos', $torneo)->with('error', 'La inscripción no existe o ya fue eliminada.');
		}

		$nombreJugador = $inscripcion->user?->name ?? 'participante';
		$inscripcion->delete();

		return redirect()->route('admin.torneos.inscritos', $torneo)->with('success', 'El jugador «' . $nombreJugador . '» fue dado de baja del torneo.');
	}
}
