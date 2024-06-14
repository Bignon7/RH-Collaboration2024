@extends('pages.link')
@section('content')
    {{-- <main>
        <div class="max-w-3xl mx-auto py-8">
            <div class="min-h-screen bg-gray-100">

                <!-- Page Content -->
                <main>
                    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($demandeconges as $demandeconge)
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-4">{{ $demandeconge->type_conge }}</h3>
                                    <h3 class="text-xl font-semibold mb-4">{{ $demandeconge->user->nom }}</h3>
                                    <p><strong>Date de début:</strong> {{ $demandeconge->date_debut_conge }}</p>
                                    <p><strong>Durée:</strong> {{ $demandeconge->duree_conge }} jours</p>
                                    <p><strong>Motif:</strong> {{ $demandeconge->motif_conge }}</p>
                                    <p><strong>Statut:</strong>
                                        <span
                                            class="inline-block px-2 py-1 text-white rounded-md
                                        @if ($demandeconge->statut_conge == 'Approuvée') bg-green-500
                                        @elseif($demandeconge->statut_conge == 'Rejetée') bg-yellow-500
                                        @else bg-red-500 @endif">
                                            {{ ucfirst($demandeconge->statut_conge) }}
                                        </span>
                                    </p>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </main>
            </div>
        </div>

    </main> --}}

    <main>
        <div class="container  mx-auto py-8">
            <div class="min-h-screen bg-gray-100">
                <!-- Page Content -->
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold mb-6">Liste des Demandes de Congés</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($demandeconges as $demandeconge)
                            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                                        {{ substr($demandeconge->user->nom, 0, 1) }}
                                    </div>
                                    <h3 class="text-xl font-semibold">{{ $demandeconge->user->nom }}</h3>
                                </div>
                                <h4 class="text-lg font-medium text-gray-700 mb-2">{{ $demandeconge->type_conge }}</h4>
                                <p class="text-gray-600 mb-2"><strong>Date de début:</strong>
                                    {{ $demandeconge->date_debut_conge }}</p>
                                <p class="text-gray-600 mb-2"><strong>Durée:</strong> {{ $demandeconge->duree_conge }}
                                    jours</p>
                                <p class="text-gray-600 mb-2"><strong>Motif:</strong> {{ $demandeconge->motif_conge }}</p>
                                <p class="text-gray-600"><strong>Statut:</strong>
                                    <span
                                        class="inline-block px-2 py-1 text-white rounded-md
                                    @if ($demandeconge->statut_conge == 'Approuvée') bg-green-500
                                    @elseif($demandeconge->statut_conge == 'Rejetée') bg-red-500
                                    @else bg-yellow-500 @endif">
                                        {{ $demandeconge->statut_conge ? ucfirst($demandeconge->statut_conge) : 'En cours' }}
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
