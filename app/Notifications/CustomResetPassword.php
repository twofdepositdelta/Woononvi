<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        // Stocke le token pour l'utiliser dans l'e-mail
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Générer l'URL de réinitialisation
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(__('Réinitialisation du mot de passe'))
            ->view('emails.reset-password', [
                'url' => $url,
            ]);
    }

    /**
     * Récupérer l'URL de réinitialisation.
     */
    protected function getResetUrl($notifiable)
    {
        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }

    /**
     * Build the mail representation of the notification.
     */
    public function build()
    {
        return $this->markdown('emails.reset-password')
                    ->subject(__('Réinitialisation du mot de passe'))
                    ->with([
                        'url' => $this->getResetUrl($notifiable),
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}