<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="storage/img/logo_nbg.ico" />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->

    <style>
        :root {
            font-family: 'Public Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Oxygen', 'Ubuntu', 'Cantarell',
                'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
        }

        .brand-color {
            color: #696cff;
        }

        .brand-color-hover:hover {
            color: #6610f2;
        }

        .hover-underline-animation {
            display: inline-block;
            position: relative;
        }

        .hover-underline-animation::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #696cff;
            transform-origin: bottom right;
            transition: transform 0.5s ease-out;
        }

        .hover-underline-animation:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
        }

        .carousel-item.active {
            opacity: 1;
            transform: scale(1.05);
        }

        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.5);
            color: white;
            padding: 1rem 1.2rem;
            border-radius: 50%;
            cursor: pointer;
        }

        .carousel-control.left {
            left: 1rem;
        }

        .carousel-control.right {
            right: 1rem;
        }

        .carousel-control i {
            font-size: 1.5rem;
        }

        /* Les images couvrent toute la surface du carrousel */
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .underline-stylized {
            position: relative;
            display: inline-block;
        }

        .underline-stylized::before {
            content: '';
            position: absolute;
            left: -15%;
            /* Extend 10% beyond the left */
            right: -15%;
            /* Extend 10% beyond the right */
            bottom: -0.35rem;
            height: 0.15rem;
            background: #6366F1;
            /* indigo-500 */
        }

        .underline-stylized::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -0.45rem;
            width: 80%;
            /* Adjust the width of the thick underline */
            height: 0.35rem;
            background: #6366F1;
            /* indigo-500 */

        }
    </style>
</head>


