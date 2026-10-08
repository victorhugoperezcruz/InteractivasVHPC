<!DOCTYPE html>
<html lang="es" class="dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Torneos') }} · Acceso</title>
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<script>
		(function () {
			try {
				var tema = localStorage.getItem('tema') || 'oscuro';
				if (tema === 'oscuro') { document.documentElement.classList.add('dark'); }
				else { document.documentElement.classList.remove('dark'); }
			} catch (e) { document.documentElement.classList.add('dark'); }
		})();
	</script>
	<style>
		body { font-family: 'Figtree', sans-serif; }
	</style>
</head>
<body class="bg-slate-100 font-sans text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
	<button type="button" onclick="alternarTema()" title="Cambiar entre modo claro y oscuro" aria-label="Cambiar entre modo claro y oscuro" class="fixed right-4 top-4 rounded-lg bg-white p-2 text-slate-500 shadow ring-1 ring-slate-200 hover:bg-slate-50 dark:bg-slate-900 dark:text-slate-400 dark:ring-slate-800 dark:hover:bg-slate-800">
		<span data-icona-luna class="hidden">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 12 21.75a9.753 9.753 0 0 0 9.752-6.748Z" /></svg>
		</span>
		<span data-icona-sol>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
		</span>
	</button>
	<div class="flex min-h-screen items-center justify-center p-4">
		<div class="w-full max-w-md overflow-hidden rounded-xl bg-white shadow-xl ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
			<div class="border-b border-slate-200 px-8 py-6 text-center dark:border-slate-800">
				<a href="/" class="mx-auto flex h-11 w-11 items-center justify-center rounded-lg bg-violet-600 text-lg font-bold text-white">T</a>
				<h1 class="mt-3 font-bold text-slate-900 dark:text-white">Sistema de Torneos</h1>
				<p class="text-sm text-slate-500 dark:text-slate-400">Inicia sesión o crea tu cuenta de jugador</p>
			</div>
			<div class="px-8 py-6">{{ $slot }}</div>
		</div>
	</div>
	<script>
		function alternarTema() {
			var esOscuro = document.documentElement.classList.toggle('dark');
			try { localStorage.setItem('tema', esOscuro ? 'oscuro' : 'claro'); } catch (e) {}
			document.querySelectorAll('[data-icona-sol]').forEach(function (el) { el.classList.toggle('hidden', !esOscuro); });
			document.querySelectorAll('[data-icona-luna]').forEach(function (el) { el.classList.toggle('hidden', esOscuro); });
		}
		(function () {
			var esOscuro = document.documentElement.classList.contains('dark');
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('[data-icona-sol]').forEach(function (el) { el.classList.toggle('hidden', !esOscuro); });
				document.querySelectorAll('[data-icona-luna]').forEach(function (el) { el.classList.toggle('hidden', esOscuro); });
			});
		})();
	</script>
</body>
</html>
