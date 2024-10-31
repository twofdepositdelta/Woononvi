<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActualiteNotification extends Notification
{
    use Queueable;
    protected $email;
    protected $description;
    protected $titre;

    /**
     * Create a new notification instance.
     */
    public function __construct($email,$description,$titre)
    {
        $this->email=$email;
        $this->description=$description;
        $this->titre=$titre;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->titre)
                    ->greeting('Bonjour ' . $notifiable->firstname . ' ' . $notifiable->lastname . ',')
                    ->line(strip_tags($this->description)) 
                    ->line("Cliquez sur le bouton ci-dessous pour vous connecter.")
                    ->action('Connexion', route('login'));
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