<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#" class="xs:text-2xl sm:text-3xl font-bold brand-color brand-color-hover">
                        StaffNest
                    </a>
                </div>

                <div class="flex ml-auto space-x-4 sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard.welcome') }}"
                                class="xs:text-xxs sm:text-xs md:text-lg text-gray-500 font-semibold hover:text-indigo-500 hover:font-bold hover-underline-animation">Tableau
                                de bord</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="xs:text-xxs sm:text-xs md:text-lg  text-gray-500 font-semibold hover:text-indigo-500 hover:font-bold hover-underline-animation ">
                                Se connecter
                            </a>
                            <a href="{{ route('contact_us') }}"
                                class="xs:text-xxs sm:text-xs md:text-lg text-gray-500 font-semibold hover:text-indigo-500 hover:font-bold hover-underline-animation">
                                Pour commencer
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div class="relative mt-16 h-screen overflow-hidden" id="carousel">
        <div class="carousel-item active h-full bg-cover bg-center"
            style="background-image: url('storage/img/meet.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Bienvenue à StaffNest</h1>
                    <p class="text-lg md:text-xl mb-8">Votre solution de gestion du personnel</p>
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <a href="#">Découvrez plus</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="carousel-item h-full bg-cover bg-center" style="background-image: url('storage/img/talk.jpeg');">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Découvrez nos services</h1>
                    <p class="text-lg md:text-xl mb-8">Solutions adaptées à vos besoins</p>
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <a href="#">En savoir plus</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="carousel-item h-full bg-cover bg-center"
            style="background-image: url('storage/img/handshake.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Rejoignez-nous</h1>
                    <p class="text-lg md:text-xl mb-8">Construisons ensemble l'avenir</p>
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <a href="#">Contactez-nous</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <div id="prev" class="carousel-control left">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div id="next" class="carousel-control right">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>

    <!-- Titre des cartes -->
    <div class="text-center mt-20 mb-20" id="about">
        <h2 class="text-3xl font-bold text-gray-500 underline-stylized">A PROPOS DE NOUS</h2>
    </div>
    <!-- Section des cartes -->
    <div class="container mx-auto px-4 md:px-20 mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-20">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-between">
            <!-- Image -->
            <img class="w-full h-60 object-cover object-center" src="storage/img/img1.jpeg" alt="Card image">

            <!-- Conteneur du texte -->
            <div class="p-6 text-left">
                <h2 class="text-2xl text-center font-semibold text-indigo-500 mb-2">Notre Mission</h2>
                <p class="text-gray-500 mb-4 text-justify">Notre mission est de transformer la gestion des
                    ressources humaines en un processus efficace et centralisé. Avec l'automatisation des tâches
                    administratives, nous vous aidons à améliorer votre productivité. En facilitant l'enregistrement
                    des employés, le suivi des congés, la gestion des plannings de formation et la création des fiches
                    de paie, nous permettrons aux entreprises de se concentrer sur leur cœur de métier. </p>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-between">
            <!-- Image -->
            <img class="w-full h-60 object-cover object-center" src="storage/img/plan.jpg" alt="Card image">

            <!-- Conteneur du texte -->
            <div class="p-6 text-left">
                <h2 class="text-2xl text-center font-semibold text-indigo-500 mb-2">Notre Plan</h2>
                <p class="text-gray-500 mb-4 text-justify">Avec une interface utilisateur intuitive pour les employés et
                    les
                    gestionnaires ; nous prévoyons donner à vos utilisateurs une expérience des plus belles et une
                    utilisation compréhensible et aisée de la plateforme. Nous prévoyons également centraliser toutes
                    les données RH, automatiser
                    les processus manuels et sécuriser les informations sensibles pour garantir leur confidentialité et
                    leur intégrité.</p>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col justify-between">
            <!-- Image -->
            <img class="w-full h-60 object-cover object-center" src="storage/img/add2.jpg" alt="Card image">

            <!-- Conteneur du texte -->
            <div class="p-6 text-left">
                <h2 class="text-2xl text-center font-semibold text-indigo-500 mb-2">Notre Vision</h2>
                <p class="text-gray-500 mb-4 text-justify">Notre plateforme envisage un système où toutes les
                    informations RH sont
                    centralisées, accessibles et sécurisées, permettant une transparence totale et une prise de décision
                    éclairée. En automatisant les tâches administratives et en fournissant des outils d'analyse
                    puissants, nous vous aiderons à améliorer votre efficacité opérationnelle, à réduire vos coûts et à
                    augmenter la satisfaction de vos employés.</p>
            </div>
        </div>
    </div>


    <!-- Titre des services -->
    <div class="text-center mt-20 mb-20" id="services">
        <h2 class="text-3xl font-bold text-gray-500 underline-stylized">SERVICES</h2>
    </div>

    <!-- Section des services ligne1-->
    <div class="container mx-auto px-4 md:px-6 mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6">
        <!-- Service 1 -->
        <div class="service text-center bg-white p-6 shadow-lg rounded-lg">
            <div class="icon text-indigo-500 mb-4">
                <i class="fa-solid fa-users text-4xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-500">Gestion complète des employés</h3>
            <p class="text-gray-600">Permet aux gestionnaires RH d'ajouter, mettre à jour et supprimer les
                informations personnelles et administratives des employés, assurant une base de données précise et à
                jour.</p>
        </div>

        <!-- Service 2 -->
        <div class="service text-center bg-white p-6 shadow-lg rounded-lg">
            <div class="icon text-indigo-500 mb-4">
                <i class="fas fa-lightbulb text-4xl"></i>
                <i class="fa-solid fa-book text-4xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-500">Planification et suivi des formations</h3>
            <p class="text-gray-600">Les gestionnaires RH peuvent planifier des formations pour les
                employés, qui peuvent ensuite s'inscrire et recevoir des notifications, facilitant ainsi le
                développement des
                compétences.</p>
        </div>

        <!-- Service 3 -->
        <div class="service text-center bg-white p-6 shadow-lg rounded-lg">
            <div class="icon text-indigo-500 mb-4">
                <i class="fa-solid fa-chart-line text-4xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-500">Évaluation et suivi des performances</h3>
            <p class="text-gray-600">Permet aux gestionnaires RH d'évaluer régulièrement les performances des
                employés selon des critères prédéfinis et de générer des rapports détaillés sur les évaluations.</p>
        </div>
    </div>

    <!-- Section des services ligne2 -->
    <div class="container mx-auto px-4 md:px-6 mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6">
        <!-- Service 1 -->
        <div class="service text-center bg-white p-6 shadow-lg rounded-lg">
            <div class="icon text-indigo-500 mb-4">
                <i class="fa-solid fa-bullhorn text-4xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-500">Système d'information performant</h3>
            <p class="text-gray-600">Facilite la diffusion rapide et efficiente des différentes informations circulant
                dans l'entreprise au moyen des notifications, des emails et autres.
            </p>
        </div>

        <!-- Service 2 -->
        <div class="service text-center bg-white p-6 shadow-lg rounded-lg">
            <div class="icon text-indigo-500 mb-4">
                <i class="fa-solid fa-scroll text-4xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-500">Accès et gestion des fiches de paie</h3>
            <p class="text-gray-600">Les employés peuvent consulter et télécharger leurs fiches de paie,
                tandis que les gestionnaires peuvent les générer et les distribuer, simplifiant ainsi le processus de
                paie.</p>
        </div>

        <!-- Service 3 -->
        <div class="service text-center bg-white p-6 shadow-lg rounded-lg">
            <div class="icon text-indigo-500 mb-4">
                <i class="fas fa-rocket text-4xl"></i>
            </div>
            <h3 class="font-bold text-lg text-gray-500">Gestion des congés</h3>
            <p class="text-gray-600">Les employés peuvent soumettre des demandes de congé, et les gestionnaires peuvent
                approuver ou rejeter ces demandes en fonction des disponibilités et des politiques de l'entreprise.</p>
        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-32">
        <div class="container mx-auto px-6 md:px-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Colonne 1 -->
                <div>
                    <h3 class="text-xl font-bold mb-6">À propos</h3>
                    <p class="text-gray-400 leading-relaxed">Nous sommes une entreprise dédiée à fournir les meilleurs
                        services à nos clients. Votre satisfaction est notre priorité.</p>
                </div>

                <!-- Colonne 2 -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Liens rapides</h3>
                    <ul class="text-gray-400 space-y-4">
                        <li><a href="#carousel"
                                class="hover:text-indigo-500 transition-colors duration-300">Accueil</a>
                        </li>
                        <li><a href="#about" class="hover:text-indigo-500 transition-colors duration-300">À
                                propos</a></li>
                        <li><a href="#services"
                                class="hover:text-indigo-500 transition-colors duration-300">Services</a></li>
                        <li><a href="#" class="hover:text-indigo-500 transition-colors duration-300">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Colonne 3 -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Suivez-nous</h3>
                    <div class="flex space-x-6">
                        <a href="#"
                            class="relative social-icon text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#"
                            class="relative social-icon text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#"
                            class="relative social-icon text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#"
                            class="relative social-icon text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Javascript pour le carousel -->
    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;

        function showItem(index) {
            items[currentIndex].classList.remove('active');
            currentIndex = index;
            if (currentIndex >= totalItems) {
                currentIndex = 0;
            }
            if (currentIndex < 0) {
                currentIndex = totalItems - 1;
            }
            items[currentIndex].classList.add('active');
        }

        document.getElementById('next').addEventListener('click', () => {
            showItem(currentIndex + 1);
        });

        document.getElementById('prev').addEventListener('click', () => {
            showItem(currentIndex - 1);
        });

        setInterval(() => {
            showItem(currentIndex + 1);
        }, 5000); // Change item every 5 seconds
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
