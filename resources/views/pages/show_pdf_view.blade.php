<!-- resources/views/pages/view_pdf.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation du Contrat</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .pdf-container {
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <iframe class="pdf-container" src="storage/{{ $lien }}" frameborder="0"></iframe>
</body>

</html>