<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
    <h1>Bonjour !</h1>

    <p>Vous recevez cet email parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>

    <p>
        <a href="{{ $url }}" style="display: inline-block; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
            Réinitialiser le mot de passe
        </a>
    </p>

    <p>Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.</p>

    <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune action supplémentaire n'est requise.</p>

    <p>Merci,<br>{{ config('app.name') }}</p>
</body>
</html>
