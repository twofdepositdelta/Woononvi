<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact {{ $data['subject'] }}</title>
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
    <h2>Vous avez un nouveau message</h2>


    <h3>Récapitulatif du message :</h3>
    <ul>
        <li><strong>Nom :</strong> {{ $data['fullname'] }}</li>
        <li><strong>E-mail :</strong> {{ $data['email'] }}</li>
        <li><strong>Téléphone :</strong> {{ $data['phone'] }}</li>
        <li><strong>Objet :</strong> {{ $data['subject'] }}</li>
        <li><strong>Message :</strong> {{ $data['message'] }}</li>
    </ul>


    <p>Wononvi</p>
</div>

</body>
</html>
