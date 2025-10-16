<?php

namespace App\Http\Requests\ServiceOrder;

use Illuminate\Foundation\Http\FormRequest;

class PostponeOrderRequest extends FormRequest
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
      'new_date' => [
        'required',
        'date',
        'after:now',
      ],
    ];
  }

  public function messages(): array
  {
    return [
      'new_date.required' => 'Debe indicar la :attribute para posponer la orden.',
      'new_date.date' => 'La :attribute debe ser un valor válido.',
      'new_date.after' => 'La :attribute debe ser posterior a ahora.',
    ];
  }

  public function attributes(): array
  {
    return [
      'new_date' => 'fecha de posposición',
    ];
  }
}
