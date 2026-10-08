<nav x-data="{ abiertoMovil: false, menuUsuario: false }" class="sticky top-0 z-40 border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="flex h-16 justify-between">
			<div class="flex items-center gap-3">
				<a href="{{ route('torneos.index') }}" class="flex items-center gap-2.5">
					<span class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-600 text-lg font-bold text-white">T</span>
					<span class="leading-tight">
						<span class="block text-sm font-bold text-slate-900 dark:text-white">Torneos</span>
						<span class="block text-[11px] font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Competencias</span>
					</span>
				</a>
				<div class="ml-6 hidden items-center gap-1 sm:flex">
					<a href="{{ route('torneos.index') }}" class="rounded-lg px-3.5 py-2 text-sm font-semibold transition {{ request()->routeIs('torneos.*', 'inicio') ? 'bg-violet-600/10 text-violet-700 dark:text-violet-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">Torneos</a>
					@auth
						@if (auth()->user()->role === 'jugador')
							<a href="{{ route('mis-torneos') }}" class="rounded-lg px-3.5 py-2 text-sm font-semibold transition {{ request()->routeIs('mis-torneos*') ? 'bg-teal-600/10 text-teal-700 dark:text-teal-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">Mis torneos</a>
						@endif
						@if (auth()->user()->role === 'admin')
							<a href="{{ route('admin.torneos.index') }}" class="rounded-lg px-3.5 py-2 text-sm font-semibold transition {{ request()->routeIs('admin.*') ? 'bg-amber-400/15 text-amber-700 dark:text-amber-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">Administración</a>
						@endif
						<a href="{{ route('dashboard') }}" class="rounded-lg px-3.5 py-2 text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-slate-500/10 text-slate-900 dark:text-white' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">Panel</a>
					@endauth
				</div>
			</div>
			<div class="hidden items-center gap-2 sm:flex">
				<button type="button" onclick="alternarTema()" title="Cambiar entre modo claro y oscuro" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800" aria-label="Cambiar entre modo claro y oscuro">
					<span data-icona-luna class="hidden">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 12 21.75a9.753 9.753 0 0 0 9.752-6.748Z" /></svg>
					</span>
					<span data-icona-sol>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
					</span>
				</button>
				@guest
					<a href="{{ route('login') }}" class="rounded-lg px-3.5 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Iniciar sesión</a>
					<x-ui.boton variante="primario" href="{{ route('register') }}" class="!px-4 !py-2">Crear cuenta</x-ui.boton>
				@endguest
				@auth
					<x-ui.badge tipo="{{ auth()->user()->role === 'admin' ? 'admin' : 'jugador' }}">{{ auth()->user()->role === 'admin' ? 'Admin' : 'Jugador' }}</x-ui.badge>
					<div class="relative">
						<button type="button" @click="menuUsuario = ! menuUsuario" @click.outside="menuUsuario = false" class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white p-1.5 pr-2.5 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700">
							<span class="flex h-8 w-8 items-center justify-center rounded-md bg-violet-600 text-xs font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
							<span class="max-w-32 truncate text-left text-sm font-semibold text-slate-800 dark:text-slate-100">{{ auth()->user()->name }}</span>
							<svg class="h-4 w-4 text-slate-400 transition" :class="{ 'rotate-180': menuUsuario }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
						</button>
						<div x-show="menuUsuario" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute right-0 mt-2 w-60 overflow-hidden rounded-xl bg-white shadow-xl ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700" style="display: none;">
							<div class="border-b border-slate-100 px-4 py-3 dark:border-slate-800">
								<p class="truncate text-sm font-bold text-slate-900 dark:text-white">{{ auth()->user()->name }}</p>
								<p class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</p>
							</div>
							<div class="p-1.5">
								<a href="{{ route('profile.edit') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Mi perfil</a>
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<button type="submit" class="block w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-rose-600 hover:bg-rose-500/10">Cerrar sesión</button>
								</form>
							</div>
						</div>
					</div>
				@endauth
			</div>
			<div class="-me-2 flex items-center gap-1 sm:hidden">
				<button type="button" onclick="alternarTema()" title="Cambiar entre modo claro y oscuro" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800" aria-label="Cambiar tema">
					<span data-icona-luna class="hidden">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 12 21.75a9.753 9.753 0 0 0 9.752-6.748Z" /></svg>
					</span>
					<span data-icona-sol>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
					</span>
				</button>
				<button @click="abiertoMovil = ! abiertoMovil" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800" aria-label="Abrir menú">
					<svg x-show="! abiertoMovil" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
					<svg x-show="abiertoMovil" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
				</button>
			</div>
		</div>
	</div>
	<div x-show="abiertoMovil" x-transition class="border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900 sm:hidden" style="display: none;">
		<div class="space-y-1 px-4 py-3">
			<a href="{{ route('torneos.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Torneos</a>
			@auth
				@if (auth()->user()->role === 'jugador')
					<a href="{{ route('mis-torneos') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Mis torneos</a>
				@endif
				@if (auth()->user()->role === 'admin')
					<a href="{{ route('admin.torneos.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Administración</a>
				@endif
				<a href="{{ route('dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Panel</a>
			@endauth
			@guest
				<a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Iniciar sesión</a>
				<a href="{{ route('register') }}" class="block rounded-lg bg-violet-600 px-3 py-2 text-center text-sm font-semibold text-white">Crear cuenta</a>
			@endguest
		</div>
		@auth
			<div class="border-t border-slate-200 px-4 py-3 dark:border-slate-800">
				<p class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ auth()->user()->name }}</p>
				<p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
				<div class="mt-2 flex gap-2">
					<a href="{{ route('profile.edit') }}" class="flex-1 rounded-lg bg-slate-100 px-3 py-2 text-center text-sm font-semibold text-slate-700 dark:bg-slate-800 dark:text-slate-200">Mi perfil</a>
					<form method="POST" action="{{ route('logout') }}" class="flex-1">
						@csrf
						<button type="submit" class="w-full rounded-lg bg-rose-600/10 px-3 py-2 text-sm font-semibold text-rose-600">Salir</button>
					</form>
				</div>
			</div>
		@endauth
	</div>
</nav>
