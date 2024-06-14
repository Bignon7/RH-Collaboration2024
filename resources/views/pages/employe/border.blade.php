<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Employé | Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="storage/img/logo_nbg.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('pages.employe.side')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('nav')
                <!-- / Navbar -->


                <!--  Badge -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-12 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end">
                                    <div class="col-sm-6 col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Bienvenue {{ Auth::user()->prenom }} !🎉
                                            </h5>
                                            <p class="mb-4">
                                                Heureux de vous revoir
                                            </p>

                                            {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                                                Badges</a> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-right">
                                        <div class="card-body pb-0 px-0 px-md-4 sm">
                                            <img src="assets/img/illustrations/man-with-laptop-light.png"
                                                style="height: 140px" alt="View Badge User"
                                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Badge -->


                <!-- Profile -->
                <div class="container mt-5 mb-5">
                    <div class="card profile-card">
                        <div class="card-header text-center mb-5"
                            style="background-color: #696cff;
                        color: white;">
                            <h2 class="text-white text-base">Mon profile</h2>
                        </div>
                        <div class="card-body text-center">
                            <div class="profile-img-container mb-3"
                                style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img src="storage/{{ Auth::user()->photo_file }}" alt="User Photo"
                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center; ">
                            </div>
                            <h3>{{ Auth::user()->prenom . ' ' . Auth::user()->nom }}</h3>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <p>Téléphone: {{ Auth::user()->phone }}</p>
                            <p>Adresse: {{ Auth::user()->adresse }}</p>
                        </div>
                        <hr>
                        <div class="card-body">
                            <h4>Informations Personnelles</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Matricule:</strong> {{ Auth::user()->matricule }}</p>
                                    <p><strong>Nom:</strong> {{ Auth::user()->nom }}</p>
                                    <p><strong>Prénom:</strong> {{ Auth::user()->prenom }}</p>
                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                    <p><strong>Téléphone:</strong> {{ Auth::user()->phone }}</p>
                                    <p><strong>Adresse:</strong> {{ Auth::user()->adresse }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            <h4>Informations Administratives</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Date d'embauche:</strong> {{ Auth::user()->hire_date }}</p>
                                    <p><strong>Poste:</strong> {{ Auth::user()->poste }}</p>
                                    <p><strong>Service:</strong> {{ Auth::user()->service }}</p>
                                    @if (Auth::user()->comp_file)
                                        <p><strong>Fichier de compétences:</strong> <a
                                                href="storage/{{ Auth::user()->comp_file }}"
                                                class="text-indigo-500">Télécharger</a></p>
                                    @endif
                                    @if (Auth::user()->salaire)
                                        <p><strong>Salaire:</strong> {{ Auth::user()->salaire }}an</p>
                                    @endif
                                    @if (Auth::user()->contrat)
                                        <p><strong>Contrat:</strong> <a href="storage/{{ Auth::user()->contrat }}"
                                                class="text-indigo-500">Voir le
                                                contrat</a></p>
                                    @endif
                                    @if (Auth::user()->duree_contrat)
                                        <p><strong>Durée du contrat:</strong> {{ Auth::user()->duree_contrat }}</p>
                                    @endif
                                    @if (Auth::user()->conges_total)
                                        <p><strong>Congés totaux:</strong> {{ Auth::user()->conges_total }} jours</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="card-body text-right block">
                            <button
                                class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block"><a
                                    class="hover:text-white"
                                    href="{{ route('edit_created_user', Auth::user()) }}">Modifier son
                                    profil
                                </a></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
