<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
      'content' => 'required|string|min:3|max:100',
    ];
  }

  public function messages(): array
  {
    return [
      'content.required' => 'El :attribute es obligatorio.',
      'content.string' => 'El :attribute debe ser texto.',
      'content.min' => 'El :attribute debe tener al menos :min caracteres.',
      'content.max' => 'El :attribute no debe tener más de :max caracteres.',
    ];
  }

  public function attributes(): array
  {
    return [
      'content' => 'contenido',
    ];
  }
}
