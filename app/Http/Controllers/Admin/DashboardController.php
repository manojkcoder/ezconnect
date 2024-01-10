<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Events\UserCreated;
use Illuminate\Http\Response as HttpResponse;

class DashboardController extends Controller
{
    /**
     * 
     * Display the dashboard view.
     * 
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Users/Index');
    }

    /**
     * 
     * Display the users view.
     * 
     */
    public function addUser(Request $request)
    {
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * 
     * Display the users edit view.
     * 
     */
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('Admin/Users/Edit', compact('user'));
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
        ]);

        if($request->has('welcome_email') && $request->welcome_email == true) {
            $token = app('auth.password.broker')->createToken($user);
            event(new UserCreated($user, $token));
        }

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User created.'], 200)
                    : redirect()->route('admin.dashboard');
    }

    /**
     * 
     * Display the users view.
     * 
     */
    public function allUsers(Request $request)
    {
        return User::when(
            $request->search,
            function ($query, $search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');
            }
        )->when(
            $request->sortBy,
            function ($query, $sortBy) use ($request) {
                $query->orderBy(is_array($sortBy) ? $sortBy[0] : $sortBy, strtoupper(is_array($request->sortType) ? $request->sortType[0] : $request->sortType));
            },
        )
        ->paginate($request->rowsPerPage, ['*'], 'page', $request->page);
    }
}
