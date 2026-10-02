<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
			<div>
				<h2 class="font-black text-2xl text-stone-900 leading-tight">
					Mis Recetas
				</h2>
				<p class="text-sm text-stone-500">Busca por nombre y filtra por categoría</p>
			</div>
			<a href="{{ route('recipes.create') }}" class="btn-primario">
				+ Nueva receta
			</a>
		</div>
	</x-slot>
	<div class="py-8">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if (session('exito'))
				<div class="mb-5 bg-green-50 border border-green-300 text-green-800 px-5 py-3 rounded-2xl shadow-sm transition-all duration-300">
					{{ session('exito') }}
				</div>
			@endif
			<div class="tarjeta overflow-visible">
				<div class="p-6 sm:p-8 text-gray-900">
					<form method="GET" action="{{ route('recipes.index') }}" class="relative z-20 bg-orange-50/70 border border-orange-100 rounded-2xl p-4 flex flex-col md:flex-row md:items-start gap-4 mb-6 transition-all duration-200">
						<div class="flex-1">
							<label for="buscar" class="etiqueta">Buscar por título</label>
							<input
								type="text"
								name="buscar"
								id="buscar"
								value="{{ request('buscar') }}"
								placeholder="Pasta con pollo…"
								class="campo"
							>
							<p class="ayuda">Escribe parte del título, por ejemplo: arepas, arroz, limonada.</p>
						</div>
						<div class="w-full md:w-64">
							<label for="categoria" class="etiqueta">Categoría</label>
							<x-select-personalizado
								name="categoria"
								id="categoria"
								:valor="request('categoria', '')"
								marcador="Todas las categorías"
								:opciones="collect($categorias)->map(fn($cat) => ['valor' => $cat, 'etiqueta' => ucfirst($cat)])->all()"
							/>
							<p class="ayuda">Combina búsqueda y categoría.</p>
						</div>
						<div class="flex gap-2 md:pt-[1.65rem]">
							<button type="submit" class="btn-oscuro">
								Buscar
							</button>
							<a href="{{ route('recipes.index') }}" class="btn-claro">
								Limpiar
							</a>
						</div>
					</form>
					@if ($recipes->count() === 0 && !request('buscar') && !request('categoria'))
						<div class="text-center py-12 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-dashed border-orange-200">
							<p class="text-stone-700 font-bold text-lg">Aún no tienes recetas</p>
							<p class="text-stone-500 text-sm mb-5">Guarda tu primera receta con ingredientes y pasos.</p>
							<a href="{{ route('recipes.create') }}" class="btn-primario">
								Crear mi primera receta
							</a>
						</div>
					@elseif ($recipes->count() === 0)
						<div class="text-center py-10 bg-stone-50 rounded-2xl border border-stone-200">
							<p class="text-stone-700 font-bold">No se encontraron recetas con esos criterios de búsqueda.</p>
							<p class="ayuda">Prueba con otro título o elige otra categoría.</p>
							<a href="{{ route('recipes.index') }}" class="text-orange-700 font-bold underline mt-2 inline-block transition hover:text-orange-900">Ver todas mis recetas</a>
						</div>
					@else
						<div class="overflow-x-auto rounded-2xl border border-stone-100">
							<table class="min-w-full divide-y divide-orange-100">
								<thead class="bg-stone-900">
									<tr>
										<th class="px-6 py-3 text-left text-xs font-black text-orange-100 uppercase tracking-widest">Título</th>
										<th class="px-6 py-3 text-left text-xs font-black text-orange-100 uppercase tracking-widest">Categoría</th>
										<th class="px-6 py-3 text-left text-xs font-black text-orange-100 uppercase tracking-widest">Tiempo</th>
										<th class="px-6 py-3 text-left text-xs font-black text-orange-100 uppercase tracking-widest">Dificultad</th>
										<th class="px-6 py-3 text-left text-xs font-black text-orange-100 uppercase tracking-widest">Acciones</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-orange-50">
									@foreach ($recipes as $recipe)
										<tr class="transition-colors duration-200 hover:bg-orange-50/70">
											<td class="px-6 py-4 font-bold text-stone-900">{{ $recipe->titulo }}</td>
											<td class="px-6 py-4 whitespace-nowrap">
												<span class="bg-orange-100 text-orange-800 text-xs font-black px-3 py-1 rounded-full">{{ ucfirst($recipe->categoria) }}</span>
											</td>
											<td class="px-6 py-4 whitespace-nowrap text-stone-700">{{ $recipe->tiempo }} min</td>
											<td class="px-6 py-4 whitespace-nowrap">
												<span class="bg-green-100 text-green-800 text-xs font-black px-3 py-1 rounded-full">{{ ucfirst($recipe->dificultad) }}</span>
											</td>
											<td class="px-6 py-4 whitespace-nowrap text-sm">
												<span class="flex gap-3">
													<a href="{{ route('recipes.show', $recipe) }}" class="font-bold text-orange-700 transition duration-200 hover:text-orange-900 hover:underline">Ver</a>
													<a href="{{ route('recipes.edit', $recipe) }}" class="font-bold text-stone-700 transition duration-200 hover:text-stone-900 hover:underline">Editar</a>
													<form method="POST" action="{{ route('recipes.destroy', $recipe) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta receta?');" class="inline">
														@csrf
														@method('DELETE')
														<button type="submit" class="font-bold text-red-600 transition duration-200 hover:text-red-800 hover:underline">Eliminar</button>
													</form>
												</span>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="mt-4">
							{{ $recipes->links() }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
