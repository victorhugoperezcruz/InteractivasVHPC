<div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-12 space-y-16">

    <!-- HERO SECTION -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <!-- Left: Intro & Bio -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Status Badge -->
            <div class="inline-flex items-center gap-2 bg-[#FFE600] border-3 border-black px-3 py-1 font-code font-black text-xs uppercase shadow-[3px_3px_0px_0px_#000]">
                <span class="inline-block w-2.5 h-2.5 bg-[#00FF66] border border-black rounded-full animate-ping"></span>
                <span>DISPONIBLE PARA DESARROLLO</span>
            </div>

            <!-- Main Heading -->
            <div>
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight uppercase leading-[0.95] text-black">
                    VÍCTOR HUGO<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF3366] via-purple-600 to-[#00F0FF] underline decoration-black decoration-wavy decoration-2">
                        PÉREZ CRUZ
                    </span>
                </h1>
                <p class="font-code text-sm sm:text-base font-bold text-gray-700 mt-2">
                    San Luis Potosí, México &bull; vils.123@hotmail.com &bull; +52 (444) 540-41-17
                </p>
            </div>

            <!-- Role Pills -->
            <div class="flex flex-wrap gap-2 pt-1">
                <span class="neo-tag bg-[#FFE600] text-black">DESARROLLADOR DE SOFTWARE</span>
                <span class="neo-tag bg-[#00F0FF] text-black">SISTEMAS EMBEBIDOS</span>
                <span class="neo-tag bg-[#FF3366] text-white">INTELIGENCIA ARTIFICIAL Y PAGOS</span>
                <span class="neo-tag bg-[#00FF66] text-black">DESARROLLO MÓVIL</span>
                <span class="neo-tag bg-white text-black">UASLP 2026</span>
            </div>

            <!-- Bio Statement -->
            <div class="neo-box bg-white p-5 sm:p-6 relative">
                <div class="absolute -top-3.5 right-4 bg-black text-[#FFE600] font-code text-xs font-black px-2 py-0.5 border border-black uppercase">
                    // PERFIL PROFESIONAL
                </div>
                <p class="text-base sm:text-lg text-gray-900 font-medium leading-relaxed">
                    Estudiante de <strong class="font-black bg-[#FFE600] px-1">Ingeniería en Computación</strong> en la 
                    <strong>Universidad Autónoma de San Luis Potosí</strong> (Graduación esperada: Diciembre 2026).
                </p>
                <p class="text-sm sm:text-base text-gray-800 font-medium leading-relaxed mt-2.5">
                    "Mi plan de estudios me ha dado una base sólida en software y hardware: estructuras de datos, algoritmos, compiladores, sistemas embebidos, bases de datos y administración de servidores."
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3 sm:gap-4 pt-2">
                <a href="{{ route('projects') }}" class="neo-btn bg-[#FFE600] text-black px-5 py-3 text-sm sm:text-base">
                    <span>VER PROYECTOS (6)</span>
                    <span class="text-lg">→</span>
                </a>
                <a href="{{ route('experience') }}" class="neo-btn bg-[#00F0FF] text-black px-5 py-3 text-sm sm:text-base">
                    <span>TRAYECTORIA LABORAL</span>
                    <span class="text-lg">→</span>
                </a>
                <a href="{{ asset('CV_Victor_Perez_Cruz.pdf') }}" target="_blank" download="CV_Victor_Perez_Cruz.pdf" class="neo-btn bg-white text-black px-5 py-3 text-sm sm:text-base hover:bg-[#00FF66] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4m-9 8h10"></path>
                    </svg>
                    <span>DESCARGAR CURRÍCULUM (PDF)</span>
                </a>
            </div>
        </div>

        <!-- Right: Interactive Avatar / Tech Visual Card -->
        <div class="lg:col-span-5 space-y-4">
            <div class="neo-box-lg bg-[#00F0FF] p-6 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-[#FFE600] rounded-full border-4 border-black -z-0 opacity-70"></div>
                <div class="relative z-10 space-y-4">
                    <div class="flex justify-between items-center border-b-3 border-black pb-3">
                        <span class="font-code font-black text-sm uppercase bg-black text-[#00FF66] px-2 py-0.5">
                            ID: VILS-UASLP-2026
                        </span>
                        <span class="font-black text-xs bg-white border-2 border-black px-2 py-0.5">
                            MÉXICO (GMT-6)
                        </span>
                    </div>

                    <div class="bg-white border-3 border-black p-4 space-y-3 shadow-[4px_4px_0px_0px_#000]">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-[#FF3366] text-white border-2 border-black flex items-center justify-center font-code font-black text-lg">
                                &lt;/&gt;
                            </div>
                            <div>
                                <h3 class="font-black text-base uppercase leading-none">Víctor H. Pérez Cruz</h3>
                                <span class="font-code text-xs text-gray-600 font-bold">Ingeniería en Computación</span>
                            </div>
                        </div>

                        <div class="border-t-2 border-dashed border-black pt-3 space-y-1.5 font-code text-xs">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Institución:</span>
                                <span class="font-black">UASLP</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Especialidad:</span>
                                <span class="font-black">Software y Sistemas Embebidos</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pasantía reciente:</span>
                                <span class="font-black bg-[#FFE600] px-1">Tipstate S.A. de C.V.</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Laboratorio:</span>
                                <span class="font-black bg-[#00F0FF] px-1">LESD - UASLP</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Metrics in Card -->
                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <div class="bg-black text-white p-3 border-2 border-black font-code text-center">
                            <div class="text-2xl font-black text-[#FFE600]">+2 AÑOS</div>
                            <div class="text-[10px] uppercase text-gray-300">Lab y Soporte UASLP</div>
                        </div>
                        <div class="bg-black text-white p-3 border-2 border-black font-code text-center">
                            <div class="text-2xl font-black text-[#00F0FF]">100%</div>
                            <div class="text-[10px] uppercase text-gray-300">Software + Electrónica</div>
                        </div>
                    </div>

                    <div class="text-center font-code text-xs font-bold pt-1">
                        Presiona <kbd class="bg-black text-white px-1.5 py-0.5 border border-black">T</kbd> para ir a la terminal interactiva ↓
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: INTERACTIVE NEOBRUTALIST TERMINAL -->
    <section id="terminal" class="space-y-4">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <div class="inline-block bg-[#FF3366] text-white px-2.5 py-0.5 font-code text-xs font-black border-2 border-black uppercase mb-1">
                    CONSOLA INTERACTIVA
                </div>
                <h2 class="text-3xl sm:text-4xl font-black uppercase tracking-tight">
                    TERMINAL DE LÍNEA DE COMANDOS
                </h2>
                <p class="font-code text-xs sm:text-sm text-gray-700">
                    Interactúa en tiempo real escribiendo comandos o haciendo clic en los botones rápidos.
                </p>
            </div>

            <!-- Quick command chips -->
            <div class="flex flex-wrap gap-1.5">
                <span class="font-code text-xs font-bold self-center mr-1">Comandos rápidos:</span>
                <button type="button" wire:click="runCommand('whoami')" class="neo-btn-sm bg-[#FFE600] px-2 py-1 text-xs font-code font-black">whoami</button>
                <button type="button" wire:click="runCommand('skills')" class="neo-btn-sm bg-[#00F0FF] px-2 py-1 text-xs font-code font-black">skills</button>
                <button type="button" wire:click="runCommand('projects')" class="neo-btn-sm bg-[#FF3366] text-white px-2 py-1 text-xs font-code font-black">projects</button>
                <button type="button" wire:click="runCommand('experience')" class="neo-btn-sm bg-[#00FF66] px-2 py-1 text-xs font-code font-black">experience</button>
                <button type="button" wire:click="runCommand('help')" class="neo-btn-sm bg-white px-2 py-1 text-xs font-code font-black">help</button>
                <button type="button" wire:click="runCommand('matrix')" class="neo-btn-sm bg-black text-[#00FF66] px-2 py-1 text-xs font-code font-black">matrix</button>
                <button type="button" wire:click="runCommand('clear')" class="neo-btn-sm bg-gray-200 px-2 py-1 text-xs font-code font-black">clear</button>
            </div>
        </div>

        <!-- Terminal Box Container -->
        <div id="terminal-box" class="neo-box-lg bg-[#111111] text-[#00FF66] font-code overflow-hidden shadow-[8px_8px_0px_0px_#000]">
            <!-- Terminal Titlebar -->
            <div class="bg-[#222222] border-b-3 border-black px-4 py-2.5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-[#FF5F56] border border-black inline-block"></span>
                    <span class="w-3.5 h-3.5 rounded-full bg-[#FFBD2E] border border-black inline-block"></span>
                    <span class="w-3.5 h-3.5 rounded-full bg-[#27C93F] border border-black inline-block"></span>
                    <span class="ml-2 text-xs font-black text-gray-300">vhpc@portafolio-victor:~ (bash)</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-400 font-bold">
                    <span class="hidden sm:inline">UTF-8</span>
                    <span class="bg-[#FFE600] text-black px-1.5 py-0.2 font-black border border-black">LIVEWIRE 4 ACTIVO</span>
                </div>
            </div>

            <!-- Terminal Output Area (Auto-scrolls on every command execution) -->
            <div class="p-4 sm:p-6 space-y-4 max-h-[440px] overflow-y-auto"
                id="terminal-screen"
                x-data="{
                    scrollToLatest() {
                        this.$nextTick(() => {
                            this.$el.scrollTo({ top: this.$el.scrollHeight, behavior: 'smooth' });
                            const box = document.getElementById('terminal-box');
                            if (box) {
                                const rect = box.getBoundingClientRect();
                                if (rect.bottom > window.innerHeight || rect.top < 70) {
                                    box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                                }
                            }
                        });
                    }
                }"
                @terminal-command-executed.window="scrollToLatest()">
                @foreach ($terminalHistory as $item)
                    <div class="space-y-1">
                        <!-- Command line prompt -->
                        <div class="flex items-center gap-2 text-xs sm:text-sm">
                            <span class="text-[#00F0FF] font-black">vhpc@uaslp:~$</span>
                            <span class="text-white font-bold">{{ $item['command'] }}</span>
                        </div>
                        
                        <!-- Output -->
                        <div class="text-xs sm:text-sm whitespace-pre-wrap pl-4 border-l-2 {{ $item['type'] === 'error' ? 'border-red-500 text-red-400' : ($item['type'] === 'info' ? 'border-[#00F0FF] text-[#00F0FF]' : ($item['type'] === 'system' ? 'border-[#FFE600] text-[#FFE600]' : 'border-[#00FF66] text-green-300')) }}">
                            {{ $item['output'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Terminal Input Form -->
            <form wire:submit.prevent="runCommand" class="border-t-2 border-[#333333] bg-[#1a1a1a] p-3 flex items-center gap-2">
                <span class="text-[#00F0FF] font-black text-xs sm:text-sm pl-2 select-none">vhpc@uaslp:~$</span>
                <input type="text" 
                    id="terminal-input"
                    wire:model="commandInput"
                    placeholder="Escribe 'whoami', 'skills', 'projects', 'help'..."
                    class="flex-grow bg-transparent text-white font-code text-xs sm:text-sm outline-none border-none focus:ring-0 placeholder-gray-500"
                    autocomplete="off"
                    spellcheck="false">
                <button type="submit" class="neo-btn-sm bg-[#00FF66] text-black px-3 py-1 text-xs font-black uppercase">
                    EJECUTAR ↵
                </button>
            </form>
        </div>
    </section>

    <!-- SECTION: HABILIDADES TÉCNICAS -->
    <section class="space-y-6">
        <div class="border-b-4 border-black pb-3 flex flex-wrap items-end justify-between gap-4">
            <div>
                <div class="inline-block bg-[#00F0FF] text-black px-2 py-0.5 font-code text-xs font-black border-2 border-black uppercase mb-1">
                    REPERTORIO TECNOLÓGICO
                </div>
                <h2 class="text-3xl sm:text-4xl font-black uppercase tracking-tight">
                    HABILIDADES TÉCNICAS
                </h2>
                <p class="font-code text-xs sm:text-sm text-gray-700">
                    Lenguajes, entornos de trabajo y herramientas de desarrollo que domino.
                </p>
            </div>
            <span class="neo-tag bg-[#FFE600] text-black">TOTAL: +30 TECNOLOGÍAS DOMINADAS</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Lenguajes -->
            <div class="neo-box bg-white p-5 space-y-4">
                <div class="flex items-center justify-between border-b-2 border-black pb-2">
                    <h3 class="font-black text-lg uppercase font-code">01. Lenguajes</h3>
                    <span class="bg-[#FFE600] px-1.5 py-0.5 font-code font-black text-xs border border-black">10</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @php
                        $languages = ['C#', 'JavaScript (ES6+)', 'TypeScript', 'Java', 'Python', 'C', 'PHP', 'SQL', 'Ensamblador', 'Dart'];
                    @endphp
                    @foreach ($languages as $lang)
                        <span class="neo-tag bg-[#FFE600] text-black text-[11px]">{{ $lang }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Entornos de Trabajo -->
            <div class="neo-box bg-white p-5 space-y-4">
                <div class="flex items-center justify-between border-b-2 border-black pb-2">
                    <h3 class="font-black text-lg uppercase font-code">02. Entornos</h3>
                    <span class="bg-[#00F0FF] px-1.5 py-0.5 font-code font-black text-xs border border-black">7</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @php
                        $frameworks = ['React', 'Angular', 'Node.js', 'Express', 'Laravel', '.NET', 'Flutter'];
                    @endphp
                    @foreach ($frameworks as $fw)
                        <span class="neo-tag bg-[#00F0FF] text-black text-[11px]">{{ $fw }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Herramientas y Servicios -->
            <div class="neo-box bg-white p-5 space-y-4">
                <div class="flex items-center justify-between border-b-2 border-black pb-2">
                    <h3 class="font-black text-lg uppercase font-code">03. Herramientas y APIs</h3>
                    <span class="bg-[#FF3366] text-white px-1.5 py-0.5 font-code font-black text-xs border border-black">12</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @php
                        $tools = ['Git/GitHub', 'MongoDB', 'MySQL', 'APIs REST', 'HTML5', 'CSS3', 'Airtable', 'Respond.io', 'API de Stripe', 'API de Meta Graph', 'Ingeniería de Prompts', 'Firebase'];
                    @endphp
                    @foreach ($tools as $tool)
                        <span class="neo-tag bg-[#FF3366] text-white text-[11px]">{{ $tool }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Idiomas y Electrónica -->
            <div class="neo-box bg-white p-5 space-y-4">
                <div class="flex items-center justify-between border-b-2 border-black pb-2">
                    <h3 class="font-black text-lg uppercase font-code">04. Idiomas y Electrónica</h3>
                    <span class="bg-[#00FF66] px-1.5 py-0.5 font-code font-black text-xs border border-black">6</span>
                </div>
                <div class="space-y-3 font-code text-xs">
                    <div>
                        <div class="font-bold text-gray-500 uppercase">Idiomas:</div>
                        <div class="flex gap-2 mt-1">
                            <span class="neo-tag bg-[#00FF66] text-black text-[11px]">Español (Nativo)</span>
                            <span class="neo-tag bg-[#00FF66] text-black text-[11px]">Inglés (Fluido)</span>
                        </div>
                    </div>
                    <div class="border-t border-black pt-2">
                        <div class="font-bold text-gray-500 uppercase">Electrónica y Sistemas:</div>
                        <div class="flex flex-wrap gap-1 mt-1">
                            <span class="neo-tag bg-gray-200 text-black text-[10px]">ESP32</span>
                            <span class="neo-tag bg-gray-200 text-black text-[10px]">Motores Paso a Paso</span>
                            <span class="neo-tag bg-gray-200 text-black text-[10px]">Impresión 3D</span>
                            <span class="neo-tag bg-gray-200 text-black text-[10px]">Sistemas Digitales</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION: FEATURED PROJECT PREVIEW TEASER -->
    <section class="neo-box-lg bg-[#FFE600] p-6 sm:p-8 space-y-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b-3 border-black pb-4">
            <div>
                <span class="bg-black text-[#FFE600] px-2 py-0.5 font-code font-black text-xs border border-black uppercase">
                    PROYECTO DESTACADO
                </span>
                <h3 class="text-2xl sm:text-3xl font-black uppercase mt-1">
                    SISCORR — SISTEMA DE GESTIÓN DE CORRESPONDENCIA
                </h3>
            </div>
            <a href="{{ route('projects') }}" class="neo-btn bg-black text-white px-4 py-2 text-sm font-code font-black hover:bg-[#FF3366]">
                VER LOS 6 PROYECTOS →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 font-medium text-sm">
            <div class="bg-white p-4 border-2 border-black">
                <span class="font-code font-black text-xs uppercase bg-[#00F0FF] px-1 border border-black">Liderazgo Técnico</span>
                <p class="mt-2 text-gray-800">
                    Lideró un equipo de cinco personas para digitalizar el flujo de correspondencia departamental en la UASLP, reemplazando procesos manuales en papel.
                </p>
            </div>
            <div class="bg-white p-4 border-2 border-black">
                <span class="font-code font-black text-xs uppercase bg-[#FF3366] text-white px-1 border border-black">Servidor con Laravel</span>
                <p class="mt-2 text-gray-800">
                    Construcción de la API REST en Laravel y MySQL enfocada en confiabilidad, integridad de datos y tiempos de consulta ultra bajos.
                </p>
            </div>
            <div class="bg-white p-4 border-2 border-black">
                <span class="font-code font-black text-xs uppercase bg-[#00FF66] px-1 border border-black">Interfaz con React</span>
                <p class="mt-2 text-gray-800">
                    Interfaz reactiva limpia y minimalista diseñada para ejecutarse con fluidez en equipos de oficina estándar.
                </p>
            </div>
        </div>
    </section>

</div>
