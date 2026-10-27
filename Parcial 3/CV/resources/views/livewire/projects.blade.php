<div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-12 space-y-10">

    <!-- HEADER & FILTERS -->
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b-4 border-black pb-6">
            <div>
                <div class="inline-flex items-center gap-2 bg-[#00F0FF] border-2 border-black px-2.5 py-0.5 font-code text-xs font-black uppercase shadow-[2px_2px_0px_0px_#000] mb-2">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <span>CATÁLOGO OFICIAL DE PROYECTOS</span>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black uppercase tracking-tight text-black">
                    PROYECTOS &amp; DESARROLLO
                </h1>
                <p class="font-code text-sm sm:text-base text-gray-700 mt-1 max-w-2xl">
                    6 proyectos principales de desarrollo web, ingeniería de compiladores, aplicaciones móviles con Flutter y algoritmos sobre teoría de grafos.
                </p>
            </div>

            <!-- Counter Badge -->
            <div class="bg-[#FFE600] border-3 border-black p-3 text-center neo-box-sm">
                <div class="font-black text-3xl font-code">{{ count($filteredProjects) }} / 6</div>
                <div class="font-code text-[11px] font-black uppercase">PROYECTOS VISIBLES</div>
            </div>
        </div>

        <!-- Filter and Search Toolbar -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            
            <!-- Category Buttons -->
            <div class="md:col-span-8 flex flex-wrap gap-2" role="group" aria-label="Filtro de proyectos por categoría">
                <button type="button" 
                        wire:click="setCategory('all')"
                        class="neo-btn-sm px-3 py-1.5 text-xs font-code font-black uppercase {{ $categoryFilter === 'all' ? 'bg-black text-[#FFE600] shadow-[3px_3px_0px_0px_#FFE600]' : 'bg-white text-black hover:bg-[#FFE600]' }}">
                    TODOS (6)
                </button>
                <button type="button" 
                        wire:click="setCategory('web')"
                        class="neo-btn-sm px-3 py-1.5 text-xs font-code font-black uppercase {{ $categoryFilter === 'web' ? 'bg-[#FFE600] text-black' : 'bg-white text-black hover:bg-[#FFE600]' }}">
                    DESARROLLO WEB (3)
                </button>
                <button type="button" 
                        wire:click="setCategory('mobile')"
                        class="neo-btn-sm px-3 py-1.5 text-xs font-code font-black uppercase {{ $categoryFilter === 'mobile' ? 'bg-[#00F0FF] text-black' : 'bg-white text-black hover:bg-[#00F0FF]' }}">
                    MÓVIL / FLUTTER (1)
                </button>
                <button type="button" 
                        wire:click="setCategory('systems')"
                        class="neo-btn-sm px-3 py-1.5 text-xs font-code font-black uppercase {{ $categoryFilter === 'systems' ? 'bg-[#FF3366] text-white' : 'bg-white text-black hover:bg-[#FF3366] hover:text-white' }}">
                    SISTEMAS &amp; ALGORITMOS (2)
                </button>
            </div>

            <!-- Live Search Bar -->
            <div class="md:col-span-4 relative">
                <div class="relative flex items-center">
                    <svg class="w-4 h-4 text-gray-500 absolute left-3 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"></path>
                    </svg>
                    <input type="text"
                        wire:model.live.debounce.150ms="search"
                        placeholder="Buscar tecnología o proyecto..."
                        aria-label="Buscar proyectos por tecnología o nombre"
                        class="w-full pl-9 pr-8 py-2 border-3 border-black bg-white font-code text-xs sm:text-sm font-bold shadow-[3px_3px_0px_0px_#000] focus:outline-none focus:bg-[#FFFDF5]">
                    @if ($search)
                        <button type="button" wire:click="$set('search', '')" aria-label="Limpiar búsqueda" class="absolute right-3 font-code font-black text-xs text-gray-500 hover:text-black">✕</button>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- PROJECTS GRID -->
    @if (empty($filteredProjects))
        <div class="neo-box-lg bg-white p-12 text-center space-y-4">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#FFE600] border-3 border-black rounded-full shadow-[3px_3px_0px_0px_#000]">
                <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-black uppercase">No se encontraron proyectos</h3>
            <p class="font-code text-sm text-gray-600 max-w-md mx-auto">
                No hay coincidencias con el término "{{ $search }}". Intenta con términos como 'Laravel', 'C#', 'Flutter', 'React' o 'MySQL'.
            </p>
            <button type="button" wire:click="$set('search', ''); setCategory('all');" class="neo-btn bg-[#FFE600] text-black px-4 py-2 text-xs font-black uppercase">
                REINICIAR BÚSQUEDA
            </button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach ($filteredProjects as $project)
                <div class="neo-box bg-white flex flex-col justify-between overflow-hidden group hover:shadow-[8px_8px_0px_0px_#000] transition-all">
                    
                    <!-- Top Ribbon -->
                    <div class="border-b-3 border-black p-4 flex items-center justify-between" style="background-color: {{ $project['accent'] }};">
                        <span class="font-code font-black text-xs uppercase px-2 py-0.5 bg-black text-white border border-black">
                            {{ $project['category_label'] }}
                        </span>
                        <span class="font-code text-xs font-bold text-black bg-white px-2 py-0.5 border border-black">
                            {{ $project['period'] }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 sm:p-6 space-y-4 flex-grow">
                        <!-- Role -->
                        <div class="font-code text-xs font-black uppercase text-[#FF3366]">
                            ROL: {{ $project['role'] }}
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-black uppercase tracking-tight text-black leading-tight group-hover:text-[#FF3366] transition-colors">
                            {{ $project['title'] }}
                        </h3>

                        <!-- Summary -->
                        <p class="text-sm text-gray-800 font-medium leading-relaxed">
                            {{ $project['summary'] }}
                        </p>

                        <!-- Highlights -->
                        <div class="space-y-2 border-t-2 border-dashed border-gray-300 pt-3">
                            <div class="font-code text-[11px] font-black uppercase text-gray-700">Aspectos Destacados:</div>
                            <ul class="space-y-1.5 text-xs text-gray-700">
                                @foreach (array_slice($project['highlights'], 0, 2) as $bullet)
                                    <li class="flex items-start gap-1.5">
                                        <span class="text-black font-black">▸</span>
                                        <span class="leading-snug">{{ $bullet }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Tech Tags -->
                        <div class="pt-2">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($project['tags'] as $tag)
                                    <span class="neo-tag bg-gray-100 text-black text-[10px] hover:bg-[#FFE600] transition-colors">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer Actions -->
                    <div class="border-t-3 border-black p-4 bg-[#FFFDF5] flex items-center justify-between gap-2">
                        <button type="button" 
                                @click="if (typeof lockBodyScroll === 'function') lockBodyScroll(true)"
                                wire:click="openProjectModal('{{ $project['id'] }}')" 
                                class="neo-btn-sm bg-black text-white hover:bg-[#FFE600] hover:text-black w-full py-2.5 text-xs font-code font-black uppercase text-center flex items-center justify-center gap-2">
                            <span>VER DETALLES COMPLETOS</span>
                            <span>→</span>
                        </button>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

    <!-- PROJECT DETAIL MODAL (Viewport-Locked Contained Flex Layout) -->
    @if ($selectedProject)
        <div class="fixed inset-0 z-50 w-screen h-screen overflow-hidden flex items-center justify-center p-4 sm:p-6 !mt-0"
            role="dialog"
            aria-modal="true"
            aria-labelledby="project-modal-title"
            x-data="{
                init() {
                    if (typeof lockBodyScroll === 'function') lockBodyScroll(true);
                },
                destroy() {
                    if (typeof lockBodyScroll === 'function') lockBodyScroll(false);
                }
            }"
            @keydown.escape.window="if (typeof lockBodyScroll === 'function') lockBodyScroll(false); $wire.closeProjectModal()">
            
            <!-- Fixed backdrop overlay covering 100% of the viewport and blocking outer wheel/touch scroll -->
            <div class="fixed inset-0 w-screen h-screen bg-black/85 modal-backdrop transition-opacity cursor-pointer"
                @wheel.prevent
                @touchmove.prevent
                @click="if (typeof lockBodyScroll === 'function') lockBodyScroll(false)"
                wire:click="closeProjectModal"
                aria-hidden="true"></div>

            <!-- Contained Modal Dialog: fits completely on screen (max-h-[85vh]) with pinned header & footer -->
            <div class="relative z-10 w-full max-w-2xl max-h-[85vh] flex flex-col neo-box-lg bg-white text-left overflow-hidden"
                @click.stop>
                
                <!-- Modal Top Header (Fixed / Shrink-0) -->
                <div class="shrink-0 border-b-3 border-black p-4 sm:p-5 flex items-center justify-between" style="background-color: {{ $selectedProject['accent'] }};">
                    <div>
                        <span class="font-code text-xs font-black uppercase bg-black text-white px-2 py-0.5 border border-black inline-block">
                            {{ $selectedProject['category_label'] }}
                        </span>
                        <div class="font-code text-xs font-bold text-black mt-1">{{ $selectedProject['period'] }}</div>
                    </div>
                    <button type="button"
                            @click="if (typeof lockBodyScroll === 'function') lockBodyScroll(false)"
                            wire:click="closeProjectModal"
                            aria-label="Cerrar ventana de detalles"
                            class="neo-btn-sm bg-black text-white px-3 py-1 font-black text-sm hover:bg-[#FF3366]">
                        ✕ CERRAR
                    </button>
                </div>

                <!-- Modal Scrollable Content Body (Flex-1, Overscroll Contained) -->
                <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain p-5 sm:p-6 space-y-5 font-sans">
                    <div>
                        <div class="font-code text-xs font-black uppercase text-[#FF3366] mb-1">
                            ROL: {{ $selectedProject['role'] }}
                        </div>
                        <h2 id="project-modal-title" class="text-2xl sm:text-3xl font-black uppercase tracking-tight text-black">
                            {{ $selectedProject['title'] }}
                        </h2>
                    </div>

                    <!-- Architecture Overview -->
                    <div class="neo-box-sm bg-[#FFFDF5] p-3.5 sm:p-4">
                        <div class="font-code text-xs font-black uppercase text-gray-600 mb-1">// ARQUITECTURA TÉCNICA</div>
                        <p class="text-sm font-medium text-gray-900 leading-relaxed">
                            {{ $selectedProject['tech_details'] }}
                        </p>
                    </div>

                    <!-- Complete Project Highlights -->
                    <div class="space-y-2.5">
                        <h4 class="font-code font-black text-sm uppercase border-b-2 border-black pb-1">
                            LOGROS Y RESPONSABILIDADES PRINCIPALES:
                        </h4>
                        <ul class="space-y-2">
                            @foreach ($selectedProject['highlights'] as $highlight)
                                <li class="flex items-start gap-2.5 text-sm text-gray-800">
                                    <span class="text-base font-black text-black leading-none bg-[#FFE600] px-1 border border-black shrink-0 mt-0.5">✓</span>
                                    <span class="leading-relaxed">{{ $highlight }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- All Tech Tags -->
                    <div>
                        <h4 class="font-code font-black text-xs uppercase text-gray-600 mb-2">// TECNOLOGÍAS UTILIZADAS:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($selectedProject['tags'] as $tag)
                                <span class="neo-tag bg-[#FFE600] text-black text-xs">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal Footer (Fixed / Shrink-0) -->
                <div class="shrink-0 border-t-3 border-black p-3.5 sm:p-4 bg-[#F4EEDD] flex justify-between items-center">
                    <span class="font-code text-xs text-gray-600">Presiona ESC para cerrar</span>
                    <button type="button"
                            @click="if (typeof lockBodyScroll === 'function') lockBodyScroll(false)"
                            wire:click="closeProjectModal"
                            class="neo-btn-sm bg-black text-white px-4 py-1.5 text-xs font-black uppercase hover:bg-[#FFE600] hover:text-black">
                        ENTENDIDO
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- BOTTOM CTA BANNER -->
    <div class="neo-box-lg bg-[#00F0FF] p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="text-2xl sm:text-3xl font-black uppercase tracking-tight">
                ¿TE INTERESA CONOCER MI EXPERIENCIA LABORAL?
            </h3>
            <p class="font-code text-xs sm:text-sm text-gray-800 mt-1">
                Conoce mi paso por Tipstate S.A. de C.V. y el Laboratorio de Electrónica (LESD) de la UASLP.
            </p>
        </div>
        <a href="{{ route('experience') }}" class="neo-btn bg-[#FF3366] text-white px-6 py-3 text-sm sm:text-base whitespace-nowrap hover:bg-black">
            <span>IR A EXPERIENCIA →</span>
        </a>
    </div>

</div>
