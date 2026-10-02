<x-guest-layout>
	<div class="text-center mb-6">
		<h1 class="text-2xl font-black text-stone-900">Bienvenido de nuevo</h1>
		<p class="text-sm text-stone-500 mt-1">Inicia sesión para ver tu recetario</p>
	</div>
	<x-auth-session-status class="mb-4" :status="session('status')" />
	<form method="POST" action="{{ route('login') }}">
		@csrf
		<div>
			<x-input-label for="email" :value="__('Correo electrónico')" />
			<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<div class="mt-4">
			<x-input-label for="password" :value="__('Contraseña')" />
			<x-campo-password id="password" name="password" class="mt-1" autocomplete="current-password" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div class="block mt-4">
			<label for="remember_me" class="inline-flex items-center">
				<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500" name="remember">
				<span class="ms-2 text-sm text-gray-600">Recuérdame</span>
			</label>
		</div>
		<div class="mt-6">
			<x-primary-button class="w-full justify-center bg-orange-600 hover:bg-orange-700 focus:bg-orange-700 focus:ring-orange-500">
				Iniciar sesión
			</x-primary-button>
		</div>
		<div class="flex items-center justify-center mt-4 text-sm">
			<a class="underline text-gray-600 hover:text-gray-900 font-bold" href="{{ route('register') }}">
				Crear cuenta
			</a>
		</div>
		<p class="text-center text-sm text-gray-500 mt-4">
			¿No tienes cuenta?
			<a href="{{ route('register') }}" class="font-bold text-orange-700 hover:text-orange-800">Regístrate gratis aquí</a>
		</p>
	</form>
</x-guest-layout>
