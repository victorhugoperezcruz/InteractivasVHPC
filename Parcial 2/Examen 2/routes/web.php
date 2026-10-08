<?php

use App\Http\Controllers\Admin\TorneoController as AdminTorneoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TorneoController;
use App\Models\Inscripcion;
use App\Models\Torneo;
use Illuminate\Support\Facades\Route;

Route::get('/', [TorneoController::class, 'index'])->name('inicio');

Route::get('/torneos', [TorneoController::class, 'index'])->name('torneos.index');
Route::get('/torneos/{torneo}', [TorneoController::class, 'show'])->name('torneos.show');

Route::get('/dashboard', function () {
	$usuario = auth()->user();
	$disponibles = Torneo::withCount('inscripciones')->where('estado', 'abierto')->where('fecha', '>', now())->orderBy('fecha', 'asc')->get()->filter(fn ($t) => $t->cupos_disponibles > 0)->values();
	$misInscripciones = $usuario->inscripciones()->with('torneo')->latest()->get();
	$proximosSiete = $disponibles->filter(fn ($t) => $t->fecha->lt(now()->addDays(7)))->count();
	$totalTorneos = Torneo::count();
	$totalInscritos = Inscripcion::count();
	$proximo = $disponibles->first();
	$cupoTotal = Torneo::sum('cupo');
	$ocupacion = $cupoTotal > 0 ? round(($totalInscritos / $cupoTotal) * 100) : 0;
	$topOcupacion = Torneo::withCount('inscripciones')->orderByDesc('inscripciones_count')->take(5)->get();
	$casiLlenos = Torneo::withCount('inscripciones')->get()->filter(fn ($t) => ! $t->is_closed && $t->cupo > 0 && (($t->inscripciones_count / $t->cupo) >= 0.8))->values();
	$ultimoJuego = $misInscripciones->first()?->torneo?->juego_deporte;
	$recomendados = $disponibles->when($ultimoJuego, fn ($c) => $c->sortByDesc(fn ($t) => $t->juego_deporte === $ultimoJuego))->reject(fn ($t) => $usuario->estaInscritoEn($t))->take(3)->values();
	if ($recomendados->isEmpty()) {
		$recomendados = $disponibles->reject(fn ($t) => $usuario->estaInscritoEn($t))->take(3)->values();
	}
	$nivel = min(5, intdiv($misInscripciones->count(), 2) + 1);
	$progresoNivel = min(100, ($misInscripciones->count() % 2) * 50 + ($misInscripciones->count() > 0 ? 50 : 0));
	return view('dashboard', compact('usuario', 'disponibles', 'misInscripciones', 'totalTorneos', 'totalInscritos', 'proximo', 'proximosSiete', 'ocupacion', 'topOcupacion', 'casiLlenos', 'recomendados', 'nivel', 'progresoNivel'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:jugador'])->group(function () {
	Route::post('/torneos/{torneo}/inscribir', [InscripcionController::class, 'inscribir'])->name('torneos.inscribir');
	Route::get('/mis-torneos', [InscripcionController::class, 'misTorneos'])->name('mis-torneos');
	Route::delete('/mis-torneos/{torneo}/cancelar', [InscripcionController::class, 'cancelar'])->name('mis-torneos.cancelar');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
	Route::get('/torneos', [AdminTorneoController::class, 'index'])->name('torneos.index');
	Route::get('/torneos/crear', [AdminTorneoController::class, 'create'])->name('torneos.create');
	Route::post('/torneos', [AdminTorneoController::class, 'store'])->name('torneos.store');
	Route::get('/torneos/{torneo}/editar', [AdminTorneoController::class, 'edit'])->name('torneos.edit');
	Route::put('/torneos/{torneo}', [AdminTorneoController::class, 'update'])->name('torneos.update');
	Route::delete('/torneos/{torneo}', [AdminTorneoController::class, 'destroy'])->name('torneos.destroy');
	Route::get('/torneos/{torneo}/inscritos', [AdminTorneoController::class, 'inscritos'])->name('torneos.inscritos');
	Route::delete('/torneos/{torneo}/inscritos/{inscripcion}', [AdminTorneoController::class, 'expulsar'])->name('torneos.expulsar');
});

require __DIR__.'/auth.php';
