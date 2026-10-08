<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
			<div>
				<h2 class="font-bold text-slate-900 dark:text-white">Mis torneos</h2>
				<p class="text-sm text-slate-500 dark:text-slate-400">Torneos en los que estás inscrito actualmente.</p>
			</div>
			@if (! $torneos->isEmpty())
				<x-ui.boton variante="primario" href="{{ route('torneos.index') }}">Explorar más torneos</x-ui.boton>
			@endif
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
			@if ($torneos->isEmpty())
				<div class="rounded-xl bg-white p-10 text-center ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
					<h3 class="font-bold text-slate-900 dark:text-white">Aún no estás inscrito en ningún torneo</h3>
					<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Explora los torneos disponibles y únete a tu favorito.</p>
					<div class="mt-5"><x-ui.boton variante="exito" href="{{ route('torneos.index') }}">Ver torneos disponibles</x-ui.boton></div>
				</div>
			@else
				<div class="grid gap-4 md:grid-cols-2">
					@foreach ($inscripciones as $inscripcion)
						@php $torneo = $inscripcion->torneo; @endphp
						@if ($torneo)
							<div class="rounded-xl border-l-4 border-teal-500 bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
								<div class="flex items-center justify-between gap-2">
									@if ($torneo->is_closed)
										<x-ui.badge tipo="cerrado">Cerrado / Lleno</x-ui.badge>
									@else
										<x-ui.badge tipo="disponible">Disponible</x-ui.badge>
									@endif
									<x-ui.badge tipo="inscrito">Inscrito</x-ui.badge>
								</div>
								<h3 class="mt-2 font-bold text-slate-900 dark:text-white">{{ $torneo->nombre }}</h3>
								<p class="text-sm text-slate-500 dark:text-slate-400">{{ $torneo->juego_deporte }} · {{ $torneo->fecha->format('d/m/Y H:i') }}</p>
								<p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Inscrito el {{ $inscripcion->created_at->format('d/m/Y H:i') }} · {{ $torneo->inscripciones->count() }}/{{ $torneo->cupo }} plazas ocupadas</p>
								<div class="mt-3 flex flex-wrap gap-2">
									<x-ui.boton variante="primario" href="{{ route('torneos.show', $torneo) }}" class="!px-4 !py-2">Ver detalle</x-ui.boton>
									@if ($torneo->fecha->gt(now()))
										<button type="button" data-abrir-modal="modal-cancelar-{{ $torneo->id }}" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-500">Cancelar inscripción</button>
									@else
										<span class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-500 dark:bg-slate-800 dark:text-slate-400">Evento finalizado</span>
									@endif
								</div>
							</div>
							@if ($torneo->fecha->gt(now()))
								<x-ui.modal id="modal-cancelar-{{ $torneo->id }}" titulo="Cancelar inscripción" subtitulo="Se liberará tu plaza de inmediato">
									<p class="text-sm text-slate-600 dark:text-slate-300">¿Seguro que deseas cancelar tu inscripción al torneo <strong>«{{ $torneo->nombre }}»</strong>? Podrás volver a inscribirte mientras haya cupo disponible.</p>
									<div class="mt-5 flex justify-end gap-2">
										<button type="button" data-cerrar-modal="modal-cancelar-{{ $torneo->id }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">Volver</button>
										<form method="POST" action="{{ route('mis-torneos.cancelar', $torneo) }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-500">Sí, cancelar</button>
										</form>
									</div>
								</x-ui.modal>
							@endif
						@endif
					@endforeach
				</div>
			@endif
		</div>
	</div>
</x-app-layout>
