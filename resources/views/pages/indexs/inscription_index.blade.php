@extends('pages.link')
@section('content')
    <main class="container mx-auto px-6 py-8">
        @if ($inscriptions->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucune inscription ne correspond à cette recherche</span>
            </div>
        @else
            <header class="border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-600 mb-6">Mes Inscriptions</h2>
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($inscriptions as $inscription)
                    @php
                        $formation = $inscription->formation;
                        $formationCommencee = now()->gte($formation->date_debut_formation);
                    @endphp
                    <div
                        class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between relative hover:-translate-y-3 transition duration-300">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2"> <strong>Formation:</strong>
                                {{ $formation->intitule_formation }}</h3>
                            <p class="text-gray-500 mb-2"><strong>Date de début:</strong>
                                {{ $formation->date_debut_formation }}
                            </p>
                            <p class="text-gray-500 mb-2"><strong>Date d'inscription:</strong>
                                {{ $inscription->date_inscription }}</p>
                        </div>

                        @if (!$formationCommencee)
                            <form action="{{ route('quitter_formation', $formation->id) }}" method="get" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-500 focus:ring-opacity-50">
                                    Quitter la formation
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        {{ $inscriptions->links() }}
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

                // Filtrer les cartes des inscriptions
                const inscriptionCards = document.querySelectorAll('.bg-white.shadow-md.rounded-lg.p-6');
                inscriptionCards.forEach(function(card) {
                    const cardTitle = card.querySelector('.text-lg').textContent.toLowerCase();
                    const cardFormationDate = card.querySelector('.text-gray-500:nth-of-type(1)')
                        .textContent.toLowerCase();
                    const cardInscriptionDate = card.querySelector('.text-gray-500:nth-of-type(2)')
                        .textContent.toLowerCase();

                    // Concaténer tous les textes des éléments sélectionnés dans une seule chaîne
                    let cardText = cardTitle + ' ' + cardFormationDate + ' ' + cardInscriptionDate;

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


<style>
    .card {
        background: linear-gradient(135deg, #f8fafc, #e8ecef);
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        font-size: 1.25rem;
        color: #333;
    }

    .card-content {
        color: #555;
    }

    .card-button {
        background-color: #ff6b6b;
        color: white;
        transition: background-color 0.2s;
    }

    .card-button:hover {
        background-color: #ff4b4b;
    }
</style>
