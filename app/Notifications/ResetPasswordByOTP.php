<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Notification;

class ResetPasswordByOTP extends Notification
{
    use Queueable;

    public $otp;

    public function __construct($otp)
    {
        // Stocke le token pour l'utiliser dans l'e-mail
        $this->otp = $otp;
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
        return (new MailMessage)
            ->subject(__('Réinitialisation du mot de passe'))
            ->line('Vous avez fait une demande de réinitialisation de mot de passe. Veuillez utiliser le code OTP ci-dessous pour modifier votre mot de passe.')
            ->action($this->otp, '#')
            ->line('Si vous n\'avez rien demandé, aucune autre action n\'est requise.');
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