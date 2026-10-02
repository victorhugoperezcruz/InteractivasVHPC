<x-app-layout>
	<x-slot name="header">
		<div>
			<h2 class="font-black text-2xl text-stone-900 leading-tight">
				Crear receta
			</h2>
			<p class="text-sm text-stone-500">Completa los datos de tu nuevo plato</p>
		</div>
	</x-slot>
	<div class="py-8">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
			<div class="tarjeta overflow-hidden">
				<div class="h-2 bg-gradient-to-r from-orange-500 via-red-500 to-amber-500"></div>
				<div class="p-6 sm:p-8 text-gray-900">
					<form method="POST" action="{{ route('recipes.store') }}">
						@csrf
						<div class="mb-5">
							<label for="titulo" class="etiqueta">Título *</label>
							<input
								type="text"
								name="titulo"
								id="titulo"
								value="{{ old('titulo') }}"
								placeholder="Arepas con queso"
								class="campo"
							>
							<p class="ayuda">Nombre del plato, por ejemplo: Arroz con pollo, Limonada casera.</p>
							@error('titulo')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
						<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
							<div class="bg-orange-50/60 rounded-2xl p-4 border border-orange-100 transition duration-200 hover:border-orange-200">
								<label for="categoria" class="etiqueta">Categoría *</label>
								<x-select-personalizado
									name="categoria"
									id="categoria"
									:valor="old('categoria', '')"
									marcador="Elige una categoría"
									:opciones="collect($categorias)->map(fn($cat) => ['valor' => $cat, 'etiqueta' => ucfirst($cat)])->all()"
								/>
								@error('categoria')
									<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
								@enderror
							</div>
							<div class="bg-orange-50/60 rounded-2xl p-4 border border-orange-100 transition duration-200 hover:border-orange-200">
								<label for="tiempo" class="etiqueta">Tiempo (min) *</label>
								<input
									type="number"
									name="tiempo"
									id="tiempo"
									min="1"
									value="{{ old('tiempo') }}"
									class="campo"
								>
								<p class="ayuda">Solo minutos, ej. 20.</p>
								@error('tiempo')
									<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
								@enderror
							</div>
							<div class="bg-orange-50/60 rounded-2xl p-4 border border-orange-100 transition duration-200 hover:border-orange-200">
								<label for="dificultad" class="etiqueta">Dificultad *</label>
								<x-select-personalizado
									name="dificultad"
									id="dificultad"
									:valor="old('dificultad', '')"
									marcador="Elige dificultad"
									:opciones="[['valor' => 'fácil', 'etiqueta' => 'Fácil'], ['valor' => 'media', 'etiqueta' => 'Media'], ['valor' => 'difícil', 'etiqueta' => 'Difícil']]"
								/>
								@error('dificultad')
									<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="mb-5">
							<label for="ingredientes" class="etiqueta">Ingredientes *</label>
							<textarea
								name="ingredientes"
								id="ingredientes"
								rows="5"
								placeholder="2 tazas de harina de maíz&#10;1 taza de queso rallado&#10;1 pizca de sal"
								class="campo"
							>{{ old('ingredientes') }}</textarea>
							<p class="ayuda">Un ingrediente por línea, con cantidades como en el ejemplo.</p>
							@error('ingredientes')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
						<div class="mb-5">
							<label for="pasos" class="etiqueta">Pasos *</label>
							<textarea
								name="pasos"
								id="pasos"
								rows="5"
								placeholder="Mezclar la harina con agua tibia&#10;Formar las arepas con la mano&#10;Cocinar 10 minutos por lado"
								class="campo"
							>{{ old('pasos') }}</textarea>
							<p class="ayuda">Un paso por línea, en orden de preparación.</p>
							@error('pasos')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
						<div class="mb-6">
							<label for="nota_personal" class="etiqueta">Nota personal</label>
							<textarea
								name="nota_personal"
								id="nota_personal"
								rows="3"
								class="campo"
							>{{ old('nota_personal') }}</textarea>
							<p class="ayuda">Opcional. Ej. A mi familia le gusta con extra queso.</p>
							@error('nota_personal')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
						<div class="flex items-center gap-3">
							<button type="submit" class="btn-primario">
								Guardar
							</button>
							<a href="{{ route('recipes.index') }}" class="btn-claro">
								Cancelar
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
