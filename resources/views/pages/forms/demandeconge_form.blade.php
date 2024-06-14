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

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.navigation') --}}

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div class="max-w-3xl mx-auto py-8">
                <h1 class="text-2xl font-semibold mb-6">Formulaire de demande de congés</h1>
                <form action="{{ route('store_created_demandeconge') }}" method="POST">
                    @csrf

                    <!-- Type de Congé -->
                    <div class="mb-4">
                        <x-input-label for="type_conge" :value="__('Type de l\'absence')" />
                        <select id="type_conge" name="type_conge"
                            class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            onchange="toggleOtherTypeField()" required autofocus>
                            <option value="" disabled {{ old('type_conge') == '' ? 'selected' : '' }}>Sélectionnez
                                un type de
                                congé
                            </option>
                            <option {{ old('type_conge') == 'Annuel' ? 'selected' : '' }} value="Annuel">Annuel</option>
                            <option {{ old('type_conge') == 'Maladie' ? 'selected' : '' }} value="Maladie">Maladie
                            </option>
                            <option {{ old('type_conge') == 'Maternité' ? 'selected' : '' }} value="Maternité">Maternité
                            </option>
                            <option {{ old('type_conge') == 'Paternité' ? 'selected' : '' }} value="Paternité">Paternité
                            </option>
                            <option {{ old('type_conge') == 'Autres' ? 'selected' : '' }}value="Autres">Autres</option>
                        </select>
                        <x-input-error :messages="$errors->get('type_conge')" class="mt-2" />

                    </div>
                    <!-- Champ de texte pour le type de congé 'Autres' -->
                    <div class="mb-4 mt-4 hidden" id="other_type_container">
                        <x-input-label for="type_conge" :value="__('Autre type')" />
                        <input type="text" name="type_conge" id="type_conge_input"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <x-input-error :messages="$errors->get('type_conge')" class="mt-2" />

                    </div>

                    <!-- Date de Début de Congé -->
                    <div class="mt-4">
                        <x-input-label for="date_debut_conge" :value="__('Date de début du congé ou de l\'absence')" />
                        <x-text-input id="date_debut_conge" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full"
                            type="date" name="date_debut_conge" :value="old('date_debut_conge')" required
                            autocomplete="date_debut_conge" placeholder="30/12/1995" />
                        <x-input-error :messages="$errors->get('date_debut_conge')" class="mt-2" />
                    </div>

                    <!-- Durée de Congé -->
                    <div class="mt-4">
                        <x-input-label for="duree_conge" :value="__('La durée exacte de l\'absence')" />
                        <x-text-input id="duree_conge" class="block mt-1 w-full" type="text" name="duree_conge"
                            :value="old('duree_conge')" required autocomplete="duree_conge" placeholder="La duréee..." />
                        <x-input-error :messages="$errors->get('duree_conge')" class="mt-2" />
                    </div>


                    <!-- Date de retour de Congé -->
                    <div class="mt-4">
                        <x-input-label for="date_retour_conge" :value="__('Date de votre retour')" />
                        <x-text-input id="date_retour_conge" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full"
                            type="date" name="date_retour_conge" :value="old('date_retour_conge')" required
                            autocomplete="date_retour_conge" placeholder="30/12/1995" />
                        <x-input-error :messages="$errors->get('date_retour_conge')" class="mt-2" />
                    </div>

                    <!-- Motif de Congé -->
                    <div class="mb-4 mt-4">
                        <x-input-label for="motif_conge" :value="__('Motif de votre absence')" />
                        <textarea name="motif_conge" id="motif_conge" rows="8" value="{{ old('motif_conge') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required></textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition  duration-300 hover:bg-gray-500 hover:text-white"><a
                                href="{{ route('get_dash') }}">Annuler</a></button>
                        <x-primary-button class="ms-4">
                            {{ __('Soumettre') }}
                        </x-primary-button>
                    </div>


                </form>
            </div>
            <script>
                function toggleOtherTypeField() {
                    var typeCongeSelect = document.getElementById('type_conge');
                    var otherTypeContainer = document.getElementById('other_type_container');
                    var otherTypeInput = document.getElementById('type_conge_input');

                    if (typeCongeSelect.value === 'Autres') {
                        otherTypeContainer.classList.remove('hidden');
                        otherTypeContainer.classList.add('block');
                        otherTypeInput.setAttribute('name', 'type_conge');
                        otherTypeInput.setAttribute('id', 'type_conge');
                        otherTypeInput.setAttribute('required', 'required');
                    } else {
                        otherTypeContainer.classList.remove('block');
                        otherTypeContainer.classList.add('hidden');
                        otherTypeInput.removeAttribute('name');
                        otherTypeInput.removeAttribute('id');
                        otherTypeInput.removeAttribute('required');
                    }
                }
            </script>
    </div>
    </main>

</body>

</html>
