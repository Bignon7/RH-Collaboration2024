<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir la fiche de paie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title">Votre fiche de paie</h5>
            <iframe src="{{ asset($filePath) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            <a href="{{ asset($filePath) }}" class="btn btn-primary mt-3" download>Télécharger la fiche de paie</a>
        </div>
    </div>
</div>
</body>
</html>
