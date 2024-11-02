<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réception de votre message</title>
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

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirmation de réception de votre message</h2>

    <p>Cher {{ $data['fullname'] }},</p>

    <p>Merci d'avoir pris le temps de nous contacter. Nous avons bien reçu votre message et nous vous en remercions.</p>

    <h3>Récapitulatif de votre message :</h3>
    <ul>
        <li><strong>Nom :</strong> {{ $data['fullname'] }}</li>
        <li><strong>E-mail :</strong> {{ $data['email'] }}</li>
        <li><strong>Téléphone :</strong> {{ $data['phone'] }}</li>
        <li><strong>Sujet :</strong> {{ $data['subject'] }}</li>
        <li><strong>Message :</strong> {{ $data['message'] }}</li>
    </ul>

    <p>Notre équipe traitera votre demande dans les plus brefs délais. Si nécessaire, nous vous contacterons pour obtenir des informations supplémentaires.</p>
    <p>Merci encore pour votre intérêt.</p>
</div>

</body>
</html>
