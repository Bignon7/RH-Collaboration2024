<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'matricule' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'hire_date' => ['required', 'string', 'max:100'],
            'poste' => ['required', 'string', 'max:100'],
            'service' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:60'],
            'adresse' => ['required', 'string', 'max:255'],
            'role' => ['string', 'max:60'],
            'comp_file' => ['required', 'file', 'mimes:jpg,png,jpeg,pdf,docx', 'max:2048'],
            'photo_file' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
