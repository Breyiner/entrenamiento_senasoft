<?php

namespace App\Http\Requests\ARL;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateARLRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $arlId = $this->route('id');

    return [
      'name' => 'sometimes|required|string|min:3|max:255',
      'nit' => "sometimes|required|string|min:5|max:20|unique:arls,nit,{$arlId}",
      'email' => "sometimes|required|string|email|max:255|unique:arls,email,{$arlId}",
    ];
  }

  public function messages(): array
  {
    return (new StoreARLRequest())->messages();
  }

  public function attributes(): array
  {
    return (new StoreARLRequest())->attributes();
  }
}
