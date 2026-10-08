<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
			<div class="flex items-center gap-4">
				<span class="flex h-14 w-14 items-center justify-center rounded-xl bg-violet-600 text-xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
				<div>
					<h2 class="font-bold text-slate-900 dark:text-white">{{ $user->name }}</h2>
					<p class="text-sm text-slate-500 dark:text-slate-400">{{ $user->email }} · Miembro desde {{ $user->created_at->format('m/Y') }}</p>
					<div class="mt-1.5 flex flex-wrap gap-2">
						<x-ui.badge tipo="{{ $user->role === 'admin' ? 'admin' : 'jugador' }}">{{ $user->role === 'admin' ? 'Administrador' : 'Jugador' }}</x-ui.badge>
						@if ($user->email_verified_at)
							<x-ui.badge tipo="disponible">Correo verificado</x-ui.badge>
						@else
							<x-ui.badge tipo="cerrado">Correo sin verificar</x-ui.badge>
						@endif
					</div>
				</div>
			</div>
			<div class="flex gap-2">
				<x-ui.boton variante="secundario" href="{{ route('dashboard') }}" class="!px-4 !py-2">Volver al panel</x-ui.boton>
			</div>
		</div>
	</x-slot>
	<div class="py-6" x-data="{ pestaña: 'cuenta' }">
		<div class="mx-auto max-w-7xl space-y-5 px-4 sm:px-6 lg:px-8">
			<div class="grid gap-4 sm:grid-cols-3">
				@if ($user->role === 'jugador')
					<x-ui.tarjeta-stat titulo="Inscripciones" :valor="$inscripciones->count()" descripcion="Últimos movimientos" icono="◎" acento="turquesa" />
					<x-ui.tarjeta-stat titulo="Próximos eventos" :valor="$proximos->count()" descripcion="Con fecha futura" icono="▤" acento="violeta" />
					<x-ui.tarjeta-stat titulo="Deportes" :valor="$historial->pluck('juego_deporte')->unique()->count()" descripcion="Disciplinas distintas" icono="★" acento="ambar" />
				@else
					<x-ui.tarjeta-stat titulo="Torneos recientes" :valor="$gestionados->count()" descripcion="Últimos creados" icono="▤" acento="violeta" />
					<x-ui.tarjeta-stat titulo="Inscritos" :valor="$totalInscritosGestion" descripcion="En esos torneos" icono="◎" acento="turquesa" />
					<x-ui.tarjeta-stat titulo="Mi rol" :valor="'Admin'" descripcion="Acceso total" icono="⬣" acento="ambar" />
				@endif
			</div>
			<div class="flex gap-1 rounded-xl bg-white p-1 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
				<button type="button" @click="pestaña = 'cuenta'" :class="pestaña === 'cuenta' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 dark:text-slate-300'" class="flex-1 rounded-lg px-4 py-2 text-sm font-semibold">Cuenta</button>
				<button type="button" @click="pestaña = 'seguridad'" :class="pestaña === 'seguridad' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 dark:text-slate-300'" class="flex-1 rounded-lg px-4 py-2 text-sm font-semibold">Seguridad</button>
				<button type="button" @click="pestaña = 'actividad'" :class="pestaña === 'actividad' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 dark:text-slate-300'" class="flex-1 rounded-lg px-4 py-2 text-sm font-semibold">Actividad</button>
				<button type="button" @click="pestaña = 'preferencias'" :class="pestaña === 'preferencias' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'text-slate-600 dark:text-slate-300'" class="flex-1 rounded-lg px-4 py-2 text-sm font-semibold">Preferencias</button>
			</div>
			<div x-show="pestaña === 'cuenta'" class="grid gap-5 lg:grid-cols-3">
				<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 lg:col-span-2">
					<h3 class="font-bold text-slate-900 dark:text-white">Información de la cuenta</h3>
					<p class="text-sm text-slate-500 dark:text-slate-400">Actualiza tu nombre y correo. Si cambias el correo deberás verificarlo de nuevo.</p>
					<div class="mt-4">@include('profile.partials.update-profile-information-form')</div>
				</div>
				<div class="space-y-5">
					<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
						<h3 class="font-bold text-slate-900 dark:text-white">Resumen</h3>
						<dl class="mt-3 space-y-2 text-sm">
							<div class="flex justify-between"><dt class="text-slate-500">Nombre</dt><dd class="font-semibold text-slate-800 dark:text-slate-100">{{ $user->name }}</dd></div>
							<div class="flex justify-between"><dt class="text-slate-500">Rol</dt><dd class="font-semibold">{{ $user->role === 'admin' ? 'Administrador' : 'Jugador' }}</dd></div>
							<div class="flex justify-between"><dt class="text-slate-500">Verificación</dt><dd class="font-semibold">{{ $user->email_verified_at ? 'Verificado' : 'Pendiente' }}</dd></div>
							<div class="flex justify-between"><dt class="text-slate-500">Registro</dt><dd class="font-semibold">{{ $user->created_at->format('d/m/Y') }}</dd></div>
						</dl>
						<div class="mt-4 rounded-lg bg-slate-50 p-3 text-xs text-slate-500 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:ring-slate-700">
							@if ($user->role === 'jugador')
								Como jugador puedes inscribirte a torneos abiertos, gestionar tus plazas en Mis torneos y cancelar antes de la fecha del evento.
							@else
								Como administrador puedes crear torneos, controlar cupos y estados, y dar de baja participantes.
							@endif
						</div>
					</div>
					<div class="rounded-xl border-l-4 border-rose-500 bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
						<h3 class="font-bold text-slate-900 dark:text-white">Zona de peligro</h3>
						<p class="text-sm text-slate-500">Eliminar tu cuenta borra tus datos de forma permanente.</p>
						<div class="mt-3">@include('profile.partials.delete-user-form')</div>
					</div>
				</div>
			</div>
			<div x-show="pestaña === 'seguridad'" style="display: none;" class="grid gap-5 lg:grid-cols-3">
				<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 lg:col-span-2">
					<h3 class="font-bold text-slate-900 dark:text-white">Cambiar contraseña</h3>
					<p class="text-sm text-slate-500 dark:text-slate-400">Usa una contraseña larga y única. Te pediremos la actual para confirmar.</p>
					<div class="mt-4">@include('profile.partials.update-password-form')</div>
				</div>
				<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
					<h3 class="font-bold text-slate-900 dark:text-white">Consejos de seguridad</h3>
					<ul class="mt-2 list-disc space-y-1.5 pl-5 text-sm text-slate-600 dark:text-slate-300">
						<li>No compartas tu contraseña con nadie.</li>
						<li>Cierra sesión en equipos compartidos.</li>
						<li>Verifica tu correo para recuperar el acceso.</li>
						<li>Si eliminas tu cuenta perderás tus inscripciones.</li>
					</ul>
				</div>
			</div>
			<div x-show="pestaña === 'actividad'" style="display: none;" class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
				@if ($user->role === 'jugador')
					<h3 class="font-bold text-slate-900 dark:text-white">Mis torneos y próximos eventos</h3>
					@if ($inscripciones->isEmpty())
						<p class="mt-2 text-sm text-slate-500">Aún no tienes actividad. Explora torneos y únete al primero.</p>
					@else
						<div class="mt-3 grid gap-4 lg:grid-cols-2">
							<div>
								<p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Historial</p>
								<ul class="mt-2 space-y-2">
									@foreach ($inscripciones as $ins)
										<li class="flex items-center justify-between rounded-lg bg-slate-50 px-3 py-2 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
											<div><p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $ins->torneo->nombre ?? 'Torneo eliminado' }}</p><p class="text-xs text-slate-500">{{ $ins->created_at->format('d/m/Y') }}</p></div>
											@if ($ins->torneo)
												<a href="{{ route('torneos.show', $ins->torneo) }}" class="text-xs font-bold text-violet-600 hover:underline">Ver</a>
											@endif
										</li>
									@endforeach
								</ul>
							</div>
							<div>
								<p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Próximos</p>
								@if ($proximos->isEmpty())
									<p class="mt-2 text-sm text-slate-500">No tienes eventos futuros. Tus inscripciones pasadas siguen arriba como historial.</p>
								@else
									<ul class="mt-2 space-y-2">
										@foreach ($proximos as $t)
											<li class="rounded-lg bg-teal-600/10 px-3 py-2 ring-1 ring-teal-600/20">
												<p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $t->nombre }}</p>
												<p class="text-xs text-slate-500">{{ $t->fecha->format('d/m/Y H:i') }} · {{ $t->juego_deporte }}</p>
											</li>
										@endforeach
									</ul>
								@endif
							</div>
						</div>
					@endif
				@else
					<h3 class="font-bold text-slate-900 dark:text-white">Últimos torneos gestionados</h3>
					@if ($gestionados->isEmpty())
						<p class="mt-2 text-sm text-slate-500">Aún no hay torneos. Crea el primero para empezar.</p>
					@else
						<ul class="mt-3 divide-y divide-slate-100 dark:divide-slate-800">
							@foreach ($gestionados as $t)
								<li class="flex flex-wrap items-center justify-between gap-2 py-2.5">
									<div><p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $t->nombre }}</p><p class="text-xs text-slate-500">{{ $t->inscripciones_count }}/{{ $t->cupo }} inscritos · {{ $t->fecha->format('d/m/Y') }}</p></div>
									<div class="flex gap-2">
										<a href="{{ route('admin.torneos.edit', $t) }}" class="text-xs font-bold text-amber-600 hover:underline">Editar</a>
										<a href="{{ route('admin.torneos.inscritos', $t) }}" class="text-xs font-bold text-teal-600 hover:underline">Inscritos</a>
									</div>
								</li>
							@endforeach
						</ul>
					@endif
				@endif
			</div>
			<div x-show="pestaña === 'preferencias'" style="display: none;" x-data="{ tema: (localStorage.getItem('tema') || 'oscuro') }">
				<div class="rounded-xl bg-white p-5 ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
					<h3 class="font-bold text-slate-900 dark:text-white">Apariencia</h3>
					<p class="text-sm text-slate-500">El tema se guarda en este navegador. También puedes cambiarlo con el botón de sol/luna de la barra superior.</p>
					<div class="mt-3 flex gap-2">
						<button type="button" @click="localStorage.setItem('tema','claro'); document.documentElement.classList.remove('dark'); tema='claro'" :class="tema === 'claro' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200'" class="flex-1 rounded-lg px-4 py-2 text-sm font-semibold">Modo claro</button>
						<button type="button" @click="localStorage.setItem('tema','oscuro'); document.documentElement.classList.add('dark'); tema='oscuro'" :class="tema === 'oscuro' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200'" class="flex-1 rounded-lg px-4 py-2 text-sm font-semibold">Modo oscuro</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
