<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TontineRequest extends FormRequest
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
            'name' => 'required|string',
            'profit' => 'required|numeric',
            'delay' => 'required|string',
            'periode' => 'required|string',
            'amount' => 'required|numeric',
            'number_of_members' => 'required|integer',
            'description' => 'nullable|string',
        ];
    }
    public function message() : array
    {
        return [
            'name.required' => 'Le champ nom est requis.',
            'profit.required' => 'Le champ bénéfice est requis.',
            'delay.required' => 'Le champ délai est requis.',
            'periode.required' => 'Le champ période est requis.',
            'amount.required' => 'Le champ montant est requis.',
            'number_of_members.required' => 'Le champ nombre de membres est requis.',
        ];
    }
}
