<?php

namespace App\Http\Requests\ServiceOrder;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceOrderRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'client_id' => 'required|exists:users,id',
      'professional_id' => 'required|exists:users,id',
      'activity_id' => 'required|exists:activities,id',
      'date' => 'required|date',
      'hours' => 'required|integer|min:1',
      'observations' => 'nullable|string|max:1000',
      'status_id' => 'required|exists:order_statuses,id',
    ];
  }

  public function messages(): array
  {
    return [
      'client_id.required' => 'El cliente es obligatorio.',
      'client_id.exists' => 'El cliente seleccionado no existe.',

      'professional_id.required' => 'El profesional es obligatorio.',
      'professional_id.exists' => 'El profesional seleccionado no existe.',

      'activity_id.required' => 'La actividad es obligatoria.',
      'activity_id.exists' => 'La actividad seleccionada no existe.',

      'date.required' => 'La fecha es obligatoria.',
      'date.date' => 'La fecha no tiene un formato válido.',

      'hours.required' => 'La cantidad de horas es obligatoria.',
      'hours.integer' => 'La cantidad de horas debe ser un número entero.',
      'hours.min' => 'La cantidad de horas debe ser al menos 1.',

      'observations.string' => 'Las observaciones deben ser texto.',
      'observations.max' => 'Las observaciones no deben superar los 1000 caracteres.',

      'status_id.required' => 'El estado es obligatorio.',
      'status_id.exists' => 'El estado seleccionado no existe.',
    ];
  }

  public function attributes(): array
  {
    return [
      'client_id' => 'cliente',
      'professional_id' => 'profesional',
      'activity_id' => 'actividad',
      'date' => 'fecha',
      'hours' => 'cantidad de horas',
      'observations' => 'observaciones',
      'status_id' => 'estado',
    ];
  }
}
