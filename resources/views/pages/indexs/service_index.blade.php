@extends('pages.link')
@section('content')
    <main class="font-sans antialiased min-h-screen bg-gray-100 ">
        @if ($services->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucun service trouvé</span>
            </div>
        @else
            <div class="max-w-5xl mx-auto py-8 ">
                <h1 class="text-2xl font-semibold mb-6">Liste des Services</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 ">
                    @foreach ($services as $service)
                        <div class="bg-white shadow-lg rounded-lg p-6 relative service-card-container">
                            @if (Auth::user()->role == 'Admin')
                                <div class="absolute top-2 right-2 flex space-x-2">
                                    <a href="{{ route('edit_created_service', $service->id) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fa fa-edit"></i> Éditer
                                    </a>
                                    <a href="{{ route('delete_created_service', $service->id) }}"
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </a>

                                </div>
                            @endif
                            <h2 class="text-xl font-bold mb-2">{{ $service->nom_service }}</h2>
                            <p class="text-gray-700 mb-4"><strong>Chef de service:</strong>
                                {{ $service->chef_service }}
                            </p>
                            <p class="text-gray-700 mb-4"><strong>Effectif:</strong>
                                {{ $service->effectif_service }}
                            </p>
                            <p class="text-gray-700 mb-4 description" data-full-text="{{ $service->detail_service }}">
                                <strong>Détails:</strong> {{ Str::limit($service->detail_service, 50) }}
                            </p>
                            <button onclick="toggleDetails(this)"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                Voir plus
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        {{ $services->links() }}
    </main>

    <script>
        function toggleDetails(button) {
            const card = button.closest('.bg-white');
            const description = card.querySelector('.description');
            const fullText = description.getAttribute('data-full-text');
            const truncatedText = fullText.slice(0, 50) + '...';

            if (button.textContent === "Voir plus") {
                description.innerHTML = '<strong>Détails:</strong> ' + fullText;
                button.textContent = "Voir moins";
            } else {
                description.innerHTML = '<strong>Détails:</strong> ' + truncatedText;
                button.textContent = "Voir plus";
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

                // Filtrer les cartes des services
                const serviceCards = document.querySelectorAll('.shadow-lg');

                serviceCards.forEach(function(card) {
                    // Utilisez closest pour trouver la carte parente la plus proche
                    const cardContainer = card.closest('.service-card-container');

                    if (cardContainer) {
                        const cardTextElements = cardContainer.querySelectorAll(
                            '.text-xl, .text-gray-700, .description');
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
                    }
                });
            });
        });
    </script>
@endsection
