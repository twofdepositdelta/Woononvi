<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NotificationLocale extends Notification
{
    use Queueable;

    private array $details; // Déclaration du type

    /**
     * Create a new notification instance.
     *
     * @param array $details
     * @return void
     */
    public function __construct(array $details) // Spécifiez que c'est un tableau
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => $this->details['message'] ?? 'Message non défini', // Utiliser une valeur par défaut
        ];
    }
}
