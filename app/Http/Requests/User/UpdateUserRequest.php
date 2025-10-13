<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user_id');

        return [
            'status_id' => 'required|exists:statuses,id',
            'role_id' => 'sometimes|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'status_id.required' => 'El :attribute es obligatorio.',
            'status_id.exists' => 'El :attribute seleccionado no existe.',
            'role_id.exists' => 'El :attribute seleccionado no existe.',
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
            'status_id' => 'estado',
            'role_id' => 'rol',
        ];
    }
}
