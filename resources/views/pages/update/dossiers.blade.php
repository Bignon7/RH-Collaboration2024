{{-- @extends('pages.link')

@section('content')
    <div class="container">
        <h1>Dossiers du personnel</h1>
        @foreach ($users as $user)
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{{ $user->name }}</h2>
                    <p>Email: {{ $user->email }}</p>
                </div>
                <div class="card-body">
                    <h3>Fichiers Personnels</h3>
                    <ul>
                        @if ($user->comp_file)
                            <li>
                                <a href="storage/{{ $user->comp_file }}">Télécharger le fichier de compétence</a>
                            </li>
                        @endif

                        @if ($user->photo_file)
                            <li>
                                <a href="storage/{{ $user->photo_file }}">Télécharger la photo</a>
                            </li>
                        @endif

                        @if ($user->lien_contrat)
                            <li>
                                <a href="storage/{{ $user->lien_contrat }}">Télécharger le contrat</a>
                            </li>
                        @endif
                    </ul>

                    <h3>Justificatifs de Congés</h3>
                    <ul>
                        @foreach ($user->demandeconges as $demandeconge)
                            @if ($demandeconge->justificatif)
                                <li>
                                    <a href="storage/{{ $demandeconge->justificatif }}">Télécharger le
                                        justificatif</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <h3>Fiches de Paie</h3>
                    <ul>
                        @foreach ($user->fichePaies as $fiche)
                            @php
                                $filePath = str_replace('public/', '', $fiche->lien_fiche);
                            @endphp
                            <li>
                                <a href="storage/{{ $fiche->lien_fiche ? asset($filePath) : '#' }}">Télécharger la
                                    fiche de paie</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection --}}


