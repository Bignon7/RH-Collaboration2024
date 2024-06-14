<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@extends('pages.link')
@section('content')
    <section class="container bg-gray-100 text-gray-600 py-5 px-4">
        <div class="flex flex-col justify-center h-full">
            <!-- Table -->
            <div class="w-full max-w-full mx-auto bg-white shadow-md rounded-md ">
                <header class="px-4 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xl font-medium text-gray-500">Liste des Employés</h2>
                    <form action="#" method="GET">
                        <div class="flex items-center">
                            <div class="flex">
                                <input type="text" placeholder="Recherche..." name="search"
                                    value="{{ request()->query('search') }}"
                                    class="w-64 py-2 pl-3 pr-3 text-gray-700 bg-white border border-gray-300 rounded-l-lg focus:border-indigo-300 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 cursor-pointer" />
                                <button type="submit"
                                    class="px-3 py-2 bg-indigo-500 text-white rounded-r-lg hover:bg-indigo-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer focus:outline-none">
                                    <i class="fa fa-search"></i>
                                </button>

                            </div>
                        </div>
                    </form>
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
                                        <div class="font-semibold text-center">Pointage</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-base divide-y divide-gray-100">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="p-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-12 h-12 flex-shrink-0 mr-2 sm:mr-3">
                                                    <img class="rounded-full" src="storage/{{ $user->photo_file }}"
                                                        width="48" height="48" alt="Photo de {{ $user->nom }}">
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
                                            <div class="flex space-x-2 justify-center">
                                                <button
                                                    class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-md font-semibold text-xs uppercase tracking-widest  transition  duration-300 hover:bg-indigo-600 "><a
                                                        style="color:white" href="#">Arrivée</a></button>
                                                <button
                                                    class="inline-flex items-center px-4 py-2 border border-gray-500 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-500  transition  duration-300 hover:bg-gray-500 hover:text-white "><a
                                                        href="#">Départ</a></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ $users->links() }}
@endsection
