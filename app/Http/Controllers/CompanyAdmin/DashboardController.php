<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\ContactRequest;

use App\Models\ProfileVisit;
use App\Models\LinkClick;
use App\Models\SocialNetwork; 
use App\Models\UserSocialNetwork; 



use App\Events\UserCreated;
use Illuminate\Http\Response as HttpResponse;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index(Request $request)
    {
        return Inertia::render('CompanyAdmin/Users/Index');
    }

    public function dashboard(Request $request)
    {
        // Step 1: Get IDs of users in the company
        $userIds = User::where('company_id', auth()->user()->id)->pluck('id');

        // Step 2: Fetch contact requests for these user IDs
        $contact_requests = ContactRequest::whereIn('user_id', $userIds) // Filter contact requests by user IDs
            ->latest() // Order by the latest
            ->take(5) // Limit to the most recent 5 requests
            ->get();

        $topUsers = User::withCount('contactRequests') // Assuming 'contactRequests' is the relation name
        ->whereIn('id', $userIds) // Filter by company users
        ->orderBy('contact_requests_count', 'desc') // Sort by the number of connections
        ->take(10) // Limit to top 10
        ->get(['id', 'name', 'contact_requests_count']); // Get user ID, name, and connection count


        // Pass the data to the Inertia view
        // return Inertia::render('Dashboard-Company', compact('contact_requests'));
        return Inertia::render('Dashboard-Company', [
            'contact_requests' => $contact_requests,
            'topUsers' => $topUsers,
        ]);
    }


    /**
     * Display the users view.
     */
    public function addUser(Request $request)
    {
        // return "add comapny user";
        return Inertia::render('CompanyAdmin/Users/Create');
    }

    /**
     * Display the users edit view.
     */
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('CompanyAdmin/Users/Edit', compact('user'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(rand()),
            'company_id' => auth()->user()->id, 
        ]);
        // if($request->has('welcome_email') && $request->welcome_email == true) {
        //     $token = app('auth.password.broker')->createToken($user);
        //     event(new UserCreated($user, $token));
        // }
        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User created.'], 200)
                    : redirect()->route('companyAdmin.dashboard');
    }
    
    public function store(Request $request)
    {
        // dd($request);
        // return $request;
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'company_id' => ['required'], // Ensure the company_id is valid
            // , 'exists:companies,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'password' => bcrypt(rand()),
        ]);

        if ($request->has('welcome_email') && $request->welcome_email == true) {
            $token = app('auth.password.broker')->createToken($user);
            event(new UserCreated($user, $token));
        }

        return $request->wantsJson()
            ? new HttpResponse(['message' => 'User created.'], 200)
            : redirect()->route('companyadmin.dashboard');
    }


    public function allUsers(Request $request)
    {
        return User::where('company_id', auth()->user()->id) // Only fetch users from the same company
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                }
            )->when(
                $request->sortBy,
                function ($query, $sortBy) use ($request) {
                    $query->orderBy(
                        is_array($sortBy) ? $sortBy[0] : $sortBy, 
                        strtoupper(is_array($request->sortType) ? $request->sortType[0] : $request->sortType)
                    );
                }
            )
            ->paginate($request->rowsPerPage, ['*'], 'page', $request->page);
    }


    public function toggleBlockStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User updated.', 'success' => true], 200)
                    : redirect()->route('companyAdmin.dashboard');
    }

    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update($request->all());

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User updated.', 'success' => true], 200)
                    : redirect()->route('companyAdmin.dashboard');
    }

    public function destroyUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User deleted.', 'success' => true], 200)
                    : redirect()->route('companyAdmin.dashboard');
    }

    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }

    public function getUsers()
    {
        // Get users of the authenticated user's company
        $users = User::where('company_id', auth()->user()->id)->get(['id', 'name']);

        return response()->json($users);
    }

    public function getStats(Request $request)
    {
        // Define the date ranges based on the requested time period
        switch ($request->time_period) {
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

        // Step 1: Get IDs of users in the company
       // $userIds = User::where('company_id', auth()->user()->id)->pluck('id');
       $userIds = [];
        $userName = $request->input('user_name');

        if ($userName === 'all-user') {
            // Get IDs of all users in the company
            $userIds = User::where('company_id', auth()->user()->id)->pluck('id');
        } else {
            // Get the specific user ID
            $userIds = [$userName];
        }

        $social_networks = UserSocialNetwork::whereIn('user_id', $userIds) // Filter by user IDs
        ->with('socialNetwork') // Eager load socialNetwork relation if needed
        ->withCount(['clicks' => function ($q) use ($start_date, $end_date) {
            $q->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        }])
        ->orderBy('clicks_count', 'desc') // Order by clicks_count in descending order
        ->get()
        ->sortByDesc('clicks_count')
        ->values()
        ->all();    

        // Step 3: Get visit and click statistics
        $visits = ProfileVisit::whereIn('user_id', $userIds)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->count();

        $previous_visits = ProfileVisit::whereIn('user_id', $userIds)
            ->whereDate('created_at', '>=', $previous_start_date)
            ->whereDate('created_at', '<=', $previous_end_date)
            ->count();

        $clicks = LinkClick::whereIn('user_id', $userIds)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->count();

        $previous_clicks = LinkClick::whereIn('user_id', $userIds)
            ->whereDate('created_at', '>=', $previous_start_date)
            ->whereDate('created_at', '<=', $previous_end_date)
            ->count();

        // Calculate the tap-through rate
        $tap_through_rate = number_format($visits > 0 ? round(($clicks / $visits) * 100, 2) : 0);

        // 'social_networks',
        return compact( 'social_networks', 'visits', 'previous_visits', 'clicks', 'previous_clicks', 'tap_through_rate');
    }

}
