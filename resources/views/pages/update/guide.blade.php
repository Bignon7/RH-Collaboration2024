{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin | Dashboard</title>

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

        .icon {
            font-size: 1.5rem;
            /* Agrandir les icônes */
            padding: 0.5rem 0.75rem;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        .guide-container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .guide-header {
            background-color: #696cff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
        }

        .guide-section {
            margin-bottom: 30px;
        }

        .guide-section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #696cff;
            margin-bottom: 10px;
        }

        .guide-content {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .guide-step {
            margin-bottom: 20px;
        }

        .guide-step-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .guide-step-content {
            color: #555;
            margin-bottom: 10px;
        }

        .guide-screenshot {
            margin-bottom: 20px;
        }

        .guide-screenshot img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>

</head>

<body class="font-sans antialiased">
    <div class="container-fluid" style="background-color: #f8f9fa;">
        <div class="row">

            <!-- Contenu principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="guide-container">
                    <div class="guide-header">
                        <h1>Guide Utilisateur - StaffNest</h1>
                    </div>

                    <!-- Contenu du guide en fonction du rôle -->
                    @if (Auth::user()->role === 'Admin')
                        <div class="card mb-3" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title">Guide pour les administrateurs</h5>
                                <p class="card-text">Contenu spécifique aux administrateurs...</p>
                            </div>
                        </div>
                        <div class="guide-section">
                            <div class="guide-section-title">Section pour l'Administrateur</div>
                            <div class="guide-content">
                                <div class="guide-step">
                                    <div class="guide-step-title">Gestion des Gestionnaires</div>
                                    <div class="guide-step-content">
                                        Instructions détaillées sur la gestion des gestionnaires, y compris
                                        l'enregistrement et la liste des gestionnaires.
                                    </div>
                                </div>
                                <!-- Ajoutez d'autres étapes spécifiques à l'Admin selon vos fonctionnalités -->
                                <!-- Section: Gestion des Services -->
                                <div class="guide-section">
                                    <h3>Gestion des Services</h3>
                                    <p>
                                        Ajouter, voir et gérer les services disponibles dans l'application.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion des Services">
                                </div>

                                <!-- Section: Gestion des Gestionnaires -->
                                <div class="guide-section">
                                    <h3>Gestion des Gestionnaires</h3>
                                    <p>
                                        Ajouter, voir et gérer les gestionnaires de l'application.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion des Gestionnaires">
                                </div>

                                <!-- Section: Gestion des Employés -->
                                <div class="guide-section">
                                    <h3>Gestion des Employés</h3>
                                    <p>
                                        Voir, éditer, supprimer et consulter les profils des employés.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion des Employés">
                                </div>

                                <!-- Section: Gestion des Formations -->
                                <div class="guide-section">
                                    <h3>Gestion des Formations</h3>
                                    <p>
                                        Ajouter, voir et gérer les formations disponibles. S'inscrire à une formation.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion des Formations">
                                </div>

                                <!-- Section: Gestion des Congés -->
                                <div class="guide-section">
                                    <h3>Gestion des Congés</h3>
                                    <p>
                                        Répondre aux demandes de congé des employés.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion des Congés">
                                </div>

                                <!-- Section: Gestion du Planning -->
                                <div class="guide-section">
                                    <h3>Gestion du Planning</h3>
                                    <p>
                                        Accéder et modifier le planning des activités et des tâches.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion du Planning">
                                </div>

                                <!-- Section: Gestion des Dossiers du Personnel -->
                                <div class="guide-section">
                                    <h3>Gestion des Dossiers du Personnel</h3>
                                    <p>
                                        Accéder et gérer les dossiers personnels des employés.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion des Dossiers du Personnel">
                                </div>

                                <!-- Section: Gestion du Pointage -->
                                <div class="guide-section">
                                    <h3>Gestion du Pointage</h3>
                                    <p>
                                        Gérer le pointage et la présence des employés.
                                    </p>
                                    <img src="" alt="Capture d'écran: Gestion du Pointage">
                                </div>
                            </div>
                        </div>
                    @elseif (Auth::user()->role === 'Gestionnaire')
                        <div class="card mb-3" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title">Guide pour les gestionnaires</h5>
                                <p class="card-text">Contenu spécifique aux gestionnaires...</p>
                            </div>
                        </div>
                        <div class="guide-section">
                            <div class="guide-section-title">Section pour le Gestionnaire</div>
                            <div class="guide-content">
                                <div class="guide-step">
                                    <div class="guide-step-title">Gestion des Services</div>
                                    <div class="guide-step-content">
                                        Instructions sur l'enregistrement et la liste des services disponibles.
                                    </div>
                                </div>
                                <!-- Ajoutez d'autres étapes spécifiques au Gestionnaire -->
                            </div>
                        </div>
                    @elseif (Auth::user()->role === 'Employé')
                        <div class="card mb-3" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title">Guide pour les employés</h5>
                                <p class="card-text">Contenu spécifique aux employés...</p>
                            </div>
                        </div>
                        <div class="guide-section">
                            <div class="guide-section-title">Section pour l'Employé</div>
                            <div class="guide-content">
                                <div class="guide-step">
                                    <div class="guide-step-title">Gestion des Congés & Absences</div>
                                    <div class="guide-step-content">
                                        Instructions sur la demande de congés et la consultation des demandes passées.
                                    </div>
                                </div>
                                <!-- Ajoutez d'autres étapes spécifiques à l'Employé -->
                            </div>
                        </div>
                    @endif
                    <!-- Placeholder pour les captures d'écran -->
                    <div class="guide-section">
                        <div class="guide-section-title">Captures d'écran</div>
                        <div class="guide-content">
                            <div class="guide-screenshot">
                                <div class="guide-step-title">Exemple de capture d'écran 1</div>
                                <img src="storage/img/add1.jpg" alt="Capture d'écran 1">
                            </div>
                            <div class="guide-screenshot">
                                <div class="guide-step-title">Exemple de capture d'écran 2</div>
                                <img src="storage/img/add1.jpg" alt="Capture d'écran 2">
                            </div>
                            <!-- Ajoutez d'autres captures d'écran pertinentes -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center my-8">
        Guide créé avec <span style="color: #696cff;">amour</span> par StaffNest &copy; 2024
    </footer>
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

</html> --}}



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Guide Utilisateur - RH-Optimize</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="storage/img/logo_nbg.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        .guide-container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .guide-header {
            background-color: #696cff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
        }

        .guide-section {
            margin-bottom: 30px;
        }

        .guide-section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #696cff;
            margin-bottom: 10px;
        }

        .guide-content {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .guide-step {
            margin-bottom: 20px;
        }

        .guide-step-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .guide-step-content {
            color: #555;
            margin-bottom: 10px;
        }

        .guide-screenshot {
            margin-bottom: 20px;
        }

        .guide-screenshot img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            /* Taille par défaut pour les images */
            width: 100%;
            /* Ajustez selon vos besoins */
            max-height: 400px;
            /* Hauteur maximale pour une vue équilibrée */
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div class="container-fluid">
        <div class="row">

            <!-- Contenu principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="guide-container">
                    <div class="guide-header">
                        <h1>Guide Utilisateur - RH-Optimize</h1>
                    </div>

                    <!-- Contenu du guide en fonction du rôle -->
                    @if (Auth::user()->role === 'Admin')
                        <div class="card mb-3" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title">Guide pour les administrateurs</h5>
                                <p class="card-text">Contenu spécifique aux administrateurs...</p>
                            </div>
                        </div>
                        <div class="guide-section">
                            <div class="guide-section-title">Section pour l'Administrateur</div>
                            <div class="guide-content">
                                <div class="guide-step">
                                    <div class="guide-step-title">Gestion des Gestionnaires</div>
                                    <div class="guide-step-content">
                                        Instructions détaillées sur la gestion des gestionnaires, y compris
                                        l'enregistrement et la liste des gestionnaires.
                                    </div>
                                </div>
                                <!-- Ajoutez d'autres étapes spécifiques à l'Admin selon vos fonctionnalités -->
                                <!-- Section: Gestion des Services -->
                                <div class="guide-section">
                                    <h3>Gestion des Services</h3>
                                    <p>
                                        Ajouter, voir et gérer les services disponibles dans l'application.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/service_liste.png"
                                            alt="Capture d'écran: Gestion des Services">
                                    </div>
                                </div>

                                <!-- Section: Gestion des Gestionnaires -->
                                <div class="guide-section">
                                    <h3>Gestion des Gestionnaires</h3>
                                    <p>
                                        Ajouter, voir et gérer les gestionnaires de l'application.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/user_liste2.png"
                                            alt="Capture d'écran: Gestion des Gestionnaires">
                                    </div>
                                </div>

                                <!-- Section: Gestion des Employés -->
                                <div class="guide-section">
                                    <h3>Gestion des Employés</h3>
                                    <p>
                                        Voir, éditer, supprimer et consulter les profils des employés.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/user_liste2.png"
                                            alt="Capture d'écran: Gestion des Employés">
                                    </div>
                                </div>

                                <!-- Section: Gestion des Formations -->
                                <div class="guide-section">
                                    <h3>Gestion des Formations</h3>
                                    <p>
                                        Ajouter, voir et gérer les formations disponibles. S'inscrire à une formation.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/formation_liste.png"
                                            alt="Capture d'écran: Gestion des Formations">
                                    </div>
                                </div>

                                <!-- Section: Gestion des Congés -->
                                <div class="guide-section">
                                    <h3>Gestion des Congés</h3>
                                    <p>
                                        Répondre aux demandes de congé des employés.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/my_conges_emp.png"
                                            alt="Capture d'écran: Gestion des Congés">
                                    </div>
                                </div>

                                <!-- Section: Gestion du Planning -->
                                <div class="guide-section">
                                    <h3>Gestion du Planning</h3>
                                    <p>
                                        Accéder et modifier le planning des activités et des tâches.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/planning.png"
                                            alt="Capture d'écran: Gestion du Planning">
                                    </div>
                                </div>

                                <!-- Section: Gestion des Dossiers du Personnel -->
                                <div class="guide-section">
                                    <h3>Gestion des Dossiers du Personnel</h3>
                                    <p>
                                        Accéder et gérer les dossiers personnels des employés.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/folder.png"
                                            alt="Capture d'écran: Gestion des Dossiers du Personnel">
                                    </div>
                                </div>

                                <!-- Section: Gestion du Pointage -->
                                <div class="guide-section">
                                    <h3>Gestion du Pointage</h3>
                                    <p>
                                        Enregistrer la présence et gérer les données de pointage des employés.
                                    </p>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/captures/service_liste.png"
                                            alt="Capture d'écran: Gestion du Pointage">
                                    </div>
                                </div>

                            </div>
                        </div>
                    @elseif (Auth::user()->role === 'Gestionnaire')
                        <div class="card mb-3" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title">Guide pour les gestionnaires</h5>
                                <p class="card-text">Contenu spécifique aux gestionnaires...</p>
                            </div>
                        </div>
                        <!-- Ajouter le contenu spécifique aux gestionnaires -->
                    @elseif (Auth::user()->role === 'Employé')
                        <div class="card mb-3" style="background-color: #ffffff;">
                            <div class="card-body">
                                <h5 class="card-title">Guide pour les employés</h5>
                                <p class="card-text">Contenu spécifique aux employés...</p>
                                <div class="guide-section">
                                    <div class="guide-section-title">Section pour l'Employé</div>
                                    <div class="guide-content">
                                        <div class="guide-step">
                                            <div class="guide-step-title">Voir et s'inscrire aux formations</div>
                                            <div class="guide-step-content">
                                                Vous pouvez consulter la liste des formations disponibles et vous y
                                                inscrire.
                                            </div>
                                            <div class="guide-screenshot">
                                                <div class="guide-step-title">Exemple de capture d'écran</div>
                                                <img src="storage/img/training.jpg" alt="Capture d'écran: Formations">
                                            </div>
                                        </div>
                                        <div class="guide-step">
                                            <div class="guide-step-title">Demander un congé</div>
                                            <div class="guide-step-content">
                                                Instructions pour demander un congé et suivre l'état de vos demandes.
                                            </div>
                                            <div class="guide-screenshot">
                                                <div class="guide-step-title">Exemple de capture d'écran</div>
                                                <img src="storage/img/leave.jpg"
                                                    alt="Capture d'écran: Demande de congé">
                                            </div>
                                        </div>
                                        <div class="guide-step">
                                            <div class="guide-step-title">Consulter les notifications</div>
                                            <div class="guide-step-content">
                                                Vous pouvez vérifier vos notifications pour rester informé des mises à
                                                jour
                                                importantes.
                                            </div>
                                            <div class="guide-screenshot">
                                                <div class="guide-step-title">Exemple de capture d'écran</div>
                                                <img src="storage/img/notifications.jpg"
                                                    alt="Capture d'écran: Notifications">
                                            </div>
                                        </div>
                                        <div class="guide-step">
                                            <div class="guide-step-title">Voir vos fiches de paie et contrat de travail
                                            </div>
                                            <div class="guide-step-content">
                                                Accédez à vos fiches de paie et consultez votre contrat de travail.
                                            </div>
                                            <div class="guide-screenshot">
                                                <div class="guide-step-title">Exemple de capture d'écran</div>
                                                <img src="storage/img/payslip.jpg"
                                                    alt="Capture d'écran: Fiches de paie">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- <div class="guide-section">
                            <div class="guide-section-title">Section pour l'Employé</div>
                            <div class="guide-content">
                                <div class="guide-step">
                                    <div class="guide-step-title">Voir et s'inscrire aux formations</div>
                                    <div class="guide-step-content">
                                        Vous pouvez consulter la liste des formations disponibles et vous y inscrire.
                                    </div>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/img/training.jpg" alt="Capture d'écran: Formations">
                                    </div>
                                </div>
                                <div class="guide-step">
                                    <div class="guide-step-title">Demander un congé</div>
                                    <div class="guide-step-content">
                                        Instructions pour demander un congé et suivre l'état de vos demandes.
                                    </div>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/img/leave.jpg" alt="Capture d'écran: Demande de congé">
                                    </div>
                                </div>
                                <div class="guide-step">
                                    <div class="guide-step-title">Consulter les notifications</div>
                                    <div class="guide-step-content">
                                        Vous pouvez vérifier vos notifications pour rester informé des mises à jour
                                        importantes.
                                    </div>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/img/notifications.jpg" alt="Capture d'écran: Notifications">
                                    </div>
                                </div>
                                <div class="guide-step">
                                    <div class="guide-step-title">Voir vos fiches de paie et contrat de travail</div>
                                    <div class="guide-step-content">
                                        Accédez à vos fiches de paie et consultez votre contrat de travail.
                                    </div>
                                    <div class="guide-screenshot">
                                        <div class="guide-step-title">Exemple de capture d'écran</div>
                                        <img src="storage/img/payslip.jpg" alt="Capture d'écran: Fiches de paie">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Ajouter le contenu spécifique aux employés -->
                    @endif


                </div>
            </main>

        </div>
    </div>
</body>

</html>
