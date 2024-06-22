<style>
    :root {
        font-family: 'Public Sans', ;
    }
</style>
<x-guest-layout>
    <!-- Page Content -->
    {{-- <h1 class="text-2xl font-semibold mb-6 text-gray-500 text-center">Créer une formation</h1>
    <form action="{{ route('store_created_formation') }}" method="POST">
        @csrf
        <!-- Intitulé formation -->
        <div class="mt-4">
            <x-input-label for="intitule_formation" :value="__('L\'intitulé de la formation')" />
            <x-text-input id="intitule_formation" class="block mt-1 w-full" type="text" name="intitule_formation"
                :value="old('intitule_formation')" required autofocus autocomplete="intitule_formation" placeholder="L'intitulé" />
            <x-input-error :messages="$errors->get('intitule_formation')" class="mt-2" />
        </div>

        <!-- Description formation -->
        <div class="mb-4 mt-4">
            <x-input-label for="description_formation" :value="__('Description de la formation')" />
            <textarea name="description_formation" id="description_formation" rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required></textarea>
        </div>


        <!-- Date de Début de formation -->
        <div class="mt-4">
            <x-input-label for="date_debut_formation" :value="__('Date de lancement de la formation ')" />
            <x-text-input id="date_debut_formation" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full" type="date"
                name="date_debut_formation" :value="old('date_debut_formation')" required autocomplete="date_debut_formation"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_debut_formation')" class="mt-2" />
        </div>

        <!-- Durée de formation -->
        <div class="mt-4">
            <x-input-label for="duree_formation" :value="__('La durée exacte de la formation')" />
            <x-text-input id="duree_formation" class="block mt-1 w-full" type="text" name="duree_formation"
                :value="old('duree_formation')" required autofocus autocomplete="duree_formation" placeholder="La duréee..." />
            <x-input-error :messages="$errors->get('duree_formation')" class="mt-2" />
        </div>


        <!-- Date de fin de formation -->
        <div class="mt-4">
            <x-input-label for="date_fin_formation" :value="__('Date de clôture de la formation')" />
            <x-text-input id="date_fin_formation" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full" type="date"
                name="date_fin_formation" :value="old('date_fin_formation')" required autocomplete="date_fin_formation"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_fin_formation')" class="mt-2" />
        </div>

        <!-- Lieu formation -->
        <div class="mt-4 mb-4">
            <x-input-label for="lieu_formation" :value="__('Lieu où se déroulera la formation')" />
            <x-text-input id="lieu_formation" class="block mt-1 w-full" type="text" name="lieu_formation"
                :value="old('lieu_formation')" required autofocus autocomplete="lieu_formation" placeholder="Le lieu.." />
            <x-input-error :messages="$errors->get('lieu_formation')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <button
                class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition  duration-300 hover:bg-gray-500 hover:text-white"><a
                    href="{{ route('get_dash') }}">Annuler</a></button>
            <x-primary-button class="ms-4">
                {{ __('Créer') }}
            </x-primary-button>

        </div>
    </form> --}}

    <h1 class="text-2xl font-semibold mb-6 text-gray-500 text-center">
        {{ isset($formation) ? 'Modifier une formation' : 'Créer une formation' }}
    </h1>
    <form
        action="{{ isset($formation) ? route('update_created_formation', $formation->id) : route('store_created_formation') }}"
        method="POST">
        @csrf
        {{-- @if (isset($formation))
            @method('PUT')
        @endif --}}

        <!-- Intitulé formation -->
        <div class="mt-4">
            <x-input-label for="intitule_formation" :value="__('L\'intitulé de la formation')" />
            <x-text-input id="intitule_formation" class="block mt-1 w-full" type="text" name="intitule_formation"
                :value="old('intitule_formation', isset($formation) ? $formation->intitule_formation : '')" required autofocus autocomplete="intitule_formation" placeholder="E-LEARNING" />
            <x-input-error :messages="$errors->get('intitule_formation')" class="mt-2" />
        </div>

        <!-- Description formation -->
        <div class="mb-4 mt-4">
            <x-input-label for="description_formation" :value="__('Description de la formation')" />
            <textarea name="description_formation" id="description_formation" rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>{{ old('description_formation', isset($formation) ? $formation->description_formation : '') }}</textarea>
            <x-input-error :messages="$errors->get('description_formation')" class="mt-2" />
        </div>

        <!-- Date de Début de formation -->
        <div class="mt-4">
            <x-input-label for="date_debut_formation" :value="__('Date de lancement de la formation ')" />
            <x-text-input id="date_debut_formation" min="{{ date('Y-m-d') }}" class="block mt-1 w-full" type="date"
                name="date_debut_formation" :value="old('date_debut_formation', isset($formation) ? $formation->date_debut_formation : '')" required autocomplete="date_debut_formation"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_debut_formation')" class="mt-2" />
        </div>

        <!-- Durée de formation -->
        <div class="mt-4">
            <x-input-label for="duree_formation" :value="__('La durée exacte de la formation')" />
            <x-text-input id="duree_formation" class="block mt-1 w-full" type="text" name="duree_formation"
                :value="old('duree_formation', isset($formation) ? $formation->duree_formation : '')" required autofocus autocomplete="duree_formation" placeholder="2 semaines" />
            <x-input-error :messages="$errors->get('duree_formation')" class="mt-2" />
        </div>

        <!-- Date de fin de formation -->
        <div class="mt-4">
            <x-input-label for="date_fin_formation" :value="__('Date de clôture de la formation')" />
            <x-text-input id="date_fin_formation" min="{{ date('Y-m-d') }}" class="block mt-1 w-full" type="date"
                name="date_fin_formation" :value="old('date_fin_formation', isset($formation) ? $formation->date_fin_formation : '')" required autocomplete="date_fin_formation"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_fin_formation')" class="mt-2" />
        </div>

        <!-- Lieu formation -->
        <div class="mt-4 mb-4">
            <x-input-label for="lieu_formation" :value="__('Lieu où se déroulera la formation')" />
            <x-text-input id="lieu_formation" class="block mt-1 w-full" type="text" name="lieu_formation"
                :value="old('lieu_formation', isset($formation) ? $formation->lieu_formation : '')" required autofocus autocomplete="lieu_formation" placeholder="Auditorium" />
            <x-input-error :messages="$errors->get('lieu_formation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button
                class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition  duration-300 hover:bg-gray-500 hover:text-white"><a
                    href="{{ route('get_dash') }}">Annuler</a></button>
            <x-primary-button class="ms-4">
                {{ isset($formation) ? __('Mettre à jour') : __('Créer') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
