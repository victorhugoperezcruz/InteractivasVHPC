<?php

return [
	'required' => 'El campo :attribute es obligatorio.',
	'string' => 'El campo :attribute debe ser un texto.',
	'email' => 'El campo :attribute debe ser un correo válido.',
	'max' => [
		'string' => 'El campo :attribute no puede superar los :max caracteres.',
	],
	'min' => [
		'string' => 'El campo :attribute debe tener al menos :min caracteres.',
	],
	'confirmed' => 'La confirmación del campo :attribute no coincide.',
	'unique' => 'El valor del campo :attribute ya está en uso.',
	'current_password' => 'La contraseña actual no es correcta.',
	'lowercase' => 'El campo :attribute debe estar en minúsculas.',
	'attributes' => [
		'name' => 'nombre',
		'email' => 'correo electrónico',
		'password' => 'contraseña',
		'current_password' => 'contraseña actual',
	],
];
