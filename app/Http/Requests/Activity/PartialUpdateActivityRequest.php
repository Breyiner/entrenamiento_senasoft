<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateActivityRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'sometimes|required|string|min:5|max:100',
      'description' => 'sometimes|nullable|string|max:500',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'El :attribute es obligatorio.',
      'name.string' => 'El :attribute debe ser en formato de texto.',
      'name.min' => 'El :attribute debe tener al menos :min caracteres.',
      'name.max' => 'El :attribute no debe tener más de :max caracteres.',
      'description.string' => 'La :attribute debe ser en formato de texto.',
      'description.max' => 'La :attribute no debe tener más de :max caracteres.',
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'nombre de la actividad',
      'description' => 'descripción',
    ];
  }
}
