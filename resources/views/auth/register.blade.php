<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
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
                required autofocus autocomplete="nom" placeholder="Le nom..." />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                required autofocus autocomplete="prenom" placeholder="Le prénom..." />
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
            <x-input-label for="prenom" :value="__('Date d\'embauche')" />
            <x-text-input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" :value="old('hire_date')"
                required autofocus autocomplete="hire_date" placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>
        <!-- Poste -->
        <div class="mt-4">
            <x-input-label for="poste" :value="__('Poste')" />

            <select name="example" id="example"
                class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" disabled selected>Sélectionnez un poste</option>
                <option value="Chercheur">Agent</option>
                <option value="Chercheur">Chef service informatique</option>
                <option value="Chercheur">Chercheur</option>
                <option value="Chercheur">Comptable</option>
                <option value="Chercheur">Directeur de projet</option>
                <option value="Platon">Platon</option>
                <option value="Sécrétaire">Sécrétaire</option>
            </select>
            <x-input-error :messages="$errors->get('poste')" class="mt-2" />
        </div>



        <!-- Numéro -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                required autofocus autocomplete="phone" placeholder="Le numéro téléphone..." />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        {{-- border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm --}}
        <!-- Adresse -->
        <div class="mt-4">
            <x-input-label for="adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')"
                required autofocus autocomplete="adresse" placeholder="L'adresse..." />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <!-- Compétences -->
        <div class="max-w-md mx-auto mt-4">
            <label class="block text-sm font-medium text-gray-700">Importer le CV</label>
            <div class="mt-1">
                <label for="comp_file"
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer">
                    <span id="comp-file-name" class="text-gray-500">Sélectionner un fichier</span>
                    <input id="comp_file" name="comp_file" type="file" class="file-input" style="display:none"
                        onchange="document.getElementById('comp-file-name').textContent = this.files[0].name">
                </label>
            </div>
        </div>

        <!-- Photo -->
        <div class="max-w-md mx-auto mt-4">
            <label class="block text-sm font-medium text-gray-700">Importer la photo</label>
            <div class="mt-1">
                <label for="photo_file"
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer">
                    <span id="photo-file-name" class="text-gray-500">Sélectionner un fichier</span>
                    <input id="photo_file" name="photo_file" type="file" class="file-input" style="display:none"
                        onchange="document.getElementById('photo-file-name').textContent = this.files[0].name">
                </label>
            </div>
        </div>
        <!-- /Ajout -->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
