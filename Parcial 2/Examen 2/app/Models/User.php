<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
	use HasFactory, Notifiable;

	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	public function inscripciones(): HasMany
	{
		return $this->hasMany(Inscripcion::class);
	}

	public function torneos(): BelongsToMany
	{
		return $this->belongsToMany(Torneo::class, 'inscripciones')->withTimestamps();
	}

	public function isAdmin(): bool
	{
		return $this->role === 'admin';
	}

	public function isJugador(): bool
	{
		return $this->role === 'jugador';
	}

	public function estaInscritoEn(Torneo $torneo): bool
	{
		return $this->inscripciones()->where('torneo_id', $torneo->id)->exists();
	}
}
