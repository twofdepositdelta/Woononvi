<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountConfirmation extends Notification
{
    use Queueable;

    public $user;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $url = url('/confirm-account/'.$this->token);

        return (new MailMessage)
                    ->subject('Confirmez votre compte')
                    ->greeting('Bonjour ' . $this->user->firstname . ' ' . $this->user->lastname . ',')
                    ->line('Merci de vous être inscrit sur Wononvi. Veuillez utiliser le code OTP ci-dessous pour valider votre compte.')
                    ->action($this->token, '#')
                    ->line('Si vous n\'avez pas créé de compte, aucune autre action n\'est requise.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}