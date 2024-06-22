@extends('pages.link')

@section('content')
    <div class="container mx-auto p-4 bg-gray-100 font-sans min-h-screen flex justify-center items-center sm:mx-0 md:mx-36">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-indigo-500 text-center p-6">
                <h2 class="text-white text-2xl">{{ $user->prenom . ' ' . $user->nom }}</h2>
            </div>
            <div class="p-6 text-center">
                <div class="mx-auto w-32 h-32 rounded-full overflow-hidden mb-4">
                    <img src="storage/{{ $user->photo_file }}" alt="User Photo" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold">{{ $user->prenom . ' ' . $user->nom }}</h3>
                <p>Email: {{ $user->email }}</p>
                <p>Téléphone: {{ $user->phone }}</p>
                <p>Adresse: {{ $user->adresse }}</p>
            </div>
            <hr class="border-gray-200">
            <div class="p-6">
                <h4 class="text-lg font-semibold mb-4">Informations Personnelles</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Matricule:</strong> {{ $user->matricule }}</p>
                    <p><strong>Nom:</strong> {{ $user->nom }}</p>
                    <p><strong>Prénom:</strong> {{ $user->prenom }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Téléphone:</strong> {{ $user->phone }}</p>
                    <p><strong>Adresse:</strong> {{ $user->adresse }}</p>
                </div>
            </div>
            <hr class="border-gray-200">
            <div class="p-6">
                <h4 class="text-lg font-semibold mb-4">Informations Administratives</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Date d'embauche:</strong>
                        {{ (new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE))->format(new DateTime($user->hire_date)) }}
                    </p>
                    <p><strong>Poste:</strong> {{ $user->poste }}</p>
                    <p><strong>Service:</strong> {{ $user->service }}</p>
                    @if ($user->comp_file)
                        <p><strong>Fichier de compétences:</strong> <a href="storage/{{ $user->comp_file }}"
                                class="text-indigo-500">Voir le CV</a></p>
                    @endif
                    @if ($user->salaire)
                        <p><strong>Salaire:</strong> {{ $user->salaire }}/an</p>
                    @endif
                    @if ($user->lien_contrat)
                        <p><strong>Contrat:</strong> <a href="storage/{{ $user->lien_contrat }}"
                                class="text-indigo-500">Voir le
                                contrat</a></p>
                    @endif
                    @if ($user->duree_contrat)
                        <p><strong>Durée du contrat:</strong> {{ $user->duree_contrat }}</p>
                    @endif
                    @if ($user->conges_total)
                        <p><strong>Congés totaux:</strong> {{ $user->conges_total }} jours</p>
                    @endif
                </div>
            </div>
            <div class="p-6 text-right">
                <a href="{{ route('edit_created_user', ['user' => $user, 'id' => $user->id]) }}"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Modifier</a>
            </div>
        </div>
    </div>
@endsection
