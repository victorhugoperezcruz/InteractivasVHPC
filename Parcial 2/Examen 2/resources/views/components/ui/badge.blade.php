@props(['tipo' => 'info'])

@php
	$estilos = [
		'disponible' => 'bg-emerald-500/10 text-emerald-700 ring-emerald-600/20 dark:text-emerald-300',
		'cerrado' => 'bg-rose-500/10 text-rose-700 ring-rose-600/20 dark:text-rose-300',
		'inscrito' => 'bg-amber-500/15 text-amber-800 ring-amber-600/25 dark:text-amber-300',
		'admin' => 'bg-violet-600/10 text-violet-700 ring-violet-600/20 dark:text-violet-300',
		'jugador' => 'bg-teal-600/10 text-teal-700 ring-teal-600/20 dark:text-teal-300',
		'info' => 'bg-slate-500/10 text-slate-600 ring-slate-500/20 dark:text-slate-300',
		'abierto' => 'bg-emerald-500/10 text-emerald-700 ring-emerald-600/20 dark:text-emerald-300',
	];
	$clase = $estilos[$tipo] ?? $estilos['info'];
	$punto = [
		'disponible' => 'bg-emerald-500',
		'cerrado' => 'bg-rose-500',
		'inscrito' => 'bg-amber-500',
		'admin' => 'bg-violet-500',
		'jugador' => 'bg-teal-500',
		'info' => 'bg-slate-400',
		'abierto' => 'bg-emerald-500',
	][$tipo] ?? 'bg-slate-400';
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold ring-1 ' . $clase]) }}>
	<span class="h-1.5 w-1.5 rounded-full {{ $punto }}"></span>
	{{ $slot }}
</span>
