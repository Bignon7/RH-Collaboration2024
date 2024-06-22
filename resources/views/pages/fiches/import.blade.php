<!-- resources/views/import_payslips.blade.php -->

@extends('pages.link')

@section('content')
    {{-- @if (session('error'))
        <div class="alert alert-danger">
            <p>Le téléchargement des fichiers n\'a pas reussi , taille maximale 2048 ko ,type :pdf,excel, image, word</p>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
    @endif --}}
    <div class="container mt-4 mb-2">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
            </div>
        @endif

        @if (session('errors') && count(session('errors')) > 0)
            <div class="bg-red-100 text-red-700 px-4 py-4 rounded relative my-4" role="alert">
                <strong class="font-bold">Des erreurs ont été rencontrées :</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach (session('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-primary p-5" role="alert">
                    <h5 style="line-height: 1.2rem;">Ici vous pouvez importer en un clic et sauvegarder les fiches de paies
                        de
                        vos employés pour le mois
                        courant en vous assurant que chacun de ces fichiers a le format
                        <strong>"matricule_autre.extension"</strong> avant
                        l'importation.
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <div class="custom-form-container"
            style="max-width: 600px;height:300px;
                margin: 50px auto;
                padding: 30px;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                font-size:1.1rem;">

            <h1 class="text-center mb-4">Importer les fiches de paie</h1>
            <form action="{{ route('fiches.store') }}" method="POST" enctype="multipart/form-data" class="m-2">
                @csrf
                <div class="form-group text-center m-3">
                    <label for="payslips_files">Sélectionnez les fiches de paie</label>
                    <input type="file" class="form-control rounded p-3 m-3"
                        style="border :solid 1px;
                                                                "
                        id="payslips_files" name="payslips_files[]" multiple required>
                </div>

                <div class="text-center">
                    <button type="submit" class="badge bg-label-primary me-1 m-3" style="border:none ;">Importer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
