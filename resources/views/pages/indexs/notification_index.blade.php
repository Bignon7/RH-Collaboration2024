@extends('pages.link')

@section('content')
    <div class="container mx-auto">
        @if ($notifications->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucune notification trouvée</span>
            </div>
        @else
            <div class="flex justify-end mb-3 mt-3">
                <a href="{{ request()->routeIs('user_notification_index.unread') ? route('user_notification_index.read') : route('user_notification_index.unread') }}"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                    {{ request()->routeIs('user_notification_index.unread') ? 'Voir les notifications lues' : 'Voir les notifications non lues' }}
                </a>
            </div>
            <div class="mt-8">
                @foreach ($notifications as $notification)
                    <div class="bg-white rounded-md shadow-md p-4 mb-4 relative notification-item">
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
                                <div class="font-semibold text-lg">{{ $notification->title_notification }}</div>
                                <div class="text-gray-600">{{ $notification->contenu_notification }}</div>
                                @if ($notification->data)
                                    @php
                                        if (is_string($notification->data)) {
                                            $decodedData = json_decode($notification->data, true);
                                        } else {
                                            $decodedData = $notification->data;
                                        }
                                    @endphp

                                    @if (isset($decodedData['contrat']))
                                        <p class="text-gray-600 font-semibold">Lien vers le contrat : <a
                                                class="text-indigo-500 hover:text-indigo-600"
                                                href="storage/{{ $decodedData['contrat'] }}">Voir le contrat</a></p>
                                        {{-- @elseif (isset($decodedData['fiche']['lien_fiche']))
                                        <p class="text-gray-600 font-semibold">Lien vers la fiche : <a
                                                class="text-indigo-500 hover:text-indigo-600"
                                                href="storage/{{ $decodedData['fiche']['lien_fiche'] }}">Voir la fiche</a>
                                        </p>
                                    @endif --}}
                                    @elseif (isset($decodedData['fiche']))
                                        @php
                                            $filePath = str_replace('public/', '', $decodedData['fiche']);
                                        @endphp
                                        <p class="text-gray-600 font-semibold">Lien vers la fiche : <a
                                                class="text-indigo-500 hover:text-indigo-600"
                                                href="storage/{{ $decodedData['fiche'] ? asset($filePath) : '#' }}">Voir
                                                la
                                                fiche</a>
                                        </p>
                                    @endif
                                @endif

                                {{-- <div class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }} --}}
                                <div class="text-sm text-gray-500">{{ $notification->formattedDate }}
                                </div>
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
                                        @if ($notification->read_at == null)
                                            <a href="{{ route('user_notifications.markAsRead', $notification->id) }}"
                                                class="block px-4 py-2 text-base text-blue-500 hover:bg-gray-100 hover:text-blue-700"
                                                role="menuitem" id="options-menu-item-0"><i
                                                    class="fa-regular fa-envelope-open pe-3"></i>Lue</a>
                                        @endif
                                        @if ($notification->read_at !== null)
                                            <a href="{{ route('user_notifications.markAsUnread', $notification->id) }}"
                                                class="block px-4 py-2 text-base text-yellow-500 hover:bg-gray-100 hover:text-yellow-700"
                                                role="menuitem" id="options-menu-item-0"><i
                                                    class="fa-regular fa-envelope pe-3"></i>Non
                                                lue</a>
                                        @endif
                                        <a href="{{ route('user_notifications.destroy', $notification->id) }}"
                                            class="block px-4 py-2 text-base text-red-500 hover:bg-gray-100 hover:text-red-700"
                                            role="menuitem" id="options-menu-item-1"
                                            onclick="alert('Êtes-vous sûr de vouloir supprimer cette notification?');"><i
                                                class="fa-solid fa-trash pe-3"></i>Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ajoutez d'autres notifications de la même manière -->
                @endforeach
            </div>
        @endif
    </div>
    {{ $notifications->links() }} <br>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            if (searchInput) {
                console.log('Champ de recherche trouvé.');

                searchInput.addEventListener('input', function() {
                    const searchText = this.value.trim().toLowerCase();
                    console.log('Texte de recherche:', searchText);

                    // Filtrer les notifications visibles
                    const notifications = document.querySelectorAll('.notification-item');
                    notifications.forEach(function(notification) {
                        const notificationText = notification.textContent.toLowerCase();
                        if (notificationText.includes(searchText)) {
                            notification.style.display = 'block';
                        } else {
                            notification.style.display = 'none';
                        }
                    });
                });
            } else {
                console.log('Champ de recherche non trouvé.');
            }
        });
    </script>
@endsection
