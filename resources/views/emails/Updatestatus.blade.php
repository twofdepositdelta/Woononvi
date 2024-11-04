<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du statut de  votre transaction</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .status {
            font-weight: bold;
            color: #4CAF50;
        }
        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #eaeaea;
            padding-top: 10px;
            margin-top: 20px;
        }
        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="email-container">
    <h1>Mise à jour du statut de votre statut</h1>

    <p>Bonjour <strong>{{ $transaction->passenger->firstname.' '.$transaction->passenger->lastname }}</strong>,</p>

    <p>Nous vous informons que le statut de votre transaction <strong>#{{  $transaction->transaction_reference  }}</strong> a été mis à jour. Vous trouverez ci-dessous le nouveau statut de votre transaction :</p>

    <p>Statut actuel : <span class="status">Remboursé</span> </p>

    {{-- <p>Résumé de votre commande :</p>
    <ul>
        <li>Numéro de commande : <strong>{{ $order->ref_id }}</strong></li>
        <li>Date de commande : <strong>{{ $order->created_at->format('d/m/Y') }}</strong></li>
        <li>Total : <strong>{{ number_format($order->total, 2) }} €</strong></li>
    </ul> --}}



    <p>Merci pour votre confiance !</p>

    <p>Cordialement,<br>L'équipe wononvi</p>

    {{-- <div class="email-footer">
        <p>Si vous avez des questions, n'hésitez pas à nous <a href="mailto:support@exemple.com">contacter</a>.</p>
    </div>
</div> --}}

</body>
</html>
