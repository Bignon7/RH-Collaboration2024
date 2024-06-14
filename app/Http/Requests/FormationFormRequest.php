<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationFormRequest extends FormRequest
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
            'intitule_formation' => ['required', 'string', 'max:255'],
            'description_formation' => ['required'],
            'date_debut_formation' => ['required', 'string', 'max:255'],
            'duree_formation' => ['required', 'string', 'max:255'],
            'date_fin_formation' => ['required', 'string', 'max:255'],
            'lieu_formation' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'intitule_formation.required' => "L'intitulé de la formation est obligatoire.",
            'intitule_formation.string' => "L'intitulé de la formation doit être une chaîne de caractères.",
            'intitule_formation.max' => "L'intitulé de la formation ne peut pas dépasser 255 caractères.",

            'description_formation.required' => "La description de la formation est obligatoire.",
            'description_formation.string' => "La description de la formation doit être une chaîne de caractères.",

            'date_debut_formation.required' => "La date de début de la formation est obligatoire.",
            'date_debut_formation.string' => "La date de début de la formation doit être une chaîne de caractères.",
            'date_debut_formation.max' => "La date de début de la formation ne peut pas dépasser 255 caractères.",

            'duree_formation.required' => "La durée de la formation est obligatoire.",
            'duree_formation.string' => "La durée de la formation doit être une chaîne de caractères.",
            'duree_formation.max' => "La durée de la formation ne peut pas dépasser 255 caractères.",

            'date_fin_formation.required' => "La date de fin de la formation est obligatoire.",
            'date_fin_formation.string' => "La date de fin de la formation doit être une chaîne de caractères.",
            'date_fin_formation.max' => "La date de fin de la formation ne peut pas dépasser 255 caractères.",

            'lieu_formation.required' => "Le lieu de la formation est obligatoire.",
            'lieu_formation.string' => "Le lieu de la formation doit être une chaîne de caractères.",
            'lieu_formation.max' => "Le lieu de la formation ne peut pas dépasser 255 caractères.",
        ];
    }
}
