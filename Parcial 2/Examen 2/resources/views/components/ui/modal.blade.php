@props(['id', 'titulo' => '', 'subtitulo' => ''])

<div id="{{ $id }}" class="modal-personalizado hidden fixed inset-0 z-50 items-center justify-center p-4" role="dialog" aria-modal="true">
	<div class="absolute inset-0 bg-slate-950/70 modal-fondo" data-cerrar="{{ $id }}"></div>
	<div class="modal-panel relative w-full max-w-md overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700">
		<div class="border-b border-slate-200 px-6 py-4 dark:border-slate-700">
			<h4 class="font-bold text-slate-900 dark:text-white">{{ $titulo }}</h4>
			@if ($subtitulo)
				<p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">{{ $subtitulo }}</p>
			@endif
		</div>
		<div class="px-6 py-5">
			{{ $slot }}
		</div>
	</div>
</div>
