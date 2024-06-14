<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo text-start" style="width: 100%; display: flex; justify-content: flex-start;">
        <a href="#" class="app-brand-link inline-block" style="display: flex; align-items: center;">
            <span class="app-brand-logo demo" style="display: flex; align-items: center;">
                <img src="storage/img/logo_nbg.ico" alt="" style="height:20%; width:20%; ">
                <span style="text-transform:capitalize;"
                    class="app-brand-text demo menu-text fw-bolder">StaffNest</span>
            </span>
            <span style="text-transform:capitalize; "
                class="app-brand-text demo menu-text fw-bolder ms-2">StaffNest</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('get_dash') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Mon profil</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Gestion des employés</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('register.new') }}" class="menu-link">
                        <div data-i18n="Without menu">Enregistrer un employé</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index_created_user') }}" class="menu-link">
                        <div data-i18n="Without navbar">Liste des employés</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index_created_demandeconge') }}" class="menu-link">
                        <div data-i18n="Container">Congés employés</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Fiches de paie</div>
            </a>

        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                {{-- <a href="{{ route('show_formation_form') }}" class="menu-link menu-toggle"> --}}
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Authentications">Plannifier les formations</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('show_formation_form') }}" class="menu-link">
                        <div data-i18n="Without menu">Créer une nouvelle formation</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index_created_formation') }}" class="menu-link">
                        <div data-i18n="Without navbar">Liste des formations</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Section personnelle</span>
        </li>
        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Formations</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('index_created_formation') }}" class="menu-link">
                        <div data-i18n="Without menu">Liste des formations</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index_inscription_id', Auth::user()->id) }}" class="menu-link">
                        <div data-i18n="Without navbar">Mes inscriptions</div>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Congés & Absences</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('show_demandeconge_form') }}" class="menu-link">
                        <div data-i18n="Without menu">Demander un congé</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('index_created_demandeconge_id', Auth::user()->id) }}" class="menu-link">
                        <div data-i18n="Without navbar">Consulter mes demandes</div>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Fiches de paie</div>
            </a>
        </li>


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div data-i18n="Account Settings">Contrat de travail</div>
            </a>

        </li>


    </ul>
</aside>
