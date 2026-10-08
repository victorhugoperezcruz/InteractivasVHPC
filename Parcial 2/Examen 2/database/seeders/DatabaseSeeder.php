<?php

namespace Database\Seeders;

use App\Models\Torneo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		$admin = User::updateOrCreate(
			['email' => 'admin@torneos.com'],
			[
				'name' => 'Administrador',
				'password' => Hash::make('password123'),
				'role' => 'admin',
				'email_verified_at' => now(),
			]
		);

		$jugador = User::updateOrCreate(
			['email' => 'jugador@torneos.com'],
			[
				'name' => 'Jugador Demo',
				'password' => Hash::make('password123'),
				'role' => 'jugador',
				'email_verified_at' => now(),
			]
		);

		$torneos = [
			[
				'nombre' => 'Copa Fútbol 7',
				'juego_deporte' => 'Fútbol',
				'fecha' => now()->addDays(7)->setTime(16, 0),
				'cupo' => 16,
				'descripcion' => 'Torneo relámpago de fútbol 7 con fase de grupos y eliminación directa.',
				'estado' => 'abierto',
			],
			[
				'nombre' => 'Liga Valorant Amateur',
				'juego_deporte' => 'Valorant',
				'fecha' => now()->addDays(12)->setTime(18, 0),
				'cupo' => 8,
				'descripcion' => 'Competencia por equipos de 5 jugadores. Trae a tu escuadra completa.',
				'estado' => 'abierto',
			],
			[
				'nombre' => 'Torneo Baloncesto 3x3',
				'juego_deporte' => 'Baloncesto',
				'fecha' => now()->addDays(20)->setTime(10, 0),
				'cupo' => 12,
				'descripcion' => 'Torneo urbano de baloncesto 3 contra 3 en cancha abierta.',
				'estado' => 'abierto',
			],
			[
				'nombre' => 'Copa FIFA 25',
				'juego_deporte' => 'FIFA 25',
				'fecha' => now()->addDays(5)->setTime(15, 0),
				'cupo' => 32,
				'descripcion' => 'Torneo individual de FIFA 25 en PlayStation 5.',
				'estado' => 'cerrado',
			],
		];

		foreach ($torneos as $datos) {
			Torneo::updateOrCreate(
				['nombre' => $datos['nombre']],
				$datos
			);
		}

		$primerTorneo = Torneo::where('nombre', 'Copa Fútbol 7')->first();
		if ($primerTorneo && ! $jugador->estaInscritoEn($primerTorneo)) {
			$jugador->inscripciones()->create(['torneo_id' => $primerTorneo->id]);
		}
	}
}
