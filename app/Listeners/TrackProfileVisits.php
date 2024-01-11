<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ProfileVisit;

class TrackProfileVisits
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user_id = $event->user_id;
        // find existing visits from the same ip address and user agent in the last 30 mins, if any exist, ignore the visit, else add it to database
        $visit = ProfileVisit::where('ip_address', request()->ip())->where('user_agent', request()->userAgent())->where('user_id', $user_id)->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(30))->first();
        if(!$visit){
            $visit = new ProfileVisit();
            $visit->user_id = $user_id;
            $visit->ip_address = request()->ip();
            $visit->user_agent = request()->userAgent();
            $visit->referer = request()->headers->get('referer');
            $visit->save();
        }

    }
}
