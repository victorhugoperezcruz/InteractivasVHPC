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
<body class="font-sans text-gray-900 antialiased">
	<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
		<div class="flex items-center gap-3 mb-2">
			<a href="/" class="flex items-center gap-3">
				<span class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-2xl font-black shadow-lg">R</span>
				<span class="text-2xl font-black text-stone-900">Recetario Casero</span>
			</a>
		</div>
		<div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-xl border border-orange-100 overflow-hidden sm:rounded-3xl">
			{{ $slot }}
		</div>
		<p class="mt-6 text-sm text-stone-500">
			<a href="/" class="underline hover:text-stone-800">Volver al inicio</a>
		</p>
	</div>
</body>
</html>
