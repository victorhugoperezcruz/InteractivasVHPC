<!DOCTYPE html>
<html lang="es" class="dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Torneos') }} · Competencias y torneos</title>
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
		.modal-personalizado { display: none; }
		.modal-personalizado.abierto { display: flex; }
		.modal-personalizado.abierto .modal-panel { animation: modal-entrada 0.22s ease-out; }
		@keyframes modal-entrada { from { opacity: 0; transform: translateY(10px) scale(0.98); } to { opacity: 1; transform: none; } }
	</style>
</head>
<body class="bg-slate-100 font-sans text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
	<div class="min-h-screen">
		@include('layouts.navigation')
		@include('components.flash-messages')
		@isset($header)
			<header class="border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
				<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
		@endisset
		<main>
			{{ $slot }}
		</main>
		<footer class="border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
			<div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
				<div class="grid gap-8 md:grid-cols-3">
					<div>
						<div class="flex items-center gap-2.5">
							<span class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-600 text-lg font-bold text-white">T</span>
							<span class="leading-tight">
								<span class="block text-sm font-bold text-slate-900 dark:text-white">Torneos</span>
								<span class="block text-[11px] font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Competencias</span>
							</span>
						</div>
						<p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Plataforma para crear torneos, controlar cupos y gestionar inscripciones de jugadores.</p>
						<div class="mt-3 flex flex-wrap gap-1.5">
							<span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">Laravel</span>
							<span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">Blade</span>
							<span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">Tailwind</span>
							<span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600 dark:bg-slate-800 dark:text-slate-300">MySQL</span>
						</div>
					</div>
					<div>
						<h4 class="text-sm font-bold text-slate-900 dark:text-white">Examen 2 · Parcial 2</h4>
						<p class="mt-1 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Interactivas</p>
						<ul class="mt-3 space-y-1.5 text-sm text-slate-500 dark:text-slate-400">
							<li>Roles admin y jugador con accesos diferenciados</li>
							<li>CRUD de torneos con validación en español</li>
							<li>Inscripciones con control de cupo, fecha y duplicados</li>
						</ul>
					</div>
					<div>
						<h4 class="text-sm font-bold text-slate-900 dark:text-white">Accesos</h4>
						<div class="mt-3 flex flex-wrap gap-x-4 gap-y-2 text-sm font-semibold">
							<a href="{{ route('torneos.index') }}" class="text-slate-600 hover:text-violet-600 dark:text-slate-300 dark:hover:text-violet-400">Torneos</a>
							@auth
								<a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-violet-600 dark:text-slate-300 dark:hover:text-violet-400">Panel</a>
								@if (auth()->user()->role === 'jugador')
									<a href="{{ route('mis-torneos') }}" class="text-slate-600 hover:text-violet-600 dark:text-slate-300 dark:hover:text-violet-400">Mis torneos</a>
								@else
									<a href="{{ route('admin.torneos.index') }}" class="text-slate-600 hover:text-violet-600 dark:text-slate-300 dark:hover:text-violet-400">Administración</a>
								@endif
							@endauth
							@guest
								<a href="{{ route('login') }}" class="text-slate-600 hover:text-violet-600 dark:text-slate-300 dark:hover:text-violet-400">Iniciar sesión</a>
								<a href="{{ route('register') }}" class="text-slate-600 hover:text-violet-600 dark:text-slate-300 dark:hover:text-violet-400">Crear cuenta</a>
							@endguest
						</div>
						<div class="mt-3 rounded-lg bg-slate-50 p-3 font-mono text-[11px] leading-relaxed text-slate-600 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700">
							<p><span class="font-bold">admin:</span> admin@torneos.com</p>
							<p><span class="font-bold">jugador:</span> jugador@torneos.com</p>
							<p><span class="font-bold">clave:</span> password123</p>
						</div>
					</div>
				</div>
				<div class="mt-8 flex flex-col gap-1 border-t border-slate-200 pt-6 text-xs text-slate-500 dark:border-slate-800 dark:text-slate-500 sm:flex-row sm:items-center sm:justify-between">
					<p>Sistema de Torneos</p>
					<p>Examen 2 · Parcial 2 · Interactivas</p>
				</div>
			</div>
		</footer>
	</div>
	<script>
		function abrirModal(id) {
			var el = document.getElementById(id);
			if (!el) return;
			el.classList.remove('hidden');
			el.classList.add('abierto');
			document.body.style.overflow = 'hidden';
		}
		function cerrarModal(id) {
			var el = document.getElementById(id);
			if (!el) return;
			el.classList.add('hidden');
			el.classList.remove('abierto');
			document.body.style.overflow = '';
		}
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
		document.addEventListener('click', function (e) {
			var fondo = e.target.closest('[data-cerrar]');
			if (fondo) { cerrarModal(fondo.getAttribute('data-cerrar')); }
			var btnCerrar = e.target.closest('[data-cerrar-modal]');
			if (btnCerrar) { cerrarModal(btnCerrar.getAttribute('data-cerrar-modal')); }
			var btnAbrir = e.target.closest('[data-abrir-modal]');
			if (btnAbrir) { abrirModal(btnAbrir.getAttribute('data-abrir-modal')); }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				document.querySelectorAll('.modal-personalizado.abierto').forEach(function (m) { cerrarModal(m.id); });
			}
		});
	</script>
</body>
</html>
