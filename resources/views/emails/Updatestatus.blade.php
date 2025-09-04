@component('mail::message')
# Mise à jour du statut de votre transaction

Bonjour **{{ $transaction->passenger->firstname . ' ' . $transaction->passenger->lastname }}**,

Nous vous informons que le statut de votre transaction **#{{ $transaction->transaction_reference }}** a été mis à jour.
Vous trouverez ci-dessous le nouveau statut de votre transaction :

> **Statut actuel :** Remboursé

Merci pour votre confiance !

Cordialement,
L'équipe {{ config('app.name') }} 
@endcomponent
