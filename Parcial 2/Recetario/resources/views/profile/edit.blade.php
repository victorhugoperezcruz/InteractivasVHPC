<x-app-layout>
	<x-slot name="header">
		<div>
			<h2 class="font-black text-2xl text-stone-900 leading-tight">
				Mi perfil
			</h2>
			<p class="text-sm text-stone-500">Actualiza tus datos y tu contraseña</p>
		</div>
	</x-slot>
	<div class="py-8">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="tarjeta p-6 sm:p-8 transition duration-200">
				<div class="max-w-xl">
					@include('profile.partials.update-profile-information-form')
				</div>
			</div>
			<div class="tarjeta p-6 sm:p-8 transition duration-200">
				<div class="max-w-xl">
					@include('profile.partials.update-password-form')
				</div>
			</div>
			<div class="tarjeta p-6 sm:p-8 transition duration-200">
				<div class="max-w-xl">
					@include('profile.partials.delete-user-form')
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
