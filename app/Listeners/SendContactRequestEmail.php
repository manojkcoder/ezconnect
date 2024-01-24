<?php

namespace App\Listeners;

use App\Events\ContactRequestReceived;
use App\Mail\ContactRequestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendContactRequestEmail implements ShouldQueue
{
    
    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(ContactRequestReceived $event)
    {
        $event->user->sendContactRequestNotification($event->contactRequest);
    }
}