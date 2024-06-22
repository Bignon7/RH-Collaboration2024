<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@extends('pages.link')
@section('content')
    <section class="container bg-gray-100 text-gray-600 py-5 px-4">
        @if ($users->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucun utilisateur trouvé</span>
            </div>
        @else
            <div class="flex flex-col justify-center h-full">
                <!-- Table -->
                <div class="w-full max-w-full mx-auto bg-white shadow-md rounded-md ">
                    <header class="px-4 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="text-xl font-medium text-gray-500">
                            @if (request()->routeIs('admin.index_created_manager'))
                                Liste des Managers
                            @else
                                Liste des Employés
                            @endif
                        </h2>
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
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Date d'embauche</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Poste</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Service</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Téléphone</div>
                                        </th>
                                        <th class="p-3 whitespace-nowrap">
                                            <div class="font-semibold text-left">Adresse</div>
                                        </th>
                                        @if (!request()->routeIs('admin.index_created_manager'))
                                            <th class="p-3 whitespace-nowrap">
                                                <div class="font-semibold text-center">Actions</div>
                                            </th>
                                        @endif
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
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">
                                                    {{ (new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE))->format(new DateTime($user->hire_date)) }}
                                                </div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->poste }}</div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->service }}</div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->phone }}</div>
                                            </td>
                                            <td class="p-3 whitespace-nowrap">
                                                <div class="text-left">{{ $user->adresse }}</div>
                                            </td>
                                            @if (!request()->routeIs('admin.index_created_manager'))
                                                <td class="p-3 whitespace-nowrap">
                                                    <div class="flex space-x-2 justify-center">
                                                        <a href="{{ route('show_created_user', ['user' => $user, 'id' => $user->id]) }}"
                                                            class="text-blue-500 px-1 hover:text-blue-700">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('edit_created_user', ['user' => $user, 'id' => $user->id]) }}"
                                                            class="text-yellow-500 px-1 hover:text-yellow-700">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('delete_created_user', ['user' => $user, 'id' => $user->id]) }}"
                                                            class="text-red-500 px-1 hover:text-red-700"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
