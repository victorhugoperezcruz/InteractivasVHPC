<x-guest-layout>
	<x-auth-session-status class="mb-4" :status="session('status')" />
	<div class="mb-5 text-center">
		<h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Bienvenido de nuevo</h2>
		<p class="text-sm text-slate-500 dark:text-slate-400">Ingresa con tu correo y contraseña.</p>
	</div>
	<form method="POST" action="{{ route('login') }}" class="space-y-4">
		@csrf
		<div>
			<x-input-label for="email" value="Correo electrónico" />
			<x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tucorreo@ejemplo.com" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>
		<div>
			<x-input-label for="password" value="Contraseña" />
			<x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" placeholder="Tu contraseña" />
			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>
		<div class="flex items-center justify-between">
			<label for="remember_me" class="inline-flex items-center">
				<input id="remember_me" type="checkbox" class="rounded border-slate-300 text-violet-600 shadow-sm focus:ring-violet-500" name="remember">
			<span class="ms-2 text-sm text-slate-500 dark:text-slate-400">Recuérdame</span>
		</label>
			@if (Route::has('password.request'))
				<a class="text-sm font-bold text-violet-600 hover:underline dark:text-violet-400" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
			@endif
		</div>
		<x-ui.boton variante="primario" class="w-full">Entrar a mi cuenta</x-ui.boton>
		<p class="text-center text-sm text-slate-500 dark:text-slate-400">¿Aún no tienes cuenta? <a href="{{ route('register') }}" class="font-bold text-teal-600 hover:underline dark:text-teal-300">Regístrate gratis</a></p>
		<div class="rounded-xl bg-slate-50 p-3 text-xs text-slate-500 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:ring-slate-700">
			<p class="font-bold text-slate-700 dark:text-slate-300">Cuentas demo:</p>
			<p>Admin: admin@torneos.com / password123</p>
			<p>Jugador: jugador@torneos.com / password123</p>
		</div>
	</form>
</x-guest-layout>
