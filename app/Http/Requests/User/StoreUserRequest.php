<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
      'first_name' => 'required|min:3|max:50',
      'last_name' => 'required|min:3|max:50',
      'document' => 'required|min:6|max:10|unique:users',
      'email' => 'required|email|unique:profiles',
      'phone_number' => 'required|min:10',
      'city_id' => 'required|exists:cities,id',
      'gender_id' => 'required|exists:genders,id',
      'role_id' => 'required|exists:roles,id',
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
      'first_name.required' => 'El :attribute es obligatorio',
      'last_name.required' => 'El :attribute es obligatorio',
      'email.required' => 'El :attribute es obligatorio',
      'phone_number.required' => 'El :attribute es obligatorio',
      'city_id.required' => 'La :attribute es obligatoria',
      'gender_id.required' => 'El :attribute es obligatorio',
      'role_id.required' => 'El :attribute es obligatorio',
      
      'document.min' => 'El :attribute debe tener al menos :min caracteres.',
      'first_name.min' => 'El :attribute debe tener al menos :min caracteres',
      'last_name.min' => 'El :attribute debe tener al menos :min caracteres',
      'phone_number.min' => 'El :attribute debe tener al menos :min caracteres',
      
      'document.max' => 'El :attribute no debe tener más de :max caracteres',
      'first_name.max' => 'El :attribute no debe tener más de :max caracteres',
      'last_name.max' => 'El :attribute no debe tener más de :max caracteres',
      
      'email.unique'   => 'Este :attribute ya está registrado en el sistema.',
      'document.unique'   => 'Este :attribute ya está registrado en el sistema.',
      
      'city_id.exists' => 'La :attribute seleccionada no existe.',
      'gender_id.exists' => 'El :attribute seleccionado no existe.',
      'role_id.exists' => 'El :attribute seleccionado no existe.'
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
      'first_name' => 'nombre',
      'last_name' => 'apellido',
      'document' => 'número de documento',
      'email' => 'correo',
      'phone_number' => 'número de teléfono',
      'city_id' => 'ciudad',
      'gender_id' => 'género',
      'role_id' => 'rol',
    ];
  }
}
