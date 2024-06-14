@php
    function generateComplexPassword($length = 12)
    {
        // $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?';
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*-_=+|:.<>?';
        $charactersLength = strlen($characters);
        $randomPassword = '';

        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomPassword;
    }

    $pass_value = generateComplexPassword(12);
    // Ajouter ceci dans les inputs    value="{{ $pass_value }}" disabled hidden plutôt
@endphp
<x-guest-layout>
    {{-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> --}}
    <form method="POST" action="{{ route('register.new.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Matricule -->
        <div>
            <x-input-label for="matricule" :value="__('Matricule')" />
            <x-text-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')"
                required autofocus autocomplete="matricule" placeholder="Le matricule..." />
            <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
        </div>

        <!-- Nom -->
        <div class="mt-4">
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                required autocomplete="nom" placeholder="Le nom..." />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                required autocomplete="prenom" placeholder="Le prénom..." />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="exemple@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>



        <!-- Ajout -->
        <!-- Date -->
        <div class="mt-4">
            <x-input-label for="hire_date" :value="__('Date d\'embauche')" />
            <x-text-input id="hire_date" max="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full" type="date"
                name="hire_date" :value="old('hire_date')" required autocomplete="hire_date" placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
        </div>
        <!-- Poste -->
        <div class="mt-4">
            <x-input-label for="poste" :value="__('Poste')" />

            <select name="poste" id="poste"
                class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" disabled {{ old('poste') == '' ? 'selected' : '' }}>Sélectionnez un poste
                </option>
                <option {{ old('poste') == 'Agent' ? 'selected' : '' }} value="Agent">Agent</option>
                <option {{ old('poste') == 'Chef service' ? 'selected' : '' }} value="Chef service">Chef service
                </option>
                <option {{ old('poste') == 'Chercheur' ? 'selected' : '' }} value="Chercheur">Chercheur</option>
                <option {{ old('poste') == 'Comptable' ? 'selected' : '' }} value="Comptable">Comptable</option>
                <option {{ old('poste') == 'Directeur de projet' ? 'selected' : '' }} value="Directeur de projet">
                    Directeur de projet
                </option>
                <option {{ old('poste') == 'Platon' ? 'selected' : '' }} value="Platon">Platon</option>
                <option {{ old('poste') == 'Sécrétaire' ? 'selected' : '' }} value="Sécrétaire">Sécrétaire</option>
            </select>
            <x-input-error :messages="$errors->get('poste')" class="mt-2" />
        </div>

        <!-- Service -->
        <div class="mt-4">
            <x-input-label for="service" :value="__('Service')" />

            <select name="service" id="service"
                class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" disabled {{ old('service') == '' ? 'selected' : '' }}>Sélectionnez un service
                </option>
                <option {{ old('service') == 'Art' ? 'selected' : '' }} value="Art">Art</option>
                <option {{ old('service') == 'Bureautique' ? 'selected' : '' }} value="Bureautique">Bureautique
                </option>
                <option {{ old('service') == 'Comptabilité' ? 'selected' : '' }} value="Comptabilité">Comptabilité
                </option>
                <option {{ old('service') == 'Electricité' ? 'selected' : '' }} value="Electricité">Electricité
                </option>
                <option {{ old('service') == 'Entretien' ? 'selected' : '' }} value="Entretien">Entretien</option>
                <option {{ old('service') == 'Informatique' ? 'selected' : '' }} value="Informatique">Informatique
                </option>
                <option {{ old('service') == 'Planification' ? 'selected' : '' }} value="Planification">Planification
                </option>
            </select>
            <x-input-error :messages="$errors->get('service')" class="mt-2" />
        </div>


        <!-- Numéro -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                required autocomplete="phone" placeholder="Le numéro téléphone..." />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        {{-- border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm --}}
        <!-- Adresse -->
        <div class="mt-4">
            <x-input-label for="adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')"
                required autocomplete="adresse" placeholder="L'adresse..." />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        {{-- <!-- Role --> A commenter si nécessaire --}}
        @if (Auth::user())
            @if (Auth::user()->role == 'Admin')
                <div class="mt-4">
                    <label for="role"></label>
                    <input type="hidden" id="role" name="role" value="Gestionnaire">
                </div>
            @endif
            @if (Auth::user()->role == 'Gestionnaire')
                <div class="mt-4">
                    <label for="role"></label>
                    <input type="hidden" id="role" name="role" value="Employé">
                </div>
            @endif
        @endif
        <!-- Compétences -->
        <div class="max-w-md mx-auto mt-4">
            <label class="block text-sm font-medium text-gray-700">Importer le CV</label>
            <div class="mt-1">
                <label for="comp_file"
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer">
                    <span id="comp-file-name" class="text-gray-500">Sélectionner un fichier</span>
                    <input id="comp_file" name="comp_file" type="file" class="file-input" style="display:none"
                        onchange="document.getElementById('comp-file-name').textContent = this.files[0].name.slice(0,15)+'...';">
                </label>
            </div>
            <x-input-error :messages="$errors->get('comp_file')" class="mt-2" />
        </div>

        <!-- Photo -->
        <div class="max-w-md mx-auto mt-4">
            <label class="block text-sm font-medium text-gray-700">Importer la photo</label>
            <div class="mt-1">
                <label for="photo_file"
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer">
                    <span id="photo-file-name" class="text-gray-500">Sélectionner un fichier</span>
                    <input id="photo_file" name="photo_file" type="file" class="file-input" style="display:none"
                        onchange="document.getElementById('photo-file-name').textContent = this.files[0].name.slice(0,15)+'...';">
                </label>
            </div>
            <x-input-error :messages="$errors->get('photo_file')" class="mt-2" />
        </div>
        <!-- /Ajout -->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('')" />

            <x-text-input id="password" class="block mt-1 w-full" type="hidden" name="password" required
                autocomplete="new-password" value="{{ $pass_value }}" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="hidden"
                name="password_confirmation" required autocomplete="new-password" value="{{ $pass_value }}" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('get_dash') }}">
                {{ __('Retourner sur le tableau de bord') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Créer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
