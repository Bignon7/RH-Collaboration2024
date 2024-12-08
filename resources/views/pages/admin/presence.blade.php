@extends('pages.link')
@section('content')

    @if ($attendances->isEmpty())
        <div class="container m-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert alert-primary p-5" role="alert">
                        <h3>Aucun employé n'a enregistré d'horodatage pour la date sélectionnée.</h3>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prenom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Heure d'arrivée</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $index => $attendance)
                                        <tr class="user-row">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $attendance->user->nom }}</td>
                                            <td>{{ $attendance->user->prenom }}</td>
                                            <td>{{ $attendance->user->email }}</td>
                                            <td>{{ $attendance->clock_in_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{ $attendances->links() }}
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
