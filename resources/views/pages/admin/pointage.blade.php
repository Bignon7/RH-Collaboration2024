{{-- @extends('pages.link')
@section('content')
    <div class="container mt-5 mb-3">
        @if (session('auto_filled') && Carbon\Carbon::now()->greaterThanOrEqualTo(Carbon\Carbon::create()->setTime(19, 0, 0)))
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Fin de journée !</strong>
                <span class="block sm:inline">Veuillez revenir demain pour enregistrer votre présence.</span>
            </div>
        @elseif ($users->isEmpty() && $usersClockedIn->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucun utilisateur trouvé</span>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <button
                        class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                        <a class="hover:text-white" href="{{ route('attendance.autofillClockOut') }}">Fermer la session du
                            jour</a>
                    </button>
                    <div class="card">
                        <h5 class="card-header">Bienvenue sur le portail de pointage</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Service</th>
                                        <th>Arrivée</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($users as $user)
                                        <form action="{{ route('attendance.clockin') }}" method="post">
                                            @csrf
                                            <tr class="user-row">
                                                <td>
                                                    <span class="fw-medium"><img src="storage/{{ $user->photo_file }}"
                                                            alt="image" class="rounded-circle"
                                                            style="border-radius:50%;
                                width:50px;
                                height:50px">
                                                    </span>
                                                </td>
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                <td>{{ $user->matricule }}</td>
                                                <td>
                                                    {{ $user->nom }}
                                                </td>
                                                <td>
                                                    {{ $user->prenom }}
                                                </td>
                                                <td>{{ $user->service }}</td>

                                                <td><button type="submit" value=""
                                                        class="badge bg-label-primary me-1"
                                                        style="border:none;font-size:1rem;padding:0.8rem">Arrivée</button></a>
                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (!$usersClockedIn->isEmpty())
                        <div class="card mt-4">
                            <h5 class="card-header">Utilisateurs à Départ</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Service</th>
                                            <th>Départ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($usersClockedIn as $user)
                                            <form action="{{ route('attendance.clockout') }}" method="post">
                                                @csrf
                                                <tr class="user-row">
                                                    <td>
                                                        <span class="fw-medium"><img src="storage/{{ $user->photo_file }}"
                                                                alt="image" class="rounded-circle"
                                                                style="border-radius:50%;
                                    width:50px;
                                    height:50px">
                                                        </span>
                                                    </td>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    <td>{{ $user->matricule }}</td>
                                                    <td>
                                                        {{ $user->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $user->prenom }}
                                                    </td>
                                                    <td>{{ $user->service }}</td>

                                                    <td><button type="submit" value=""
                                                            class="badge bg-label-danger me-1"
                                                            style="border:none;font-size:1rem;padding:0.8rem">Départ</button></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    {{ $users->links() }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

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
@endsection --}}



{{-- @extends('pages.link')
@section('content')
    <div class="container mt-5 mb-3">
        @php
            $now = Carbon\Carbon::now();
            $today = $now->toDateString();
            $closingTime = Carbon\Carbon::create()->setTime(19, 0, 0);
            $sessionClosedDate = session('session_closed_date', ''); // Récupérer la date de fermeture de session
        @endphp

        @if (($now->greaterThanOrEqualTo($closingTime) && $sessionClosedDate == $today) || $sessionClosedDate == $today)
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Fin de journée !</strong>
                <span class="block sm:inline">Veuillez revenir demain pour enregistrer votre présence.</span>
            </div>
        @elseif ($users->isEmpty() && $usersClockedIn->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucun utilisateur trouvé</span>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if ($now->greaterThanOrEqualTo($closingTime) && $sessionClosedDate != $today)
                        <button
                            class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                            <a class="hover:text-white" href="{{ route('attendance.autofillClockOut') }}">Fermer la session
                                du
                                jour</a>
                        </button>
                    @endif

                    @if ($now->lessThan($closingTime))
                        <div class="card">
                            <h5 class="card-header">Bienvenue sur le portail de pointage</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Service</th>
                                            <th>Arrivée</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($users as $user)
                                            <form action="{{ route('attendance.clockin') }}" method="post">
                                                @csrf
                                                <tr class="user-row">
                                                    <td>
                                                        <span class="fw-medium"><img src="storage/{{ $user->photo_file }}"
                                                                alt="image" class="rounded-circle"
                                                                style="border-radius:50%;
                                    width:50px;
                                    height:50px">
                                                        </span>
                                                    </td>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    <td>{{ $user->matricule }}</td>
                                                    <td>
                                                        {{ $user->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $user->prenom }}
                                                    </td>
                                                    <td>{{ $user->service }}</td>

                                                    <td><button type="submit" value=""
                                                            class="badge bg-label-primary me-1"
                                                            style="border:none;font-size:1rem;padding:0.8rem">Arrivée</button></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if (!$usersClockedIn->isEmpty() && $now->lessThan($closingTime))
                        <div class="card mt-4">
                            <h5 class="card-header">Utilisateurs à Départ</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Service</th>
                                            <th>Départ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($usersClockedIn as $user)
                                            <form action="{{ route('attendance.clockout') }}" method="post">
                                                @csrf
                                                <tr class="user-row">
                                                    <td>
                                                        <span class="fw-medium"><img src="storage/{{ $user->photo_file }}"
                                                                alt="image" class="rounded-circle"
                                                                style="border-radius:50%;
                                    width:50px;
                                    height:50px">
                                                        </span>
                                                    </td>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    <td>{{ $user->matricule }}</td>
                                                    <td>
                                                        {{ $user->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $user->prenom }}
                                                    </td>
                                                    <td>{{ $user->service }}</td>

                                                    <td><button type="submit" value=""
                                                            class="badge bg-label-danger me-1"
                                                            style="border:none;font-size:1rem;padding:0.8rem">Départ</button></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    {{ $users->links() }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

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
@endsection --}}

@extends('pages.link')
@section('content')
    <div class="container mt-5 mb-3">
        @if (session('auto_filled') && Carbon\Carbon::now()->greaterThanOrEqualTo(Carbon\Carbon::create()->setTime(19, 0, 0)))
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Fin de journée !</strong>
                <span class="block sm:inline">Veuillez revenir demain pour enregistrer votre présence.</span>
            </div>
        @elseif ($users->isEmpty() && $usersClockedIn->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Tous les utilisateurs ont déjà signalé leur présence du jour</span>
            </div>
        @elseif (session('session_closed_date') == Carbon\Carbon::now()->toDateString())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Fin de journée !</strong>
                <span class="block sm:inline">Veuillez revenir demain pour enregistrer votre présence.</span>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-12">
                    {{-- <button
                        class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                        <a class="hover:text-white" href="{{ route('attendance.autofillClockOut') }}">Fermer la session du
                            jour</a>
                    </button> --}}
                    @php
                        $now = now();
                        $closingTime = now()->setTime(19, 0, 0);
                    @endphp
                    @if ($now->gte($closingTime))
                        <button
                            class="bg-indigo-500 text-white px-4 py-2 mb-3 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                            <a class="hover:text-white" href="{{ route('attendance.autofillClockOut') }}">Fermer la session
                                du
                                jour</a>
                        </button>
                    @endif
                    @if (!$users->isEmpty())
                        <div class="card">
                            <h5 class="card-header">Bienvenue sur le portail de pointage</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Service</th>
                                            <th>Arrivée</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($users as $user)
                                            <form action="{{ route('attendance.clockin') }}" method="post">
                                                @csrf
                                                <tr class="user-row">
                                                    <td>
                                                        <span class="fw-medium"><img src="storage/{{ $user->photo_file }}"
                                                                alt="image" class="rounded-circle"
                                                                style="border-radius:50%;
                                width:50px;
                                height:50px">
                                                        </span>
                                                    </td>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    <td>{{ $user->matricule }}</td>
                                                    <td>
                                                        {{ $user->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $user->prenom }}
                                                    </td>
                                                    <td>{{ $user->service }}</td>

                                                    <td><button type="submit" value=""
                                                            class="badge bg-label-primary me-1"
                                                            style="border:none;font-size:1rem;padding:0.8rem">Arrivée</button></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="bg-blue-100 text-blue-700 px-4 py-4 rounded relative my-4" role="alert">
                            <strong class="font-bold">Statut</strong>
                            <span class="block sm:inline">Tous les utilisateurs enregistrés ont déjà marqué leur présence du
                                jour</span>
                        </div>
                    @endif
                    {{ $users->links() }}
                    @if (!$usersClockedIn->isEmpty())
                        <div class="card mt-4">
                            <h5 class="card-header">Utilisateurs à Départ</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Service</th>
                                            <th>Départ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($usersClockedIn as $user)
                                            <form action="{{ route('attendance.clockout') }}" method="post">
                                                @csrf
                                                <tr class="user-row">
                                                    <td>
                                                        <span class="fw-medium"><img src="storage/{{ $user->photo_file }}"
                                                                alt="image" class="rounded-circle"
                                                                style="border-radius:50%;
                                    width:50px;
                                    height:50px">
                                                        </span>
                                                    </td>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                    <td>{{ $user->matricule }}</td>
                                                    <td>
                                                        {{ $user->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $user->prenom }}
                                                    </td>
                                                    <td>{{ $user->service }}</td>

                                                    <td><button type="submit" value=""
                                                            class="badge bg-label-danger me-1"
                                                            style="border:none;font-size:1rem;padding:0.8rem">Départ</button></a>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    {{-- {{ $usersClockedIn->links() }} --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

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
