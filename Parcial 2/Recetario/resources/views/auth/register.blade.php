<x-guest-layout>
	<div class="text-center mb-6">
		<h1 class="text-2xl font-black text-stone-900">Crea tu cuenta</h1>
		<p class="text-sm text-stone-500 mt-1">Gratis y en menos de un minuto</p>
	</div>
	<form method="POST" action="{{ route('register') }}">
		@csrf
		<div>
			<x-input-label for="name" :value="__('Nombre')" />
			<x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
			<x-input-error :messages="$errors->get('name')" class="mt-2" />
		</div>
		<div class="mt-4">
			<x-input-label for="email" :value="__('Correo electrónico')" />
			<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<div class="mt-4">
			<x-input-label for="password" :value="__('Contraseña (mínimo 8 caracteres)')" />
			<x-campo-password id="password" name="password" contador minimo="8" class="mt-1" autocomplete="new-password" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div class="mt-4">
			<x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
			<x-campo-password id="password_confirmation" name="password_confirmation" class="mt-1" autocomplete="new-password" />
			<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
		</div>
		<div class="mt-6">
			<x-primary-button class="w-full justify-center bg-orange-600 hover:bg-orange-700 focus:bg-orange-700 focus:ring-orange-500">
				Crear cuenta
			</x-primary-button>
		</div>
		<p class="text-center text-sm text-gray-500 mt-4">
			¿Ya tienes cuenta?
			<a class="font-bold text-orange-700 hover:text-orange-800" href="{{ route('login') }}">
				Inicia sesión aquí
			</a>
		</p>
	</form>
</x-guest-layout>
