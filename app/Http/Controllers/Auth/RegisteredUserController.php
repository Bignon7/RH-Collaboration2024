<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterCredentialsMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {


        $compPath = Str::uuid() . '_' . $request->file('comp_file')->getClientOriginalName();
        $photoPath = Str::uuid() . '_' . $request->file('photo_file')->getClientOriginalName();
        $photo = $request->file('photo_file')->storeAs('photo_files', $photoPath, 'public');
        $comp = $request->file('comp_file')->storeAs('comp_files', $compPath, 'public');

        $request = $request->validated();
        // $user = User::create([
        //     'matricule' => $request->matricule,
        //     'nom' => $request->nom,
        //     'prenom' => $request->prenom,
        //     'email' => $request->email,
        //     'hire_date' => $request->hire_date,
        //     'poste' => $request->poste,
        //     'service' => $request->service,
        //     'phone' => $request->phone,
        //     'adresse' => $request->adresse,
        //     'role' => $request->role,
        //     'comp_file' => $comp,
        //     'photo_file' => $photo,
        //     'password' => Hash::make($request->password),
        // ]);

        $user = User::create([
            'matricule' => $request['matricule'],
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'email' => $request['email'],
            'hire_date' => $request['hire_date'],
            'poste' => $request['poste'],
            'service' => $request['service'],
            'phone' => $request['phone'],
            'adresse' => $request['adresse'],
            'role' => $request['role'],
            'comp_file' => $comp,
            'photo_file' => $photo,
            'password' => Hash::make($request['password']),
        ]);

        Mail::send(new RegisterCredentialsMail($request));
        // $user = User::create([
        //     'matricule' => 000001,
        //     'nom' => 'ADMIN',
        //     'prenom' => "Administrateur",
        //     'email' => 'admin@gmail.com',
        //     'hire_date' => '13/06/2011',
        //     'poste' => 'Directeur',
        //     'service' => 'Informatique',
        //     'phone' => '+229 40 40 40 40',
        //     'adresse' => '02BP Séoul Corée du Sud',
        //     'role' => 'Admin',
        //     'comp_file' => $comp,
        //     'photo_file' => $photo,
        //     'password' => Hash::make('Administrator1!'),
        // ]);

        //Ne pas oublier cette partie
        event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return to_route('get_dash')->with('success', 'Le nouvel utilisateur a bien été enregistré');
    }
}
