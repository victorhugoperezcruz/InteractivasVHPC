<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Recetario Casero</title>
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
	<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
		@include('layouts.navigation')
		@isset($header)
			<header class="relative z-10 bg-white/80 backdrop-blur shadow-sm border-b border-orange-100">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
		@endisset
		<main class="relative z-0">
			{{ $slot }}
		</main>
		<footer class="max-w-7xl mx-auto px-6 py-10 text-center text-sm text-stone-400">
			Recetario Casero · Guarda tus recetas favoritas
		</footer>
	</div>
</body>
</html>
