<section class="space-y-5">
	<header>
		<h2 class="text-lg font-bold text-slate-900 dark:text-white">Eliminar cuenta</h2>
		<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Al eliminar tu cuenta se borrarán tus inscripciones de forma permanente. Descarga antes cualquier información que quieras conservar.</p>
	</header>
	<button type="button" data-abrir-modal="modal-eliminar-cuenta" class="rounded-lg bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-500">Eliminar mi cuenta</button>
	<x-ui.modal id="modal-eliminar-cuenta" titulo="¿Eliminar tu cuenta?" subtitulo="Esta acción no se puede deshacer">
		<form method="post" action="{{ route('profile.destroy') }}">
			@csrf
			@method('delete')
			<p class="text-sm text-slate-600 dark:text-slate-300">Tus torneos e inscripciones se eliminarán para siempre. Escribe tu contraseña para confirmar.</p>
			<div class="mt-4">
				<x-input-label for="password" value="Contraseña" class="sr-only" />
				<x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="Tu contraseña" />
				<x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
			</div>
			<div class="mt-6 flex justify-end gap-2">
				<button type="button" data-cerrar-modal="modal-eliminar-cuenta" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">Cancelar</button>
				<button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-500">Sí, eliminar</button>
			</div>
		</form>
	</x-ui.modal>
</section>
