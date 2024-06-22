<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandecongeFormRequest extends FormRequest
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
            'type_conge' => ['required', 'string', 'max:255'],
            'date_debut_conge' => ['required', 'string', 'max:255'],
            'duree_conge' => ['required', 'string'],
            'date_retour_conge' => ['required', 'string', 'max:255'],
            'motif_conge' => ['required', 'string'],
            'statut_conge' => ['nullable', 'string', 'in:approuvée,rejetée'],
        ];
    }

    public function messages(): array
    {
        return [
            'type_conge.required' => 'Le type de congé est requis.',
            'type_conge.string' => 'Le type de congé doit être une chaîne de caractères.',
            'type_conge.max' => 'Le type de congé ne doit pas dépasser :max caractères.',

            'date_debut_conge.required' => 'La date de début de congé est requise.',
            'date_debut_conge.string' => 'La date de début de congé doit être une chaîne de caractères.',
            'date_debut_conge.max' => 'La date de début de congé ne doit pas dépasser :max caractères.',

            'duree_conge.required' => 'La durée du congé est requise.',
            'duree_conge.string' => 'La durée du congé doit être une chaîne de caractères.',

            'date_retour_conge.required' => 'La date de retour de congé est requise.',
            'date_retour_conge.string' => 'La date de retour de congé doit être une chaîne de caractères.',
            'date_retour_conge.max' => 'La date de retour de congé ne doit pas dépasser :max caractères.',

            'motif_conge.required' => 'Le motif de congé est requis.',
            'motif_conge.string' => 'Le motif de congé doit être composé de chaînes de caractères.',
        ];
    }
}
