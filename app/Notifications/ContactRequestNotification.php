<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ContactRequest;
use Illuminate\Support\HtmlString;

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
                    ->subject('EZCONNECT - New connection added')
                    ->greeting('Dear '.$notifiable->name.'!')
                    ->line('We are delighted to inform you that a new connection has been successfully added to your profile.')
                    ->line('Please find the details of the new connection below:')
                    ->line(new HtmlString('<b>Name:</b> '.$this->contactRequest->name .'<br>'
                        .'<b>Email</b>: '.$this->contactRequest->email .'<br>'
                        .'<b>Phone</b>: '.$this->contactRequest->phone .'<br>'
                        .($this->contactRequest->company_name ? '<b>Company Name</b>: '.$this->contactRequest->company_name .'<br>' : '')
                        .($this->contactRequest->title ? '<b>Title</b>: '.$this->contactRequest->title .'<br>' : '')
                        .($this->contactRequest->message ? '<b>Message</b>: '.$this->contactRequest->message .'<br>' : '')))
                    ->line('Thank you for using our application!')
                    ->line(new HtmlString('Not interested? Manage your preferences <a href="'.route('profile.edit').'">here</a>'));
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