{{-- @extends('pages.link')

@section('content')
    <div class="container">
        <h1>Dossiers du personnel</h1>
        <div class="file-explorer">
            @foreach ($users as $user)
                <div class="folder">
                    <div class="folder-header">
                        <h2>{{ $user->matricule }}_{{ $user->nom }}_{{ $user->prenom }}</h2>
                        <p>Email: {{ $user->email }}</p>
                    </div>
                    <div class="folder-content">
                        <h3>Fichiers Personnels</h3>
                        <ul>
                            @if ($user->comp_file)
                                <li>
                                    <a href="{{ asset('storage/' . $user->comp_file) }}">Télécharger le fichier de
                                        compétence</a>
                                </li>
                            @endif

                            @if ($user->photo_file)
                                <li>
                                    <a href="{{ asset('storage/' . $user->photo_file) }}">Télécharger la photo</a>
                                </li>
                            @endif

                            @if ($user->lien_contrat)
                                <li>
                                    <a href="{{ asset('storage/' . $user->lien_contrat) }}">Télécharger le contrat</a>
                                </li>
                            @endif
                        </ul>

                        <h3>Justificatifs de Congés</h3>
                        <ul>
                            @foreach ($user->demandeconges as $index => $demandeconge)
                                @if ($demandeconge->justificatif)
                                    <li>
                                        <a href="{{ asset('storage/' . $demandeconge->justificatif) }}">Télécharger le
                                            justificatif {{ $index + 1 }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <h3>Fiches de Paie</h3>
                        <ul>
                            @foreach ($user->fichePaies as $index => $fiche)
                                @php
                                    $filePath = str_replace('public/', '', $fiche->lien_fiche);
                                @endphp
                                <li>
                                    <a href="{{ asset('storage/' . $filePath) }}">Télécharger la fiche de paie
                                        {{ $index + 1 }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .file-explorer {
        display: flex;
        flex-wrap: wrap;
    }

    .folder {
        width: 30%;
        border: 1px solid #ddd;
        margin: 10px;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .folder-header {
        background-color: #f7f7f7;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .folder-content {
        padding: 10px;
    }

    .folder-content h3 {
        margin-top: 0;
    }

    .folder-content ul {
        list-style-type: none;
        padding-left: 0;
    }

    .folder-content ul li {
        margin: 5px 0;
    }

    .folder-content ul li a {
        text-decoration: none;
        color: #007bff;
    }

    .folder-content ul li a:hover {
        text-decoration: underline;
    }
</style> --}}


{{-- @extends('pages.link')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Dossiers du personnel</h1>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm" style="background-color: #f8f9fa; border-color: #697a8d;">
                        <div class="card-header" style="background-color: #8d9bab; color: white;">
                            <h2 class="h5 mb-0 text-white">{{ $user->matricule }}_{{ $user->nom }}_{{ $user->prenom }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 my-3 text-gray-500">Fichiers Personnels</h3>
                            <ul class="list-unstyled mb-4">
                                @if ($user->comp_file)
                                    <li class="mb-2">
                                        <a href="storage/{{ $user->comp_file }}"
                                            style="color: #697a8d; font-size: 0.9rem;">Télécharger le fichier de
                                            compétence</a>
                                    </li>
                                @endif

                                @if ($user->photo_file)
                                    <li class="mb-2">
                                        <a href="storage/{{ $user->photo_file }}"
                                            style="color: #697a8d; font-size: 0.9rem;">Télécharger la photo</a>
                                    </li>
                                @endif

                                @if ($user->lien_contrat)
                                    <li class="mb-2">
                                        <a href="storage/{{ $user->lien_contrat }}"
                                            style="color: #697a8d; font-size: 0.9rem;">Télécharger le contrat</a>
                                    </li>
                                @endif
                            </ul>
                            @if ($user->demandeconges->filter(fn($demandeconge) => $demandeconge->justificatif)->isNotEmpty())
                                <h3 class="h5 my-3 text-gray-500">Justificatifs de Congés</h3>
                                <ul class="list-unstyled mb-4">
                                    @foreach ($user->demandeconges as $index => $demandeconge)
                                        @if ($demandeconge->justificatif)
                                            <li class="mb-2">
                                                <a href="storage/{{ $demandeconge->justificatif }}"
                                                    style="color: #697a8d; font-size: 0.9rem;">Télécharger le justificatif
                                                    {{ $index + 1 }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif

                            @if ($user->fichePaies->isNotEmpty())
                                <h3 class="h5 my-3 text-gray-500">Fiches de Paie</h3>
                                <ul class="list-unstyled mb-4">
                                    @foreach ($user->fichePaies as $index => $fiche)
                                        @php
                                            $filePath = str_replace('public/', '', $fiche->lien_fiche);
                                        @endphp
                                        <li class="mb-2">
                                            <a href="storage/{{ $fiche->lien_fiche ? asset($filePath) : '#' }}"
                                                style="color: #697a8d; font-size: 0.9rem;">Télécharger la fiche de paie
                                                {{ $index + 1 }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif


                            <button
                                class="btn btn-link p-2 font-semibold text-gray-500 bg-white border border-gray-400 hover:text-indigo-500"
                                onclick="toggleVisibility(this)">Voir
                                moins</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleVisibility(button) {
            const cardBody = button.closest('.card-body');
            const lists = cardBody.querySelectorAll('ul');
            lists.forEach(list => {
                list.classList.toggle('d-none');
            });
            button.textContent = button.textContent === 'Voir plus' ? 'Voir moins' : 'Voir plus';
        }
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchText = this.value.trim().toLowerCase();
                    console.log('Texte de recherche:', searchText);

                    // Filtrer les cartes visibles
                    const cards = document.querySelectorAll('.card');
                    cards.forEach(function(card) {
                        const cardText = card.textContent.toLowerCase();
                        if (cardText.includes(searchText)) {
                            card.style.display = 'block'; // Afficher la carte si elle correspond
                        } else {
                            card.style.display = 'none'; // Masquer la carte sinon
                        }
                    });
                });
            }
        });
    </script>

    <style>
        .card-body ul.d-none {
            display: none;
        }

        .card-body ul:not(.d-none) li {
            display: block;
        }
    </style>
@endsection --}}


{{-- ///MON CODEEE --}}
{{-- @extends('pages.link')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4 text-xl font-medium text-gray-500">Dossiers du personnel</h1>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm" style="background-color: #f8f9fa; border-color: #697a8d;">
                        <div class="card-header" style="background-color: #8d9bab; color: white;">
                            <h2 class="h5 mb-0 text-white">{{ $user->matricule }}_{{ $user->nom }}_{{ $user->prenom }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 my-3 text-gray-500">Fichiers Personnels</h3>
                            <ul class="list-unstyled mb-4 d-none">
                                @if ($user->comp_file)
                                    <li class="mb-2">
                                        <a href="storage/{{ $user->comp_file }}"
                                            style="color: #697a8d; font-size: 0.9rem;">Télécharger le fichier de
                                            compétence</a>
                                    </li>
                                @endif

                                @if ($user->photo_file)
                                    <li class="mb-2">
                                        <a href="storage/{{ $user->photo_file }}"
                                            style="color: #697a8d; font-size: 0.9rem;">Télécharger la photo</a>
                                    </li>
                                @endif

                                @if ($user->lien_contrat)
                                    <li class="mb-2">
                                        <a href="storage/{{ $user->lien_contrat }}"
                                            style="color: #697a8d; font-size: 0.9rem;">Télécharger le contrat</a>
                                    </li>
                                @endif
                            </ul>

                            @if ($user->demandeconges->filter(fn($demandeconge) => $demandeconge->justificatif)->isNotEmpty())
                                <h3 class="h5 my-3 text-gray-500">Justificatifs de Congés</h3>
                                <ul class="list-unstyled mb-4 d-none">
                                    @foreach ($user->demandeconges as $index => $demandeconge)
                                        @if ($demandeconge->justificatif)
                                            <li class="mb-2">
                                                <a href="storage/{{ $demandeconge->justificatif }}"
                                                    style="color: #697a8d; font-size: 0.9rem;">Télécharger le justificatif
                                                    {{ $index + 1 }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif

                            @if ($user->fichePaies->isNotEmpty())
                                <h3 class="h5 my-3 text-gray-500">Fiches de Paie</h3>
                                <ul class="list-unstyled mb-4 d-none">
                                    @foreach ($user->fichePaies as $index => $fiche)
                                        @php
                                            $filePath = str_replace('public/', '', $fiche->lien_fiche);
                                        @endphp
                                        <li class="mb-2">
                                            <a href="storage/{{ $fiche->lien_fiche ? asset($filePath) : '#' }}"
                                                style="color: #697a8d; font-size: 0.9rem;">Télécharger la fiche de paie
                                                {{ $index + 1 }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <button
                                class="btn btn-link p-2 font-semibold text-gray-500 bg-white border border-gray-400 hover:text-indigo-500"
                                onclick="toggleVisibility(this)">Voir plus</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleVisibility(button) {
            const cardBody = button.closest('.card-body');
            const lists = cardBody.querySelectorAll('ul');
            lists.forEach(list => {
                list.classList.toggle('d-none');
            });
            const buttonText = button.textContent.trim();
            button.textContent = buttonText === 'Voir plus' ? 'Voir moins' : 'Voir plus';
        }
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchText = this.value.trim().toLowerCase();
                    console.log('Texte de recherche:', searchText);

                    // Filtrer les cartes visibles
                    const cards = document.querySelectorAll('.card');
                    cards.forEach(function(card) {
                        const cardText = card.textContent.toLowerCase();
                        if (cardText.includes(searchText)) {
                            card.style.display = 'block'; // Afficher la carte si elle correspond
                        } else {
                            card.style.display = 'none'; // Masquer la carte sinon
                        }
                    });
                });
            }
        });
    </script>

    <style>
        .card-body ul.d-none {
            display: none;
        }

        .card-body ul:not(.d-none) li {
            display: block;
        }
    </style>
@endsection --}}



@extends('pages.link')

@section('content')
    @if (request()->routeIs('dossiers_personnel.byEmployee'))
        <div class="container my-4">
            <header class="border-b border-gray-100 flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-500 mb-6">Dossiers du personnel</h2>
                <button
                    class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                    <a class="hover:text-white" href="{{ route('dossiers_personnel.byFolder') }}">Regrouper</a>
                </button>
            </header>

            <div class="row">
                @foreach ($users as $user)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm" style="background-color: #f8f9fa; border-color: #697a8d;">
                            <div class="card-header" style="background-color: #8d9bab; color: white;">
                                <h2 class="h5 mb-0 text-white">
                                    {{ $user->matricule }}_{{ $user->nom }}_{{ $user->prenom }}
                                </h2>
                            </div>
                            <div class="card-body">
                                <h3 class="h5 my-3 text-gray-500">Fichiers Personnels</h3>
                                <ul class="list-unstyled mb-4 d-none">
                                    @if ($user->comp_file)
                                        <li class="mb-2">
                                            <a href="storage/{{ $user->comp_file }}"
                                                style="color: #697a8d; font-size: 0.9rem;">Consulter le fichier de
                                                compétence</a>
                                        </li>
                                    @endif

                                    @if ($user->photo_file)
                                        <li class="mb-2">
                                            <a href="storage/{{ $user->photo_file }}"
                                                style="color: #697a8d; font-size: 0.9rem;">Consulter la photo</a>
                                        </li>
                                    @endif

                                    @if ($user->lien_contrat)
                                        <li class="mb-2">
                                            <a href="storage/{{ $user->lien_contrat }}"
                                                style="color: #697a8d; font-size: 0.9rem;">Consulter le contrat</a>
                                        </li>
                                    @endif
                                </ul>

                                @if ($user->demandeconges->filter(fn($demandeconge) => $demandeconge->justificatif)->isNotEmpty())
                                    <h3 class="h5 my-3 text-gray-500">Justificatifs de Congés</h3>
                                    <ul class="list-unstyled mb-4 d-none">
                                        @foreach ($user->demandeconges as $index => $demandeconge)
                                            @if ($demandeconge->justificatif)
                                                <li class="mb-2">
                                                    <a href="storage/{{ $demandeconge->justificatif }}"
                                                        style="color: #697a8d; font-size: 0.9rem;">Consulter le
                                                        justificatif
                                                        {{ $index + 1 }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($user->fichePaies->isNotEmpty())
                                    <h3 class="h5 my-3 text-gray-500">Fiches de Paie</h3>
                                    <ul class="list-unstyled mb-4 d-none">
                                        @foreach ($user->fichePaies as $index => $fiche)
                                            @php
                                                $filePath = str_replace('public/', '', $fiche->lien_fiche);
                                            @endphp
                                            <li class="mb-2">
                                                <a href="storage/{{ $fiche->lien_fiche ? asset($filePath) : '#' }}"
                                                    style="color: #697a8d; font-size: 0.9rem;">Consulter la fiche de paie
                                                    {{ $index + 1 }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <button
                                    class="btn btn-link p-2 font-semibold text-gray-500 bg-white border border-gray-400 hover:text-indigo-500"
                                    onclick="toggleVisibility(this)">Voir plus</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            function toggleVisibility(button) {
                const cardBody = button.closest('.card-body');
                const lists = cardBody.querySelectorAll('ul');
                lists.forEach(list => {
                    list.classList.toggle('d-none');
                });
                const buttonText = button.textContent.trim();
                button.textContent = buttonText === 'Voir plus' ? 'Voir moins' : 'Voir plus';
            }
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const searchText = this.value.trim().toLowerCase();
                        console.log('Texte de recherche:', searchText);

                        // Filtrer les cartes visibles
                        const cards = document.querySelectorAll('.card');
                        cards.forEach(function(card) {
                            const cardText = card.textContent.toLowerCase();
                            if (cardText.includes(searchText)) {
                                card.style.display = 'block'; // Afficher la carte si elle correspond
                            } else {
                                card.style.display = 'none'; // Masquer la carte sinon
                            }
                        });
                    });
                }
            });
        </script>

        <style>
            .card-body ul.d-none {
                display: none;
            }

            .card-body ul:not(.d-none) li {
                display: block;
            }
        </style>
    @else
        <div class="container my-4">
            <header class="border-b border-gray-100 flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-500 mb-6">Dossiers du personnel</h2>
                <button
                    class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                    <a class="hover:text-white" href="{{ route('dossiers_personnel.byEmployee') }}">Regrouper</a>
                </button>
            </header>

            <div class="row" id="fileContainer">
                @foreach ($filesGroupedByType as $type => $files)
                    <div class="col-12 mb-4 file-card">
                        <div class="card h-100 shadow-sm" style="background-color: #f8f9fa; border-color: #697a8d;">
                            <div class="card-header" style="background-color: #696cff; color: white;">
                                <h2 class="h5 mb-0 text-white">{{ ucfirst(str_replace('_', ' ', $type)) }}</h2>
                            </div>
                            <div class="card-body">
                                @foreach ($files as $index => $fileData)
                                    <div class="d-flex justify-content-between mb-2 file-item">
                                        <span class="text-#697a8d file-name" style="font-size: 1.1rem;">
                                            {{ $fileData['user']->matricule }}_{{ $fileData['user']->nom }}_{{ $fileData['user']->prenom }}_{{ ucfirst($type) }}
                                            {{ $index + 1 }}
                                        </span>
                                        @if ($type == 'fiches_de_paie')
                                            @php
                                                $filePath = str_replace('public/', '', $fileData['file']);
                                            @endphp
                                            <a href="storage/{{ $fileData['file'] ? asset($filePath) : '#' }}"
                                                class="text-#697a8d">
                                                Consulter
                                            </a>
                                        @else
                                            <a href="storage/{{ $fileData['file'] }}" target="_blank" class="text-#697a8d">
                                                Consulter
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const fileContainer = document.getElementById('fileContainer');

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const searchText = this.value.trim().toLowerCase();
                        const fileCards = fileContainer.querySelectorAll('.file-card');

                        fileCards.forEach(function(card) {
                            const fileNames = card.querySelectorAll('.file-name');
                            let cardVisible = false;

                            fileNames.forEach(function(fileName) {
                                if (fileName.textContent.toLowerCase().includes(searchText)) {
                                    cardVisible = true;
                                }
                            });

                            card.style.display = cardVisible ? 'block' : 'none';
                        });
                    });
                }
            });
        </script>

        <style>
            .card-header.bg-primary {
                background-color: #696cff !important;
            }

            .card-body .text-#697a8d {
                color: #697a8d !important;
                font-size: 1.1rem;
                margin-bottom: 8px;
            }

            .card-body a.text-#697a8d {
                color: #697a8d !important;
                font-size: 1.1rem;
                text-decoration: underline;
            }

            .file-card {
                border-radius: 8px;
                transition: transform 0.2s;
            }

            .file-card:hover {
                transform: scale(1.02);
            }

            .form-control {
                padding: 0.75rem 1rem;
                font-size: 1rem;
                border-radius: 0.5rem;
                border: 1px solid #697a8d;
            }

            .container {
                max-width: 1200px;
                margin: auto;
            }

            .card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            .card-body {
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            .d-flex {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        </style>
    @endif

@endsection
