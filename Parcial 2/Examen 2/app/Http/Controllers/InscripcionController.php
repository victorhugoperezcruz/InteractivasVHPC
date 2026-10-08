<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InscripcionController extends Controller
{
	public function inscribir(Torneo $torneo): RedirectResponse
	{
		$user = auth()->user();

		if (! $user || $user->role !== 'jugador') {
			return redirect()->route('torneos.show', $torneo)->with('error', 'Solo los jugadores pueden inscribirse a torneos.');
		}

		if ($user->estaInscritoEn($torneo)) {
			return redirect()->route('torneos.show', $torneo)->with('error', 'Ya estás inscrito en este torneo.');
		}

		if ($torneo->estado === 'cerrado') {
			return redirect()->route('torneos.show', $torneo)->with('error', 'No puedes inscribirte porque el torneo está cerrado.');
		}

		if ($torneo->fecha->lt(now())) {
			return redirect()->route('torneos.show', $torneo)->with('error', 'No puedes inscribirte porque la fecha del torneo ya pasó.');
		}

		if ($torneo->inscripciones()->count() >= (int) $torneo->cupo) {
			return redirect()->route('torneos.show', $torneo)->with('error', 'No puedes inscribirte porque el cupo está lleno.');
		}

		$user->inscripciones()->create([
			'torneo_id' => $torneo->id,
		]);

		return redirect()->route('torneos.show', $torneo)->with('success', 'Te has inscrito correctamente al torneo «' . $torneo->nombre . '».');
	}

	public function misTorneos(): View
	{
		$user = auth()->user();

		$inscripciones = $user->inscripciones()->with('torneo.inscripciones')->orderByDesc('created_at')->get();
		$torneos = $inscripciones->map(fn ($i) => $i->torneo)->filter();

		return view('jugador.mis-torneos', compact('inscripciones', 'torneos'));
	}

	public function cancelar(Torneo $torneo): RedirectResponse
	{
		$user = auth()->user();

		$inscripcion = $user->inscripciones()->where('torneo_id', $torneo->id)->first();

		if (! $inscripcion) {
			return redirect()->route('mis-torneos')->with('error', 'No tienes inscripción en este torneo.');
		}

		if ($torneo->fecha->lt(now())) {
			return redirect()->route('mis-torneos')->with('error', 'No puedes cancelar la inscripción porque la fecha del torneo ya pasó.');
		}

		$inscripcion->delete();

		return redirect()->route('mis-torneos')->with('success', 'Tu inscripción al torneo «' . $torneo->nombre . '» fue cancelada y la plaza quedó liberada.');
	}
}
