<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name' => ['required', 'string', 'max:255'],
			'email' => [
				'required',
				'string',
				'lowercase',
				'email',
				'max:255',
				Rule::unique(User::class)->ignore($this->user()->id),
			],
		];
	}

	public function messages(): array
	{
		return [
			'name.required' => 'El nombre es obligatorio.',
			'name.string' => 'El nombre debe ser un texto válido.',
			'name.max' => 'El nombre no puede superar los 255 caracteres.',
			'email.required' => 'El correo electrónico es obligatorio.',
			'email.email' => 'Debes ingresar un correo electrónico válido.',
			'email.unique' => 'Este correo ya está en uso por otra cuenta.',
		];
	}
}
