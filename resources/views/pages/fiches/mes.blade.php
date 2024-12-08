@extends('pages.link')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5">
        @if ($fiches->isEmpty())
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Aucun élément trouvé.</strong>
                <span class="block sm:inline">Vous n'avez pas encore reçu de fiche</span>
            </div>
        @else
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Mes fiches de paie</h5>
                    <ul class="list-group">
                        @foreach ($fiches as $fiche)
                            <li class="list-group-item">
                                <a href="{{ route('fiches.view', $fiche->id) }}"
                                    target="_blank">{{ basename($fiche->lien_fiche) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
