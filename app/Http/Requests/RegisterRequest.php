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
            // 'matricule' => ['required', 'numeric', 'regex:/^\d{6,12}$/', 'unique:' . User::class],
            // 'nom' => ['required', 'string', 'max:100', 'regex:/^[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ]{2,20}$/u'],
            // 'prenom' => ['required', 'string', 'max:100', 'regex:/^[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ][a-zàâäéèêëîïôùûüÿçœ]{1,19}(?:-[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ][a-zàâäéèêëîïôùûüÿçœ]{1,19})*$/u'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/u', 'unique:' . User::class],
            // 'hire_date' => ['required', 'string', 'max:100'],
            // 'poste' => ['required', 'string', 'max:100'],
            // 'service' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:60', 'regex:/^(?:\+|00)\d{1,3}[-. ]?\(?\d{1,4}\)?[-. ]?\d{1,4}[-. ]?\d{1,4}[-. ]?\d{1,9}$/'],
            'adresse' => ['required', 'string', 'max:255', 'regex:/^[a-zàâäéèêëîïôùûüÿçœA-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ0-9\s,.\'-]*[a-zàâäéèêëîïôùûüÿçœA-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ0-9][a-zàâäéèêëîïôùûüÿçœA-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ0-9\s,.\'-]*$/'],
            // 'role' => ['string', 'max:60'],
            'comp_file' => ['required', 'file', 'mimes:jpg,png,jpeg,pdf,docx', 'max:2048'],
            'photo_file' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults(),],
            'lien_contrat' => ['nullable', 'file', 'mimes:doc,pdf,docx', 'max:2048'],
            'salaire' => ['nullable', 'regex:/^((\$|€)?\d{1,}(?:([,.]\d{3})*)?(\.\d{2})?(\s*(USD|EUR|GBP|JPY))?|\d{1,}(?:([,.]\d{3})*)?(\.\d{2})?(\$|€)?(\s*(USD|EUR|GBP|JPY))?)?(\s*FCFA)?$/i'],
            'duree_contrat' => ['nullable', 'regex:/^\d+\s*(mois|an|ans)$/i'],
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.required' => 'Le champ matricule est requis.',
            'matricule.numeric' => 'Le champ matricule ne doit contenir que des chiffres',
            'matricule.regex' => 'Le champ matricule doit comporter 6 caractères au minimum et 12 au maximum',
            'matricule.unique' => 'Ce matricule a déjà été utilisé pour un autre utilisateur',

            'nom.required' => 'Le champ nom est requis.',
            'nom.string' => 'Le champ nom doit contenir uniquement des lettres.',
            'nom.regex' => 'Le champ nom doit contenir uniquement des lettres majuscules.',
            'nom.max' => 'Le champ nom ne doit pas dépasser :max caractères.',

            'prenom.required' => 'Le champ prénom est requis.',
            'prenom.string' => 'Le champ prénom doit contenir uniquement des lettres.',
            'prenom.regex' => 'Le champ prénom doit commencer par une lettre majuscule et les lettres suivantes doivent être minuscules.',
            'prenom.max' => 'Le champ prénom ne doit pas dépasser :max caractères.',

            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'phone.regex' => 'Le numéro de téléphone doit respecter le format international',
            'salaire.regex' => 'Le salaire doit contenir la valeur et l\'unité ou la devise',
            'duree_contrat.regex' => 'La durée du contrat doit être sous la forme  nombre mois,an ou ans',
            'adresse.regex' => 'L\'adresse doit être composée de votre boîte postale, de votre Ville et de votre pays',

            'comp_file.required' => 'Le fichier de compétences est requis.',
            'comp_file.file' => 'Le fichier de compétences doit être un fichier.',
            'comp_file.mimes' => 'Le fichier de compétences doit être de type : jpg, png, jpeg, pdf ou docx.',
            'comp_file.max' => 'Le fichier de compétences ne doit pas dépasser :max kilo-octets.',

            'photo_file.required' => 'Le fichier de photo est requis.',
            'photo_file.image' => 'Le fichier de photo doit être une image.',
            'photo_file.mimes' => 'Le fichier de photo doit être de type : jpg, jpeg ou png.',
            'photo_file.max' => 'Le fichier de photo ne doit pas dépasser :max kilo-octets.',

            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.*' => 'Le mot de passe doit respecter les critères de complexité.',
        ];
    }
}
