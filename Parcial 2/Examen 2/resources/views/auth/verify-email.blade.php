<x-guest-layout>
	<div class="mb-4 text-center">
		<h2 class="text-lg font-extrabold text-slate-900 dark:text-white">Verifica tu correo</h2>
		<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Gracias por registrarte. Antes de empezar, verifica tu correo pulsando el enlace que te acabamos de enviar. Si no lo recibiste, te enviaremos otro con gusto.</p>
	</div>
	@if (session('status') == 'verification-link-sent')
		<div class="mb-4 rounded-xl bg-emerald-50 p-3 text-sm font-semibold text-emerald-700 ring-1 ring-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:ring-emerald-500/20">Se ha enviado un nuevo enlace de verificación a tu correo.</div>
	@endif
	<div class="mt-4 flex items-center justify-between gap-3">
		<form method="POST" action="{{ route('verification.send') }}">
			@csrf
			<x-ui.boton variante="primario">Reenviar correo</x-ui.boton>
		</form>
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<button type="submit" class="text-sm font-bold text-slate-500 underline hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-100">Cerrar sesión</button>
		</form>
	</div>
</x-guest-layout>
