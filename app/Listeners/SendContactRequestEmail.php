<?php

namespace App\Listeners;

use App\Events\ContactRequestReceived;
use App\Mail\ContactRequestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        Mail::to($event->contactRequest->email)->send(new ContactRequestMail($event->contactRequest));
    }
}