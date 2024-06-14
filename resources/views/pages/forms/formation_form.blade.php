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
                <h1 class="text-2xl font-semibold mb-6">Créer une formation</h1>
                <form action="{{ route('store_created_formation') }}" method="POST">
                    @csrf
                    <!-- Intitulé formation -->
                    <div class="mt-4">
                        <x-input-label for="intitule_formation" :value="__('L\'intitulé de la formation')" />
                        <x-text-input id="intitule_formation" class="block mt-1 w-full" type="text"
                            name="intitule_formation" :value="old('intitule_formation')" required autofocus
                            autocomplete="intitule_formation" placeholder="L'intitulé" />
                        <x-input-error :messages="$errors->get('intitule_formation')" class="mt-2" />
                    </div>

                    <!-- Description formation -->
                    <div class="mb-4 mt-4">
                        <x-input-label for="description_formation" :value="__('Description de la formation')" />
                        <textarea name="description_formation" id="description_formation" rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required></textarea>
                    </div>


                    <!-- Date de Début de formation -->
                    <div class="mt-4">
                        <x-input-label for="date_debut_formation" :value="__('Date de lancement de la formation ')" />
                        <x-text-input id="date_debut_formation" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full"
                            type="date" name="date_debut_formation" :value="old('date_debut_formation')" required
                            autocomplete="date_debut_formation" placeholder="30/12/1995" />
                        <x-input-error :messages="$errors->get('date_debut_formation')" class="mt-2" />
                    </div>

                    <!-- Durée de formation -->
                    <div class="mt-4">
                        <x-input-label for="duree_formation" :value="__('La durée exacte de la formation')" />
                        <x-text-input id="duree_formation" class="block mt-1 w-full" type="text"
                            name="duree_formation" :value="old('duree_formation')" required autofocus autocomplete="duree_formation"
                            placeholder="La duréee..." />
                        <x-input-error :messages="$errors->get('duree_formation')" class="mt-2" />
                    </div>


                    <!-- Date de fin de formation -->
                    <div class="mt-4">
                        <x-input-label for="date_fin_formation" :value="__('Date de clôture de la formation')" />
                        <x-text-input id="date_fin_formation" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full"
                            type="date" name="date_fin_formation" :value="old('date_fin_formation')" required
                            autocomplete="date_fin_formation" placeholder="30/12/1995" />
                        <x-input-error :messages="$errors->get('date_fin_formation')" class="mt-2" />
                    </div>

                    <!-- Lieu formation -->
                    <div class="mt-4 mb-4">
                        <x-input-label for="lieu_formation" :value="__('Lieu où se déroulera la formation')" />
                        <x-text-input id="lieu_formation" class="block mt-1 w-full" type="text" name="lieu_formation"
                            :value="old('lieu_formation')" required autofocus autocomplete="lieu_formation"
                            placeholder="Le lieu.." />
                        <x-input-error :messages="$errors->get('lieu_formation')" class="mt-2" />
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition  duration-300 hover:bg-gray-500 hover:text-white"><a
                                href="{{ route('get_dash') }}">Annuler</a></button>
                        <x-primary-button class="ms-4">
                            {{ __('Créer') }}
                        </x-primary-button>
                        <br><br><br>
                    </div>


                </form>
            </div>

        </main>
    </div>
</body>

</html>
