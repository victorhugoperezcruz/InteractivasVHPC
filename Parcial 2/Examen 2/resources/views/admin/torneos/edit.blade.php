<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
			<div>
				<h2 class="font-bold text-slate-900 dark:text-white">Editar torneo</h2>
				<p class="text-sm text-slate-500 dark:text-slate-400">{{ $torneo->nombre }} · {{ $torneo->inscripciones_count }} inscrito(s) actualmente.</p>
			</div>
			<x-ui.boton variante="secundario" href="{{ route('admin.torneos.index') }}" class="!px-4 !py-2">Volver</x-ui.boton>
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="mx-auto max-w-3xl rounded-xl bg-white ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
				<div class="p-5 sm:p-6">
					<div class="mb-5 rounded-lg bg-violet-600/10 px-4 py-3 text-sm text-violet-800 ring-1 ring-violet-600/20 dark:text-violet-300">
						Este torneo tiene <strong>{{ $torneo->inscripciones_count }}</strong> participante(s). No podrás reducir el cupo por debajo de ese número.
					</div>
					<form method="POST" action="{{ route('admin.torneos.update', $torneo) }}" class="space-y-5">
						@csrf
						@method('PUT')
						<div>
							<x-input-label for="nombre" value="Nombre del torneo *" />
							<x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $torneo->nombre)" required />
							<x-input-error :messages="$errors->get('nombre')" class="mt-2" />
						</div>
						<div>
							<x-input-label for="juego_deporte" value="Juego / Deporte *" />
							<x-text-input id="juego_deporte" name="juego_deporte" type="text" class="mt-1 block w-full" :value="old('juego_deporte', $torneo->juego_deporte)" required />
							<x-input-error :messages="$errors->get('juego_deporte')" class="mt-2" />
						</div>
						<div class="grid gap-5 sm:grid-cols-2">
							<div>
								<x-input-label for="fecha" value="Fecha y hora *" />
								<x-text-input id="fecha" name="fecha" type="datetime-local" class="mt-1 block w-full" :value="old('fecha', $torneo->fecha->format('Y-m-d\TH:i'))" required />
								<p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Debe ser una fecha futura.</p>
								<x-input-error :messages="$errors->get('fecha')" class="mt-2" />
							</div>
							<div>
								<x-input-label for="cupo" value="Cupo (2 a 100) *" />
								<x-text-input id="cupo" name="cupo" type="number" min="2" max="100" class="mt-1 block w-full" :value="old('cupo', $torneo->cupo)" required />
								<p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Mínimo permitido actual: {{ max(2, $torneo->inscripciones_count) }} por los inscritos.</p>
								<x-input-error :messages="$errors->get('cupo')" class="mt-2" />
							</div>
						</div>
						<div>
							<x-input-label for="descripcion" value="Descripción (opcional)" />
							<textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">{{ old('descripcion', $torneo->descripcion) }}</textarea>
							<x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
						</div>
						<div>
							<x-input-label for="estado" value="Estado *" />
							<select id="estado" name="estado" class="mt-1 block w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
								<option value="abierto" {{ old('estado', $torneo->estado) === 'abierto' ? 'selected' : '' }}>Abierto</option>
								<option value="cerrado" {{ old('estado', $torneo->estado) === 'cerrado' ? 'selected' : '' }}>Cerrado</option>
							</select>
							<x-input-error :messages="$errors->get('estado')" class="mt-2" />
						</div>
						<div class="flex justify-end gap-2">
							<x-ui.boton variante="secundario" href="{{ route('admin.torneos.index') }}">Cancelar</x-ui.boton>
							<x-ui.boton variante="primario">Actualizar torneo</x-ui.boton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
