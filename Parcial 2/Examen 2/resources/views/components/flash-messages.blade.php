@if (session('success') || session('error') || session('warning') || session('info'))
<div class="mx-auto w-full max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
	<div class="space-y-3" id="contenedor-avisos">
		@if (session('success'))
			<div class="aviso-auto aviso-animado relative overflow-hidden rounded-xl border-l-4 border-emerald-500 bg-white shadow ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700" role="alert" data-tiempo="6000">
				<div class="flex items-start gap-3 p-4">
					<span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-500/15 text-base font-bold text-emerald-600 dark:text-emerald-300">✓</span>
					<div class="min-w-0 flex-1">
						<p class="text-sm font-bold text-slate-900 dark:text-white">Operación exitosa</p>
						<p class="mt-0.5 text-sm text-slate-600 dark:text-slate-300">{{ session('success') }}</p>
					</div>
					<button type="button" class="aviso-cerrar rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Cerrar aviso">✕</button>
				</div>
				<div class="h-0.5 w-full bg-slate-100 dark:bg-slate-800"><div class="aviso-progreso h-0.5 bg-emerald-500"></div></div>
			</div>
		@endif
		@if (session('error'))
			<div class="aviso-auto aviso-animado relative overflow-hidden rounded-xl border-l-4 border-rose-500 bg-white shadow ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700" role="alert" data-tiempo="8000">
				<div class="flex items-start gap-3 p-4">
					<span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-rose-500/15 text-base font-bold text-rose-600 dark:text-rose-300">!</span>
					<div class="min-w-0 flex-1">
						<p class="text-sm font-bold text-slate-900 dark:text-white">Atención</p>
						<p class="mt-0.5 text-sm text-slate-600 dark:text-slate-300">{{ session('error') }}</p>
					</div>
					<button type="button" class="aviso-cerrar rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Cerrar aviso">✕</button>
				</div>
				<div class="h-0.5 w-full bg-slate-100 dark:bg-slate-800"><div class="aviso-progreso h-0.5 bg-rose-500"></div></div>
			</div>
		@endif
		@if (session('warning'))
			<div class="aviso-auto aviso-animado relative overflow-hidden rounded-xl border-l-4 border-amber-400 bg-white shadow ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700" role="alert" data-tiempo="7000">
				<div class="flex items-start gap-3 p-4">
					<span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-400/20 text-base font-bold text-amber-600 dark:text-amber-300">⚠</span>
					<div class="min-w-0 flex-1">
						<p class="text-sm font-bold text-slate-900 dark:text-white">Aviso</p>
						<p class="mt-0.5 text-sm text-slate-600 dark:text-slate-300">{{ session('warning') }}</p>
					</div>
					<button type="button" class="aviso-cerrar rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Cerrar aviso">✕</button>
				</div>
				<div class="h-0.5 w-full bg-slate-100 dark:bg-slate-800"><div class="aviso-progreso h-0.5 bg-amber-400"></div></div>
			</div>
		@endif
		@if (session('info'))
			<div class="aviso-auto aviso-animado relative overflow-hidden rounded-xl border-l-4 border-violet-500 bg-white shadow ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700" role="alert" data-tiempo="6000">
				<div class="flex items-start gap-3 p-4">
					<span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-violet-600/15 text-base font-bold text-violet-600 dark:text-violet-300">i</span>
					<div class="min-w-0 flex-1">
						<p class="text-sm font-bold text-slate-900 dark:text-white">Información</p>
						<p class="mt-0.5 text-sm text-slate-600 dark:text-slate-300">{{ session('info') }}</p>
					</div>
					<button type="button" class="aviso-cerrar rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Cerrar aviso">✕</button>
				</div>
				<div class="h-0.5 w-full bg-slate-100 dark:bg-slate-800"><div class="aviso-progreso h-0.5 bg-violet-500"></div></div>
			</div>
		@endif
	</div>
</div>
<style>
	.aviso-animado { animation: aviso-entrada 0.25s ease-out; }
	@keyframes aviso-entrada { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: none; } }
	.aviso-salida { opacity: 0 !important; transform: translateY(-6px); transition: all 0.25s ease; }
	.aviso-progreso { width: 100%; animation-name: aviso-cuenta; animation-timing-function: linear; animation-fill-mode: forwards; }
	@keyframes aviso-cuenta { from { width: 100%; } to { width: 0%; } }
</style>
<script>
	(function () {
		function cerrarAviso(el) {
			el.classList.add('aviso-salida');
			setTimeout(function () { el.remove(); }, 260);
		}
		document.querySelectorAll('.aviso-auto').forEach(function (aviso) {
			var tiempo = parseInt(aviso.getAttribute('data-tiempo') || '6000', 10);
			var barra = aviso.querySelector('.aviso-progreso');
			if (barra) { barra.style.animationDuration = tiempo + 'ms'; }
			var temporizador = setTimeout(function () { cerrarAviso(aviso); }, tiempo);
			aviso.querySelector('.aviso-cerrar').addEventListener('click', function () {
				clearTimeout(temporizador);
				cerrarAviso(aviso);
			});
		});
	})();
</script>
@endif
