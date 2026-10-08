<x-guest-layout>
	<div class="mb-4 text-center">
		<h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Confirmar contraseña</h2>
		<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Esta es una zona segura. Confirma tu contraseña para continuar.</p>
	</div>
	<form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
		@csrf
		<div>
			<x-input-label for="password" value="Contraseña" />
			<x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" placeholder="Tu contraseña" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<x-ui.boton variante="primario" class="w-full">Confirmar</x-ui.boton>
	</form>
</x-guest-layout>
