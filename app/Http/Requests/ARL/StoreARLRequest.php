<?php

namespace App\Http\Requests\ARL;

use Illuminate\Foundation\Http\FormRequest;

class StoreARLRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|min:3|max:255',
      'nit' => 'required|string|min:5|max:20|unique:arls,nit',
      'email' => 'required|string|email|max:255|unique:arls,email',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'El :attribute es obligatorio.',
      'name.string' => 'El :attribute debe ser texto.',
      'name.min' => 'El :attribute debe tener al menos :min caracteres.',
      'name.max' => 'El :attribute no debe tener más de :max caracteres.',

      'nit.required' => 'El :attribute es obligatorio.',
      'nit.string' => 'El :attribute debe ser texto.',
      'nit.min' => 'El :attribute debe tener al menos :min caracteres.',
      'nit.max' => 'El :attribute no debe tener más de :max caracteres.',
      'nit.unique' => 'El :attribute ya está registrado.',
      
      'email.required' => 'El :attribute es obligatorio.',
      'email.email' => 'El :attribute debe ser un correo válido.',
      'email.max' => 'El :attribute no debe tener más de :max caracteres.',
      'email.unique' => 'El :attribute ya está registrado.',
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'nombre',
      'nit' => 'NIT',
      'email' => 'correo electrónico',
    ];
  }
}