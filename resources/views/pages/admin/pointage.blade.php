@extends('pages.link')
@section('content')
    <div class="container mt-5 mb-3">
        @if ($users->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Aucun utilisateur trouvé</span>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                                                            style="border-raduis:50%;
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
                                        </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
