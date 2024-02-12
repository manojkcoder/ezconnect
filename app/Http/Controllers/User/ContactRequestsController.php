<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ContactRequest;
use Illuminate\Http\Response as HttpResponse;

class ContactRequestsController extends Controller
{
    /**
     * Display the contact requests index page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Handle index request
        return Inertia::render('ContactRequests/Index');
    }

    /**
     * Get all contact requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
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

    /**
     * Show the form for creating a new contact request.
     *
     * @return void
     */
    public function create()
    {
        // Handle create request
    }

    /**
     * Store a newly created contact request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        // Handle store request
    }

    /**
     * Display the specified contact request.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        // Handle show request
    }

    /**
     * Show the form for editing the specified contact request.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        // Handle edit request
    }

    /**
     * Update the specified contact request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Handle update request
    }

    /**
     * Remove the specified contact request from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Handle destroy request
        ContactRequest::findOrFail($id)->delete();
        return request()->wantsJson()
                    ? new HttpResponse(['message' => 'Contact deleted.', 'success' => true], 200)
                    : redirect()->route('contact-requests.index');
    }

    /**
     * Export all contact requests as a CSV file.
     *
     * @return void
     */
    public function exportRequests()
    {
        // Handle export requests
        $data = auth()->user()->contactRequests()->get();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Connections.csv"');

        $data = $data->toArray();    
        $out = fopen('php://output', 'w');
        $headers = ['Name', 'Email', 'Phone', 'Title', 'Company Name'];
        fputcsv($out, $headers);
        foreach($data as $line)
        {
            fputcsv($out, [
                $line['name'],
                $line['email'],
                $line['phone'],
                $line['title'],
                $line['company_name'],
            ]);
        }
        fclose($out);
        exit;
    }
}
