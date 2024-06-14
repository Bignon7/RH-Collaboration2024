@extends('pages.link')
@section('content')
    <main class="container mx-auto px-6 py-8">
        @if (Auth::user()->role == 'Gestionnaire')
            <button
                class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block"><a
                    class="hover:text-white" href="{{ route('show_formation_form') }}">Ajouter une
                    formation</a></button>
        @endif



        <header class="border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-700 mb-6">Liste des Formations</h2>
            <form action="#" method="GET">
                <div class="flex items-center">
                    <div class="flex">
                        <input type="text" placeholder="Recherche..." name="search"
                            value="{{ request()->query('search') }}"
                            class="w-64 py-2 pl-3 pr-3 text-gray-700 bg-white border border-gray-300 rounded-l-lg focus:border-indigo-300 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 cursor-pointer" />
                        <button type="submit"
                            class="px-3 py-2 bg-indigo-500 text-white rounded-r-lg hover:bg-indigo-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer focus:outline-none">
                            <i class="fa fa-search"></i>
                        </button>

                    </div>
                </div>
            </form>
        </header>




        {{-- <h2 class="text-xl font-semibold text-gray-700 mb-6">Liste des Formations</h2> --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($formations as $formation)
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $formation->intitule_formation }}</h3>
                        <p class="text-gray-600 mb-4"><strong>Date de début:</strong> {{ $formation->date_debut_formation }}
                        </p>
                        <p class="text-gray-600 mb-4"><strong>Date de fin:</strong> {{ $formation->date_fin_formation }}</p>
                        <p class="text-gray-600 mb-4"><strong>Durée:</strong> {{ $formation->duree_formation }}</p>
                        <p class="text-gray-600 mb-4"><strong>Lieu:</strong> {{ $formation->lieu_formation }}</p>
                        <p class="text-gray-700 mb-4 description" data-full-text="{{ $formation->description_formation }}">
                            <strong>Description:</strong> {{ Str::limit($formation->description_formation, 100) }}
                        </p>
                    </div>
                    <button onclick="toggleDescription(this)"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-500 focus:ring-opacity-50 mt-4">
                        Voir plus
                    </button>
                </div>
            @endforeach
        </div>
    </main>


    <script>
        function toggleDescription(button) {
            const card = button.closest('.flex');
            const description = card.querySelector('.description');
            const fullText = description.getAttribute('data-full-text');
            const truncatedText = "{{ Str::limit('FULL_TEXT_PLACEHOLDER', 100) }}".replace('FULL_TEXT_PLACEHOLDER',
                fullText);

            if (button.textContent === "Voir plus") {
                description.innerHTML = "<strong>Description:</strong> " + fullText;
                button.textContent = "Voir moins";
            } else {
                description.innerHTML = "<strong>Description:</strong> " + truncatedText;
                button.textContent = "Voir plus";
            }
        }
    </script>
@endsection
