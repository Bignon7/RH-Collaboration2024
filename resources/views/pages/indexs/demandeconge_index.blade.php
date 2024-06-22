@extends('pages.link')
@section('content')
    <main>
        <div class="container mx-auto py-8">
            <div class="min-h-screen bg-gray-100">
                @if ($demandeconges->isEmpty())
                    <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                        <strong class="font-bold">Aucun élément trouvé.</strong>
                        <span class="block sm:inline">Aucune demande de congés ne correspond à cette recherche</span>
                    </div>
                @else
                    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-bold mb-6">Liste des Demandes de Congés</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="demandecongesGrid">
                            @foreach ($demandeconges as $demandeconge)
                                <div
                                    class="demandeconge-card bg-white p-6 rounded-lg shadow-lg hover:shadow-xl overflow-hidden transition-shadow duration-300 relative">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4"
                                            style="background-color: {{ $demandeconge->getRandomColor() }}">
                                            {{ substr($demandeconge->user->nom, 0, 1) }}
                                        </div>
                                        <h3 class="text-xl font-semibold">
                                            {{ $demandeconge->user->prenom . ' ' . $demandeconge->user->nom }}</h3>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-700 mb-2">{{ $demandeconge->type_conge }}</h4>
                                    <p class="text-gray-600 mb-2"><strong>Date de début:</strong>
                                        {{ $demandeconge->date_debut_conge }}</p>
                                    <p class="text-gray-600 mb-2"><strong>Durée:</strong> {{ $demandeconge->duree_conge }}
                                    </p>
                                    <p class="text-gray-600 mb-2"><strong>Motif:</strong> {{ $demandeconge->motif_conge }}
                                    </p>
                                    @if (!$demandeconge->statut_conge && Auth::user()->role != 'Employé' && Auth::user()->id != $demandeconge->user->id)
                                        <p class="text-gray-600 mb-4">
                                            <strong>Acceptable:</strong>
                                            <span
                                                class="inline-block px-2 py-1 rounded-md {{ $demandeconge->isAcceptable() ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ $demandeconge->isAcceptable() ? 'Oui' : 'Non' }}
                                            </span>
                                        </p>
                                    @endif
                                    @if ($demandeconge->statut_conge || Auth::user()->id == $demandeconge->user->id)
                                        <p class="text-gray-600 mb-4">
                                            <strong>Statut:</strong>
                                            <span
                                                class="inline-block px-2 py-1 text-white rounded-md
                                            @if ($demandeconge->statut_conge == 'Approuvée') bg-green-500
                                            @elseif($demandeconge->statut_conge == 'Rejetée') bg-red-500
                                            @else bg-yellow-500 @endif">
                                                {{ $demandeconge->statut_conge ? ucfirst($demandeconge->statut_conge) : 'En cours' }}
                                            </span>
                                        </p>
                                    @endif

                                    @if (!$demandeconge->statut_conge && Auth::user()->role != 'Employé' && Auth::user()->id != $demandeconge->user->id)
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4"
                                            onclick="toggleResponseForm({{ $demandeconge->id }})">Répondre</button>

                                        <div id="response-form-{{ $demandeconge->id }}" class="hidden">
                                            <form action="{{ route('demandes.repondre', $demandeconge->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="justification-{{ $demandeconge->id }}"
                                                        class="block text-gray-700 font-medium mb-2">Justification</label>
                                                    <textarea name="justification" id="justification-{{ $demandeconge->id }}" rows="3"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                        required></textarea>
                                                </div>
                                                <div class="flex justify-between">
                                                    <button type="submit" name="action" value="Approuvée"
                                                        class="bg-green-500 text-white px-4 py-2 rounded-md">Accepter</button>
                                                    <button type="submit" name="action" value="Rejetée"
                                                        class="bg-red-500 text-white px-4 py-2 rounded-md">Refuser</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif

                                    @if (!$demandeconge->statut_conge && Auth::user()->id == $demandeconge->user->id)
                                        <div class="absolute top-4 right-4 flex space-x-2">
                                            <a href="{{ route('edit_created_demandeconge', $demandeconge) }}"
                                                class="text-yellow-500">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('delete_created_demandeconge', $demandeconge) }}"
                                                class="text-red-500"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            {{ $demandeconges->links() }}
        </div>
    </main>

    <script>
        function toggleResponseForm(id) {
            var form = document.getElementById('response-form-' + id);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const demandecongesGrid = document.getElementById('demandecongesGrid');

            if (searchInput && demandecongesGrid) { // Vérifier que les éléments existent
                searchInput.addEventListener('input', function() {
                    const searchText = this.value.trim().toLowerCase();

                    // Filtrer les cartes des demandes de congés
                    const demandecongeCards = demandecongesGrid.querySelectorAll('.demandeconge-card');
                    demandecongeCards.forEach(function(card) {
                        const cardTitleElem = card.querySelector('.text-xl');
                        const cardUserElem = card.querySelector('h3');
                        const cardTypeElem = card.querySelector('.text-lg');
                        const cardDateElem = card.querySelector('.text-gray-600:nth-of-type(1)');
                        const cardDureeElem = card.querySelector('.text-gray-600:nth-of-type(2)');
                        const cardMotifElem = card.querySelector('.text-gray-600:nth-of-type(3)');
                        const cardStatutElem = card.querySelector('.inline-block');

                        // Vérifier si les éléments existent avant d'accéder à textContent
                        const cardTitle = cardTitleElem ? cardTitleElem.textContent.toLowerCase() :
                            '';
                        const cardUser = cardUserElem ? cardUserElem.textContent.toLowerCase() :
                            '';
                        const cardType = cardTypeElem ? cardTypeElem.textContent.toLowerCase() : '';
                        const cardDate = cardDateElem ? cardDateElem.textContent.toLowerCase() : '';
                        const cardDuree = cardDureeElem ? cardDureeElem.textContent.toLowerCase() :
                            '';
                        const cardMotif = cardMotifElem ? cardMotifElem.textContent.toLowerCase() :
                            '';
                        const cardStatut = cardStatutElem ? cardStatutElem.textContent
                            .toLowerCase() : '';

                        // Vérifier si le texte de recherche est présent dans le titre, le type, la date, la durée, le motif ou le statut
                        if (cardUser.includes(searchText) || cardTitle.includes(searchText) ||
                            cardType.includes(searchText) ||
                            cardDate.includes(searchText) || cardDuree.includes(searchText) ||
                            cardMotif.includes(searchText) || cardStatut.includes(searchText)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
@endsection
