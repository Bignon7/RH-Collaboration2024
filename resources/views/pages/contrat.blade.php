<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contrat de Travail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        .container {
            margin: 0 auto;
            padding: 15px;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section p {
            text-align: justify;
        }

        .header {
            background-color: #696cff;
            color: white;
            text-align: center;
            padding: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Contrat de Travail</h1>
    </div>
    <div class="container">
        <div class="section info-columns row">
            <h2>Informations de l'Employé</h2>
            <div>
                <p><strong>Matricule:</strong> {{ $user->matricule }}</p>
                <p><strong>Nom:</strong> {{ $user->nom }}</p>
                <p><strong>Prénom:</strong> {{ $user->prenom }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Téléphone:</strong> {{ $user->phone }}</p>
                <p><strong>Adresse:</strong> {{ $user->adresse }}</p>
                <p><strong>Date d'embauche:</strong> {{ $user->hire_date }}</p>
                <p><strong>Poste:</strong> {{ $user->poste }}</p>
                <p><strong>Service:</strong> {{ $user->service }}</p>
                <p><strong>Salaire:</strong> {{ $user->salaire }} /an</p>
                <p><strong>Durée du contrat:</strong> {{ $user->duree_contrat }}</p>
            </div>

            <div class="section">
                <h2>Conditions Générales</h2>
                <p>
                    Ce contrat de travail est conclu entre l'employeur et l'employé mentionné ci-dessus. L'employé
                    accepte
                    de travailler sous la direction de l'employeur aux conditions générales suivantes :
                </p>
                <ul>
                    <li>Les horaires de travail sont de 9h à 17h, du lundi au vendredi.</li>
                    <li>L'employé est tenu de respecter les règles et règlements de l'entreprise.</li>
                    <li>L'employé doit informer l'employeur en cas de maladie ou d'absence imprévue.</li>
                    <li>L'employé doit maintenir la confidentialité des informations de l'entreprise.</li>
                </ul>
            </div>

            <div class="section">
                <h2>Salaire et Avantages</h2>
                <p>
                    L'employé recevra un salaire annuel de {{ $user->salaire }} , payé mensuellement. En outre,
                    l'employé
                    est éligible aux avantages suivants :
                </p>
                <ul>
                    <li>20 jours de congés payés par an.</li>
                    <li>Assurance santé complète.</li>
                    <li>Plan de retraite de l'entreprise.</li>
                </ul>
            </div>

            <div class="section">
                <h2>Durée du Contrat</h2>
                <p>
                    Ce contrat est conclu pour une durée de {{ $user->duree_contrat }} ans, commençant le
                    {{ (new IntlDateFormatter('fr_FR', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE))->format(new DateTime($user->hire_date)) }}.
                    Il peut être renouvelé ou résilié selon les termes et conditions établis
                    par
                    l'employeur.
                </p>
            </div>

            <div class="section">
                <h2>Signature</h2>
                <div class="row justify-items-center">
                    <div>
                        <br><br>
                        <p> Signature de l'employé &nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; Signature de l'employeur
                        </p>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
