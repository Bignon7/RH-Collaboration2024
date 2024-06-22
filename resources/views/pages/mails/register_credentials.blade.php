@extends('pages.mails.mails_base')

@section('title', 'Mail de confirmation')

@section('content')
    <div class="container mt-5 mb-5 card col-md-5 mx-auto">
        <div class="card-body border border-1 p-3">
            <h2 style="color:#696cff" class="text-start text-bold">StaffNest</h2>
            <h4>Voici vos informations de connexion</h4>
            <p> - Nom: {{ $credentials['nom'] }}</p>
            <p>- Prénom: {{ $credentials['prenom'] }}</p>
            <p>- Mot de passe: {{ $credentials['password'] }}</p>
            <a style="font-size:small; background-color:#696cff; border:none;"
                class="text-decoration-none btn btn-info text-center col row d-flex text-bold center-block justify-content-center mx-auto text-light fw-bold"
                href="{{ route('login') }}">Se connecter</a>
            </p><br>

            <p class="text-center fs-5">Service d'aide de <b>{{ config('app.name') }}</b></p>

        </div>

    </div>

@endsection
