<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true; 
  }

  public function rules(): array
  {
    return [
      'document' => 'required|file|mimes:docx,pdf,xls,xlsx|max:10240',
    ];
  }

  public function messages(): array
  {
    return [
      'document.required' => 'El :attribute es obligatorio.',
      'document.file' => 'El :attribute debe ser un archivo válido.',
      'document.mimes' => 'El :attribute debe ser un documento Word, PDF o Excel.',
      'document.max' => 'El :attribute no debe superar los 10MB.',
    ];
  }

  public function attributes(): array
  {
    return [
      'document' => 'documento',
    ];
  }
}
