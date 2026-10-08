<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
			<div>
				<h2 class="font-bold text-slate-900 dark:text-white">{{ $torneo->nombre }}</h2>
				<p class="text-sm text-slate-500 dark:text-slate-400">{{ $torneo->juego_deporte }} · {{ $torneo->fecha->format('d/m/Y H:i') }}</p>
			</div>
			<x-ui.boton variante="secundario" href="{{ route('torneos.index') }}" class="!px-4 !py-2">Volver</x-ui.boton>
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
			<div class="grid gap-5 lg:grid-cols-3">
				<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 lg:col-span-2">
					<div class="flex flex-wrap items-center gap-2">
						@if ($torneo->is_closed)
							<x-ui.badge tipo="cerrado">Cerrado / Lleno</x-ui.badge>
						@else
							<x-ui.badge tipo="disponible">Disponible</x-ui.badge>
						@endif
						<x-ui.badge tipo="info">{{ $torneo->estado === 'abierto' ? 'Abierto' : 'Cerrado' }}</x-ui.badge>
						<x-ui.badge tipo="admin">{{ $torneo->juego_deporte }}</x-ui.badge>
					</div>
					<h3 class="mt-3 font-bold text-slate-900 dark:text-white">{{ $torneo->nombre }}</h3>
					<p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ $torneo->descripcion ?? 'Este torneo aún no tiene descripción.' }}</p>
					<dl class="mt-4 grid gap-3 rounded-xl bg-slate-50 p-4 text-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700 sm:grid-cols-2">
						<div><dt class="font-semibold text-slate-500">Fecha</dt><dd class="font-semibold text-slate-900 dark:text-white">{{ $torneo->fecha->format('d/m/Y H:i') }}</dd></div>
						<div><dt class="font-semibold text-slate-500">Cupo</dt><dd class="font-semibold">{{ $torneo->inscripciones->count() }} / {{ $torneo->cupo }}</dd></div>
						<div><dt class="font-semibold text-slate-500">Plazas libres</dt><dd class="font-semibold">{{ $torneo->cupos_disponibles }}</dd></div>
						<div><dt class="font-semibold text-slate-500">Estado</dt><dd class="font-semibold">{{ $torneo->is_closed ? 'No disponible' : 'Disponible' }}</dd></div>
					</dl>
					@if ($torneo->is_closed)
						<p class="mt-3 rounded-lg bg-rose-500/10 px-3 py-2 text-sm font-semibold text-rose-700 ring-1 ring-rose-500/20 dark:text-rose-300">{{ $torneo->motivoNoDisponible() }}</p>
					@endif
					<div class="mt-4">
						@guest
							<p class="rounded-lg bg-slate-100 px-3 py-2.5 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-200"><strong>¿Quieres participar?</strong> <a href="{{ route('login') }}" class="font-bold text-violet-600 underline">Inicia sesión</a> o <a href="{{ route('register') }}" class="font-bold underline">regístrate</a>.</p>
						@endguest
						@auth
							@if (auth()->user()->role === 'admin')
								<div class="flex flex-wrap gap-2">
									<x-ui.boton variante="aviso" href="{{ route('admin.torneos.edit', $torneo) }}">Editar torneo</x-ui.boton>
									<x-ui.boton variante="primario" href="{{ route('admin.torneos.inscritos', $torneo) }}">Ver inscritos</x-ui.boton>
								</div>
							@elseif (auth()->user()->role === 'jugador')
								@if ($yaInscrito)
									<div class="rounded-lg bg-amber-400/10 px-3 py-2.5 text-sm ring-1 ring-amber-400/30">
										<p><x-ui.badge tipo="inscrito">Inscrito</x-ui.badge> <strong>Ya estás inscrito.</strong></p>
										@if ($torneo->fecha->gt(now()))
											<button type="button" data-abrir-modal="modal-cancelar-detalle" class="mt-2 rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-500">Cancelar mi inscripción</button>
											<x-ui.modal id="modal-cancelar-detalle" titulo="Cancelar inscripción" subtitulo="Se liberará tu plaza">
												<p class="text-sm text-slate-600 dark:text-slate-300">¿Confirmas la cancelación en <strong>«{{ $torneo->nombre }}»</strong>?</p>
												<div class="mt-4 flex justify-end gap-2">
													<button type="button" data-cerrar-modal="modal-cancelar-detalle" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold dark:bg-slate-800">Volver</button>
													<form method="POST" action="{{ route('mis-torneos.cancelar', $torneo) }}">
														@csrf
														@method('DELETE')
														<button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white">Sí, cancelar</button>
													</form>
												</div>
											</x-ui.modal>
										@endif
									</div>
								@else
									@if ($torneo->is_closed)
										<p class="rounded-lg bg-slate-100 px-3 py-2.5 text-sm font-semibold text-slate-500 dark:bg-slate-800">No disponible: {{ $torneo->motivoNoDisponible() }}</p>
									@else
										<form method="POST" action="{{ route('torneos.inscribir', $torneo) }}">
											@csrf
											<x-ui.boton variante="exito">Inscribirme ahora</x-ui.boton>
										</form>
									@endif
								@endif
							@endif
						@endauth
					</div>
				</div>
				<div class="rounded-xl bg-white ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
					<div class="border-b border-slate-200 px-5 py-3 dark:border-slate-800">
						<h4 class="font-bold text-slate-900 dark:text-white">Participantes ({{ $torneo->participantes->count() }})</h4>
					</div>
					<div class="p-5">
						@if ($torneo->participantes->isEmpty())
							<p class="text-sm text-slate-500">Aún no hay participantes.</p>
						@else
							<ul class="divide-y divide-slate-100 dark:divide-slate-800">
								@foreach ($torneo->participantes as $participante)
									<li class="flex items-center gap-3 py-2">
										<span class="flex h-8 w-8 items-center justify-center rounded-md bg-slate-900 text-xs font-bold text-white dark:bg-slate-700">{{ strtoupper(substr($participante->name, 0, 1)) }}</span>
										<div><p class="text-sm font-semibold">{{ $participante->name }}</p><p class="text-xs text-slate-500">{{ $participante->pivot->created_at->format('d/m/Y') }}</p></div>
									</li>
								@endforeach
							</ul>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
