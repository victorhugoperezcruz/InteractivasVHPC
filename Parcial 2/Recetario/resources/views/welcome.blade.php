<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recetario Casero</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<style>
		.aparecer {
			animation: aparecer 0.5s ease-out both;
		}
		.aparecer-tarde {
			animation: aparecer 0.5s ease-out 0.15s both;
		}
		@keyframes aparecer {
			from {
				opacity: 0;
				transform: translateY(8px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 min-h-screen">
	<nav class="max-w-5xl mx-auto flex items-center justify-between px-6 py-5">
		<div class="flex items-center gap-3">
			<div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-xl font-black shadow transition duration-200 hover:scale-105">
				R
			</div>
			<p class="text-lg font-black text-stone-900">Recetario Casero</p>
		</div>
		<div class="flex items-center gap-3">
			@auth
				<a href="{{ route('recipes.index') }}" class="bg-stone-900 hover:bg-stone-800 text-white font-bold py-2 px-5 rounded-full transition">
					Mis recetas
				</a>
			@else
				<a href="{{ route('login') }}" class="text-stone-700 hover:text-stone-900 font-bold py-2 px-4 transition">
					Iniciar sesión
				</a>
				<a href="{{ route('register') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-5 rounded-full transition">
					Crear cuenta
				</a>
			@endauth
		</div>
	</nav>
	<main class="max-w-2xl mx-auto px-6 pb-16 text-center aparecer">
		<p class="inline-block bg-orange-100 text-orange-800 text-xs font-bold px-4 py-2 rounded-full mt-6">
			Desayunos · Almuerzos · Cenas · Postres · Bebidas
		</p>
		<h1 class="text-4xl font-black text-stone-900 mt-4">
			Guarda tus recetas favoritas
		</h1>
		<p class="text-stone-600 mt-3">
			Organiza tus platos con título, categoría, tiempo, dificultad,
			ingredientes y pasos. Solo tú puedes ver tus recetas.
		</p>
		<div class="flex justify-center gap-3 mt-6 aparecer-tarde">
			@guest
				<a href="{{ route('register') }}" class="bg-stone-900 hover:bg-stone-800 text-white font-bold py-2.5 px-7 rounded-full transition duration-200 hover:-translate-y-0.5">
					Crear cuenta
				</a>
				<a href="{{ route('login') }}" class="bg-white hover:bg-orange-50 text-stone-900 font-bold py-2.5 px-7 rounded-full border border-stone-200 transition duration-200 hover:-translate-y-0.5">
					Iniciar sesión
				</a>
			@endguest
			@auth
				<a href="{{ route('recipes.index') }}" class="bg-stone-900 hover:bg-stone-800 text-white font-bold py-2.5 px-7 rounded-full transition duration-200 hover:-translate-y-0.5">
					Ir a mis recetas
				</a>
			@endauth
		</div>
	</main>
</body>
</html>
