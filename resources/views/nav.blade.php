<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <!-- Dropdown avec icône de trois points alignés verticalement -->

            <div class="ml-auto mr-4 relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center justify-center p-1 rounded-md text-gray-500 focus:outline-none focus:text-indigo-500"
                    id="options-menu" aria-haspopup="true">
                    <!-- Icone de trois points -->
                    <i class="fa-regular fa-bell text-2xl position-relative"></i>
                    <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
                        5+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute z-10 right-0 mt-2 w-80 sm:w-96 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <!-- En-tête de la liste des notifications -->
                        <div class="px-4 py-2 flex items-center justify-between font-semibold text-gray-500 text-lg">
                            <span>Liste des notifications</span>
                            <i class="fa-regular fa-envelope-open"></i>
                        </div>
                        <hr class="border-3 border-gray-700">

                        <!-- Notifications -->
                        <div class="px-4 py-2 flex items-center text-sm">
                            <!-- Icone avec fond de couleur aléatoire -->
                            <div class="h-10 w-10 rounded-full flex items-center justify-center"
                                style="background-color: #{{ dechex(rand(0x000000, 0xffffff)) }}">
                                <!-- Icone de personne -->
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 2c3.866 0 7 3.134 7 7 0 3.866-3.134 7-7 7-3.866 0-7-3.134-7-7 0-3.866 3.134-7 7-7zM12 14c2.33 0 4.336-.97 5.802-2.524C17.381 10.23 14.76 9 12 9c-2.76 0-5.381 1.23-6.802 2.476C7.664 13.03 9.67 14 12 14zM2 20v2h20v-2">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="font-semibold text-base">Notification Title 1</div>
                                <div class="text-gray-600">Notification message goes here...</div>
                                <div class="text-sm text-gray-500">3 hours ago</div>
                            </div>
                        </div>
                        <hr class="border-3 border-gray-700">
                        <div class="px-4 py-2 flex items-center text-sm">
                            <!-- Icone avec fond de couleur aléatoire -->
                            <div class="h-10 w-10 rounded-full flex items-center justify-center"
                                style="background-color: #{{ dechex(rand(0x000000, 0xffffff)) }}">
                                <!-- Icone de personne -->
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 2c3.866 0 7 3.134 7 7 0 3.866-3.134 7-7 7-3.866 0-7-3.134-7-7 0-3.866 3.134-7 7-7zM12 14c2.33 0 4.336-.97 5.802-2.524C17.381 10.23 14.76 9 12 9c-2.76 0-5.381 1.23-6.802 2.476C7.664 13.03 9.67 14 12 14zM2 20v2h20v-2">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="font-semibold text-base">Notification Title 2</div>
                                <div class="text-gray-600">Notification message goes here...</div>
                                <div class="text-sm text-gray-500">2 hours ago</div>
                            </div>
                        </div>
                        <hr class="border-3 border-gray-700">
                        {{-- <hr class="border-gray-700 "> --}}
                        <div class="px-4 py-2 flex items-center text-sm">
                            <!-- Icone avec fond de couleur aléatoire -->
                            <div class="h-10 w-10 rounded-full flex items-center justify-center"
                                style="background-color: #{{ dechex(rand(0x000000, 0xffffff)) }}">
                                <!-- Icone de personne -->
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 2c3.866 0 7 3.134 7 7 0 3.866-3.134 7-7 7-3.866 0-7-3.134-7-7 0-3.866 3.134-7 7-7zM12 14c2.33 0 4.336-.97 5.802-2.524C17.381 10.23 14.76 9 12 9c-2.76 0-5.381 1.23-6.802 2.476C7.664 13.03 9.67 14 12 14zM2 20v2h20v-2">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="font-semibold text-base">Notification Title 3</div>
                                <div class="text-gray-600">Notification message goes here...</div>
                                <div class="text-sm text-gray-500">1 hour ago</div>
                            </div>
                        </div>
                        <hr class="border-3 border-gray-700">

                        <!-- Centré le bouton à la fin avec animation au survol -->
                        <div class="flex justify-center mt-3 mb-2">
                            <button
                                class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                <a class="hover:text-white" href="{{ route('user_notification_index') }}">Voir la liste
                                    des
                                    notifications</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="storage/{{ Auth::user()->photo_file }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="storage/{{ Auth::user()->photo_file }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span
                                        class="fw-semibold d-block">{{ Auth::user()->prenom . ' ' . Auth::user()->nom }}</span>
                                    <small class="text-muted">{{ Auth::user()->role }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('edit_created_user', ['user' => Auth::user()]) }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Modifier mon profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('user_reset_password') }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Mot de passe</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Se déconnecter</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
