@props(['id', 'name' => 'password', 'autocomplete' => 'new-password', 'requerido' => true, 'contador' => false, 'minimo' => 8])
<div x-data="{ ver: false, texto: '' }">
	<div class="relative" style="position: relative;">
		<input
			id="{{ $id }}"
			name="{{ $name }}"
			x-model="texto"
			type="password"
			:type="ver ? 'text' : 'password'"
			autocomplete="{{ $autocomplete }}"
			@if($requerido) required @endif
			@if($contador) minlength="{{ $minimo }}" @endif
			{{ $attributes->merge(['class' => 'campo pr-12']) }}
		>
		<button
			type="button"
			@click="ver = ! ver"
			:title="ver ? 'Ocultar contraseña' : 'Ver contraseña'"
			class="absolute inset-y-0 right-3 flex items-center text-stone-400 transition duration-200 hover:text-orange-600 focus:outline-none focus:text-orange-600"
			style="position: absolute; inset-block: 0; right: 0.75rem; display: flex; align-items: center;"
		>
			<svg x-show="! ver" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
				<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
			</svg>
			<svg x-show="ver" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display: none;">
				<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.948 9.948 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
			</svg>
		</button>
	</div>
	@if($contador)
		<div class="mt-2">
			<div
				class="h-2 rounded-full bg-stone-200 overflow-hidden"
				role="progressbar"
				aria-label="Progreso de contraseña"
				:aria-valuenow="texto.length"
				aria-valuemin="0"
				aria-valuemax="{{ $minimo }}"
			>
				<div
					class="h-full rounded-full transition-all duration-200"
					:class="texto.length >= {{ $minimo }} ? 'bg-green-500' : (texto.length > 0 ? 'bg-orange-400' : 'bg-stone-200')"
					:style="'width: ' + (Math.min(texto.length, {{ $minimo }}) / {{ $minimo }} * 100) + '%'"
				></div>
			</div>
			<p class="ayuda">
				<span x-text="texto.length"></span> de {{ $minimo }} caracteres mínimo.
				<span x-show="texto.length >= {{ $minimo }}" class="font-bold text-green-700">Listo.</span>
			</p>
		</div>
	@endif
</div>
