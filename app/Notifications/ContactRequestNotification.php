<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ContactRequest;

class ContactRequestNotification extends Notification
{
    use Queueable;

    public ContactRequest $contactRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(ContactRequest $contactRequest)
    {
        $this->contactRequest = $contactRequest;
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
                    ->subject(config('app.name').': '.$this->contactRequest->name.' wants to connect with you.')
                    ->greeting('Hello '.$notifiable->name.'!')
                    ->line($this->contactRequest->name.' wants to connect with you.')
                    ->line('Name: '.$this->contactRequest->name)
                    ->line('Email: '.$this->contactRequest->email)
                    ->line('Phone: '.$this->contactRequest->phone)
                    ->lineIf($this->contactRequest->company, 'Company: '.$this->contactRequest->company)
                    ->lineIf($this->contactRequest->title, 'Title: '.$this->contactRequest->title)
                    ->lineIf($this->contactRequest->message, 'Message: '.$this->contactRequest->message)
                    ->line('Thank you for using our application!');
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
