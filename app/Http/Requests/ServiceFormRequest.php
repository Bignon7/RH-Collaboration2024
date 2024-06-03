<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
            'nom_service' => ['string', 'required', 'max:255'],
            'chef_service' => ['string', 'required', 'max:255'],
            'effectif_service' => ['integer', 'required', 'max:8'],
            'detail_service' => ['nullable'],
        ];
    }
}
