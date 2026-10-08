<x-app-layout>
	<x-slot name="header">
		<div>
			<h2 class="font-bold text-slate-900 dark:text-white">Torneos disponibles</h2>
			<p class="text-sm text-slate-500 dark:text-slate-400">Explora los torneos abiertos con cupo y fecha futura.</p>
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
			<div class="rounded-xl bg-white p-4 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
				<form method="GET" action="{{ route('torneos.index') }}" class="flex flex-col gap-2 sm:flex-row">
					<input type="text" name="buscar" value="{{ $busqueda ?? '' }}" placeholder="Buscar por nombre o juego / deporte..." class="flex-1 rounded-lg border-slate-300 bg-white text-slate-900 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
					<x-ui.boton variante="primario">Buscar</x-ui.boton>
					@if (! empty($busqueda))
						<a href="{{ route('torneos.index') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">Limpiar</a>
					@endif
				</form>
				@if (! empty($busqueda))
					<p class="mt-2 text-sm text-slate-500">Mostrando resultados para: <strong>«{{ $busqueda }}»</strong> ({{ $torneos->count() }})</p>
				@endif
			</div>
			@if ($torneos->isEmpty())
				<div class="rounded-xl bg-white p-10 text-center ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
					<h3 class="font-bold text-slate-900 dark:text-white">No hay torneos disponibles por ahora</h3>
					<p class="mt-1 text-sm text-slate-500">Vuelve pronto o prueba con otra búsqueda.</p>
				</div>
			@else
				<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
					@foreach ($torneos as $torneo)
						@php
							$disponibles = $torneo->cupos_disponibles;
							$inscritos = $torneo->inscripciones_count ?? $torneo->inscripciones()->count();
							$porcentaje = $torneo->cupo > 0 ? round(($inscritos / $torneo->cupo) * 100) : 0;
						@endphp
						<article class="flex flex-col rounded-xl bg-white ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
							<div class="flex-1 space-y-3 p-5">
								<div class="flex items-center justify-between gap-2">
									<x-ui.badge tipo="disponible">Disponible</x-ui.badge>
									<span class="text-xs font-semibold text-slate-500">{{ $torneo->juego_deporte }}</span>
								</div>
								<h3 class="font-bold text-slate-900 dark:text-white">{{ $torneo->nombre }}</h3>
								<p class="line-clamp-2 text-sm text-slate-500">{{ $torneo->descripcion ?? 'Sin descripción. ¡Anímate a participar!' }}</p>
								<div class="rounded-lg bg-slate-50 p-3 text-sm text-slate-600 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700">
									<p>Fecha: {{ $torneo->fecha->format('d/m/Y H:i') }}</p>
									<p>Inscritos: {{ $inscritos }} / {{ $torneo->cupo }} · Libres: {{ $disponibles }}</p>
								</div>
								<div class="h-1.5 w-full rounded-full bg-slate-100 dark:bg-slate-800"><div class="h-1.5 rounded-full bg-violet-500" style="width: {{ $porcentaje }}%"></div></div>
							</div>
							<div class="p-5 pt-0">
								<x-ui.boton variante="primario" href="{{ route('torneos.show', $torneo) }}" class="w-full">Ver detalle</x-ui.boton>
							</div>
						</article>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</x-app-layout>
