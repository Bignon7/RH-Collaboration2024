@extends('pages.link')

@section('content')
    {{-- @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif --}}

    <div style="height:100vh">
        <div class="container mt-5">
            <button
                class="bg-indigo-500 text-white px-4 py-2 mb-4 mt-2  rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 ml-auto block">
                <a class="hover:text-white" href="{{ route('show_import_fiche_form') }}">Importer pour un employé</a>
            </button>
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-12">
                    <div class="card shadow-sm bg-white">
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                            <a href=" {{ route('fiches.import') }}"><button class="badge bg-label-primary me-1 p-3"
                                    style="font-size : 1.2rem">Téléverser les fiches de paies de vos employés</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <div class="card shadow-sm bg-white">
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 200px;">
                            <a href=" {{ route('send_notif_employee') }}"><button class="badge bg-label-primary me-1 p-3"
                                    style="font-size : 1.2rem">Notifier les employés que les fiches de paie sont prêtes
                                </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
