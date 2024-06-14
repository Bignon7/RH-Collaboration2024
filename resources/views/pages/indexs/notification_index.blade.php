@extends('pages.link')
@section('content')
    {{-- @foreach ($notifications as $notification) --}}
    <div class="container mx-auto">
        <div class="mt-8">
            <div class="bg-white rounded-md shadow-md p-4 mb-4 relative">
                <div class="flex items-center">
                    <!-- Icone avec fond de couleur aléatoire -->
                    <div class="h-10 w-10 rounded-full flex items-center justify-center"
                        style="background-color: #{{ dechex(rand(0x000000, 0xffffff)) }}">
                        <!-- Icone de personne -->
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2c3.866 0 7 3.134 7 7 0 3.866-3.134 7-7 7-3.866 0-7-3.134-7-7 0-3.866 3.134-7 7-7zM12 14c2.33 0 4.336-.97 5.802-2.524C17.381 10.23 14.76 9 12 9c-2.76 0-5.381 1.23-6.802 2.476C7.664 13.03 9.67 14 12 14zM2 20v2h20v-2">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-grow">
                        <div class="font-semibold text-lg">Notification Title</div>
                        <div class="text-gray-600">Notification message goes here...</div>
                        <div class="text-sm text-gray-500">3 hours ago</div>
                    </div>
                    <!-- Dropdown avec icône de trois points alignés verticalement -->
                    <div class="ml-auto relative" x-data="{ open: false }">
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
                                <a href="#"
                                    class="block px-4 py-2 text-base text-gray-500 hover:bg-gray-100 hover:text-gray-500"
                                    role="menuitem" id="options-menu-item-0"><i class="fa fa-check pe-3"></i>Marquer comme
                                    lu</a>
                                <a href="#"
                                    class="block px-4 py-2 text-base text-gray-500 hover:bg-gray-100 hover:text-gray-500"
                                    role="menuitem" id="options-menu-item-1"><i class="fas fa-edit pe-3"></i>Supprimer</a>
                                <a href="#"
                                    class="block px-4 py-2 text-base text-gray-500 hover:bg-gray-100 hover:text-gray-500"
                                    role="menuitem" id="options-menu-item-2"><i class="fas fa-edit pe-3"></i>Ignorer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajoutez d'autres notifications de la même manière -->
        </div>
    </div>
    {{-- @endforeach --}}
@endsection
