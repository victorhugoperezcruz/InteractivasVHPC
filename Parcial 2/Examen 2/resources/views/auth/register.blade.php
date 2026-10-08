<x-guest-layout>
	<div class="mb-5 text-center">
		<h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Crear cuenta de jugador</h2>
		<p class="text-sm text-slate-500 dark:text-slate-400">Regístrate gratis y empieza a competir.</p>
	</div>
	<form method="POST" action="{{ route('register') }}" class="space-y-4">
		@csrf
		<div>
			<x-input-label for="name" value="Nombre completo" />
			<x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ej: Ana Pérez" />
			<x-input-error :messages="$errors->get('name')" class="mt-2" />
		</div>
		<div>
			<x-input-label for="email" value="Correo electrónico" />
			<x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="tucorreo@ejemplo.com" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<div>
			<x-input-label for="password" value="Contraseña" />
			<x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div>
			<x-input-label for="password_confirmation" value="Confirmar contraseña" />
			<x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña" />
			<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
		</div>
		<x-ui.boton variante="exito" class="w-full">Registrarme</x-ui.boton>
		<p class="text-center text-sm text-slate-500 dark:text-slate-400">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="font-bold text-violet-600 hover:underline dark:text-violet-400">Inicia sesión</a></p>
	</form>
</x-guest-layout>
