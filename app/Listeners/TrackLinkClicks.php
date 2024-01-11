<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LinkClick;

class TrackLinkClicks implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $network_id = $event->network_id;
        // find the network (pivot table user_social_networks) by id
        $network = \DB::table('user_social_networks')->find($network_id);
        if($network){
            $user_id = $network->user_id;
            // find existing clicks from the same ip address and user agent in the last 30 mins, if any exist, ignore the click, else add it to database
            $click = LinkClick::where('ip_address', request()->ip())->where('user_agent', request()->userAgent())->where('user_social_network_id', $network_id)->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(30))->first();
            if(!$click){
                $click = new LinkClick();
                $click->user_id = $user_id;
                $click->user_social_network_id = $network_id;
                $click->ip_address = request()->ip();
                $click->user_agent = request()->userAgent();
                $click->referer = request()->headers->get('referer');
                $click->save();
            }
        }

    }
}
