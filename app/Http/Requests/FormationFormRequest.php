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
            'lieu_formation' => ['required', 'string', 'max:255'],
        ];
    }
}
