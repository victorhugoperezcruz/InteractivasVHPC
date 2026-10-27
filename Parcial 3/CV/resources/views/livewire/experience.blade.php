<div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-12 space-y-12">

    <!-- PAGE HEADER -->
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b-4 border-black pb-6">
            <div>
                <div class="inline-flex items-center gap-2 bg-[#FF3366] text-white border-2 border-black px-2.5 py-0.5 font-code text-xs font-black uppercase shadow-[2px_2px_0px_0px_#000] mb-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                    <span>TRAYECTORIA PROFESIONAL &amp; ACADÉMICA</span>
                </div>
                <h1 class="text-4xl sm:text-6xl font-black uppercase tracking-tight text-black">
                    EXPERIENCIA &amp; FORMACIÓN
                </h1>
                <p class="font-code text-sm sm:text-base text-gray-700 mt-1 max-w-2xl">
                    Historial laboral, pasantías y formación universitaria. Desde desarrollo de software corporativo con inteligencia artificial hasta proyectos mecatrónicos y electrónicos en laboratorio.
                </p>
            </div>

            <!-- Download Button -->
            <a href="{{ asset('CV_Victor_Perez_Cruz.pdf') }}" target="_blank" download="CV_Victor_Perez_Cruz.pdf"
                class="neo-btn bg-[#00FF66] text-black px-5 py-3 text-sm font-code font-black uppercase flex items-center gap-2 hover:bg-[#FFE600]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4m-9 8h10"></path>
                </svg>
                <span>DESCARGAR CURRÍCULUM (PDF)</span>
            </a>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2" role="group" aria-label="Filtro de experiencia por sector">
            <button type="button" 
                    wire:click="setTab('all')"
                    class="neo-btn-sm px-4 py-2 text-xs font-code font-black uppercase {{ $tab === 'all' ? 'bg-black text-[#FFE600] shadow-[3px_3px_0px_0px_#FFE600]' : 'bg-white text-black hover:bg-[#FFE600]' }}">
                TODA LA TRAYECTORIA
            </button>
            <button type="button" 
                    wire:click="setTab('industry')"
                    class="neo-btn-sm px-4 py-2 text-xs font-code font-black uppercase {{ $tab === 'industry' ? 'bg-[#FFE600] text-black' : 'bg-white text-black hover:bg-[#FFE600]' }}">
                INDUSTRIA / SOFTWARE (TIPSTATE)
            </button>
            <button type="button" 
                    wire:click="setTab('lab')"
                    class="neo-btn-sm px-4 py-2 text-xs font-code font-black uppercase {{ $tab === 'lab' ? 'bg-[#00F0FF] text-black' : 'bg-white text-black hover:bg-[#00F0FF]' }}">
                LABORATORIO Y ELECTRÓNICA (LESD)
            </button>
            <button type="button" 
                    wire:click="setTab('education')"
                    class="neo-btn-sm px-4 py-2 text-xs font-code font-black uppercase {{ $tab === 'education' ? 'bg-[#FF3366] text-white' : 'bg-white text-black hover:bg-[#FF3366] hover:text-white' }}">
                EDUCACIÓN (UASLP)
            </button>
        </div>
    </div>

    <!-- METRICS BANNER -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="neo-box bg-[#FFE600] p-4 text-center">
            <div class="font-code font-black text-3xl sm:text-4xl text-black">2026</div>
            <div class="font-code text-xs font-black uppercase text-gray-800 mt-1">Graduación UASLP</div>
        </div>
        <div class="neo-box bg-[#00F0FF] p-4 text-center">
            <div class="font-code font-black text-3xl sm:text-4xl text-black">+2 AÑOS</div>
            <div class="font-code text-xs font-black uppercase text-gray-800 mt-1">Soporte Lab LESD</div>
        </div>
        <div class="neo-box bg-[#FF3366] text-white p-4 text-center">
            <div class="font-code font-black text-3xl sm:text-4xl">P1-P11</div>
            <div class="font-code text-xs font-black uppercase text-white mt-1">Sesiones de Lab</div>
        </div>
        <div class="neo-box bg-[#00FF66] p-4 text-center">
            <div class="font-code font-black text-3xl sm:text-4xl text-black">100%</div>
            <div class="font-code text-xs font-black uppercase text-gray-800 mt-1">Software + Electrónica</div>
        </div>
    </div>

    <!-- TIMELINE STRUCTURE -->
    <div class="relative border-l-4 border-black ml-4 sm:ml-8 pl-6 sm:pl-10 space-y-12">
        
        @foreach ($filteredExperiences as $exp)
            <div class="relative">
                <!-- Timeline Dot Indicator with Semantic SVG Icon -->
                <div class="absolute -left-[35px] sm:-left-[51px] top-6 w-8 h-8 rounded-full border-3 border-black flex items-center justify-center font-black text-sm shadow-[2px_2px_0px_0px_#000]"
                    style="background-color: {{ $exp['accent'] }};">
                    @if ($exp['icon'] === 'software')
                        <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="16 18 22 12 16 6"></polyline>
                            <polyline points="8 6 2 12 8 18"></polyline>
                        </svg>
                    @elseif ($exp['icon'] === 'hardware')
                        <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                            <rect x="9" y="9" width="6" height="6"></rect>
                            <line x1="9" y1="1" x2="9" y2="4"></line>
                            <line x1="15" y1="1" x2="15" y2="4"></line>
                            <line x1="9" y1="20" x2="9" y2="23"></line>
                            <line x1="15" y1="20" x2="15" y2="23"></line>
                            <line x1="20" y1="9" x2="23" y2="9"></line>
                            <line x1="20" y1="15" x2="23" y2="15"></line>
                            <line x1="1" y1="9" x2="4" y2="9"></line>
                            <line x1="1" y1="15" x2="4" y2="15"></line>
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    @endif
                </div>

                <!-- Main Experience Card -->
                <div class="neo-box-lg bg-white overflow-hidden">
                    
                    <!-- Top Bar -->
                    <div class="border-b-3 border-black p-4 sm:p-5 flex flex-wrap items-center justify-between gap-3"
                        style="background-color: {{ $exp['accent'] }};">
                        <div>
                            <span class="font-code font-black text-xs uppercase bg-black text-white px-2 py-0.5 border border-black inline-block">
                                {{ $exp['type_label'] }}
                            </span>
                            <div class="font-code font-bold text-xs text-black mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 inline text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path>
                                    <circle cx="12" cy="9" r="2.5"></circle>
                                </svg>
                                <span>{{ $exp['location'] }}</span>
                            </div>
                        </div>
                        <div class="font-code font-black text-xs sm:text-sm bg-white border-2 border-black px-3 py-1 shadow-[2px_2px_0px_0px_#000] flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 inline text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>{{ $exp['period'] }}</span>
                        </div>
                    </div>

                    <!-- Content Body -->
                    <div class="p-6 sm:p-8 space-y-6">
                        <div>
                            <div class="font-code text-xs sm:text-sm font-black uppercase text-[#FF3366] mb-1">
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black uppercase tracking-tight text-black">
                                {{ $exp['role'] }}
                            </h2>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-800 mt-1">
                                {{ $exp['title'] }}
                            </h3>
                        </div>

                        <!-- Summary block -->
                        <div class="bg-[#FFFDF5] border-2 border-black p-4 font-medium text-sm text-gray-800 leading-relaxed">
                            {{ $exp['summary'] }}
                        </div>

                        <!-- Bullet points -->
                        <div class="space-y-3">
                            <h4 class="font-code font-black text-xs sm:text-sm uppercase text-black border-b-2 border-black pb-1">
                                RESPONSABILIDADES Y LOGROS PRINCIPALES:
                            </h4>
                            <ul class="space-y-3 text-sm text-gray-800">
                                @foreach ($exp['bullets'] as $bullet)
                                    <li class="flex items-start gap-3">
                                        <span class="font-black text-base text-black bg-[#FFE600] px-1.5 py-0.2 border border-black leading-none mt-0.5">
                                            ✓
                                        </span>
                                        <span class="leading-relaxed font-medium">
                                            {{ $bullet }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Technologies Used -->
                        <div class="border-t-2 border-dashed border-gray-300 pt-4">
                            <div class="font-code text-xs font-black uppercase text-gray-600 mb-2">
                                // COMPETENCIAS &amp; TECNOLOGÍAS APLICADAS:
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($exp['tech'] as $tech)
                                    <span class="neo-tag bg-gray-100 text-black text-xs hover:bg-[#FFE600] transition-colors">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

    </div>

    <!-- SPECIAL HIGHLIGHT: RELOJ DE CARTAS ESP32 & IA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
        
        <!-- Highlight Card 1: ESP32 -->
        <div class="neo-box bg-[#00F0FF] p-6 space-y-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-black text-[#00F0FF] border-2 border-black flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#00F0FF]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </div>
                <span class="font-code font-black text-xs uppercase bg-black text-white px-2 py-0.5 border border-black">
                    PROYECTO MECATRÓNICO DESTACADO
                </span>
            </div>
            <h3 class="text-xl sm:text-2xl font-black uppercase text-black">
                "Reloj de Cartas" Cinético ESP32
            </h3>
            <p class="text-sm font-medium text-gray-900 leading-relaxed">
                Proyecto desarrollado en el Laboratorio de Electrónica (LESD). Integra microcontrolador ESP32, actuadores con motores paso a paso, diseño y fabricación aditiva (piezas impresas en 3D) y programación integral en C/C++.
            </p>
            <div class="flex flex-wrap gap-1.5 pt-1">
                <span class="neo-tag bg-white text-black text-[11px]">ESP32</span>
                <span class="neo-tag bg-white text-black text-[11px]">Programación C++</span>
                <span class="neo-tag bg-white text-black text-[11px]">Motores Paso a Paso</span>
                <span class="neo-tag bg-white text-black text-[11px]">Modelado 3D</span>
            </div>
        </div>

        <!-- Highlight Card 2: AI -->
        <div class="neo-box bg-[#FFE600] p-6 space-y-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-black text-[#FFE600] border-2 border-black flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#FFE600]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2a4 4 0 0 1 4 4c0 1.1-.9 2-2 2h-4c-1.1 0-2-.9-2-2a4 4 0 0 1 4-4z"></path>
                        <path d="M8 8v3a4 4 0 0 0 8 0V8"></path>
                        <path d="M4 14a8 8 0 0 0 16 0"></path>
                        <line x1="12" y1="18" x2="12" y2="22"></line>
                    </svg>
                </div>
                <span class="font-code font-black text-xs uppercase bg-black text-[#FFE600] px-2 py-0.5 border border-black">
                    SOFTWARE E IA EN TIPSTATE
                </span>
            </div>
            <h3 class="text-xl sm:text-2xl font-black uppercase text-black">
                Ecosistema de IA &amp; Pagos Stripe
            </h3>
            <p class="text-sm font-medium text-gray-900 leading-relaxed">
                Implementación de máquinas de estados finitos en Respond.io para gestión de clientes potenciales, programación asíncrona en JavaScript para Airtable, envío automatizado de reportes por WhatsApp y técnicas de protección e ingeniería de instrucciones para IA.
            </p>
            <div class="flex flex-wrap gap-1.5 pt-1">
                <span class="neo-tag bg-white text-black text-[11px]">Agentes de IA</span>
                <span class="neo-tag bg-white text-black text-[11px]">Pasarela Stripe</span>
                <span class="neo-tag bg-white text-black text-[11px]">Automatización WhatsApp</span>
                <span class="neo-tag bg-white text-black text-[11px]">Seguridad de IA</span>
            </div>
        </div>

    </div>

    <!-- CALL TO ACTION BANNER -->
    <div class="neo-box-lg bg-[#FF3366] text-white p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <span class="bg-black text-[#FFE600] px-2 py-0.5 font-code text-xs font-black uppercase border border-black">
                CONTACTO &amp; CONTRATACIÓN
            </span>
            <h3 class="text-2xl sm:text-3xl font-black uppercase tracking-tight mt-1">
                ¿CONSTRUIMOS ALGO EXTRAORDINARIO JUNTOS?
            </h3>
            <p class="font-code text-xs sm:text-sm text-pink-100 mt-1">
                Disponible para desarrollo de software, proyectos de sistemas embebidos e integración de agentes de inteligencia artificial.
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('home') }}" class="neo-btn bg-black text-white px-5 py-3 text-sm font-code font-black uppercase hover:bg-white hover:text-black">
                VOLVER AL INICIO
            </a>
        </div>
    </div>

</div>
