<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTorneoRequest extends FormRequest
{
	public function authorize(): bool
	{
		return auth()->check() && auth()->user()->role === 'admin';
	}

	public function rules(): array
	{
		return [
			'nombre' => ['required', 'string', 'max:255'],
			'juego_deporte' => ['required', 'string', 'max:255'],
			'fecha' => ['required', 'date', 'after:now'],
			'cupo' => ['required', 'integer', 'min:2', 'max:100'],
			'descripcion' => ['nullable', 'string'],
			'estado' => ['required', 'in:abierto,cerrado'],
		];
	}

	public function messages(): array
	{
		return [
			'nombre.required' => 'El nombre del torneo es obligatorio.',
			'nombre.string' => 'El nombre debe ser un texto válido.',
			'nombre.max' => 'El nombre no puede superar los 255 caracteres.',
			'juego_deporte.required' => 'El juego o deporte es obligatorio.',
			'juego_deporte.string' => 'El juego o deporte debe ser un texto válido.',
			'juego_deporte.max' => 'El juego o deporte no puede superar los 255 caracteres.',
			'fecha.required' => 'La fecha del torneo es obligatoria.',
			'fecha.date' => 'La fecha debe ser una fecha válida.',
			'fecha.after' => 'La fecha del torneo debe ser una fecha futura.',
			'cupo.required' => 'El cupo es obligatorio.',
			'cupo.integer' => 'El cupo debe ser un número entero.',
			'cupo.min' => 'El cupo mínimo es de 2 participantes.',
			'cupo.max' => 'El cupo máximo es de 100 participantes.',
			'descripcion.string' => 'La descripción debe ser un texto válido.',
			'estado.required' => 'El estado es obligatorio.',
			'estado.in' => 'El estado debe ser abierto o cerrado.',
		];
	}

	public function attributes(): array
	{
		return [
			'nombre' => 'nombre',
			'juego_deporte' => 'juego o deporte',
			'fecha' => 'fecha',
			'cupo' => 'cupo',
			'descripcion' => 'descripción',
			'estado' => 'estado',
		];
	}
}
