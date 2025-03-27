<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPlatNotification extends Notification
{
    use Queueable;

    protected $plat;

    public function __construct($plat)
    {
        $this->plat = $plat;
    }

    // 📌 SOLO Email
    public function via($notifiable)
    {
        return ['mail'];
    }

    // 📌 Contenuto dell'Email
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nuovo Piatto Aggiunto! 🍕')
            ->greeting('Ciao ' . $notifiable->name . '!')
            ->line("Un nuovo piatto è stato aggiunto: **{$this->plat->nom}**")
            ->action('Visualizza il piatto', url('/plats/' . $this->plat->id))
            ->line('Grazie per aver utilizzato la nostra piattaforma!');
    }
}

