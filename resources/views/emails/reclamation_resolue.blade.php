<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réclamation Résolue</title>
</head>
<body>
    <h2>Bonjour {{ $reclamation->user->firstname }},</h2>

    <p>Nous vous informons que votre réclamation concernant la réservation
        <strong>#{{ $reclamation->booking->booking_number ?? 'non spécifiée' }}</strong>
        a été résolue.</p>

    <p>Nous avons résolu votre réclamation. Merci de votre patience.</p>

    <p>Merci pour votre confiance.</p>
    <p>— L'équipe de {{ config('app.name') }}</p>
</body>
</html>
