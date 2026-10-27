<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public string $commandInput = '';

    public array $terminalHistory = [];

    public bool $matrixMode = false;

    public function mount(): void
    {
        $this->terminalHistory = [
            [
                'command' => 'system --boot',
                'output' => "===================================================================\n".
                            "● VÍCTOR HUGO PÉREZ CRUZ :: PORTAFOLIO TERMINAL v2.5\n".
                            "● UASLP - Facultad de Ingeniería | Ing. en Computación\n".
                            "● San Luis Potosí, México | Estado: ACTIVO Y LISTO PARA COLABORAR\n".
                            "===================================================================\n".
                            "Escribe 'help' o presiona los comandos sugeridos abajo.",
                'type' => 'system',
            ],
            [
                'command' => 'whoami',
                'output' => "USUARIO: Víctor Hugo Pérez Cruz\n".
                            "ROL: Ingeniero en Computación / Desarrollador de Software y Sistemas Embebidos\n".
                            "UNIVERSIDAD: Universidad Autónoma de San Luis Potosí (Graduación: Dic 2026)\n".
                            "PERFIL: Estudiante de Ingeniería en Computación con sólida formación en software y hardware: estructuras de datos, algoritmos, compiladores, sistemas embebidos, bases de datos y administración de servidores.\n".
                            "EXPERIENCIA CLAVE: Practicante en Tipstate S.A. de C.V. (IA conversacional, Stripe, Airtable, API de WhatsApp) y Becario de Laboratorio en LESD-UASLP (Reloj de Cartas cinético ESP32, mantenimiento y docencia P1-P11).\n".
                            "UBICACIÓN: San Luis Potosí, México\n".
                            'CONTACTO: vils.123@hotmail.com | +52 (444) 540-41-17',
                'type' => 'success',
            ],
        ];
    }

    public function runCommand(?string $cmd = null): void
    {
        $commandToRun = trim($cmd ?? $this->commandInput);
        if ($commandToRun === '') {
            return;
        }

        $lowerCmd = strtolower($commandToRun);
        $output = '';
        $type = 'default';

        switch ($lowerCmd) {
            case 'whoami':
            case 'perfil':
                $output = "USUARIO: Víctor Hugo Pérez Cruz\n".
                          "ROL: Ingeniero en Computación / Desarrollador de Software y Sistemas Embebidos\n".
                          'PERFIL: Formación integral en software y hardware (UASLP). Especialista en desarrollo web moderno (Laravel, React, Node.js), aplicaciones móviles (Flutter), sistemas embebidos (ESP32) y agentes de IA.';
                $type = 'success';
                break;

            case 'help':
            case 'ayuda':
                $output = "COMANDOS DISPONIBLES EN ESTA TERMINAL:\n".
                          "  whoami       - Despliega biografía y perfil profesional\n".
                          "  skills       - Lista de lenguajes, entornos, herramientas y bases de datos\n".
                          "  projects     - Resumen rápido de los 6 proyectos principales desarrollados\n".
                          "  experience   - Resumen del historial laboral (Tipstate y LESD-UASLP)\n".
                          "  education    - Información académica y formación en la UASLP\n".
                          "  contact      - Datos directos de comunicación (correo, teléfono, enlaces)\n".
                          "  cat cv.txt   - Muestra el resumen profesional en texto plano\n".
                          "  matrix       - Alterna el modo visual Matrix\n".
                          "  easteregg    - Descubre un detalle especial de desarrollo\n".
                          '  clear        - Limpia la pantalla de la terminal';
                $type = 'info';
                break;

            case 'skills':
            case 'habilidades':
                $output = "HABILIDADES TÉCNICAS:\n".
                          "--------------------------------------------------\n".
                          "• LENGUAJES: C#, JavaScript (ES6+), TypeScript, Java, Python, C, PHP, SQL, Ensamblador, Dart\n".
                          "• ENTORNOS: React, Angular, Node.js, Express, Laravel, .NET, Flutter\n".
                          "• HERRAMIENTAS Y SERVICIOS: Git/GitHub, MongoDB, MySQL, APIs REST, HTML5, CSS3, Airtable, Respond.io, API de Stripe, API de Meta Graph, Ingeniería de Prompts, Firebase\n".
                          '• IDIOMAS: Español (Nativo), Inglés (Fluido)';
                $type = 'success';
                break;

            case 'projects':
            case 'proyectos':
                $output = "PROYECTOS DESTACADOS:\n".
                          "1. SISCORR (Laravel + React + MySQL): Sistema de gestión de correspondencia departamental.\n".
                          "2. Metro Trivia CDMX (Flutter + Firestore): Trivia interactiva para 195 estaciones y algoritmo Dijkstra.\n".
                          "3. Analizador Léxico-Sintáctico (C#): Compilador de TINY con autómatas AFN/AFD.\n".
                          "4. Neo-Manga (MEAN + Modo sin conexión): Aplicación web progresiva y autenticación JWT con roles.\n".
                          "5. Algoritmos de Grafos (C#): BFS, DFS, Dijkstra, Kruskal y resolución de laberintos.\n".
                          "6. CubOS (PHP + MySQL + Chart.js): Cronómetro de milisegundos y analíticas para armado de cubos.\n".
                          '-> Visita la pestaña /proyectos para ver todos los detalles interactivos.';
                $type = 'info';
                break;

            case 'experience':
            case 'experiencia':
                $output = "HISTORIAL LABORAL:\n".
                          "• TIPSTATE S.A. DE C.V. (Jun 2026 - Ago 2026)\n".
                          "  Practicante de Ingeniería de Software: IA conversacional, Stripe, Airtable JS, API de WhatsApp, Ingeniería de Prompts.\n".
                          "• LAB. DE ELECTRÓNICA Y SISTEMAS DIGITALES (LESD - UASLP) (May 2024 - Jul 2026)\n".
                          "  Becario y Soporte Técnico: Reloj cinético de cartas ESP32, mantenimiento de precisión, apoyo en sesiones P1-P11.\n".
                          '-> Visita la pestaña /experiencia para ver la línea de tiempo completa.';
                $type = 'info';
                break;

            case 'education':
            case 'educacion':
            case 'educación':
                $output = "UNIVERSIDAD AUTÓNOMA DE SAN LUIS POTOSÍ (UASLP)\n".
                          "Carrera: Ingeniería en Computación\n".
                          "Graduación esperada: Diciembre 2026\n".
                          'Formación: estructuras de datos, algoritmos, compiladores, sistemas embebidos, bases de datos y administración de servidores.';
                $type = 'info';
                break;

            case 'contact':
            case 'contacto':
                $output = "DATOS DE CONTACTO:\n".
                          "• Correo: vils.123@hotmail.com\n".
                          "• Teléfono: +52 (444) 540-41-17\n".
                          "• Ubicación: San Luis Potosí, México\n".
                          '• GitHub y LinkedIn disponibles en los enlaces oficiales.';
                $type = 'success';
                break;

            case 'cat cv.txt':
            case 'cat cv':
            case 'cv':
            case 'resumen':
                $output = "=================== RESUMEN PROFESIONAL ===================\n".
                          "Víctor Hugo Pérez Cruz | San Luis Potosí, México\n".
                          "Ingeniería en Computación (UASLP - 2026)\n".
                          "Desarrollo Integral: Laravel, React, Node.js, Flutter, C#, SQL\n".
                          'Puedes descargar la versión en PDF usando el botón del encabezado.';
                $type = 'default';
                break;

            case 'matrix':
                $this->matrixMode = ! $this->matrixMode;
                $this->dispatch('toggle-matrix');
                $output = $this->matrixMode
                    ? "Has entrado al Modo Matrix. Presiona 'M' o escribe 'matrix' para salir."
                    : 'Regresando al diseño neobrutalista estándar.';
                $type = 'success';
                break;

            case 'easteregg':
            case 'easter egg':
            case 'secreto':
                $output = "¡FELICIDADES! Encontraste el detalle oculto de la terminal:\n".
                          "¿Sabías que el 'Reloj de Cartas' construido en el laboratorio LESD utiliza un microcontrolador ESP32 con motores paso a paso y piezas modeladas e impresas en 3D desde cero por Víctor?\n".
                          'Consejo: presiona las teclas [M] para Matrix, [P] para Proyectos o [E] para Experiencia en cualquier momento.';
                $type = 'success';
                break;

            case 'clear':
            case 'cls':
            case 'limpiar':
                $this->terminalHistory = [];
                $this->commandInput = '';
                $this->dispatch('terminal-command-executed');

                return;

            case 'sudo':
            case 'sudo rm -rf /':
            case 'rm -rf':
                $output = "ALERTA: 'vils' no tiene permisos de superusuario. Este incidente será reportado al departamento de Inteligencia Artificial de la UASLP.";
                $type = 'error';
                break;

            default:
                $output = "bash: {$commandToRun}: comando no encontrado. Escribe 'help' para ver la lista de comandos disponibles.";
                $type = 'error';
                break;
        }

        $this->terminalHistory[] = [
            'command' => $commandToRun,
            'output' => $output,
            'type' => $type,
        ];

        $this->commandInput = '';
        $this->dispatch('terminal-command-executed');
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.app', [
            'title' => 'Víctor Hugo Pérez Cruz | Desarrollador de Software y Sistemas Embebidos',
        ]);
    }
}
