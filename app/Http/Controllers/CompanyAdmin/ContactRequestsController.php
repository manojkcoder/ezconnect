<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ContactRequest;
use Illuminate\Http\Response as HttpResponse;
use App\Models\User;

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
        return Inertia::render('CompanyAdmin/ContactRequests/Index');
    }

    /**
     * Get all contact requests for the company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    

    // public function allRequests(Request $request)
    // {
    //     // Step 1: Get IDs of users in the company
    //     $userIds = User::where('company_id', auth()->user()->id)->pluck('id');
        
    //     // Step 2: Fetch contact requests for these user IDs and include user information
    //     return ContactRequest::with('user') // Eager load the user relationship
    //         ->whereIn('user_id', $userIds) // Filter contact requests by user IDs
    //         ->when(
    //             $request->search,
    //             function ($query, $search) {
    //                 $query->where('name', 'LIKE', '%'.$search.'%')
    //                     ->orWhere('email', 'LIKE', '%'.$search.'%');
    //             }
    //         )
    //         ->when(
    //             $request->sortBy,
    //             function ($query, $sortBy) use ($request) {
    //                 $query->orderBy(
    //                     is_array($sortBy) ? $sortBy[0] : $sortBy,
    //                     strtoupper(is_array($request->sortType) ? $request->sortType[0] : $request->sortType)
    //                 );
    //             }
    //         )
    //         ->paginate($request->rowsPerPage, ['*'], 'page', $request->page);
    // }
   
    public function allRequests(Request $request)
    {
        // Get IDs of users in the company
        $userIds = User::where('company_id', auth()->user()->id)->pluck('id')->toArray();
    
        // Determine which user IDs to use based on the `user_id` parameter
        $filteredUserIds = $request->user_id === 'all-user' || $request->user_id === null
            ? $userIds // Use all user IDs
            : [$request->user_id]; // Use single user ID in an array
    
        // Ensure the filtered user IDs only include valid IDs
        $filteredUserIds = array_intersect($userIds, $filteredUserIds);
    
        // Fetch contact requests based on the filtered user IDs and include user information
        return ContactRequest::with('user') // Eager load the user relationship
            ->whereIn('user_id', $filteredUserIds) // Filter contact requests by the filtered user IDs
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                }
            )
            ->when(
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
        ContactRequest::where('company_id', auth()->user()->company_id) // Ensure the contact request belongs to the company
            ->findOrFail($id)
            ->delete();
        return request()->wantsJson()
                    ? new HttpResponse(['message' => 'Contact deleted.', 'success' => true], 200)
                    : redirect()->route('companyAdmin.contact-requests.index');
    }

    /**
     * Export all contact requests for the company as a CSV file.
     *
     * @return void
     */
    // public function exportRequests()
    // {
    //     return "fsdf";
    //     // Handle export requests
    //     $data = ContactRequest::where('company_id', auth()->user()->company_id)->get();
    //     header('Content-Type: text/csv');
    //     header('Content-Disposition: attachment; filename="ContactRequests.csv"');

    //     $data = $data->toArray();    
    //     $out = fopen('php://output', 'w');
    //     $headers = ['Name', 'Email', 'Phone', 'Title', 'Company Name'];
    //     fputcsv($out, $headers);
    //     foreach($data as $line)
    //     {
    //         fputcsv($out, [
    //             $line['name'],
    //             $line['email'],
    //             $line['phone'],
    //             $line['title'],
    //             $line['company_name'],
    //         ]);
    //     }
    //     fclose($out);
    //     exit;
    // }

    public function exportRequests(Request $request)
    {
        // Get the user IDs based on the `user_id` parameter
         $userIds = User::where('company_id', auth()->user()->id)->pluck('id')->toArray();
        
        // Determine which user IDs to use based on the `user_id` parameter
        $filteredUserIds = $request->user_id === 'all-user' 
            ? $userIds 
            : [$request->user_id]; // Use single user ID in an array
        
        // Fetch contact requests based on the filtered user IDs
        $data = ContactRequest::with('user') // Eager load the user relationship
            ->whereIn('user_id', $filteredUserIds) // Filter contact requests by the filtered user IDs
            ->get();
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="ContactRequests.csv"');
        
        // Create a file pointer connected to the output stream
        $out = fopen('php://output', 'w');
        
        // Write the headers of the CSV file
        $headers = ['Name', 'Email', 'Phone', 'Title', 'Company Name'];
        fputcsv($out, $headers);
        
        // Write the data to the CSV file
        foreach ($data as $line) {
            fputcsv($out, [
                $line->name,
                $line->email,
                $line->phone,
                $line->title,
                $line->company_name,
            ]);
        }
        
        // Close the file pointer
        fclose($out);
        exit;
    }

}
