<?php

namespace App\Notifications;

use App\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DocumentPublished extends Notification {
    
    use Queueable;
    public $document;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('More Updates from '.config('app.name'))
            ->subject('New contents')
            ->line('A new ' . $this->document->type
                . ' of ' . $this->document->department->name
                . ' is published.')
            ->line('To see it now click on given link.')
            ->action('Browse', url('/browse/' . $this->document->file))
            ->line('Thank you for using our service!');
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
