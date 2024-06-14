<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
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
                <h1 class="text-2xl font-semibold mb-6">Enregistrer un service</h1>
                <form action="{{ route('store_created_service') }}" method="POST">
                    @csrf
                    <!-- Le nom du service -->
                    <div class="mt-4">
                        <x-input-label for="nom_service" :value="__('Le nom du service')" />
                        <x-text-input id="nom_service" class="block mt-1 w-full" type="text" name="nom_service"
                            :value="old('nom_service')" required autofocus autocomplete="nom_service"
                            placeholder="Le nom du service" />
                        <x-input-error :messages="$errors->get('nom_service')" class="mt-2" />
                    </div>

                    <!-- Le nom du chef service -->
                    <div class="mt-4">
                        <x-input-label for="chef_service" :value="__('Le nom du chef service')" />
                        <x-text-input id="chef_service" class="block mt-1 w-full" type="text" name="chef_service"
                            :value="old('chef_service')" required autofocus autocomplete="chef_service"
                            placeholder="Le nom du chef service" />
                        <x-input-error :messages="$errors->get('chef_service')" class="mt-2" />
                    </div>

                    <!-- L'effectif du service -->
                    <div class="mt-4">
                        <x-input-label for="effectif_service" :value="__('L\'effectif du service')" />
                        <x-text-input id="effectif_service" class="block mt-1 w-full" type="number"
                            name="effectif_service" :value="old('effectif_service')" required autofocus autocomplete="effectif_service"
                            placeholder="L'effectif du service" />
                        <x-input-error :messages="$errors->get('effectif_service')" class="mt-2" />
                    </div>

                    <!-- Description formation -->
                    <div class="mb-4 mt-4">
                        <x-input-label for="description_formation" :value="__('Informations nécessaires sur le service')" />
                        <textarea name="description_formation" id="description_formation" rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition  duration-300 hover:bg-gray-500 hover:text-white"><a
                                href="{{ route('get_dash') }}">Annuler</a></button>
                        <x-primary-button class="ms-4">
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                        <br><br><br>
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
    </div>
</body>

</html>
