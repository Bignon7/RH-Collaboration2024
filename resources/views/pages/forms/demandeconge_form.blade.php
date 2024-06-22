<style>
    :root {
        font-family: 'Public Sans', ;
        color: rgb(123, 123, 123);
    }
</style>
<x-guest-layout>
    <!-- Page Content -->
    {{-- <h1 class="text-2xl font-semibold mb-6 text-gray-500 text-center">Demande de congés</h1>
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
            <x-text-input id="date_debut_conge" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full" type="date"
                name="date_debut_conge" :value="old('date_debut_conge')" required autocomplete="date_debut_conge"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_debut_conge')" class="mt-2" />
        </div>

        <!-- Durée de Congé -->
        <div class="mt-4">
            <x-input-label for="duree_conge" :value="__('La durée exacte de l\'absence')" />
            <x-text-input id="duree_conge" class="block mt-1 w-full" type="text" name="duree_conge" :value="old('duree_conge')"
                required autocomplete="duree_conge" placeholder="La duréee..." />
            <x-input-error :messages="$errors->get('duree_conge')" class="mt-2" />
        </div>


        <!-- Date de retour de Congé -->
        <div class="mt-4">
            <x-input-label for="date_retour_conge" :value="__('Date de votre retour')" />
            <x-text-input id="date_retour_conge" min="<?php echo date('Y-m-d'); ?>" class="block mt-1 w-full" type="date"
                name="date_retour_conge" :value="old('date_retour_conge')" required autocomplete="date_retour_conge"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_retour_conge')" class="mt-2" />
        </div>

        <!-- Motif de Congé -->
        <div class="mb-4 mt-4">
            <x-input-label for="motif_conge" :value="__('Motif de votre absence')" />
            <textarea name="motif_conge" id="motif_conge" rows="5" value="{{ old('motif_conge') }}"
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


    </form> --}}

    <h1 class="text-2xl font-semibold mb-6 text-gray-500 text-center">
        {{ isset($demandeconge) ? 'Modifier une demande de congé' : 'Enregistrer une demande de congé' }}
    </h1>
    <form
        action="{{ isset($demandeconge) ? route('update_created_demandeconge', $demandeconge->id) : route('store_created_demandeconge') }}"
        method="POST">
        @csrf
        {{-- @if (isset($demandeconge))
            @method('PUT')
        @endif --}}

        <!-- Type de Congé -->
        <div class="mb-4">
            <x-input-label for="type_conge" :value="__('Type de l\'absence')" />
            <select id="type_conge" name="type_conge"
                class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                onchange="toggleOtherTypeField()" required autofocus>
                <option value="" disabled
                    {{ old('type_conge', isset($demandeconge) ? $demandeconge->type_conge : '') == '' ? 'selected' : '' }}>
                    Sélectionnez un type de congé</option>
                <option
                    {{ old('type_conge', isset($demandeconge) && $demandeconge->type_conge == 'Annuel' ? 'selected' : '') }}
                    value="Annuel">Annuel</option>
                <option
                    {{ old('type_conge', isset($demandeconge) && $demandeconge->type_conge == 'Maladie' ? 'selected' : '') }}
                    value="Maladie">Maladie</option>
                <option
                    {{ old('type_conge', isset($demandeconge) && $demandeconge->type_conge == 'Maternité' ? 'selected' : '') }}
                    value="Maternité">Maternité</option>
                <option
                    {{ old('type_conge', isset($demandeconge) && $demandeconge->type_conge == 'Paternité' ? 'selected' : '') }}
                    value="Paternité">Paternité</option>
                <option
                    {{ old('type_conge', isset($demandeconge) && $demandeconge->type_conge == 'Autres' ? 'selected' : '') }}
                    value="Autres">Autres</option>
            </select>
            <x-input-error :messages="$errors->get('type_conge')" class="mt-2" />
        </div>

        <!-- Champ de texte pour le type de congé 'Autres' -->
        <div class="mb-4 mt-4 {{ old('type_conge', isset($demandeconge) && $demandeconge->type_conge == 'Autres' ? '' : 'hidden') }}"
            id="other_type_container">
            <x-input-label for="type_conge_autre" :value="__('Autre type')" />
            <input type="text" name="type_conge_autre" id="type_conge_input"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                value="{{ old('type_conge_autre', isset($demandeconge) ? $demandeconge->type_conge : '') }}">
            <x-input-error :messages="$errors->get('type_conge')" class="mt-2" />
        </div>

        <!-- Date de Début de Congé -->
        <div class="mt-4">
            <x-input-label for="date_debut_conge" :value="__('Date de début du congé ou de l\'absence')" />
            <x-text-input id="date_debut_conge" min="{{ date('Y-m-d') }}" class="block mt-1 w-full" type="date"
                name="date_debut_conge" :value="old('date_debut_conge', isset($demandeconge) ? $demandeconge->date_debut_conge : '')" required autocomplete="date_debut_conge"
                placeholder="30/12/1995" />
            <x-input-error :messages="$errors->get('date_debut_conge')" class="mt-2" />
        </div>

        <!-- Durée de Congé -->
        <div class="mt-4">
            <x-input-label for="duree" :value="__('La durée exacte de l\'absence')" />
            <div class="flex">
                <x-text-input id="duree" class="block mt-1 w-full" type="number" name="duree" min="1"
                    :value="old('duree', isset($demandeconge) ? explode(' ', $demandeconge->duree_conge)[0] : '')" required autocomplete="duree" placeholder="La durée..." />
                <select id="duree_unite" name="duree_unite"
                    class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="jour"
                        {{ old('duree_unite', isset($demandeconge) ? explode(' ', $demandeconge->duree_conge)[1] : '') == 'jour' ? 'selected' : '' }}>
                        {{ __('Jour') }}</option>
                    <option value="jours"
                        {{ old('duree_unite', isset($demandeconge) ? explode(' ', $demandeconge->duree_conge)[1] : '') == 'jours' ? 'selected' : '' }}>
                        {{ __('Jours') }}</option>
                    <option value="semaine"
                        {{ old('duree_unite', isset($demandeconge) ? explode(' ', $demandeconge->duree_conge)[1] : '') == 'semaine' ? 'selected' : '' }}>
                        {{ __('Semaine') }}</option>
                    <option value="semaines"
                        {{ old('duree_unite', isset($demandeconge) ? explode(' ', $demandeconge->duree_conge)[1] : '') == 'semaines' ? 'selected' : '' }}>
                        {{ __('Semaines') }}</option>
                    <option value="mois"
                        {{ old('duree_unite', isset($demandeconge) ? explode(' ', $demandeconge->duree_conge)[1] : '') == 'mois' ? 'selected' : '' }}>
                        {{ __('Mois') }}</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('duree')" class="mt-2" />
            <input type="hidden" id="duree_conge" name="duree_conge"
                value="{{ old('duree_conge', isset($demandeconge) ? $demandeconge->duree_conge : '') }}">
        </div>

        <!-- Date de retour de Congé -->
        <div class="mt-4">
            <x-input-label for="date_retour_conge" :value="__('Date de votre retour')" />
            <x-text-input id="date_retour_conge" min="{{ date('Y-m-d') }}" class="block mt-1 w-full" type="date"
                name="date_retour_conge" :value="old('date_retour_conge', isset($demandeconge) ? $demandeconge->date_retour_conge : '')" required autocomplete="date_retour_conge"
                placeholder="30/12/1995" readonly />
            <x-input-error :messages="$errors->get('date_retour_conge')" class="mt-2" />
        </div>


        <!-- Motif de Congé -->
        <div class="mb-4 mt-4">
            <x-input-label for="motif_conge" :value="__('Motif de votre absence')" />
            <textarea name="motif_conge" id="motif_conge" rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>{{ old('motif_conge', isset($demandeconge) ? $demandeconge->motif_conge : '') }}</textarea>
            <x-input-error :messages="$errors->get('motif_conge')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button
                class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500 border border-gray-500 transition  duration-300 hover:bg-gray-500 hover:text-white"><a
                    href="{{ route('get_dash') }}">Annuler</a></button>
            <x-primary-button class="ms-4">
                {{ isset($demandeconge) ? __('Mettre à jour') : __('Soumettre') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
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
    document.addEventListener('DOMContentLoaded', function() {
        const dateDebutInput = document.getElementById('date_debut_conge');
        const dureeInput = document.getElementById('duree');
        const dureeUniteSelect = document.getElementById('duree_unite');
        const dateRetourInput = document.getElementById('date_retour_conge');

        function calculateReturnDate() {
            const dateDebut = dateDebutInput.value;
            const duree = parseInt(dureeInput.value);
            const unite = dureeUniteSelect.value;

            if (dateDebut && !isNaN(duree) && duree > 0) {
                const date = new Date(dateDebut);
                if ((unite === 'jours') || (unite === 'jour')) {
                    date.setDate(date.getDate() + duree);
                } else if ((unite === 'semaines') || (unite === 'semaine')) {
                    date.setDate(date.getDate() + duree * 7);
                } else if (unite === 'mois') {
                    date.setMonth(date.getMonth() + duree);
                }
                dateRetourInput.value = date.toISOString().split('T')[0];
            } else {
                dateRetourInput.value = '';
            }
        }

        dateDebutInput.addEventListener('input', calculateReturnDate);
        dureeInput.addEventListener('input', calculateReturnDate);
        dureeUniteSelect.addEventListener('change', calculateReturnDate);
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.querySelector('form');
        const dureeInput = document.getElementById('duree');
        const dureeUniteSelect = document.getElementById('duree_unite');
        const dureeCongeHiddenInput = document.getElementById('duree_conge');

        // Concaténer les valeurs avant la soumission du formulaire
        form.addEventListener('submit', (e) => {
            const duree = dureeInput.value;
            const dureeUnite = dureeUniteSelect.value;
            dureeCongeHiddenInput.value = `${duree} ${dureeUnite}`;
        });
    });
</script>
