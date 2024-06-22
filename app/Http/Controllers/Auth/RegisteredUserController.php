<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterCredentialsMail;
use App\Models\Service;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\NotificationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $pass_value = User::generateComplexPassword();
        return view('auth.register', compact('pass_value'));
    }

    public function create_employee(): View
    {
        $pass_value = User::generateComplexPassword();
        return view('auth.register_employee_for_admin', compact('pass_value'));
    }

    public function to_step2(Request $request)
    {
        $messages = [
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

            'hire_date' => 'La date d\'embauche est requise',

            'poste.required' => 'Le poste est requis.',
            'poste.string' => 'Le poste doit être une chaîne de caractères.',
            'poste.max' => 'Le poste ne doit pas dépasser 100 caractères.',

            'service.required' => 'Le service est requis.',
            'service.string' => 'Le service doit être une chaîne de caractères.',
            'service.max' => 'Le service ne doit pas dépasser 100 caractères.',
        ];

        $request->validate([
            'matricule' => ['required', 'numeric', 'regex:/^\d{6,12}$/', 'unique:users'],
            'nom' => ['required', 'string', 'max:100', 'regex:/^[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ]{2,20}$/u'],
            'prenom' => ['required', 'string', 'max:100', 'regex:/^[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ][a-zàâäéèêëîïôùûüÿçœ]{1,19}(?:-[A-ZÀÂÄÉÈÊËÎÏÔÙÛÜŸÇŒ][a-zàâäéèêëîïôùûüÿçœ]{1,19})*$/u'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/u', 'unique:users'],
            'hire_date' => ['required', 'date'],
            'poste' => ['required', 'string', 'max:100'],
            'service' => ['required', 'string', 'max:100'],
            'role' => ['string', 'max:60'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);

        $request->session()->put('step1', $request->only(
            'matricule',
            'nom',
            'prenom',
            'email',
            'hire_date',
            'poste',
            'service',
            'role',
            'password',
            'password_confirmation',
        ));

        return view('auth.register_step2');
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(RegisterRequest $request): RedirectResponse
    {
        $step1 = $request->session()->get('step1');
        if (!$step1) {
            return redirect()->route('register.new')->withErrors('Veuillez remplir la première étape.');
        }

        $compPath = Str::uuid() . '_' . $request->file('comp_file')->getClientOriginalName();
        $photoPath = Str::uuid() . '_' . $request->file('photo_file')->getClientOriginalName();
        $photo = $request->file('photo_file')->storeAs('photo_files', $photoPath, 'public');
        $comp = $request->file('comp_file')->storeAs('comp_files', $compPath, 'public');

        $step2 = $request->only(
            'phone',
            'adresse',
            'comp_file',
            'photo_file',
            'salaire',
            'duree_contrat',
        );

        $data = array_merge($step1, $step2);
        // var_dump($data);
        // dd($data);
        $user = User::create([
            'matricule' => $data['matricule'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'hire_date' => $data['hire_date'],
            'poste' => $data['poste'],
            'service' => $data['service'],
            'phone' => $data['phone'],
            'adresse' => $data['adresse'],
            'role' => $data['role'],
            'comp_file' => $comp,
            'photo_file' => $photo,
            'salaire' => $data['salaire'],
            'duree_contrat' => $data['duree_contrat'],
            'password' => Hash::make($data['password']),
        ]);

        $service = Service::where('nom_service', $data['service'])->first();
        if ($service) {
            $service->increment('effectif_service');
        }

        // Envoyer les notifications et mails après l'enregistrement
        NotificationService::notifyNewEmployee($user);
        Mail::send(new RegisterCredentialsMail($data));

        event(new Registered($user));

        $request->session()->forget(['step1', 'step2']);

        return to_route('get_dash')->with('success', 'Le nouvel utilisateur a bien été enregistré');
    }














    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(RegisterRequest $request): RedirectResponse
    // {


    //     $compPath = Str::uuid() . '_' . $request->file('comp_file')->getClientOriginalName();
    //     $photoPath = Str::uuid() . '_' . $request->file('photo_file')->getClientOriginalName();
    //     $photo = $request->file('photo_file')->storeAs('photo_files', $photoPath, 'public');
    //     $comp = $request->file('comp_file')->storeAs('comp_files', $compPath, 'public');

    //     $request = $request->validated();
    //     // $user = User::create([
    //     //     'matricule' => $request->matricule,
    //     //     'nom' => $request->nom,
    //     //     'prenom' => $request->prenom,
    //     //     'email' => $request->email,
    //     //     'hire_date' => $request->hire_date,
    //     //     'poste' => $request->poste,
    //     //     'service' => $request->service,
    //     //     'phone' => $request->phone,
    //     //     'adresse' => $request->adresse,
    //     //     'role' => $request->role,
    //     //     'comp_file' => $comp,
    //     //     'photo_file' => $photo,
    //     //     'password' => Hash::make($request->password),
    //     // ]);

    //     $user = User::create([
    //         'matricule' => $request['matricule'],
    //         'nom' => $request['nom'],
    //         'prenom' => $request['prenom'],
    //         'email' => $request['email'],
    //         'hire_date' => $request['hire_date'],
    //         'poste' => $request['poste'],
    //         'service' => $request['service'],
    //         'phone' => $request['phone'],
    //         'adresse' => $request['adresse'],
    //         'role' => $request['role'],
    //         'comp_file' => $comp,
    //         'photo_file' => $photo,
    //         'salaire' => $request['salaire'],
    //         'duree_contrat' => $request['duree_contrat'],
    //         'password' => Hash::make($request['password']),
    //     ]);
    //     NotificationService::notifyNewEmployee($user);
    //     Mail::send(new RegisterCredentialsMail($request));
    //     // $user = User::create([
    //     //     'matricule' => 000001,
    //     //     'nom' => 'ADMIN',
    //     //     'prenom' => "Administrateur",
    //     //     'email' => 'admin@gmail.com',
    //     //     'hire_date' => '13/06/2011',
    //     //     'poste' => 'Directeur',
    //     //     'service' => 'Informatique',
    //     //     'phone' => '+229 40 40 40 40',
    //     //     'adresse' => '02BP Séoul Corée du Sud',
    //     //     'role' => 'Admin',
    //     //     'comp_file' => $comp,
    //     //     'photo_file' => $photo,
    //     //     'password' => Hash::make('Administrator1!'),
    //     // ]);

    //     //Ne pas oublier cette partie
    //     event(new Registered($user));

    //     // Auth::login($user);

    //     // return redirect(RouteServiceProvider::HOME);
    //     return to_route('get_dash')->with('success', 'Le nouvel utilisateur a bien été enregistré');
    // }
}
