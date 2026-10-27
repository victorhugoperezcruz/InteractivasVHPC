<?php

namespace App\Livewire;

use Livewire\Component;

class Experience extends Component
{
    public string $tab = 'all'; // 'all', 'industry', 'lab', 'education'

    public ?string $activeCard = null;

    public function experiences(): array
    {
        return [
            [
                'id' => 'tipstate',
                'type' => 'industry',
                'type_label' => 'Industria / Software',
                'title' => 'Tipstate S.A. de C.V.',
                'role' => 'Practicante de Ingeniería de Software',
                'period' => 'Junio 2026 – Agosto 2026',
                'location' => 'México / Remoto e Híbrido',
                'accent' => '#FFE600',
                'icon' => 'software',
                'summary' => 'Desarrollo de ecosistema automatizado con agentes de IA conversacional, máquinas de estados para clientes potenciales, pasarela de pagos Stripe y automatización en la nube.',
                'bullets' => [
                    'Desarrollé un ecosistema automatizado de ventas y postventa utilizando agentes de IA conversacional, implementando máquinas de estados finitos para la gestión del ciclo de vida de clientes potenciales a través de Respond.io.',
                    'Integré la pasarela de pagos de Stripe y sincronicé bases de datos en la nube con un sistema de planificación empresarial (ERP) corporativo utilizando APIs REST, notificaciones web automáticas y estructuras JSON.',
                    'Desarrollé rutinas asíncronas en JavaScript dentro de Airtable para automatizar el cálculo de métricas y el envío programado de reportes mediante la API de WhatsApp en la nube.',
                    'Apliqué técnicas avanzadas de ingeniería de instrucciones (protección contra manipulación y entrenamiento por ejemplos) y ejecuté auditorías de control de calidad (QA) para resolver vulnerabilidades y asegurar la estabilidad de los entornos de producción.',
                ],
                'tech' => ['IA Conversacional', 'API de Stripe', 'Respond.io', 'ERP Corporativo', 'JavaScript Asíncrono', 'API de WhatsApp', 'Ingeniería de Instrucciones', 'Control de Calidad (QA)', 'Airtable', 'Notificaciones Web'],
            ],
            [
                'id' => 'lesd',
                'type' => 'lab',
                'type_label' => 'Laboratorio y Electrónica',
                'title' => 'Laboratorio de Electrónica y Sistemas Digitales (LESD) – UASLP',
                'role' => 'Becario de Laboratorio y Soporte Técnico',
                'period' => 'Mayo 2024 – Julio 2026',
                'location' => 'Facultad de Ingeniería, UASLP (San Luis Potosí)',
                'accent' => '#00F0FF',
                'icon' => 'hardware',
                'summary' => 'Diseño y fabricación de proyectos mecatrónicos conectados (ESP32, programación C++, impresión 3D), mantenimiento de equipo de laboratorio de precisión y soporte a alumnos en prácticas P1 a P11.',
                'bullets' => [
                    'Construí un "Reloj de Cartas" cinético utilizando un microcontrolador ESP32 y motores paso a paso, desarrollando tanto el programa interno como las piezas impresas en 3D.',
                    'Realicé mantenimiento preventivo y correctivo en equipos de medición de precisión, aplicando conocimientos de cursos de circuitos y sistemas digitales.',
                    'Brindé soporte a estudiantes durante las sesiones de laboratorio (P1-P11): explicando conceptos, ayudando a depurar circuitos en tiempo real y resolviendo dudas de electrónica emergentes.',
                    'Mantuve los registros administrativos del laboratorio y actualicé los manuales técnicos conforme a los estándares actuales.',
                    'Gestioné el préstamo de equipos y la revisión de materiales para asegurar que cada sesión de laboratorio estuviera lista y configurada.',
                ],
                'tech' => ['ESP32', 'Programación C/C++', 'Motores Paso a Paso', 'Impresión 3D', 'Circuitos Digitales', 'Equipos de Medición', 'Soporte P1-P11', 'Manuales Técnicos'],
            ],
            [
                'id' => 'uaslp',
                'type' => 'education',
                'type_label' => 'Educación Superior',
                'title' => 'Universidad Autónoma de San Luis Potosí (UASLP)',
                'role' => 'Licenciatura en Ingeniería en Computación',
                'period' => 'Graduación esperada: Diciembre 2026',
                'location' => 'San Luis Potosí, S.L.P., México',
                'accent' => '#FF3366',
                'icon' => 'education',
                'summary' => 'Formación universitaria rigurosa con equilibrio entre desarrollo de software de alto nivel y electrónica de bajo nivel.',
                'bullets' => [
                    'Mi plan de estudios me ha dado una base sólida en software y electrónica: estructuras de datos, algoritmos, compiladores, sistemas embebidos, bases de datos y administración de servidores.',
                    'Dominio de programación en C#, JavaScript, Python, C, Java, PHP y Ensamblador.',
                    'Desarrollo de proyectos departamentales aplicados a la gestión universitaria (SISCORR).',
                    'Participación activa en laboratorios técnicos de electrónica y sistemas de cómputo.',
                ],
                'tech' => ['Estructuras de Datos', 'Algoritmos', 'Compiladores', 'Sistemas Embebidos', 'Bases de Datos', 'Administración de Servidores', 'Ensamblador'],
            ],
        ];
    }

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
    }

    public function toggleCard(string $id): void
    {
        $this->activeCard = ($this->activeCard === $id) ? null : $id;
    }

    public function render()
    {
        $experiences = $this->experiences();

        if ($this->tab !== 'all') {
            $experiences = array_filter($experiences, fn ($e) => $e['type'] === $this->tab);
        }

        return view('livewire.experience', [
            'filteredExperiences' => $experiences,
        ])->layout('layouts.app', [
            'title' => 'Experiencia Laboral & Trayectoria | Víctor Hugo Pérez Cruz',
        ]);
    }
}
