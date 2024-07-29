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
    public function companies(Request $request)
    {
        return Inertia::render('Admin/Users/Company');
    }
    // public function companyUsers(Request $request)
    // {
    //     return Inertia::render('Admin/Users/CompanyUsers');
    // }
    
    public function companyUsers(Request $request, $id)
    {
        return Inertia::render('Admin/Users/CompanyUsers', ['companyId' => $id]);
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
    
    public function addCompany(Request $request)
    {
 
        return Inertia::render('Admin/Users/CreateCompany');
    }
    public function editCompany(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('Admin/Users/EditCompany', compact('user'));
    }
    
    public function companyUsersData(Request $request, $id)
    {
        return User::where('company_id', $id) // Only fetch users from the same company
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

    public function storeCompanyAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'company_admin',
            'company_name' => $request->company_name,
            'password' => bcrypt(rand()),
        ]);

        // if($request->has('welcome_email') && $request->welcome_email == true) {
        //     $token = app('auth.password.broker')->createToken($user);
        //     event(new UserCreated($user, $token));
        // }

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'Company Admin created.'], 200)
                    : redirect()->route('admin.companies');
    }


    /**
     * 
     * Display the users view.
     * 
     */
    public function allUsers(Request $request)
    {
        return User::where('user_type', 'user')->when(
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
    public function allCompany(Request $request)
    {
        // return "dfsd";
        return User::where('user_type', 'company_admin')->when(
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
    

    public function toggleBlockStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User updated.', 'success' => true], 200)
                    : redirect()->route('admin.dashboard');
    }

    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update($request->all());

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User updated.', 'success' => true], 200)
                    : redirect()->route('admin.dashboard');
    }

    public function destroyUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        return $request->wantsJson()
                    ? new HttpResponse(['message' => 'User deleted.', 'success' => true], 200)
                    : redirect()->route('admin.dashboard');
    }
}
