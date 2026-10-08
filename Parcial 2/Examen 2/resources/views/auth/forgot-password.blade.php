<x-guest-layout>
	<div class="mb-4 text-center">
		<h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Recuperar contraseña</h2>
		<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Escribe tu correo y te enviaremos un enlace para elegir una nueva contraseña.</p>
	</div>
	<x-auth-session-status class="mb-4" :status="session('status')" />
	<form method="POST" action="{{ route('password.email') }}" class="space-y-4">
		@csrf
		<div>
			<x-input-label for="email" value="Correo electrónico" />
			<x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="tucorreo@ejemplo.com" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<x-ui.boton variante="primario" class="w-full">Enviar enlace de recuperación</x-ui.boton>
		<p class="text-center text-sm text-slate-500 dark:text-slate-400"><a href="{{ route('login') }}" class="font-bold text-violet-600 hover:underline dark:text-violet-400">Volver al inicio de sesión</a></p>
	</form>
</x-guest-layout>
