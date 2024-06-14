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
            'nom_service' => ['string', 'required', 'max:120'],
            'chef_service' => ['string', 'required', 'max:150'],
            'effectif_service' => ['integer', 'required', 'max:1200'],
            'detail_service' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'nom_service.required' => 'Le nom du service est obligatoire.',
            'nom_service.string' => 'Le nom du service doit être une chaîne de caractères.',
            'nom_service.max' => 'Le nom du service ne peut pas dépasser 120 caractères.',
            // 'nom_service.regex' => 'Le nom du service ne peut contenir que des lettres et des espaces.',

            'chef_service.required' => 'Le nom du chef de service est obligatoire.',
            'chef_service.string' => 'Le nom du chef de service doit être une chaîne de caractères.',
            'chef_service.max' => 'Le nom du chef de service ne peut pas dépasser 150 caractères.',
            // 'chef_service.regex' => 'Le nom du chef de service ne peut contenir que des lettres et des espaces.',

            'effectif_service.required' => "L'effectif du service est obligatoire.",
            'effectif_service.integer' => "L'effectif du service doit être un nombre entier.",
            'effectif_service.max' => "L'effectif du service ne peut pas dépasser 1200.",

            'detail_service.string' => 'Le détail du service doit être une chaîne de caractères.',
        ];
    }
}
