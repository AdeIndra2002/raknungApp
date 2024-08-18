<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DistribusiVerified extends Notification
{
    use Queueable;

    private $distribusi;

    /**
     * Create a new notification instance.
     */
    public function __construct($distribusi)
    {
        $this->distribusi = $distribusi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toDatabase(object $notifiable): array
    {
        return [
            'distribusi' => $this->distribusi->id,
            'pengajuan' => $this->distribusi->pengajuan->nama_pengaju,
            'message' => 'Distribusi ' . $this->distribusi->pengajuan->nama_pengaju . ' distribusi telah selesai dilaksanakan',

        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'distribusi' => $this->distribusi->id,
            'pengajuan' => $this->distribusi->pengajuan->nama_pengaju,
            'message' => 'Distribusi ' . $this->distribusi->pengajuan->nama_pengaju . ' distribusi telah selesai dilaksanakan',

        ];
    }
}
