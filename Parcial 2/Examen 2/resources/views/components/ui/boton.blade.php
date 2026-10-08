@props(['variante' => 'primario', 'href' => null, 'type' => 'submit'])

@php
	$estilos = [
		'primario' => 'bg-violet-600 text-white hover:bg-violet-500',
		'exito' => 'bg-teal-600 text-white hover:bg-teal-500',
		'peligro' => 'bg-rose-600 text-white hover:bg-rose-500',
		'aviso' => 'bg-amber-400 text-slate-950 hover:bg-amber-300',
		'secundario' => 'bg-white text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50 dark:bg-slate-800 dark:text-slate-100 dark:ring-slate-700 dark:hover:bg-slate-700',
		'fantasma' => 'bg-transparent text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800',
	];
	$clase = $estilos[$variante] ?? $estilos['primario'];
@endphp
@if ($href)
	<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold transition active:scale-[0.98] ' . $clase]) }}>{{ $slot }}</a>
@else
	<button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold transition active:scale-[0.98] ' . $clase]) }}>{{ $slot }}</button>
@endif
