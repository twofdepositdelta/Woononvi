<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <p>Bonjour {{ $document->user->firstname }},</p>
    <p>Votre document intitulé "{{ $document->typeDocument->label }}" a été rejeté pour la raison suivante :</p>
    <p><strong>{{ $document->reason }}</strong></p>
    <p>Merci de corriger ou fournir un document valide.</p>

    <p>Wononvi</p>
</div>

</body>
</html>
