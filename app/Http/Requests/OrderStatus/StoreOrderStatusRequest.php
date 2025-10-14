<?php

namespace App\Http\Requests\OrderStatus;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderStatusRequest extends FormRequest
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
      'name' => 'required|string|min:3|max:30',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'El :attribute es obligatorio.',
      'name.string' => 'El :attribute debe ser texto.',
      'name.min' => 'El :attribute debe tener al menos :min caracteres.',
      'name.max' => 'El :attribute no debe tener más de :max caracteres.',
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'nombre del estado',
    ];
  }
}
