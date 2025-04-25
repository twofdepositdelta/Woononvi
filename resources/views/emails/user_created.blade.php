
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9b21e;
            margin: 0;
            padding: 20px;
        }
        .container {

            max-width: 600px;
            margin: 0 auto;
            padding: 0;
        }

        .logo-small {
            width: 200px;
            height: auto;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 4px;
        }
        h1 {
            font-size: 18px;
            color: #333;
            margin-top: 0;
            font-weight: normal;
        }
        .alert {
            background-color: #174e6a;
            border-left: 4px solid #718096;
            padding: 15px;
            margin: 20px 0;
            color: #f9b21e;
        }
        p {
            color: #718096;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            color: #174e6a;
            font-size: 12px;
            padding: 20px 0;
        }
        .logo-black {
            color: #000000;
            /* Couleur noire pour "Woô" */
        }

        .logo-text {
            font-size: 2rem; /* Taille générale du logo */
            font-weight: bold; /* Poids pour un impact visuel */
            font-family: 'Poppins', sans-serif; /* Police moderne et élégante */
            text-transform: uppercase; /* Texte tout en majuscules */
            letter-spacing: 1px; /* Espacement entre les lettres */
            color: #174e6a;
        }

        .logo-white {
            color: #FFF;
            /* Couleur blanche pour "Woô" */
        }

        .logo-yellow {
            color: #FFB300;
            /* Jaune vibrant pour "nonvi" */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" >
            {{-- <span class="">{{ explode('ō', FrontHelper::getAppName())[0] }}ō</span><span>{{ explode('ō', FrontHelper::getAppName())[1] }}</span> --}}
            <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/images/log.png') }}" alt="" class="logo-small ">
        </div>
        <div class="content">
            <h1>Bienvenue, {{ $user->firstname }} {{ $user->lastname }} !</h1>

            <p>Votre compte a été créé avec succès. Voici vos informations de connexion :</p>

            <div class="alert">
                <li><strong>Email :</strong> {{ $user->email }}</li>
                <li><strong>Mot de passe :</strong> {{ $password }}</li>
            </div>

            <p>Merci de faire confiance à {{ config('app.name') }}.</p>

            <p>Cordialement, L'équipe {{ config('app.name') }}</p>
        </div>
        <div class="footer">
            © 2025 {{ config('app.name') }}. Tous droits réservés.
        </div>
    </div>
</body>
</html>
