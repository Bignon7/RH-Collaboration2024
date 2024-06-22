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
    {{-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> --}}
    <form method="POST" action="{{ route('register.new.to_step2') }}" enctype="multipart/form-data">
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
        {{-- <!-- Role --> A commenter si nécessaire --}}
        @if (Auth::user())
            <div class="mt-4">
                <label for="role"></label>
                <input type="hidden" id="role" name="role" value="Employé">
            </div>
        @endif
        <!-- Service -->
        <div class="mt-4">
            <x-input-label for="service" :value="__('Service')" />

            <select name="service" id="service"
                class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" disabled {{ old('service') == '' ? 'selected' : '' }}>Sélectionnez un service
                </option>

                @foreach (\App\Models\Service::getAllServiceNames() as $service)
                    <option {{ old('service') == $service ? 'selected' : '' }} value="{{ $service }}">
                        {{ $service }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('service')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('')" />

            <x-text-input id="password" class="block mt-1 w-full" type="hidden" name="password" required
                autocomplete="new-password" value="{{ $pass_value }}" />

            {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="hidden"
                name="password_confirmation" required autocomplete="new-password" value="{{ $pass_value }}" />

            {{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('get_dash') }}">
                {{ __('Retourner sur le tableau de bord') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Etape suivante') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
