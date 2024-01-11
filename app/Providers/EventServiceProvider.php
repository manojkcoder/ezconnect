<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserCreated;
use App\Listeners\SendWelcomeEmail;
use App\Events\ContactRequestReceived;
use App\Listeners\SendContactRequestEmail;
use App\Events\LinkClicked;
use App\Listeners\TrackLinkClicks;
use App\Events\ProfileVisited;
use App\Listeners\TrackProfileVisits;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        UserCreated::class => [
            SendWelcomeEmail::class,
        ],
        ContactRequestReceived::class => [
            SendContactRequestEmail::class,
        ],
        LinkClicked::class => [
            TrackLinkClicks::class,
        ],
        ProfileVisited::class => [
            TrackProfileVisits::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
