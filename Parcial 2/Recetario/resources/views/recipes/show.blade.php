<x-app-layout>
	<x-slot name="header">
		<div>
			<h2 class="font-black text-2xl text-stone-900 leading-tight">
				{{ $recipe->titulo }}
			</h2>
			<p class="text-sm text-stone-500">Detalle de tu receta</p>
		</div>
	</x-slot>
	<div class="py-8">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
			@if (session('exito'))
				<div class="mb-5 bg-green-50 border border-green-300 text-green-800 px-5 py-3 rounded-2xl shadow-sm transition-all duration-300">
					{{ session('exito') }}
				</div>
			@endif
			<div class="tarjeta overflow-hidden">
				<div class="h-24 bg-gradient-to-r from-orange-500 via-red-500 to-amber-500 relative">
					<div class="absolute -bottom-6 left-8 flex flex-wrap gap-2">
						<span class="bg-white text-orange-800 text-xs font-black px-4 py-2 rounded-full shadow transition duration-200">
							{{ ucfirst($recipe->categoria) }}
						</span>
						<span class="bg-stone-900 text-white text-xs font-black px-4 py-2 rounded-full shadow transition duration-200">
							{{ $recipe->tiempo }} min
						</span>
						<span class="bg-green-600 text-white text-xs font-black px-4 py-2 rounded-full shadow transition duration-200">
							{{ ucfirst($recipe->dificultad) }}
						</span>
					</div>
				</div>
				<div class="p-6 sm:p-8 pt-10 text-gray-900">
					<div class="grid md:grid-cols-2 gap-5 mb-6">
						<div class="bg-orange-50/70 border border-orange-100 rounded-2xl p-5 transition duration-200 hover:shadow-md">
							<h3 class="text-base font-black uppercase tracking-widest text-orange-800 mb-3">Ingredientes</h3>
							<ul class="list-disc list-inside space-y-1.5 text-stone-700">
								@foreach (preg_split('/\r\n|\r|\n/', $recipe->ingredientes) as $ingrediente)
									@if (trim($ingrediente) !== '')
										<li>{{ trim($ingrediente) }}</li>
									@endif
								@endforeach
							</ul>
						</div>
						<div class="bg-stone-50 border border-stone-200 rounded-2xl p-5 transition duration-200 hover:shadow-md">
							<h3 class="text-base font-black uppercase tracking-widest text-stone-800 mb-3">Pasos</h3>
							<ol class="list-decimal list-inside space-y-1.5 text-stone-700">
								@foreach (preg_split('/\r\n|\r|\n/', $recipe->pasos) as $paso)
									@if (trim($paso) !== '')
										<li>{{ trim($paso) }}</li>
									@endif
								@endforeach
							</ol>
						</div>
					</div>
					@if ($recipe->nota_personal)
						<div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-r-2xl transition duration-200">
							<h3 class="font-black text-stone-900 mb-1">Nota personal</h3>
							<p class="text-stone-700">{{ $recipe->nota_personal }}</p>
						</div>
					@endif
					<div class="flex flex-wrap items-center gap-3 mt-6 pt-5 border-t border-orange-100">
						<a href="{{ route('recipes.edit', $recipe) }}" class="btn-oscuro">
							Editar
						</a>
						<form method="POST" action="{{ route('recipes.destroy', $recipe) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta receta?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-full shadow transition duration-200 hover:-translate-y-0.5">
								Eliminar
							</button>
						</form>
						<a href="{{ route('recipes.index') }}" class="btn-claro">
							Volver
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
