<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('pages.indexs.user_index', [
    //         'users' => User::where('role', 'Employé')->orderBy('created_at', 'desc')->paginate(2),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::where('role', 'Employé')->orderBy('nom', 'asc');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('hire_date', 'LIKE', "%{$search}%")
                    ->orWhere('poste', 'LIKE', "%{$search}%")
                    ->orWhere('service', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('adresse', 'LIKE', "%{$search}%")
                    ->orWhere('salaire', 'LIKE', "%{$search}%")
                    ->orWhere('duree_contrat', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(8);

        return view('pages.indexs.user_index', compact('users'));
    }

    // public function admin_attendance_index()
    // {
    //     return view('pages.indexs.attendance_user_index', [
    //         'users' => User::orderBy('nom', 'asc')->paginate(2),
    //     ]);
    // }


    public function admin_attendance_index(Request $request)
    {
        $search = $request->input('search');

        $query = User::orderBy('nom', 'asc');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('hire_date', 'LIKE', "%{$search}%")
                    ->orWhere('poste', 'LIKE', "%{$search}%")
                    ->orWhere('service', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('adresse', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(8);

        return view('pages.indexs.attendance_user_index', compact('users'));
    }

    // public function admin_index_manager()
    // {
    //     return view('pages.indexs.user_index', [
    //         'users' => User::where('role', 'Gestionnaire')->orderBy('created_at', 'desc')->paginate(2),
    //     ]);
    // }
    public function admin_index_manager(Request $request)
    {
        $search = $request->input('search');

        $query = User::where('role', 'Gestionnaire')->orderBy('nom', 'asc');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('hire_date', 'LIKE', "%{$search}%")
                    ->orWhere('poste', 'LIKE', "%{$search}%")
                    ->orWhere('service', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('adresse', 'LIKE', "%{$search}%")
                    ->orWhere('salaire', 'LIKE', "%{$search}%")
                    ->orWhere('duree_contrat', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(8);

        return view('pages.indexs.user_index', compact('users'));
    }


    // public function contrat_index()
    // {
    //     return view('pages.indexs.contrat_index', [
    //         'users' => User::orderBy('nom', 'asc')->whereNot('role', 'Admin')->paginate(2),
    //     ]);
    // }


    public function contrat_index(Request $request)
    {
        $search = $request->input('search');

        $query = User::orderBy('nom', 'asc')->whereNot('role', 'Admin');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('matricule', 'LIKE', "%{$search}%")
                    ->orWhere('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('hire_date', 'LIKE', "%{$search}%")
                    ->orWhere('poste', 'LIKE', "%{$search}%")
                    ->orWhere('service', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('adresse', 'LIKE', "%{$search}%")
                    ->orWhere('salaire', 'LIKE', "%{$search}%")
                    ->orWhere('duree_contrat', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(8);

        return view('pages.indexs.contrat_index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.show_user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.user_profile_update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, User $user)
    // {
    //     var_dump($request);
    //     //$data = $request->validated();
    //     $id = $user->id;
    //     Storage::disk('public')->delete($user->photo_file);
    //     Storage::disk('public')->delete($user->comp_file);

    //     if ($user->lien_contrat) {
    //         Storage::disk('public')->delete($user->lien_contrat);
    //     }
    //     $data['lien_contrat'] = $request->file('lien_contrat')->store('user_contrat', 'public');

    //     $user->update($data);
    //     if ($id != Auth::user()->id) {
    //         NotificationService::notifyUserProfileUpdate($id);
    //     } else {
    //         NotificationService::notifySelfProfileUpdate($user);
    //     }

    //     return back()->with('success', 'Les informations ont bien été mis à jour !');
    // }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $messages = [
            'matricule.required' => 'Le matricule est requis.',
            'matricule.numeric' => 'Le matricule doit être un nombre.',
            'matricule.regex' => 'Le matricule doit comporter entre 6 et 12 chiffres.',

            'nom.required' => 'Le nom est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 100 caractères.',
            'nom.regex' => 'Le nom doit comporter uniquement des lettres majuscules sans espaces.',

            'prenom.required' => 'Le prénom est requis.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 100 caractères.',
            'prenom.regex' => 'Le prénom doit commencer par une majuscule et peut contenir un tiret.',

            'email.required' => 'L\'email est requis.',
            'email.string' => 'L\'email doit être une chaîne de caractères.',
            'email.lowercase' => 'L\'email doit être en minuscules.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.max' => 'L\'email ne doit pas dépasser 100 caractères.',
            'email.regex' => 'L\'email n\'est pas au format valide.',
            'email.unique' => 'L\'email est déjà utilisé.',

            'hire_date.required' => 'La date d\'embauche est requise.',
            'hire_date.date' => 'La date d\'embauche doit être une date valide.',

            'poste.required' => 'Le poste est requis.',
            'poste.string' => 'Le poste doit être une chaîne de caractères.',
            'poste.max' => 'Le poste ne doit pas dépasser 100 caractères.',

            'service.required' => 'Le service est requis.',
            'service.string' => 'Le service doit être une chaîne de caractères.',
            'service.max' => 'Le service ne doit pas dépasser 100 caractères.',

            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 60 caractères.',
            'phone.regex' => 'Le numéro de téléphone n\'est pas au format valide.',

            'adresse.required' => 'L\'adresse est requise.',
            'adresse.string' => 'L\'adresse doit être une chaîne de caractères.',
            'adresse.max' => 'L\'adresse ne doit pas dépasser 255 caractères.',
            'adresse.regex' => 'L\'adresse n\'est pas au format valide.',

            // 'salaire.required' => 'Le salaire est requis.',
            'salaire.string' => 'Le salaire doit être une chaîne de caractères.',
            'salaire.max' => 'Le salaire ne doit pas dépasser 255 caractères.',
            'salaire.regex' => 'Le salaire n\'est pas au format valide.',

            // 'duree_contrat.required' => 'La durée du contrat est requise.',
            'duree_contrat.string' => 'La durée du contrat doit être une chaîne de caractères.',
            'duree_contrat.max' => 'La durée du contrat ne doit pas dépasser 255 caractères.',
            'duree_contrat.regex' => 'La durée du contrat n\'est pas au format valide.',

            'photo_file.max' => 'Le fichier photo ne doit pas dépasser 2048 Ko.',
            'comp_file.max' => 'Le fichier complémentaire ne doit pas dépasser 2048 Ko.',
            'lien_contrat.max' => 'Le lien de contrat ne doit pas dépasser 2048 Ko.',
        ];

        // Validation des données
        // $request->validate([
        //     'matricule' => 'required|numeric',
        //     'nom' => 'required|string|max:255',
        //     'prenom' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        //     'phone' => 'required|string|max:255',
        //     'adresse' => 'required|string|max:255',
        //     'poste' => 'required|string|max:255',
        //     'service' => 'required|string|max:255',
        //     'hire_date' => 'required|date',
        //     'salaire' => 'required|string|max:255',
        //     'duree_contrat' => 'required|string|max:255',
        //     'photo_file' => 'nullable|max:2048', // Nullable pour permettre aucune mise à jour
        //     'comp_file' => 'nullable|max:2048', // Nullable pour permettre aucune mise à jour
        //     'lien_contrat' => 'nullable|max:2048',
        // ]);

        $request->validate([
            'matricule' => [
                'required',
                'numeric',
                'regex:/^\d{6,12}$/'
            ],
            'nom' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ]{2,20}$/u'
            ],
            'prenom' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ][a-zàâäéèêëîïôùûüÿçœ]{1,19}(?:-[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ][a-zàâäéèêëîïôùûüÿçœ]{1,19})*$/u'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:100',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/u',
                'unique:users,email,' . $id
            ],
            'hire_date' => [
                'required',
                'date'
            ],
            'poste' => [
                'required',
                'string',
                'max:100'
            ],
            'service' => [
                'required',
                'string',
                'max:100'
            ],
            'phone' => [
                'required',
                'string',
                'max:60',
                'regex:/^(?:\+|00)\d{1,3}[-. ]?\(?\d{1,4}\)?[-. ]?\d{1,4}[-. ]?\d{1,4}[-. ]?\d{1,9}$/'
            ],
            'adresse' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zàâäéèêëîïôùûüÿçœA-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ0-9\s,.\'-]*[a-zàâäéèêëîïôùûüÿçœA-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ0-9][a-zàâäéèêëîïôùûüÿçœA-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ0-9\s,.\'-]*$/'
            ],
            'salaire' => [
                'string',
                'max:255',
                'regex:/^((\$|€)?\d{1,}(?:([,.]\d{3})*)?(\.\d{2})?(\s*(USD|EUR|GBP|JPY))?|\d{1,}(?:([,.]\d{3})*)?(\.\d{2})?(\$|€)?(\s*(USD|EUR|GBP|JPY))?)?(\s*FCFA)?$/i'
            ],
            'duree_contrat' => [
                'string',
                'max:255',
                'regex:/^\d+\s*(mois|an|ans)$/i'
            ],
            'photo_file' => [
                'nullable',
                'max:2048'
            ],
            'comp_file' => [
                'nullable',
                'max:2048'
            ],
            'lien_contrat' => [
                'nullable',
                'max:2048'
            ],
        ], $messages);


        $user->matricule = $request->input('matricule');
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->adresse = $request->input('adresse');
        $user->poste = $request->input('poste');
        $user->service = $request->input('service');
        $user->hire_date = $request->input('hire_date');
        $user->salaire = $request->input('salaire');
        $user->duree_contrat = $request->input('duree_contrat');

        if ($request->hasFile('photo_file')) {
            if ($user->photo_file) {
                Storage::delete('public/' . $user->photo_file);
            }
            $photoPath = $request->file('photo_file')->store('photo_files', 'public');
            $user->photo_file = $photoPath;
        } else {
            $user->photo_file = $request->input('photo_file');
        }

        if ($request->hasFile('comp_file')) {
            if ($user->comp_file) {
                Storage::delete('public/' . $user->comp_file);
            }
            $compFilePath = $request->file('comp_file')->store('comp_files', 'public');
            $user->comp_file = $compFilePath;
        } else {
            $user->comp_file = $request->input('comp_file');
        }

        if ($request->hasFile('lien_contrat')) {
            if ($user->lien_contrat) {
                Storage::delete('public/' . $user->lien_contrat);
            }
            $contratPath = $request->file('lien_contrat')->store('contracts', 'public');
            $user->lien_contrat = $contratPath;
        } else {
            $user->lien_contrat = $request->input('lien_contrat');
        }

        $user->update();
        if ($id != Auth::user()->id) {
            NotificationService::notifyUserProfileUpdate($id);
        } else {
            NotificationService::notifySelfProfileUpdate($user);
        }

        // Rediriger vers la page de profil avec un message de succès
        return redirect()->route('get_dash')->with('success', 'Profil mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    { //Envoyer un mail
        //var_dump($user);
        //var_dump(Storage::url('photo_files/236ca612-d17b-442b-8175-2a4498daf263_p...'));
        Storage::disk('public')->delete($user->photo_file);
        Storage::disk('public')->delete($user->comp_file);
        if ($user->lien_contrat) {
            Storage::disk('public')->delete($user->lien_contrat);
        }
        $user->delete();
        return back()->with('success', 'L\'utilisateur a bien été supprimé!');
    }


    public function show_pass_form()
    {
        return view('pages.password_change');
    }

    // public function notification_index()
    // {
    //     return view('pages.indexs.notification_index', [
    //         'notifications' => Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(2),
    //     ]);
    // }
}
