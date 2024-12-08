@extends('pages.link')

@section('content')
    <section class="container bg-gray-100 text-gray-600 py-5 px-4">
        <div class="flex flex-col justify-center h-full">
            @if ($users->isEmpty())
                <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                    <strong class="font-bold">Aucun élément trouvé.</strong>
                    <span class="block sm:inline">Aucun utilisateur trouvé</span>
                </div>
            @else
                <!-- Table -->
                <div class="w-full max-w-full mx-auto bg-white shadow-md rounded-md">
                    <header class="px-4 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="text-xl font-medium text-gray-500">Liste des Employés inscrits à
                            {{ $formation->intitule_formation }}</h2>
                        <div>
                            <a href="#"
                                class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                {{ $users->total() }} inscrit{{ $users->total() != 1 ? 's' : '' }}
                            </a>
                        </div>
                    </header>

                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-sm font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Photo</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Matricule</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Nom</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Prénom</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Email</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-base divide-y divide-gray-100">
                                    @foreach ($users as $user)
                                        <tr class="user-row">
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-12 h-12 flex-shrink-0 mr-2 sm:mr-3">
                                                        <img class="rounded-full" src="storage/{{ $user->photo_file }}"
                                                            width="48" height="48"
                                                            alt="Photo de {{ $user->nom }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->matricule }}</div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->nom }}</div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->prenom }}</div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->email }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </section>

    {{ $users->links() }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

                // Filtrer les lignes du tableau des utilisateurs
                const userRows = document.querySelectorAll('.user-row');
                userRows.forEach(function(row) {
                    const rowData = row.textContent.toLowerCase();
                    if (rowData.includes(searchText)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
