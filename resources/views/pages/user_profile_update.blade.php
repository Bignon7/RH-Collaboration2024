<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="storage/img/logo_nbg.ico" />
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            font-family: 'Public Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Oxygen', 'Ubuntu', 'Cantarell',
                'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
            color: rgb(123, 123, 123);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans min-h-screen sm:mx-0 md:mx-36 ">
    <!-- Section principale -->
    <section class="container mx-auto px-10 py-8">
        <!-- Conteneur principal -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <form method="POST" action="{{ route('update_created_user', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <!-- En-tête de profil -->
                <header class="bg-gray-200 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-28 w-28 rounded-lg overflow-hidden mr-4">
                                <img src="storage/{{ $user->photo_file }}" alt="Photo de profil"
                                    class="object-cover w-full h-full">
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 ">{{ $user->prenom . ' ' . $user->nom }}
                                </h2>
                                <p class="text-gray-600">{{ $user->poste . ' Service ' . $user->service }}</p>
                                <div>
                                    <!-- Photo -->
                                    <x-input-label for="photo_file" :value="__('')" />
                                    <div class="flex items-center space-x-4">
                                        <label for="photo_file"
                                            class="inline-block px-4 py-2 bg-indigo-500 text-white font-semibold rounded-md shadow-sm cursor-pointer hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <input id="photo_file" name="photo_file" type="file" class="file-input"
                                                style="display:none"
                                                onchange="if (this.files && this.files[0]) {
                                                document.getElementById('photo-file-name').textContent = this.files[0].name.slice(0,20)+'...';
                                                document.getElementById('photo-file-div').classList.remove('hidden');
                                             }">
                                            <span>Changer la photo</span>
                                        </label>
                                        <div id="photo-file-div"
                                            class="flex-1 hidden  px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                                            <span id="photo-file-name" class="text-gray-500"
                                                onchange="document.getElementById('photo-file-div').classList.remove('hidden');">
                                                <!-- Afficher le nom du fichier actuel -->
                                                @if ($user->photo_file)
                                                    <a href="{{ asset('storage/' . $user->photo_file) }}"
                                                        target="_blank" class="text-indigo-500">
                                                        {{ basename($user->photo_file) }}
                                                    </a>
                                                @else
                                                    Sélectionner un fichier
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('photo_file')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Contenu principal -->
                <main class="px-6 py-4">
                    <!-- Informations personnelles -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-600 mb-2 border-b border-gray-200 pb-2">Informations
                            Personnelles</h3>
                        <div class=" gap-4 mt-4">
                            <!-- Inputs en deux colonnes -->
                            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 gap-x-16">
                                <!-- Matricule -->
                                <div>
                                    <x-input-label for="matricule" :value="__('Matricule')" />
                                    <x-text-input id="matricule" class=" w-full" type="text" name="matricule"
                                        :value="old('matricule', $user->matricule)" required autocomplete="matricule" placeholder="13062013" />
                                    <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
                                </div>

                                <!-- Nom -->
                                <div>
                                    <x-input-label for="nom" :value="__('Nom')" />
                                    <x-text-input id="nom" class=" w-full" type="text" name="nom"
                                        :value="old('nom', $user->nom)" required autocomplete="nom" placeholder="QUENUM" />
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                </div>

                                <!-- Prénom -->
                                <div>
                                    <x-input-label for="prenom" :value="__('Prénom')" />
                                    <x-text-input id="prenom" class="w-full" type="text" name="prenom"
                                        :value="old('prenom', $user->prenom)" required autocomplete="prenom" placeholder="Everest" />
                                    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class=" w-full" type="email" name="email"
                                        :value="old('email', $user->email)" required autocomplete="username"
                                        placeholder="exemple@gmail.com" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <!-- Téléphone -->
                                <div>
                                    <x-input-label for="phone" :value="__('Téléphone')" />
                                    <x-text-input id="phone" class=" w-full" type="text" name="phone"
                                        :value="old('phone', $user->phone)" required autocomplete="phone"
                                        placeholder="Le numéro téléphone..." />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Adresse -->
                                <div>
                                    <x-input-label for="adresse" :value="__('Adresse')" />
                                    <x-text-input id="adresse" class=" w-full" type="text" name="adresse"
                                        :value="old('adresse', $user->adresse)" required autocomplete="adresse" placeholder="L'adresse..." />
                                    <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                                </div>
                            </div>

                            @if (Auth::user()->id == $user->id && Auth::user()->role != 'Admin')
                                <div class="flex items-center justify-end mt-12">
                                    <button
                                        class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition scale-110 duration-300 hover:bg-gray-500 hover:text-white"><a
                                            href="{{ route('get_dash') }}">Annuler</a></button>
                                    <x-primary-button class="ms-8 scale-110">
                                        {{ __('Mettre à jour') }}
                                    </x-primary-button>

                                </div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="hire_date" value="{{ old('hire_date', $user->hire_date) }}">
                    <input type="hidden" name="poste" value="{{ old('poste', $user->poste) }}">
                    <input type="hidden" name="service" value="{{ old('service', $user->service) }}">
                    <input type="hidden" name="salaire" value="{{ old('salaire', $user->salaire) }}">
                    <input type="hidden" name="duree_contrat"
                        value="{{ old('duree_contrat', $user->duree_contrat) }}">
                    <input type="hidden" name="photo_file" value="{{ old('photo_file', $user->photo_file) }}">
                    <input type="hidden" name="comp_file" value="{{ old('comp_file', $user->comp_file) }}">
                    <input type="hidden" name="lien_contrat"
                        value="{{ old('lien_contrat', $user->lien_contrat) }}">
                    @if ((Auth::user()->role == 'Gestionnaire' && Auth::user()->id != $user->id) || Auth::user()->role == 'Admin')
                        <!-- Informations administratives -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2 border-b border-gray-200 pb-2">
                                Informations
                                Administratives</h3>
                            <div class=" gap-4 mt-4">
                                <!-- Inputs en deux colonnes -->
                                <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 gap-x-16">
                                    <!-- Date d'embauche -->
                                    <div>
                                        <x-input-label for="hire_date" :value="__('Date d\'embauche')" />
                                        <x-text-input id="hire_date" max="<?php echo date('Y-m-d'); ?>" class=" w-full"
                                            type="date" name="hire_date" :value="old('hire_date', $user->hire_date)" required
                                            autocomplete="hire_date" />
                                        <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
                                    </div>

                                    <!-- Poste -->
                                    <div>
                                        <x-input-label for="poste" :value="__('Poste')" />
                                        <select name="poste" id="poste"
                                            class="block w-full  bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option value="old('poste', $user->poste)" disabled>
                                                Sélectionnez un
                                                poste</option>
                                            <option value="Agent">Agent
                                            </option>
                                            <option value="Chef service">Chef
                                                service</option>
                                            <option value="Chercheur">
                                                Chercheur
                                            </option>
                                            <option value="Comptable">
                                                Comptable
                                            </option>
                                            <option value="Directeur de projet">Directeur de projet</option>
                                            <option value="Platon">Platon
                                            </option>
                                            <option value="Sécrétaire">Sécrétaire
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('poste')" class="mt-2" />
                                    </div>

                                    <!-- Service -->
                                    <div>
                                        <x-input-label for="service" :value="__('Service')" />
                                        <select name="service" id="service"
                                            class="block w-full  bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option value="old('service', $user->service)" disabled>
                                                Sélectionnez un
                                                service</option>
                                            <option value="Art">Art
                                            </option>
                                            <option value="Bureautique">
                                                Bureautique</option>
                                            <option value="Comptabilité">
                                                Comptabilité</option>
                                            <option value="Electricité">
                                                Electricité</option>
                                            <option value="Entretien">Entretien
                                            </option>
                                            <option value="Informatique">
                                                Informatique</option>
                                            <option value="Planification">
                                                Planification</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('service')" class="mt-2" />
                                    </div>


                                    <!-- Salaire -->
                                    <div>
                                        <x-input-label for="salaire" :value="__('Salaire')" />
                                        <x-text-input id="salaire" class=" w-full" type="text" name="salaire"
                                            :value="old('salaire', $user->salaire)" required autocomplete="salaire"
                                            placeholder="Le salaire..." />
                                        <x-input-error :messages="$errors->get('salaire')" class="mt-2" />
                                    </div>
                                    <!-- Duree contrat -->
                                    <div>
                                        <x-input-label for="duree_contrat" :value="__('Durée du contrat')" />
                                        <x-text-input id="duree_contrat" class=" w-full" type="text"
                                            name="duree_contrat" :value="old('duree_contrat', $user->duree_contrat)" required
                                            autocomplete="Durée du contrat" placeholder="Le duree_contrat..." />
                                        <x-input-error :messages="$errors->get('duree_contrat')" class="mt-2" />
                                    </div>
                                    <!-- Contrat de travail -->
                                    <div>
                                        <x-input-label for="lien_contrat" :value="__('Importer le contrat')" />
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="flex-1 block px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                                                <span id="contrat-file-name" class="text-gray-500">
                                                    <!-- Afficher le nom du fichier actuel -->
                                                    @if ($user->lien_contrat)
                                                        <a href="{{ asset('storage/' . $user->lien_contrat) }}"
                                                            target="_blank" class="text-indigo-500">
                                                            {{ basename($user->lien_contrat) }}
                                                        </a>
                                                    @else
                                                        Aucun contrat existant
                                                    @endif
                                                </span>
                                            </div>
                                            <label for="lien_contrat"
                                                class="inline-block px-4 py-2 bg-indigo-500 text-white font-semibold rounded-md shadow-sm cursor-pointer hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <input id="lien_contrat" name="lien_contrat" type="file"
                                                    class="file-input" style="display:none"
                                                    onchange="document.getElementById('contrat-file-name').textContent = this.files[0].name.slice(0,15)+'...';">
                                                <span>Sélectionner le contrat</span>
                                            </label>
                                        </div>
                                        <x-input-error :messages="$errors->get('lien_contrat')" class="mt-2" />
                                    </div>
                                    <!-- Compétences -->
                                    <div>
                                        <x-input-label for="comp_file" :value="__('Importer le CV')" />
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="flex-1 block px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
                                                <span id="comp-file-name" class="text-gray-500">
                                                    <!-- Afficher le nom du fichier actuel -->
                                                    @if ($user->comp_file)
                                                        <a href="storage/{{ $user->comp_file }}" target="_blank"
                                                            class="text-indigo-500">
                                                            {{ strlen(basename($user->comp_file)) > 20 ? substr(basename($user->comp_file), 0, 20) . '...' : basename($user->comp_file) }}
                                                        </a>
                                                    @else
                                                        Sélectionner un fichier
                                                    @endif
                                                </span>
                                            </div>
                                            <label for="comp_file"
                                                class="inline-block px-4 py-2 bg-indigo-500 text-white font-semibold rounded-md shadow-sm cursor-pointer hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <input id="comp_file" name="comp_file" type="file"
                                                    class="file-input" style="display:none"
                                                    onchange="document.getElementById('comp-file-name').textContent = this.files[0].name.slice(0,15)+'...';">
                                                <span>Changer le fichier</span>
                                            </label>
                                        </div>
                                        <x-input-error :messages="$errors->get('comp_file')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-12">
                                    <button
                                        class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition scale-110 duration-300 hover:bg-gray-500 hover:text-white"><a
                                            href="{{ route('get_dash') }}">Annuler</a></button>
                                    <x-primary-button class="ms-4 scale-110">
                                        {{ __('Mettre à jour') }}
                                    </x-primary-button>

                                </div>
                            </div>

                        </div>
                    @endif


                </main>
            </form>

        </div>

    </section>

    <!-- Insertion-->



</body>

</html>
