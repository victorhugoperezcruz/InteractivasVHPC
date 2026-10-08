<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
			<div>
				<h2 class="font-bold text-slate-900 dark:text-white">Panel Admin · Torneos</h2>
				<p class="text-sm text-slate-500 dark:text-slate-400">Gestiona todos los torneos, cupos y participantes.</p>
			</div>
			<x-ui.boton variante="primario" href="{{ route('admin.torneos.create') }}">Crear torneo</x-ui.boton>
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="rounded-xl bg-white ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
				<div class="p-5">
					@if ($torneos->isEmpty())
						<div class="py-8 text-center">
							<p class="font-bold text-slate-900 dark:text-white">No hay torneos registrados</p>
							<p class="text-sm text-slate-500 dark:text-slate-400">Crea el primer torneo con el botón «Crear torneo».</p>
						</div>
					@else
						<div class="overflow-x-auto rounded-lg ring-1 ring-slate-200 dark:ring-slate-700">
							<table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
								<thead class="bg-slate-900 dark:bg-slate-800">
									<tr>
										<th class="px-4 py-3 text-left font-bold text-white">Nombre</th>
										<th class="px-4 py-3 text-left font-bold text-white">Juego / Deporte</th>
										<th class="px-4 py-3 text-left font-bold text-white">Fecha</th>
										<th class="px-4 py-3 text-left font-bold text-white">Cupo</th>
										<th class="px-4 py-3 text-left font-bold text-white">Estado</th>
										<th class="px-4 py-3 text-left font-bold text-white">Acciones</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-700 dark:bg-slate-900">
									@foreach ($torneos as $torneo)
										<tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800">
											<td class="px-4 py-3 font-bold text-slate-900 dark:text-white">{{ $torneo->nombre }}</td>
											<td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $torneo->juego_deporte }}</td>
											<td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $torneo->fecha->format('d/m/Y H:i') }}</td>
											<td class="px-4 py-3 font-semibold text-slate-700 dark:text-slate-200">{{ $torneo->inscripciones_count }} / {{ $torneo->cupo }}</td>
											<td class="px-4 py-3">
												@if ($torneo->is_closed)
													<x-ui.badge tipo="cerrado">Cerrado / Lleno</x-ui.badge>
												@else
													<x-ui.badge tipo="disponible">Abierto</x-ui.badge>
												@endif
											</td>
											<td class="px-4 py-3">
												<div class="flex flex-wrap gap-1.5">
													<a href="{{ route('torneos.show', $torneo) }}" class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">Ver</a>
													<a href="{{ route('admin.torneos.inscritos', $torneo) }}" class="rounded-lg bg-teal-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-teal-500">Inscritos</a>
													<a href="{{ route('admin.torneos.edit', $torneo) }}" class="rounded-lg bg-amber-400 px-3 py-1.5 text-xs font-bold text-slate-950 hover:bg-amber-300">Editar</a>
													<button type="button" data-abrir-modal="modal-eliminar-{{ $torneo->id }}" class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-rose-500">Eliminar</button>
												</div>
												<x-ui.modal id="modal-eliminar-{{ $torneo->id }}" titulo="Eliminar torneo" subtitulo="Esta acción no se puede deshacer">
													<p class="text-sm text-slate-600 dark:text-slate-300">¿Seguro que deseas eliminar el torneo <strong>«{{ $torneo->nombre }}»</strong>? También se eliminarán sus {{ $torneo->inscripciones_count }} inscripción(es).</p>
													<div class="mt-5 flex justify-end gap-2">
														<button type="button" data-cerrar-modal="modal-eliminar-{{ $torneo->id }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">Cancelar</button>
														<form method="POST" action="{{ route('admin.torneos.destroy', $torneo) }}">
															@csrf
															@method('DELETE')
															<button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-500">Sí, eliminar</button>
														</form>
													</div>
												</x-ui.modal>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
