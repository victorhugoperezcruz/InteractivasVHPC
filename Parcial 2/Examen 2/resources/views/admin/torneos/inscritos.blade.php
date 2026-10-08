<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
			<div>
				<h2 class="font-bold text-slate-900 dark:text-white">Inscritos · {{ $torneo->nombre }}</h2>
				<p class="text-sm text-slate-500 dark:text-slate-400">{{ $inscripciones->count() }} / {{ $torneo->cupo }} plazas ocupadas · {{ $torneo->fecha->format('d/m/Y H:i') }}</p>
			</div>
			<x-ui.boton variante="secundario" href="{{ route('admin.torneos.index') }}" class="!px-4 !py-2">Volver</x-ui.boton>
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="mx-auto max-w-5xl rounded-xl bg-white ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
				<div class="p-5">
					@if ($inscripciones->isEmpty())
						<div class="py-8 text-center">
							<p class="font-bold text-slate-900 dark:text-white">Aún no hay inscritos</p>
							<p class="text-sm text-slate-500 dark:text-slate-400">Cuando los jugadores se inscriban aparecerán en esta tabla.</p>
						</div>
					@else
						<div class="overflow-x-auto rounded-lg ring-1 ring-slate-200 dark:ring-slate-700">
							<table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-700">
								<thead class="bg-slate-900 dark:bg-slate-800">
									<tr>
										<th class="px-4 py-3 text-left font-bold text-white">Jugador</th>
										<th class="px-4 py-3 text-left font-bold text-white">Correo</th>
										<th class="px-4 py-3 text-left font-bold text-white">Fecha de registro</th>
										<th class="px-4 py-3 text-left font-bold text-white">Acción</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-700 dark:bg-slate-900">
									@foreach ($inscripciones as $inscripcion)
										<tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800">
											<td class="px-4 py-3 font-semibold text-slate-900 dark:text-white">{{ $inscripcion->user->name ?? 'Usuario eliminado' }}</td>
											<td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $inscripcion->user->email ?? '—' }}</td>
											<td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $inscripcion->created_at->format('d/m/Y H:i') }}</td>
											<td class="px-4 py-3">
												<button type="button" data-abrir-modal="modal-baja-{{ $inscripcion->id }}" class="rounded-lg bg-rose-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-rose-500">Dar de baja</button>
												<x-ui.modal id="modal-baja-{{ $inscripcion->id }}" titulo="Dar de baja" subtitulo="Se liberará la plaza de inmediato">
													<p class="text-sm text-slate-600 dark:text-slate-300">¿Seguro que deseas dar de baja a <strong>{{ $inscripcion->user->name ?? 'este participante' }}</strong> del torneo <strong>«{{ $torneo->nombre }}»</strong>?</p>
													<div class="mt-5 flex justify-end gap-2">
														<button type="button" data-cerrar-modal="modal-baja-{{ $inscripcion->id }}" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">Cancelar</button>
														<form method="POST" action="{{ route('admin.torneos.expulsar', [$torneo, $inscripcion->id]) }}">
															@csrf
															@method('DELETE')
															<button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-500">Sí, dar de baja</button>
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
