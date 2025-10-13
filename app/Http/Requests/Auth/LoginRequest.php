<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'document' => 'required|min:6|max:10',
      'password' => 'required|string|min:8|max:20',
    ];
  }

  /**

   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'document.required' => 'El :attribute es obligatorio',
      'password.required' => 'La :attribute es obligatoria',

      'document.min' => 'El :attribute debe tener al menos :min caracteres.',
      'document.max' => 'El :attribute no debe tener más de :max caracteres',
      'password.min' => 'La :attribute debe tener al menos :min caracteres.',
      'password.max' => 'La :attribute no debe tener más de :max caracteres',

      'password.string' => 'La :attribute debe ser texto',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'document' => 'número de documento',
      'password' => 'contraseña'
    ];
  }
}
