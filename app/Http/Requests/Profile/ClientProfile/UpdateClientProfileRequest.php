<?php

namespace App\Http\Requests;

use App\Http\Requests\Profile\UserProfile\UpdateProfileRequest;

class UpdateClientProfileRequest extends UpdateProfileRequest
{

  public function rules(): array
  {
    return array_merge(parent::rules(), [
      'company_name' => 'required|string|max:100',
      'arl_id' => 'required|exists:arls,id',
      'address' => 'required|string|max:100',
    ]);
  }

  public function messages()
  {
    return array_merge(parent::messages(), [
      'company_name.required' => 'El :attribute es obligatorio.',
      'company_name.string' => 'El :attribute debe ser una cadena de texto.',
      'company_name.max' => 'El :attribute no puede tener más de :max caracteres.',

      'arl_id.required' => 'La :attribute es obligatoria.',
      'arl_id.exists' => 'La :attribute seleccionada no es válida.',

      'address.required' => 'La :attribute es obligatoria.',
      'address.string' => 'La :attribute debe ser una cadena de texto.',
      'address.max' => 'La :attribute no puede tener más de :max caracteres.',
    ]);
  }


  public function attributes(): array
  {
    return array_merge(parent::attributes(), [
      'company_name' => 'nombre de la empresa',
      'arl_id' => 'ARL',
      'address' => 'dirección',
    ]);
  }
}
