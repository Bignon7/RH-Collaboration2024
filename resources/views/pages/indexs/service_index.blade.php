@extends('pages.link')
@section('content')
    <main class="font-sans antialiased min-h-screen bg-gray-100 ">
        <div class="max-w-5xl mx-auto py-8">
            <h1 class="text-2xl font-semibold mb-6">Liste des Services</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($services as $service)
                    <div class="bg-white shadow-lg rounded-lg p-6">
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
    </script>
@endsection
