<x-guest-layout>
	<div class="mb-5 text-center">
		<h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Elegir nueva contraseña</h2>
		<p class="text-sm text-slate-500 dark:text-slate-400">Escribe tu correo y tu nueva contraseña.</p>
	</div>
	<form method="POST" action="{{ route('password.store') }}" class="space-y-4">
		@csrf
		<input type="hidden" name="token" value="{{ $request->route('token') }}">
		<div>
			<x-input-label for="email" value="Correo electrónico" />
			<x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<div>
			<x-input-label for="password" value="Nueva contraseña" />
			<x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div>
			<x-input-label for="password_confirmation" value="Confirmar contraseña" />
			<x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
			<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
		</div>
		<x-ui.boton variante="primario" class="w-full">Guardar nueva contraseña</x-ui.boton>
	</form>
</x-guest-layout>
