<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Torneo extends Model
{
	use HasFactory;

	protected $table = 'torneos';

	protected $fillable = [
		'nombre',
		'juego_deporte',
		'fecha',
		'cupo',
		'descripcion',
		'estado',
	];

	protected function casts(): array
	{
		return [
			'fecha' => 'datetime',
			'cupo' => 'integer',
		];
	}

	public function inscripciones(): HasMany
	{
		return $this->hasMany(Inscripcion::class);
	}

	public function participantes(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'inscripciones')->withTimestamps();
	}

	public function getIsClosedAttribute(): bool
	{
		if ($this->estado === 'cerrado') {
			return true;
		}
		if ($this->fecha && $this->fecha->lt(now())) {
			return true;
		}
		if ($this->inscripciones()->count() >= (int) $this->cupo) {
			return true;
		}
		return false;
	}

	public function getCuposDisponiblesAttribute(): int
	{
		$disponibles = (int) $this->cupo - $this->inscripciones()->count();
		return $disponibles < 0 ? 0 : $disponibles;
	}

	public function getInscritosCountAttribute(): int
	{
		return $this->inscripciones()->count();
	}

	public function estaDisponible(): bool
	{
		return ! $this->is_closed;
	}

	public function motivoNoDisponible(): ?string
	{
		if ($this->estado === 'cerrado') {
			return 'El torneo se encuentra cerrado.';
		}
		if ($this->fecha && $this->fecha->lt(now())) {
			return 'La fecha del torneo ya pasó.';
		}
		if ($this->inscripciones()->count() >= (int) $this->cupo) {
			return 'El cupo del torneo está lleno.';
		}
		return null;
	}
}
