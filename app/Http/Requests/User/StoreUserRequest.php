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
            'last_name' => ['required', 'string', 'min:2', 'max:245'],
            'first_name' => ['required', 'string', 'min:2', 'max:245'],
            'identity_document_front' => ['nullable', 'image', 'max:2000'],
            'identity_document_back' => ['nullable', 'image', 'max:2000'],
            'phone_number' => ['required', 'integer', 'min:8'],
            'username' => ['nullable', 'string', 'unique:users,username'],
            'role' => ['nullable', 'in:participant,organizer,administrator'],
            'password' => ['nullable', 'string',],
            'nombre_bras' => ['nullable', 'integer', 'min:1']
        ];
    }
}
