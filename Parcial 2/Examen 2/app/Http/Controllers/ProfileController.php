<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
	public function edit(Request $request): View
	{
		$user = $request->user();
		$inscripciones = $user->inscripciones()->with('torneo')->latest()->take(6)->get();
		$proximos = $user->torneos()->where('fecha', '>', now())->orderBy('fecha')->take(3)->get();
		$historial = $user->torneos()->orderByDesc('inscripciones.created_at')->take(6)->get();
		$gestionados = collect();
		$totalInscritosGestion = 0;
		if ($user->role === 'admin') {
			$gestionados = Torneo::withCount('inscripciones')->orderByDesc('created_at')->take(5)->get();
			$totalInscritosGestion = $gestionados->sum('inscripciones_count');
		}
		return view('profile.edit', compact('user', 'inscripciones', 'proximos', 'historial', 'gestionados', 'totalInscritosGestion'));
	}

	public function update(ProfileUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile.edit')->with('success', 'Tus datos fueron actualizados correctamente.');
	}

	public function destroy(Request $request): RedirectResponse
	{
		$request->validateWithBag('userDeletion', [
			'password' => ['required', 'current_password'],
		], [
			'password.required' => 'Debes ingresar tu contraseña para eliminar la cuenta.',
			'password.current_password' => 'La contraseña ingresada no es correcta.',
		]);

		$user = $request->user();

		Auth::logout();

		$user->delete();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to('/')->with('success', 'Tu cuenta fue eliminada correctamente.');
	}
}
