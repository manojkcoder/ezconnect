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
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index(Request $request){
        return Inertia::render('CompanyAdmin/Users/Index');
    }
    public function dashboard(Request $request){
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


    public function allUsers(Request $request){
        $users = User::where('company_id',auth()->user()->id)->when($request->search,function($query,$search){
            $query->where('name','LIKE','%' . $search . '%')->orWhere('email','LIKE','%' . $search . '%');
        })->when($request->sortBy,function($query,$sortBy) use ($request){
            $query->orderBy(
                is_array($sortBy) ? $sortBy[0] : $sortBy, 
                strtoupper(is_array($request->sortType) ? $request->sortType[0] : $request->sortType)
            );
        })->paginate($request->rowsPerPage,['*'],'page',$request->page);
        $users = tap($users)->transform(function($user){
            $user->contact_requests = ContactRequest::where('user_id',$user->id)->count();
            return $user;
        });
        return $users;
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

    public function getStats(Request $request){
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
            case 'custom_range':
                $start_date = $request->from_date . " 00:00:00";
                $end_date = $request->to_date . " 23:59:59";
                break;
            default:
                $start_date = now()->subDays(3650)->startOfDay();
                $end_date = now()->endOfDay();
                $previous_start_date = now()->subDays(7300)->startOfDay();
                $previous_end_date = now()->subDays(3650)->endOfDay();
                break;
        }
        // Step 1: Get IDs of users in the company
        $userIds = [];
        $userName = $request->input('user_name');
        if($userName === 'all-user'){
            $userIds = User::where('company_id',auth()->user()->id)->pluck('id');
        }else{
            $userIds = [$userName];
        }
        $social_networks = UserSocialNetwork::whereIn('user_id',$userIds)->with('socialNetwork')->withCount(['clicks' => function($q) use ($start_date,$end_date){
            $q->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
        }])->orderBy('clicks_count','desc')->get()->sortByDesc('clicks_count')->values()->all();

        // Step 3: Get visit and click statistics
        $visits = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->count();
        $clicks = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->count();
        if($request->time_period == "custom_range"){
            $previous_visits = 0;
            $previous_clicks = 0;
        }else{
            $previous_visits = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$previous_start_date)->whereDate('created_at','<=',$previous_end_date)->count();
            $previous_clicks = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$previous_start_date)->whereDate('created_at','<=',$previous_end_date)->count();
        }
        $contactRequest = ContactRequest::whereIn('user_id',$userIds)->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->count();

        // Calculate the tap-through rate
        $tap_through_rate = number_format($visits > 0 ? round(($clicks / $visits) * 100,2) : 0);


        $chartLabels = [];
        $viewsChartData = [];
        $linkChartData = [];
        $contactsChartData = [];
        if($request->time_period == "today" || $request->time_period == "yesterday" || $request->time_period == "last_7_days"){
            for($i = 6;$i>=0;$i--){
                $chartLabels[] = now()->subDay($i)->format("D");
                $sDate = now()->subDay($i)->startOfDay();
                $eDate = now()->subDay($i)->endOfDay();
                $viewsChartData[] = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $linkChartData[] = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $contactsChartData[] = ContactRequest::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
            }
        }else if($request->time_period == "last_30_days"){
            for($i = 29;$i>=0;$i--){
                $chartLabels[] = now()->subDay($i)->format("d M");
                $sDate = now()->subDay($i)->startOfDay();
                $eDate = now()->subDay($i)->endOfDay();
                $viewsChartData[] = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $linkChartData[] = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $contactsChartData[] = ContactRequest::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
            }
        }else if($request->time_period == "last_90_days"){
            for($i = 89;$i>=0;$i--){
                $chartLabels[] = now()->subDay($i)->format("d M");
                $sDate = now()->subDay($i)->startOfDay();
                $eDate = now()->subDay($i)->endOfDay();
                $viewsChartData[] = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $linkChartData[] = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $contactsChartData[] = ContactRequest::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
            }
        }else if($request->time_period == "custom_range"){
            $sDate = $request->from_date . " 00:00:00";
            $endDate = $request->to_date . " 23:59:59";
            while(strtotime($sDate) < strtotime($endDate)){
                $chartLabels[] = Carbon::parse($sDate)->format("d M");
                $eDate = Carbon::parse($sDate)->endOfDay();
                $viewsChartData[] = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $linkChartData[] = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $contactsChartData[] = ContactRequest::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $sDate = Carbon::parse($sDate)->addDays(1)->startOfDay();
            }
        }else{
            for($i = 11;$i>=0;$i--){
                $chartLabels[] = now()->subMonth($i)->format("M Y");
                $sDate = now()->subMonth($i)->startOfDay();
                $eDate = now()->subMonth($i)->endOfDay();
                $viewsChartData[] = ProfileVisit::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $linkChartData[] = LinkClick::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
                $contactsChartData[] = ContactRequest::whereIn('user_id',$userIds)->whereDate('created_at','>=',$sDate)->whereDate('created_at','<=',$eDate)->count();
            }
        }
        $chartData = [
            "labels" => $chartLabels,
            "datasets" => [
                ["label" => "Views","backgroundColor" => "#44abac","borderColor" => "#44abac","pointBackgroundColor" => "#177f80","pointBorderColor" => "#177f80","fill" => true,"tension" => 0.2,"data" => $viewsChartData],
                ["label" => "Link Taps","backgroundColor" => "#f87979","borderColor" => "#f87979","pointBackgroundColor" => "#b53d3d","pointBorderColor" => "#b53d3d","fill" => true,"tension" => 0.2,"data" => $linkChartData],
                ["label" => "Contacts","backgroundColor" => "#ffb200","borderColor" => "#ffb200","pointBackgroundColor" => "#c18701","pointBorderColor" => "#c18701","fill" => true,"data" => $contactsChartData]
            ]
        ];
        // 'social_networks',
        return compact( 'social_networks','visits','previous_visits','clicks','previous_clicks','tap_through_rate','contactRequest',"chartData");
    }

}
