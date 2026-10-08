<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
			<div class="flex items-center gap-4">
				<span class="flex h-12 w-12 items-center justify-center rounded-lg bg-violet-600 text-lg font-bold text-white">{{ strtoupper(substr($usuario->name, 0, 1)) }}</span>
				<div>
					<h2 class="font-bold text-slate-900 dark:text-white">Hola, {{ $usuario->name }}</h2>
					<p class="text-sm text-slate-500 dark:text-slate-400">Miembro desde {{ $usuario->created_at->format('m/Y') }} · {{ $misInscripciones->count() }} inscripción(es) · {{ $disponibles->count() }} torneos abiertos</p>
				</div>
			</div>
			<div class="flex flex-wrap items-center gap-2">
				@if ($usuario->role === 'admin')
					<x-ui.boton variante="primario" href="{{ route('admin.torneos.create') }}" class="!px-4 !py-2">Nuevo torneo</x-ui.boton>
				@else
					<x-ui.boton variante="primario" href="{{ route('mis-torneos') }}" class="!px-4 !py-2">Mis torneos</x-ui.boton>
				@endif
			</div>
		</div>
	</x-slot>
	<div class="py-6">
		<div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
			<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
				<x-ui.tarjeta-stat titulo="Disponibles" :valor="$disponibles->count()" descripcion="Con cupo y fecha futura" icono="◉" acento="violeta">
					<p class="text-xs text-slate-500 dark:text-slate-400">{{ $proximosSiete }} en los próximos 7 días</p>
				</x-ui.tarjeta-stat>
				@if ($usuario->role === 'jugador')
					<x-ui.tarjeta-stat titulo="Mis inscripciones" :valor="$misInscripciones->count()" descripcion="Torneos donde participas" icono="◎" acento="turquesa" />
					<x-ui.tarjeta-stat titulo="Nivel {{ $nivel }}" :valor="$progresoNivel . '%'" descripcion="Progreso al siguiente nivel" icono="★" acento="ambar">
						<div class="mt-2 h-1.5 rounded-full bg-slate-100 dark:bg-slate-800"><div class="h-1.5 rounded-full bg-amber-400" style="width: {{ $progresoNivel }}%"></div></div>
					</x-ui.tarjeta-stat>
				@else
					<x-ui.tarjeta-stat titulo="Inscripciones" :valor="$totalInscritos" descripcion="Participaciones totales" icono="◎" acento="turquesa" />
					<x-ui.tarjeta-stat titulo="Ocupación" :valor="$ocupacion . '%'" descripcion="Plazas ocupadas global" icono="▦" acento="ambar">
						<div class="mt-2 h-1.5 rounded-full bg-slate-100 dark:bg-slate-800"><div class="h-1.5 rounded-full bg-violet-500" style="width: {{ $ocupacion }}%"></div></div>
					</x-ui.tarjeta-stat>
				@endif
				<x-ui.tarjeta-stat titulo="Total torneos" :valor="$totalTorneos" descripcion="Creados en la plataforma" icono="▤" acento="gris">
					<p class="text-xs text-slate-500 dark:text-slate-400">Próximo: {{ $proximo ? $proximo->fecha->format('d/m/Y') : '—' }}</p>
				</x-ui.tarjeta-stat>
			</div>
			<div class="grid gap-5 lg:grid-cols-3">
				<div class="space-y-5 lg:col-span-2">
					<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
						<div class="flex items-center justify-between">
							<h3 class="font-bold text-slate-900 dark:text-white">Próximo torneo destacado</h3>
							<x-ui.badge tipo="info">Recomendado</x-ui.badge>
						</div>
						@if ($proximo)
							<div class="mt-3 flex flex-col gap-4 sm:flex-row sm:items-center">
								<div class="flex-1">
									<p class="font-bold text-slate-900 dark:text-white">{{ $proximo->nombre }}</p>
									<p class="text-sm text-slate-500 dark:text-slate-400">{{ $proximo->juego_deporte }} · {{ $proximo->fecha->format('d/m/Y H:i') }} · {{ $proximo->cupos_disponibles }} plazas libres</p>
									<p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ \Illuminate\Support\Str::limit($proximo->descripcion ?? 'Sin descripción.', 120) }}</p>
									<div class="mt-3 flex gap-2">
										<x-ui.boton variante="primario" href="{{ route('torneos.show', $proximo) }}" class="!px-4 !py-2">Ver detalle</x-ui.boton>
										@if ($usuario->role === 'jugador' && ! $usuario->estaInscritoEn($proximo) && ! $proximo->is_closed)
											<form method="POST" action="{{ route('torneos.inscribir', $proximo) }}">
												@csrf
												<x-ui.boton variante="exito" class="!px-4 !py-2">Inscribirme</x-ui.boton>
											</form>
										@endif
									</div>
								</div>
								<div class="rounded-lg bg-slate-50 p-4 text-center ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700" data-cuenta="{{ $proximo->fecha->toIso8601String() }}">
									<p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Faltan</p>
									<p class="cuenta-texto mt-1 text-sm font-bold text-slate-900 dark:text-white">Calculando…</p>
								</div>
							</div>
						@else
							<p class="mt-3 text-sm text-slate-500">No hay torneos próximos.</p>
						@endif
					</div>
					<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
						<h3 class="font-bold text-slate-900 dark:text-white">{{ $usuario->role === 'jugador' ? 'Mi actividad reciente' : 'Torneos con mayor ocupación' }}</h3>
						@if ($usuario->role === 'jugador')
							@if ($misInscripciones->isEmpty())
								<p class="mt-2 text-sm text-slate-500">Aún no tienes movimientos. Cuando te inscribas o canceles aparecerán aquí.</p>
							@else
								<ol class="mt-3 space-y-3 border-l border-slate-200 pl-4 dark:border-slate-700">
									@foreach ($misInscripciones->take(5) as $ins)
										<li>
											<p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $ins->torneo->nombre ?? 'Torneo eliminado' }}</p>
											<p class="text-xs text-slate-500">Inscrito el {{ $ins->created_at->format('d/m/Y H:i') }} · {{ $ins->torneo->juego_deporte ?? '' }}</p>
										</li>
									@endforeach
								</ol>
							@endif
						@else
							<ul class="mt-3 space-y-3">
								@foreach ($topOcupacion as $t)
									@php $pct = $t->cupo > 0 ? round(($t->inscripciones_count / $t->cupo) * 100) : 0; @endphp
									<li>
										<div class="flex items-center justify-between text-sm">
											<span class="font-semibold text-slate-800 dark:text-slate-100">{{ $t->nombre }}</span>
											<span class="text-xs text-slate-500">{{ $t->inscripciones_count }}/{{ $t->cupo }} · {{ $pct }}%</span>
										</div>
										<div class="mt-1 h-1.5 rounded-full bg-slate-100 dark:bg-slate-800"><div class="h-1.5 rounded-full bg-violet-500" style="width: {{ $pct }}%"></div></div>
									</li>
								@endforeach
							</ul>
						@endif
					</div>
					<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
						<div class="flex items-center justify-between">
							<h3 class="font-bold text-slate-900 dark:text-white">{{ $usuario->role === 'jugador' ? 'Recomendados para ti' : 'Alertas' }}</h3>
							<a href="{{ route('torneos.index') }}" class="text-xs font-semibold text-violet-600 hover:underline dark:text-violet-400">Ver todos →</a>
						</div>
						@if ($usuario->role === 'jugador')
							@if ($recomendados->isEmpty())
								<p class="mt-2 text-sm text-slate-500">Ya estás en todos los torneos disponibles. Vuelve cuando haya novedades.</p>
							@else
								<div class="mt-3 grid gap-3 sm:grid-cols-3">
									@foreach ($recomendados as $t)
										<a href="{{ route('torneos.show', $t) }}" class="rounded-lg border border-slate-200 p-3 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
											<p class="text-sm font-bold text-slate-900 dark:text-white">{{ $t->nombre }}</p>
											<p class="text-xs text-slate-500">{{ $t->juego_deporte }} · {{ $t->cupos_disponibles }} libres</p>
										</a>
									@endforeach
								</div>
							@endif
						@else
							@if ($casiLlenos->isEmpty())
								<p class="mt-2 text-sm text-slate-500">Sin alertas. Ningún torneo supera el 80% de ocupación.</p>
							@else
								<ul class="mt-3 space-y-2">
									@foreach ($casiLlenos as $t)
										<li class="flex items-center justify-between rounded-lg bg-amber-400/10 px-3 py-2 text-sm ring-1 ring-amber-400/30">
											<span class="font-semibold text-slate-800 dark:text-slate-100">{{ $t->nombre }} casi lleno</span>
											<a href="{{ route('admin.torneos.inscritos', $t) }}" class="text-xs font-bold text-amber-700 hover:underline dark:text-amber-300">Revisar</a>
										</li>
									@endforeach
								</ul>
							@endif
						@endif
					</div>
				</div>
				<div class="space-y-5">
					<div class="rounded-xl bg-white p-5 text-slate-600 ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-200 dark:ring-slate-800">
						<h3 class="font-bold text-slate-900 dark:text-white">Cómo avanzar</h3>
						@if ($usuario->role === 'jugador')
							<ol class="mt-2 space-y-2 text-sm text-slate-600 dark:text-slate-300">
								<li>1. Busca un torneo con plazas libres.</li>
								<li>2. Inscríbete antes de la fecha límite.</li>
								<li>3. Cancela solo si aún falta para el evento.</li>
							</ol>
						@else
							<ol class="mt-2 space-y-2 text-sm text-slate-600 dark:text-slate-300">
								<li>1. Crea torneos con fecha futura.</li>
								<li>2. No bajes el cupo bajo los inscritos.</li>
								<li>3. Expulsa solo para liberar plazas.</li>
							</ol>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		(function () {
			var caja = document.querySelector('[data-cuenta]');
			if (!caja) return;
			var fin = new Date(caja.getAttribute('data-cuenta')).getTime();
			var texto = caja.querySelector('.cuenta-texto');
			function tick() {
				var diff = fin - Date.now();
				if (diff <= 0) { texto.textContent = 'En curso o finalizado'; return; }
				var d = Math.floor(diff / 86400000);
				var h = Math.floor((diff % 86400000) / 3600000);
				var m = Math.floor((diff % 3600000) / 60000);
				texto.textContent = d + 'd ' + h + 'h ' + m + 'min';
			}
			tick();
			setInterval(tick, 60000);
		})();
	</script>
</x-app-layout>
