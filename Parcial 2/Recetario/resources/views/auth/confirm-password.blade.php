<x-guest-layout>
	<div class="mb-4 text-sm text-stone-600">
		Esta es una zona segura. Confirma tu contraseña antes de continuar.
	</div>
	<form method="POST" action="{{ route('password.confirm') }}">
		@csrf
		<div>
			<x-input-label for="password" :value="__('Contraseña')" />
			<x-campo-password id="password" name="password" class="mt-1" autocomplete="current-password" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div class="flex justify-end mt-4">
			<x-primary-button>
				Confirmar
			</x-primary-button>
		</div>
	</form>
</x-guest-layout>
