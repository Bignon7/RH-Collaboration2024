@if ($errors->any())
    <div class="text-base text-center text-white font-semibold px-6 py-3 mb-5 bg-red-500">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-guest-layout>
    <form method="POST" action="{{ route('register.new.store') }}" enctype="multipart/form-data">
        @csrf
        @method('post')

        <!-- Numéro -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                autocomplete="phone" placeholder="Le numéro téléphone..." />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <!-- Adresse -->
        <div class="mt-4">
            <x-input-label for="adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')"
                required autocomplete="adresse" placeholder="L'adresse..." />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <!-- Compétences -->
        <div class="max-w-md mx-auto mt-4">
            <label class="block font-semibold text-gray-600">Importer le CV</label>
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
            <label class="block  font-semibold text-gray-600">Importer la photo</label>
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
        <!-- Salaire -->
        <div class="mt-4">
            <x-input-label for="salaire" :value="__('Salaire annuel de base')" />
            <x-text-input id="salaire" class="block mt-1 w-full" type="text" name="salaire" :value="old('salaire')"
                required autocomplete="salaire" placeholder="30.000 FCFA / $120 " />
            <x-input-error :messages="$errors->get('salaire')" class="mt-2" />
        </div>
        <!-- Durée du contrat -->
        <div class="mt-4">
            <x-input-label for="duree_contrat" :value="__('Durée du contrat')" />
            <x-text-input id="duree_contrat" class="block mt-1 w-full" type="text" name="duree_contrat"
                :value="old('duree_contrat')" required autocomplete="duree_contrat" placeholder="valeur ans/mois" />
            <x-input-error :messages="$errors->get('duree_contrat')" class="mt-2" />
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
