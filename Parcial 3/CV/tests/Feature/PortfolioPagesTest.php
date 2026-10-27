<?php

namespace Tests\Feature;

use App\Livewire\Experience;
use App\Livewire\Home;
use App\Livewire\Projects;
use Livewire\Livewire;
use Tests\TestCase;

class PortfolioPagesTest extends TestCase
{
    public function test_home_page_returns_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('VÍCTOR HUGO');
        $response->assertSee('PÉREZ CRUZ');
        $response->assertSee('UASLP');
        $response->assertSee('TERMINAL DE LÍNEA DE COMANDOS');
    }

    public function test_projects_page_returns_successful_response(): void
    {
        $response = $this->get('/proyectos');
        $response->assertStatus(200);
        $response->assertSee('SISCORR');
        $response->assertSee('Metro Trivia CDMX');
        $response->assertSee('Analizador Léxico-Sintáctico');
        $response->assertSee('Neo-Manga');
        $response->assertSee('CubOS');
    }

    public function test_experience_page_returns_successful_response(): void
    {
        $response = $this->get('/experiencia');
        $response->assertStatus(200);
        $response->assertSee('Tipstate S.A. de C.V.');
        $response->assertSee('Laboratorio de Electrónica y Sistemas Digitales (LESD) – UASLP');
        $response->assertSee('Reloj de Cartas');
        $response->assertSee('UASLP');
    }

    public function test_home_terminal_livewire_component(): void
    {
        Livewire::test(Home::class)
            ->assertSee('whoami')
            ->call('runCommand', 'whoami')
            ->assertSee('Víctor Hugo Pérez Cruz')
            ->call('runCommand', 'skills')
            ->assertSee('HABILIDADES TÉCNICAS')
            ->call('runCommand', 'projects')
            ->assertSee('SISCORR')
            ->call('runCommand', 'clear')
            ->assertSet('terminalHistory', []);
    }

    public function test_projects_livewire_filter_and_search(): void
    {
        Livewire::test(Projects::class)
            ->assertSee('SISCORR')
            ->assertSee('Metro Trivia CDMX')
            ->set('categoryFilter', 'mobile')
            ->assertSee('Metro Trivia CDMX')
            ->assertDontSee('SISCORR')
            ->set('categoryFilter', 'all')
            ->set('search', 'compilador')
            ->assertSee('Analizador Léxico-Sintáctico')
            ->assertDontSee('CubOS')
            ->call('openProjectModal', 'siscorr')
            ->assertSet('selectedProject.id', 'siscorr')
            ->call('closeProjectModal')
            ->assertSet('selectedProject', null);
    }

    public function test_experience_livewire_tabs(): void
    {
        Livewire::test(Experience::class)
            ->assertSee('Practicante de Ingeniería de Software')
            ->assertSee('Becario de Laboratorio y Soporte Técnico')
            ->set('tab', 'industry')
            ->assertSee('Practicante de Ingeniería de Software')
            ->assertDontSee('Becario de Laboratorio y Soporte Técnico')
            ->set('tab', 'lab')
            ->assertSee('Becario de Laboratorio y Soporte Técnico')
            ->assertDontSee('Practicante de Ingeniería de Software');
    }
}
