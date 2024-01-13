<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ContactRequest;
use Illuminate\Http\Response as HttpResponse;
use App\Models\ProfileVisit;
use App\Models\LinkClick;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {
        // Handle index request
        $contact_requests = auth()->user()->contactRequests()->take(5)->latest()->get();
        return Inertia::render('Dashboard', compact('contact_requests'));
    }

    public function getStats(Request $request)
    {
        switch($request->time_period){
            case 'today':
                $start_date = now()->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDay()->startOfDay();
                $previous_end_date = now()->subDay()->endOfDay();
                break;
            case 'yesterday':
                $start_date = now()->subDay()->startOfDay();
                $end_date = now()->subDay()->endOfDay();
                $previous_start_date = now()->subDays(2)->startOfDay();
                $previous_end_date = now()->subDays(2)->endOfDay();
                break;
            case 'last_7_days':
                $start_date = now()->subDays(7)->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDays(14)->startOfDay();
                $previous_end_date = now()->subDays(7)->endOfDay();
                break;
            case 'last_30_days':
                $start_date = now()->subDays(30)->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDays(60)->startOfDay();
                $previous_end_date = now()->subDays(30)->endOfDay();
                break;
            case 'last_90_days':
                $start_date = now()->subDays(90)->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDays(180)->startOfDay();
                $previous_end_date = now()->subDays(90)->endOfDay();
                break;
            case 'last_365_days':   
                $start_date = now()->subDays(365)->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDays(730)->startOfDay();
                $previous_end_date = now()->subDays(365)->endOfDay();
                break;
            default:
                $start_date = now()->subDays(3650)->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDays(7300)->startOfDay();
                $previous_end_date = now()->subDays(3650)->endOfDay();
                break;
        }
        // Get user social networks with number of clicks on each link based on the date chosen by user
        $user = $request->user();
        $social_networks = $user->socialNetworks()->with('socialNetwork')->withCount(['clicks' => function($q) use ($start_date, $end_date){
            $q->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }])->orderBy('id', 'desc')->get()->sortByDesc('clicks_count')->values()->all();

        $visits = ProfileVisit::where('user_id', $user->id)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
        $previous_visits = ProfileVisit::where('user_id', $user->id)->whereDate('created_at', '>=', $previous_start_date)->whereDate('created_at', '<=', $previous_end_date)->count();

        $clicks = LinkClick::where('user_id', $user->id)->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->count();
        $previous_clicks = LinkClick::where('user_id', $user->id)->whereDate('created_at', '>=', $previous_start_date)->whereDate('created_at', '<=', $previous_end_date)->count();

        $tap_through_rate = number_format($visits > 0 ? round(($clicks / $visits) * 100, 2) : 0);


        return compact('social_networks', 'visits', 'previous_visits', 'clicks', 'previous_clicks', 'tap_through_rate');

    }
}
