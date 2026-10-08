@props(['titulo' => '', 'valor' => '', 'descripcion' => '', 'icono' => '🏆', 'acento' => 'violeta'])

@php
	$acentos = [
		'violeta' => 'border-violet-500 bg-violet-600',
		'ambar' => 'border-amber-400 bg-amber-400',
		'turquesa' => 'border-teal-500 bg-teal-600',
		'rosa' => 'border-rose-500 bg-rose-600',
		'gris' => 'border-slate-400 bg-slate-500',
	];
	$clase = $acentos[$acento] ?? $acentos['violeta'];
@endphp
<div class="rounded-xl border-l-4 {{ $clase }} bg-white p-5 shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
	<div class="flex items-start justify-between gap-3">
		<div>
			<p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">{{ $titulo }}</p>
			<p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $valor }}</p>
			<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $descripcion }}</p>
		</div>
		<span class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 text-xl dark:bg-slate-800">{{ $icono }}</span>
	</div>
	@if (trim($slot) !== '')
		<div class="mt-3">{{ $slot }}</div>
	@endif
</div>
