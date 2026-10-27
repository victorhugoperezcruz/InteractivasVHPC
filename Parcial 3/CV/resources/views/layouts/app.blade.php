<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Víctor Hugo Pérez Cruz | Portafolio Neobrutalista' }}</title>
    
    <!-- Google Fonts for Bold Neobrutalist Typography (Non-blocking load for instant page rendering) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700;800&family=Space+Grotesk:wght@500;700;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700;800&family=Space+Grotesk:wght@500;700;900&display=swap" rel="stylesheet">
    </noscript>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Space Grotesk', system-ui, sans-serif;
            background-color: #F4EEDD;
            background-image: radial-gradient(#000000 1.2px, transparent 1.2px);
            background-size: 24px 24px;
        }
        .font-code {
            font-family: 'JetBrains Mono', monospace;
        }
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            display: flex;
            width: 200%;
            animation: marquee 25s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
</head>
<body class="text-black antialiased selection:bg-[#FFE600] selection:text-black min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- Livewire Navigation Progress Feedback Bar (Heuristic #1: System Status) -->
    <div id="nav-progress-bar" class="hidden" role="progressbar" aria-label="Cargando página"></div>

    <!-- Top Alert / Availability Ticker -->
    <aside aria-label="Anuncio de disponibilidad" class="bg-[#FFE600] border-b-3 border-black py-1.5 px-4 overflow-hidden select-none font-code text-xs font-black tracking-widest uppercase">
        <div class="animate-marquee flex gap-8 items-center">
            <span>● DISPONIBLE PARA NUEVAS OPORTUNIDADES Y PROYECTOS DE DESARROLLO</span>
            <span>★</span>
            <span>INGENIERO EN COMPUTACIÓN &bull; UASLP 2026</span>
            <span>★</span>
            <span>SAN LUIS POTOSÍ, MÉXICO</span>
            <span>★</span>
            <span>LARAVEL &bull; REACT &bull; C# &bull; FLUTTER &bull; ESP32 &bull; IA</span>
            <span>★</span>
            <span>PRESIONA 'M' PARA MODO MATRIX // 'T' PARA TERMINAL // '?' PARA ATAJOS</span>
            <span>★</span>
            <span>● DISPONIBLE PARA NUEVAS OPORTUNIDADES Y PROYECTOS DE DESARROLLO</span>
            <span>★</span>
            <span>INGENIERO EN COMPUTACIÓN &bull; UASLP 2026</span>
            <span>★</span>
            <span>SAN LUIS POTOSÍ, MÉXICO</span>
            <span>★</span>
            <span>LARAVEL &bull; REACT &bull; C# &bull; FLUTTER &bull; ESP32 &bull; IA</span>
        </div>
    </aside>

    <!-- Neobrutalist Main Header -->
    <header class="sticky top-0 z-40 bg-[#F4EEDD] border-b-4 border-black px-4 sm:px-8 py-3.5 shadow-[0px_4px_0px_0px_#000]">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            
            <!-- Brand / Logo -->
            <a href="{{ route('home') }}" class="group flex items-center gap-3" aria-label="Ir al inicio">
                <div class="bg-[#00F0FF] border-3 border-black p-2 shadow-[3px_3px_0px_0px_#000] group-hover:bg-[#FF3366] group-hover:text-white transition-all transform group-hover:rotate-3">
                    <span class="font-code font-black text-xl">VP</span>
                </div>
                <div>
                    <span class="block font-black text-lg sm:text-xl tracking-tight leading-none uppercase">
                        VÍCTOR PÉREZ
                    </span>
                    <span class="font-code text-xs font-bold text-gray-800 bg-[#FFE600] px-1.5 py-0.5 border border-black inline-block mt-0.5">
                        ING. COMPUTACIÓN
                    </span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="flex items-center gap-2 sm:gap-3 flex-wrap" aria-label="Navegación principal">
                <a href="{{ route('home') }}"
                   @if(request()->routeIs('home')) aria-current="page" @endif
                   class="neo-btn-sm px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-black uppercase {{ request()->routeIs('home') ? 'bg-[#FFE600] shadow-[3px_3px_0px_0px_#000]' : 'bg-white hover:bg-[#FFE600]' }}">
                    01. INICIO
                </a>
                <a href="{{ route('projects') }}"
                   @if(request()->routeIs('projects')) aria-current="page" @endif
                   class="neo-btn-sm px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-black uppercase {{ request()->routeIs('projects') ? 'bg-[#00F0FF] shadow-[3px_3px_0px_0px_#000]' : 'bg-white hover:bg-[#00F0FF]' }}">
                    02. PROYECTOS
                </a>
                <a href="{{ route('experience') }}"
                   @if(request()->routeIs('experience')) aria-current="page" @endif
                   class="neo-btn-sm px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-black uppercase {{ request()->routeIs('experience') ? 'bg-[#FF3366] text-white shadow-[3px_3px_0px_0px_#000]' : 'bg-white hover:bg-[#FF3366] hover:text-white' }}">
                    03. EXPERIENCIA
                </a>
            </nav>

            <!-- Actions / Matrix Mode controls -->
            <div class="flex items-center gap-2">
                <a href="{{ asset('CV_Victor_Perez_Cruz.pdf') }}" target="_blank" download="CV_Victor_Perez_Cruz.pdf"
                   class="neo-btn-sm bg-[#00FF66] px-3 py-1.5 text-xs font-black uppercase hidden md:inline-flex items-center gap-1.5 hover:bg-[#FFE600]" title="Descargar currículum en formato PDF">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4m-9 8h10"></path>
                    </svg>
                    <span>DESCARGAR PDF</span>
                </a>

                <!-- Matrix / Dark Mode Toggle Button -->
                <button id="matrixToggleBtn" type="button" onclick="toggleMatrixMode()"
                        class="neo-btn-sm bg-black text-[#00FF66] px-2.5 py-1.5 text-xs font-code font-black hover:bg-[#00FF66] hover:text-black transition-all"
                        title="Alternar Modo Matrix [Atajo: Presiona 'M']">
                    [M]ATRIX
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content Slot (Livewire Views) -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Neobrutalist Footer -->
    <footer class="bg-black text-white border-t-4 border-black mt-16">
        <!-- Marquee Ribbon -->
        <div class="bg-[#FF3366] text-black font-code font-black text-xs sm:text-sm py-2 px-4 border-b-3 border-black overflow-hidden uppercase tracking-wider">
            <div class="animate-marquee flex gap-8 items-center">
                <span>★ DESARROLLADOR DE SOFTWARE</span>
                <span>•</span>
                <span>SAN LUIS POTOSÍ, MÉXICO</span>
                <span>•</span>
                <span>VILS.123@HOTMAIL.COM</span>
                <span>•</span>
                <span>+52 (444) 540-41-17</span>
                <span>•</span>
                <span>UNIVERSIDAD AUTÓNOMA DE SAN LUIS POTOSÍ (UASLP)</span>
                <span>•</span>
                <span>C# &bull; LARAVEL &bull; REACT &bull; FLUTTER &bull; SISTEMAS EMBEBIDOS</span>
                <span>★</span>
                <span>DESARROLLADOR DE SOFTWARE</span>
                <span>•</span>
                <span>SAN LUIS POTOSÍ, MÉXICO</span>
                <span>•</span>
                <span>VILS.123@HOTMAIL.COM</span>
                <span>•</span>
                <span>+52 (444) 540-41-17</span>
                <span>•</span>
                <span>UNIVERSIDAD AUTÓNOMA DE SAN LUIS POTOSÍ (UASLP)</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-[#FFE600] text-black px-2 py-0.5 font-code font-black text-sm border-2 border-white">
                        VÍCTOR PÉREZ
                    </span>
                    <span class="font-code text-xs text-gray-400">© {{ date('Y') }}</span>
                </div>
                <p class="text-sm text-gray-300 font-medium leading-relaxed max-w-sm">
                    Portafolio profesional interactivo con diseño neobrutalista, construido con Laravel 13, Livewire v4 y Tailwind CSS.
                </p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="neo-tag bg-[#00F0FF] text-black text-[10px]">LARAVEL 13</span>
                    <span class="neo-tag bg-[#FFE600] text-black text-[10px]">LIVEWIRE v4</span>
                    <span class="neo-tag bg-[#FF3366] text-white text-[10px]">TAILWIND CSS</span>
                </div>
            </div>

            <div>
                <h4 class="font-black text-base uppercase text-[#00F0FF] mb-3 font-code tracking-wider">
                    // NAVEGACIÓN RÁPIDA
                </h4>
                <ul class="space-y-2 text-sm font-bold">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-[#FFE600] transition-colors flex items-center gap-2">
                            <span>→</span> 01. INICIO (PERFIL Y TERMINAL)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects') }}" class="hover:text-[#00F0FF] transition-colors flex items-center gap-2">
                            <span>→</span> 02. PROYECTOS Y ARQUITECTURA
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('experience') }}" class="hover:text-[#FF3366] transition-colors flex items-center gap-2">
                            <span>→</span> 03. HISTORIAL Y EXPERIENCIA LABORAL
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('CV_Victor_Perez_Cruz.pdf') }}" target="_blank" download class="hover:text-[#00FF66] transition-colors flex items-center gap-2">
                            <span>→</span> DESCARGAR CURRÍCULUM (PDF)
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-black text-base uppercase text-[#00FF66] mb-3 font-code tracking-wider">
                    // CONTACTO DIRECTO
                </h4>
                <div class="space-y-2 text-sm font-code">
                    <p class="text-gray-300 flex items-center gap-2">
                        <span class="text-[#FFE600]">CORREO:</span>
                        <span>vils.123@hotmail.com</span>
                    </p>
                    <p class="text-gray-300 flex items-center gap-2">
                        <span class="text-[#00F0FF]">TEL:</span>
                        <span>+52 (444) 540-41-17</span>
                    </p>
                    <p class="text-gray-300 flex items-center gap-2">
                        <span class="text-[#FF3366]">UBICACIÓN:</span>
                        <span>San Luis Potosí, México</span>
                    </p>
                    <div class="pt-3 flex gap-2">
                        <button type="button" onclick="showKeyboardHelp()" class="neo-btn-sm bg-[#222] text-white px-3 py-1 text-xs border border-white">
                            ATAJOS [?]
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- Keyboard Shortcuts Modal -->
    <div id="shortcutsModal" class="hidden fixed inset-0 z-50 w-screen h-screen overflow-hidden flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="shortcuts-modal-title">
        <!-- Viewport-anchored backdrop overlay that blocks background scroll -->
        <div class="fixed inset-0 w-screen h-screen bg-black/85 modal-backdrop transition-opacity cursor-pointer" onclick="showKeyboardHelp(false)" onwheel="event.preventDefault()" ontouchmove="event.preventDefault()"></div>
        
        <!-- Centered dialog card that fits 100% within viewport -->
        <div class="relative neo-box-lg bg-[#FFE600] p-5 sm:p-6 max-w-md w-full max-h-[88vh] flex flex-col text-left z-10 overflow-hidden" onclick="event.stopPropagation()">
            <button type="button" onclick="showKeyboardHelp(false)" aria-label="Cerrar modal de atajos" class="absolute top-3 right-3 neo-btn-sm bg-black text-white px-2.5 py-1 text-xs font-black hover:bg-[#FF3366]">✕</button>
            <div id="shortcuts-modal-title" class="shrink-0 font-code font-black text-base sm:text-lg mb-4 bg-black text-[#00FF66] p-2 border-2 border-black flex items-center gap-2 pr-10">
                <svg class="w-5 h-5 text-[#00FF66] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <path d="M6 8h.01M10 8h.01M14 8h.01M18 8h.01M6 12h.01M10 12h.01M14 12h.01M18 12h.01M8 16h8"></path>
                </svg>
                <span>ATAJOS DE TECLADO</span>
            </div>
            <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain space-y-2.5 font-code text-xs sm:text-sm">
                <div class="flex justify-between items-center bg-white p-2.5 border-2 border-black">
                    <span class="font-bold">Modo Matrix:</span>
                    <span class="bg-black text-[#00FF66] px-2 py-0.5 font-black">[ M ]</span>
                </div>
                <div class="flex justify-between items-center bg-white p-2.5 border-2 border-black">
                    <span class="font-bold">Ir a Terminal (Inicio):</span>
                    <span class="bg-black text-[#FFE600] px-2 py-0.5 font-black">[ T ]</span>
                </div>
                <div class="flex justify-between items-center bg-white p-2.5 border-2 border-black">
                    <span class="font-bold">Ver Proyectos:</span>
                    <span class="bg-black text-[#00F0FF] px-2 py-0.5 font-black">[ P ]</span>
                </div>
                <div class="flex justify-between items-center bg-white p-2.5 border-2 border-black">
                    <span class="font-bold">Ver Experiencia:</span>
                    <span class="bg-black text-[#FF3366] px-2 py-0.5 text-white font-black">[ E ]</span>
                </div>
                <div class="flex justify-between items-center bg-white p-2.5 border-2 border-black">
                    <span class="font-bold">Cerrar ventanas:</span>
                    <span class="bg-black text-white px-2 py-0.5 font-black">[ ESC ]</span>
                </div>
            </div>
            <p class="shrink-0 font-code text-xs font-bold mt-4 text-center text-black">
                Disponibles en cualquier momento mientras navegas por el portafolio.
            </p>
        </div>
    </div>

    <!-- Global Client Script (data-navigate-once prevents listener duplication across SPA navigations) -->
    <script data-navigate-once>
        function applyMatrixPreference() {
            const isMatrix = localStorage.getItem('portfolio_matrix_mode') === 'true';
            if (isMatrix) {
                document.body.classList.add('matrix-mode');
            } else {
                document.body.classList.remove('matrix-mode');
            }
            const btn = document.getElementById('matrixToggleBtn');
            if (btn) {
                btn.innerText = isMatrix ? '[S]ALIR MATRIX' : '[M]ATRIX';
            }
        }

        function toggleMatrixMode() {
            const current = document.body.classList.contains('matrix-mode');
            const newState = !current;
            localStorage.setItem('portfolio_matrix_mode', newState ? 'true' : 'false');
            applyMatrixPreference();
        }

        function lockBodyScroll(lock) {
            if (lock) {
                document.documentElement.style.overflow = 'hidden';
                document.body.style.overflow = 'hidden';
            } else {
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
            }
        }

        function showKeyboardHelp(show = true) {
            const modal = document.getElementById('shortcutsModal');
            if (modal) {
                if (show) {
                    modal.classList.remove('hidden');
                    lockBodyScroll(true);
                } else {
                    modal.classList.add('hidden');
                    lockBodyScroll(false);
                }
            }
        }

        function navigateFast(url) {
            try {
                const targetUrl = new URL(url, window.location.origin);
                if (targetUrl.pathname === window.location.pathname && !targetUrl.hash) {
                    return;
                }
            } catch (err) {}

            const bar = document.getElementById('nav-progress-bar');
            if (bar) bar.classList.remove('hidden');
            window.location.href = url;
        }

        if (!window.__portfolioEventsBound) {
            window.__portfolioEventsBound = true;

            document.addEventListener('DOMContentLoaded', applyMatrixPreference);

            document.addEventListener('livewire:navigating', () => {
                window.__navInProgress = true;
                lockBodyScroll(false);
                const bar = document.getElementById('nav-progress-bar');
                if (bar) bar.classList.remove('hidden');
            });

            document.addEventListener('livewire:navigated', () => {
                window.__navInProgress = false;
                lockBodyScroll(false);
                applyMatrixPreference();
                const bar = document.getElementById('nav-progress-bar');
                if (bar) bar.classList.add('hidden');
            });

            window.addEventListener('toggle-matrix', () => {
                toggleMatrixMode();
            });

            // Global hotkeys (bound strictly once)
            document.addEventListener('keydown', (e) => {
                if (e.repeat) return;

                if (['INPUT', 'TEXTAREA'].includes(e.target.tagName)) {
                    if (e.key === 'Escape') {
                        e.target.blur();
                    }
                    return;
                }

                if (e.key === 'm' || e.key === 'M') {
                    toggleMatrixMode();
                } else if (e.key === '?' || (e.shiftKey && e.key === '/')) {
                    showKeyboardHelp(true);
                } else if (e.key === 'Escape') {
                    showKeyboardHelp(false);
                } else if (e.key === 't' || e.key === 'T') {
                    const termInput = document.getElementById('terminal-input');
                    if (termInput) {
                        termInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        termInput.focus();
                    } else {
                        navigateFast("{{ route('home') }}#terminal");
                    }
                } else if (e.key === 'p' || e.key === 'P') {
                    navigateFast("{{ route('projects') }}");
                } else if (e.key === 'e' || e.key === 'E') {
                    navigateFast("{{ route('experience') }}");
                }
            });
        }
    </script>

    @livewireScripts
</body>
</html>
