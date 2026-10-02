<x-app-layout>
	<x-slot name="header">
		<div>
			<h2 class="font-black text-2xl text-stone-900 leading-tight">
				Editar receta
			</h2>
			<p class="text-sm text-stone-500">Actualiza los datos de "{{ $recipe->titulo }}"</p>
		</div>
	</x-slot>
	<div class="py-8">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
			<div class="tarjeta overflow-hidden">
				<div class="h-2 bg-gradient-to-r from-amber-500 via-orange-500 to-red-500"></div>
				<div class="p-6 sm:p-8 text-gray-900">
					<form method="POST" action="{{ route('recipes.update', $recipe) }}">
						@csrf
						@method('PUT')
						<div class="mb-5">
							<label for="titulo" class="etiqueta">Título *</label>
							<input
								type="text"
								name="titulo"
								id="titulo"
								value="{{ old('titulo', $recipe->titulo) }}"
								class="campo"
							>
							<p class="ayuda">Nombre del plato, por ejemplo: Arroz con pollo.</p>
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
									:valor="old('categoria', $recipe->categoria)"
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
									value="{{ old('tiempo', $recipe->tiempo) }}"
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
									:valor="old('dificultad', $recipe->dificultad)"
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
								class="campo"
							>{{ old('ingredientes', $recipe->ingredientes) }}</textarea>
							<p class="ayuda">Un ingrediente por línea, con cantidades.</p>
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
								class="campo"
							>{{ old('pasos', $recipe->pasos) }}</textarea>
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
							>{{ old('nota_personal', $recipe->nota_personal) }}</textarea>
							<p class="ayuda">Opcional. Lo que quieras recordar de esta receta.</p>
							@error('nota_personal')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>
						<div class="flex items-center gap-3">
							<button type="submit" class="btn-primario">
								Actualizar
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
