<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ContactRequest;
use Illuminate\Http\Response as HttpResponse;

class ContactRequestsController extends Controller
{
    public function index()
    {
        // Handle index request
        return Inertia::render('ContactRequests/Index');
    }

    public function allRequests(Request $request)
    {
        return auth()->user()->contactRequests()->when(
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

    public function create()
    {
        // Handle create request
    }

    public function store(Request $request)
    {
        // Handle store request
    }

    public function show($id)
    {
        // Handle show request
    }

    public function edit($id)
    {
        // Handle edit request
    }

    public function update(Request $request, $id)
    {
        // Handle update request
    }

    public function destroy($id)
    {
        // Handle destroy request
        ContactRequest::findOrFail($id)->delete();
        return request()->wantsJson()
                    ? new HttpResponse(['message' => 'Contact request deleted.', 'success' => true], 200)
                    : redirect()->route('contact-requests.index');
    }
}
