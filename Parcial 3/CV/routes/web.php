<?php

use App\Livewire\Experience;
use App\Livewire\Home;
use App\Livewire\Projects;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Víctor Hugo Pérez Cruz Portfolio
|--------------------------------------------------------------------------
|
| 3 Rutas principales gestionadas por componentes Livewire reactivos:
| 1. Home (/) : Presentación neobrutalista, bio, terminal interactiva y easter eggs.
| 2. Proyectos (/proyectos) : Galería grid neobrutalista con filtros y modales.
| 3. Experiencia (/experiencia) : Línea de tiempo estructurada con historial del CV.
|
*/

Route::get('/', Home::class)->name('home');
Route::get('/proyectos', Projects::class)->name('projects');
Route::get('/experiencia', Experience::class)->name('experience');
