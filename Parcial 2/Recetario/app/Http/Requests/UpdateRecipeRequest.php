<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'in:desayuno,almuerzo,cena,postre,bebida'],
            'tiempo' => ['required', 'integer', 'min:1'],
            'dificultad' => ['required', 'string', 'in:fácil,media,difícil'],
            'ingredientes' => ['required', 'string'],
            'pasos' => ['required', 'string'],
            'nota_personal' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.integer' => 'El tiempo debe ser un número entero.',
            'tiempo.min' => 'El tiempo debe ser mayor a 0.',
            'dificultad.required' => 'La dificultad es obligatoria.',
            'dificultad.in' => 'La dificultad seleccionada no es válida.',
            'ingredientes.required' => 'Los ingredientes son obligatorios.',
            'pasos.required' => 'Los pasos son obligatorios.',
        ];
    }
}
