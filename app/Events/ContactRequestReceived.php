<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactRequest;
use App\Models\User;

class ContactRequestReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public ContactRequest $contactRequest;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, ContactRequest $contactRequest)
    {
        $this->user = $user;
        $this->contactRequest = $contactRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
