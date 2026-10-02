<x-guest-layout>
	<div class="mb-4 text-sm text-stone-600">
		Gracias por registrarte. Antes de empezar, verifica tu correo haciendo clic en el enlace que te enviamos. Si no lo recibiste, te enviamos otro.
	</div>
	@if (session('status') == 'verification-link-sent')
		<div class="mb-4 font-medium text-sm text-green-600">
			Se envió un nuevo enlace de verificación a tu correo.
		</div>
	@endif
	<div class="mt-4 flex items-center justify-between">
		<form method="POST" action="{{ route('verification.send') }}">
			@csrf
			<div>
				<x-primary-button>
					Reenviar correo
				</x-primary-button>
			</div>
		</form>
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<button type="submit" class="underline text-sm text-stone-600 hover:text-stone-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
				Cerrar sesión
			</button>
		</form>
	</div>
</x-guest-layout>
