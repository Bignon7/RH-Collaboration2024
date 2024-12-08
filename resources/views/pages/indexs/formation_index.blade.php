@extends('pages.link')
@section('content')
    <main class="container mx-auto px-6 py-8">
        @if (Auth::user()->role != 'Employé')
            <button
                class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                <a class="hover:text-white" href="{{ route('show_formation_form') }}">Ajouter une formation</a>
            </button>
        @endif
        @if ($formations->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucune formation ne correspond à cette recherche</span>
            </div>
        @else
            <header class="border-b border-gray-100 flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-6">Liste des Formations</h2>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($formations as $formation)
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between relative formation-card">
                        @if ($formation->formationCommencee)
                            <span class="absolute top-2 right-2 bg-gray-300 text-gray-700 px-2 py-1 rounded-lg">Déjà
                                commencé</span>
                        @endif
                        @if (!$formation->formationCommencee)
                            @if (Auth::user()->role != 'Employé')
                                <div class="absolute top-2 right-2" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center justify-center p-2 rounded-md text-gray-500 focus:outline-none focus:text-indigo-500"
                                        id="options-menu" aria-haspopup="true">
                                        <!-- Icone de trois points -->
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 9a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.away="open = false" x-cloak
                                        class="absolute z-10 right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                        <div class="py-1" role="none">
                                            <!-- Options -->
                                            <a href="{{ route('edit_created_formation', $formation->id) }}"
                                                class="block px-4 py-2 text-base text-blue-500 hover:text-blue-700 hover:bg-gray-100 "
                                                role="menuitem" id="options-menu-item-0"><i class="fa fa-edit mr-1"></i>
                                                Éditer</a>
                                            <a href="{{ route('delete_created_formation', $formation->id) }}"
                                                class="block px-4 py-2 text-base text-red-500 hover:text-red-700 hover:bg-gray-100 "
                                                role="menuitem" id="options-menu-item-1"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');"><i
                                                    class="fa fa-trash mr-1"></i> Supprimer</a>
                                            <a href="{{ route('formation.inscrits', $formation->id) }}"
                                                class="block px-4 py-2 text-base text-green-500 hover:text-green-700  hover:bg-gray-100 "
                                                role="menuitem" id="options-menu-item-2"><i class="fa fa-users mr-1"></i>
                                                Liste
                                                des
                                                inscrits</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $formation->intitule_formation }}</h3>
                            <p class="text-gray-600 mb-4"><strong>Date de début:</strong>
                                {{ $formation->date_debut_formation }}</p>
                            <p class="text-gray-600 mb-4"><strong>Date de fin:</strong> {{ $formation->date_fin_formation }}
                            </p>
                            <p class="text-gray-600 mb-4"><strong>Durée:</strong> {{ $formation->duree_formation }}</p>
                            <p class="text-gray-600 mb-4"><strong>Lieu:</strong> {{ $formation->lieu_formation }}</p>
                            <p class="text-gray-700 mb-4 description"
                                data-full-text="{{ $formation->description_formation }}">
                                <strong>Description:</strong> {{ Str::limit($formation->description_formation, 100) }}
                            </p>
                        </div>

                        <div class="mt-2">
                            @php
                                $inscription = $formation->users->contains(Auth::user()->id);
                                $formationCommencee = now()->gte($formation->date_debut_formation);
                            @endphp

                            @if (!$formationCommencee)
                                <div class="flex items-center justify-start gap-2">
                                    @if (!$inscription)
                                        <form action="{{ route('inscrire_formation', $formation->id) }}" method="POST"
                                            class="flex-grow">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                                S'inscrire
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('quitter_formation', $formation->id) }}" method="GET"
                                            class="flex-grow">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50">
                                                Quitter
                                            </button>
                                        </form>
                                    @endif

                                    <button onclick="toggleDetails(this)"
                                        class="w-full bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                        Voir plus
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        {{ $formations->links() }}
    </main>

    <script>
        function toggleDetails(button) {
            const card = button.closest('.bg-white');
            const description = card.querySelector('.description');
            const fullText = description.getAttribute('data-full-text');
            const truncatedText = fullText.slice(0, 100) + '...';

            if (button.textContent === "Voir plus") {
                description.innerHTML = '<strong>Description:</strong> ' + fullText;
                button.textContent = "Voir moins";
            } else {
                description.innerHTML = '<strong>Description:</strong> ' + truncatedText;
                button.textContent = "Voir plus";
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

                // Filtrer les cartes des formations
                const formationCards = document.querySelectorAll('.formation-card');
                formationCards.forEach(function(card) {
                    const cardTextElements = card.querySelectorAll(
                        '.text-lg, .text-gray-600, .text-gray-700, .description');
                    let cardText = '';

                    // Concaténer tous les textes des éléments sélectionnés dans une seule chaîne
                    cardTextElements.forEach(function(element) {
                        cardText += element.textContent.toLowerCase() + ' ';
                    });

                    // Vérifier si le texte de recherche est présent dans la carte
                    if (cardText.includes(searchText)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
