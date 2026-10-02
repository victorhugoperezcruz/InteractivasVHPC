@props(['name', 'valor' => '', 'marcador' => 'Elige una opción', 'opciones' => [], 'id' => null])
@php
	$uid = $id ?? $name . '_' . uniqid();
	$textoActual = '';
	foreach ($opciones as $op) {
		if (($op['valor'] ?? '') === $valor && $valor !== '') {
			$textoActual = $op['etiqueta'] ?? $op['valor'];
			break;
		}
	}
@endphp
<div
	x-data="{ abierto: false, valor: @js($valor), texto: @js($textoActual) }"
	@click.outside="abierto = false"
	@keydown.escape.window="abierto = false"
	class="relative"
>
	<input type="hidden" name="{{ $name }}" :value="valor">
	<button
		type="button"
		id="{{ $uid }}"
		@click="abierto = ! abierto"
		class="combo flex items-center justify-between gap-2 text-left"
	>
		<span x-text="texto || @js($marcador)" :class="texto ? 'text-stone-900' : 'text-stone-400'" class="whitespace-nowrap overflow-hidden text-ellipsis"></span>
	</button>
	<div
		x-show="abierto"
		x-transition:enter="transition ease-out duration-200"
		x-transition:enter-start="opacity-0 scale-95 translate-y-1"
		x-transition:enter-end="opacity-100 scale-100 translate-y-0"
		x-transition:leave="transition ease-in duration-150"
		x-transition:leave-start="opacity-100 scale-100 translate-y-0"
		x-transition:leave-end="opacity-0 scale-95 translate-y-1"
		class="absolute z-[100] mt-2 w-full min-w-0 rounded-2xl bg-white border border-orange-200 shadow-2xl shadow-orange-900/15 overflow-hidden"
		style="display: none;"
	>
		<ul class="max-h-64 overflow-auto py-2">
			<li>
				<button
					type="button"
					@click="valor = ''; texto = ''; abierto = false"
					class="flex w-full items-center px-4 py-2.5 text-sm font-bold text-stone-500 transition duration-150 hover:bg-orange-50 hover:text-orange-800"
				>
					{{ $marcador }}
				</button>
			</li>
			@foreach ($opciones as $op)
				<li>
					<button
						type="button"
						@click="valor = @js($op['valor']); texto = @js($op['etiqueta']); abierto = false"
						class="flex w-full items-center justify-between gap-2 px-4 py-2.5 text-sm font-bold text-stone-700 transition duration-150 hover:bg-orange-50 hover:text-orange-800"
						:class="valor === @js($op['valor']) ? 'bg-orange-50 text-orange-800' : ''"
					>
						<span class="whitespace-normal text-left leading-snug">{{ $op['etiqueta'] }}</span>
						<span x-show="valor === @js($op['valor'])">
							<svg class="h-4 w-4 text-orange-600" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							</svg>
						</span>
					</button>
				</li>
			@endforeach
		</ul>
	</div>
</div>
