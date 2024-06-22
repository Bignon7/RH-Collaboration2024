<style>
    :root {
        font-family: 'Public Sans', ;
    }
</style>
<x-guest-layout>
    <form action="{{ route('store_one_user_fiche') }}" method="POST" class="max-w-screen-lg" enctype="multipart/form-data">
        @csrf
        <!-- Matricule -->
        <div>
            <x-input-label for="matricule" :value="__('Matricule')" />
            <x-text-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')"
                required autofocus autocomplete="matricule" placeholder="13062013" />
            <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
        </div>

        <!-- Nom -->
        <div class="mt-4">
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                required autocomplete="nom" placeholder="QUENUM" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                required autocomplete="prenom" placeholder="Everest" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="exemple@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- La fiche -->
        <div class="max-w-md mx-auto mt-4">
            <label class="block font-semibold text-gray-600">Importer la fiche</label>
            <div class="mt-1">
                <label for="lien_fiche"
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer">
                    <span id="lien-fiche-name" class="text-gray-500">Sélectionner un fichier</span>
                    <input id="lien_fiche" name="lien_fiche" type="file" class="file-input" style="display:none"
                        onchange="document.getElementById('lien-fiche-name').textContent = this.files[0].name.slice(0,15)+'...';">
                </label>
            </div>
            <x-input-error :messages="$errors->get('lien_fiche')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('get_dash') }}">
                {{ __('Retourner sur le tableau de bord') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Importer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
