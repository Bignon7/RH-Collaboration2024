@extends('pages.mails.mails_base')

@section('title', 'Mail de confirmation')

@section('content')
    <div class="container mt-5 mb-5 card col-md-5 mx-auto">
        <div class="card-body border border-1 p-3">
            <h2 style="color:#696cff" class="text-start text-bold">StaffNest</h2>
            The body of your message.
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


    <div class="container mx-auto my-5 p-5 bg-white shadow-lg rounded-lg max-w-md">
        <div class="p-6 border border-gray-200 rounded-lg">
            <h2 class="text-2xl font-bold text-indigo-600 mb-4">StaffNest</h2>
            <div class="text-gray-700 mb-4">
                <p>The body of your message.</p>
                <p><strong>Nom:</strong> {{ $credentials['nom'] }}</p>
                <p><strong>Prénom:</strong> {{ $credentials['prenom'] }}</p>
                <p><strong>Mot de passe:</strong> {{ $credentials['password'] }}</p>
            </div>
            <div class="text-center mb-4">
                <a href="{{ route('login') }}"
                    class="inline-block bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">
                    Se connecter
                </a>
            </div>
            <p class="text-center text-lg">Service d'aide de <strong>{{ config('app.name') }}</strong></p>
        </div>
    </div>

@endsection
