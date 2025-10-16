<?php

namespace App\Http\Requests\ServiceOrder;

use Illuminate\Foundation\Http\FormRequest;

class ReassignProfessionalRequest extends FormRequest
{
  public function authorize(): bool
  {
    // Aquí definir autorización según tu lógica o roles
    return true;
  }

  public function rules(): array
  {
    return [
      'professional_id' => 'required|integer|exists:users,id'
    ];
  }

  public function messages(): array
  {
    return [
      'professional_id.required' => 'Debe proporcionar el :attribute.',
      'professional_id.integer' => 'El :attribute debe ser un número entero.',
      'professional_id.exists' => 'El :attribute seleccionado no existe.',
    ];
  }

  public function attributes(): array
  {
    return [
      'professional_id' => 'ID del profesional',
    ];
  }
}