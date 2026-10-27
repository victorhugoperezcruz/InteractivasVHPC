<?php

namespace App\Livewire;

use Livewire\Component;

class Projects extends Component
{
    public string $categoryFilter = 'all';

    public string $search = '';

    public ?array $selectedProject = null;

    public function allProjects(): array
    {
        return [
            [
                'id' => 'siscorr',
                'title' => 'SISCORR – Sistema de Gestión de Correspondencia',
                'role' => 'Líder de Equipo y Desarrollador de Software',
                'period' => 'Proyecto Departamental Universitario (UASLP)',
                'category' => 'web',
                'category_label' => 'Desarrollo Web',
                'accent' => '#FFE600',
                'summary' => 'Digitalización integral del flujo de correspondencia departamental en la universidad, sustituyendo procesos manuales en papel por un sistema centralizado de alta disponibilidad.',
                'tags' => ['Laravel', 'MySQL', 'React', 'API REST', 'Git / GitHub', 'Liderazgo'],
                'highlights' => [
                    'Lideré a un equipo de cinco personas para digitalizar el flujo de correspondencia de un departamento universitario, reemplazando un proceso basado en papel por un sistema digital centralizado.',
                    'Construí la API del servidor (Laravel + MySQL), enfocándome en el manejo confiable de datos y manteniendo tiempos de consulta bajos para los usuarios finales.',
                    'Desarrollé la interfaz web en React con un diseño limpio y minimalista que funciona fluidamente en equipos de oficina estándar.',
                    'Administré el repositorio, distribuí tareas entre cuatro desarrolladores y revisé el código para mantener la arquitectura consistente en todo el proyecto.',
                ],
                'tech_details' => 'Arquitectura cliente-servidor desacoplada. API REST en Laravel 10+ con validación estricta y caché de consultas; aplicación interactiva en React con Tailwind CSS.',
            ],
            [
                'id' => 'metro-trivia',
                'title' => 'Metro Trivia CDMX – Aplicación Interactiva de Trivias',
                'role' => 'Desarrollador Flutter',
                'period' => 'Abril – Junio 2026',
                'category' => 'mobile',
                'category_label' => 'Móvil / Flutter',
                'accent' => '#00F0FF',
                'summary' => 'Aplicación móvil interactiva para Android e iOS con mapas dinámicos, cálculo de ruta más corta mediante Dijkstra y gamificación para las 195 estaciones del Metro de la CDMX.',
                'tags' => ['Flutter', 'Autenticación en Firebase', 'Base de Datos Firestore', 'Inicio de Sesión con Google', 'Gestor de Estado', 'Dijkstra', 'Teoría de Grafos'],
                'highlights' => [
                    'Construí una aplicación de trivia multiplataforma con Flutter, autenticación en Firebase, base de datos en la nube Firestore, inicio de sesión con Google y gestión de estado reactivo.',
                    'Implementé cuestionarios por línea de metro, rachas de puntuación, logros, tablas de clasificación, tarjetas de estudio y seguimiento de progreso para 195 estaciones.',
                    'Desarrollé un mapa interactivo del metro y una calculadora de la ruta más corta utilizando modelado de grafos y el algoritmo de Dijkstra, con diseños adaptables, tutoriales, animaciones y temas claro/oscuro.',
                ],
                'tech_details' => 'Patrón de proveedor para estado global reactivo, sincronización en tiempo real con Firestore en la nube y algoritmos de optimización de trayectorias sobre topología de red.',
            ],
            [
                'id' => 'compilador',
                'title' => 'Analizador Léxico-Sintáctico (Compilador)',
                'role' => 'Desarrollador en C#',
                'period' => 'Mayo – Junio 2025',
                'category' => 'systems',
                'category_label' => 'Sistemas y Compiladores',
                'accent' => '#FF3366',
                'summary' => 'Analizador léxico y sintáctico desarrollado desde cero para el lenguaje estructurado TINY, incorporando autómatas AFN/AFD y tabla de símbolos.',
                'tags' => ['C#', '.NET', 'Compiladores', 'Teoría de Autómatas (AFN/AFD)', 'Tabla de Símbolos', 'Expresiones Regulares'],
                'highlights' => [
                    'Construí un analizador sintáctico desde cero que clasifica en componentes léxicos el código fuente del lenguaje TINY y verifica su estructura gramatical.',
                    'Implementé la conversión de expresiones regulares a autómatas (AFN/AFD) y la gestión de tablas de símbolos.',
                    'Logré una alta precisión de clasificación mediante un manejo cuidadoso de la memoria y el diseño de algoritmos.',
                ],
                'tech_details' => 'Algoritmos de Thompson y construcción de subconjuntos para determinización de autómatas; estructuras de datos orientadas a rendimiento en C#.',
            ],
            [
                'id' => 'neo-manga',
                'title' => 'Neo-Manga – Aplicación Web Progresiva',
                'role' => 'Desarrollador Web (MEAN)',
                'period' => 'Mayo – Junio 2025',
                'category' => 'web',
                'category_label' => 'Aplicación Web',
                'accent' => '#B288FF',
                'summary' => 'Aplicación web progresiva para lectura de cómics y manga con modo sin conexión mediante procesos en segundo plano y control de permisos granulares con JWT y roles.',
                'tags' => ['Angular', 'Entorno MEAN', 'Node.js', 'Express', 'MongoDB', 'JWT', 'Modo Sin Conexión', 'Aplicación Web Progresiva'],
                'highlights' => [
                    'Desarrollé un lector de manga con funcionalidad sin conexión a internet mediante procesos en segundo plano.',
                    'Implementé autenticación JWT y control de acceso basado en roles para mantener seguros los datos del usuario.',
                    'Diseñé componentes reutilizables en Angular que facilitaron el mantenimiento del código a medida que el proyecto crecía.',
                ],
                'tech_details' => 'Caché dinámico de imágenes con almacenamiento local; arquitectura modular en Angular basada en componentes independientes y servicios reactivos RxJS.',
            ],
            [
                'id' => 'grafos',
                'title' => 'Análisis de Grafos y Algoritmos de Búsqueda de Rutas',
                'role' => 'Desarrollador en C#',
                'period' => 'Febrero – Junio 2025',
                'category' => 'systems',
                'category_label' => 'Algoritmos y Grafos',
                'accent' => '#00FF66',
                'summary' => 'Conjunto computacional de teoría de grafos y resolución automatizada de laberintos complejos basada en algoritmos clásicos de optimización.',
                'tags' => ['C#', 'Algoritmos', 'BFS', 'DFS', 'Dijkstra', 'Kruskal', 'Teoría de Grafos', 'Laberintos'],
                'highlights' => [
                    'Implementé algoritmos clásicos de recorrido y optimización de grafos (BFS, DFS, Dijkstra, Kruskal) como complemento práctico de mi curso de algoritmos.',
                    'Construí un sistema de resolución de laberintos capaz de manejar grandes cantidades de casos de prueba en un tiempo razonable.',
                ],
                'tech_details' => 'Estructuras de lista de adyacencia y colas con prioridad optimizadas; árbol de expansión mínima y caminos más cortos con verificación visual.',
            ],
            [
                'id' => 'cubos',
                'title' => 'CubOS – Plataforma de Análisis para Resolución de Cubos',
                'role' => 'Desarrollador en PHP y JavaScript',
                'period' => 'Abril – Junio 2025',
                'category' => 'web',
                'category_label' => 'Web y Analítica',
                'accent' => '#FF6E3A',
                'summary' => 'Plataforma web con cronómetro de resolución milimétrica y panel analítico interactivo con Chart.js para competidores de armado de cubos.',
                'tags' => ['PHP', 'JavaScript', 'MySQL', 'Chart.js', 'Temporizadores de Alta Precisión', 'Visualización de Datos'],
                'highlights' => [
                    'Diseñé un temporizador con precisión de milisegundos que guarda el historial de resoluciones en una base de datos MySQL.',
                    'Creé visualizaciones interactivas con Chart.js para que los usuarios puedan realizar un seguimiento de sus tendencias de rendimiento a lo largo del tiempo.',
                ],
                'tech_details' => 'Cálculo de medias móviles (Ao5, Ao12), desviación estándar y renderizado reactivo de curvas de mejora en tiempo real.',
            ],
        ];
    }

    public function setCategory(string $category): void
    {
        $this->categoryFilter = $category;
    }

    public function openProjectModal(string $projectId): void
    {
        foreach ($this->allProjects() as $proj) {
            if ($proj['id'] === $projectId) {
                $this->selectedProject = $proj;

                return;
            }
        }
    }

    public function closeProjectModal(): void
    {
        $this->selectedProject = null;
    }

    public function render()
    {
        $projects = $this->allProjects();

        if ($this->categoryFilter !== 'all') {
            $projects = array_filter($projects, fn ($p) => $p['category'] === $this->categoryFilter);
        }

        if (trim($this->search) !== '') {
            $search = mb_strtolower(trim($this->search));
            $projects = array_filter($projects, function ($p) use ($search) {
                $searchable = mb_strtolower($p['title'].' '.$p['summary'].' '.implode(' ', $p['tags']).' '.$p['role']);

                return str_contains($searchable, $search);
            });
        }

        return view('livewire.projects', [
            'filteredProjects' => $projects,
        ])->layout('layouts.app', [
            'title' => 'Proyectos & Arquitectura | Víctor Hugo Pérez Cruz',
        ]);
    }
}
