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
            'motif_conge' => ['required'],
            'statut_conge' => ['nullable', 'string', 'in:approuvée,rejetée'],
        ];
    }
}
