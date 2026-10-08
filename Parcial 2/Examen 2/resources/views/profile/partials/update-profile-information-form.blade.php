<section>
	<header>
		<h2 class="text-lg font-bold text-slate-900 dark:text-white">Información del perfil</h2>
		<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Actualiza el nombre y el correo de tu cuenta.</p>
	</header>
	<form id="send-verification" method="post" action="{{ route('verification.send') }}">
		@csrf
	</form>
	<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
		@csrf
		@method('patch')
		<div>
			<x-input-label for="name" value="Nombre" />
			<x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
			<x-input-error class="mt-2" :messages="$errors->get('name')" />
		</div>
		<div>
			<x-input-label for="email" value="Correo electrónico" />
			<x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
			<x-input-error class="mt-2" :messages="$errors->get('email')" />
			@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
				<div>
					<p class="mt-2 text-sm text-slate-700 dark:text-slate-300">Tu correo aún no está verificado.
						<button form="send-verification" class="font-bold text-violet-600 underline hover:text-violet-500 dark:text-violet-400">Pulsa aquí para reenviar el correo de verificación.</button>
					</p>
					@if (session('status') === 'verification-link-sent')
						<p class="mt-2 text-sm font-semibold text-emerald-600 dark:text-emerald-400">Se ha enviado un nuevo enlace de verificación a tu correo.</p>
					@endif
				</div>
			@endif
		</div>
		<div class="flex items-center gap-4">
			<x-ui.boton variante="primario">Guardar cambios</x-ui.boton>
			@if (session('status') === 'profile-updated')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)" class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Cambios guardados.</p>
			@endif
		</div>
	</form>
</section>
