<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConnectionsController extends Controller
{
    public function index()
    {
        // Handle index request
        return Inertia::render('Connections/Index');
    }

    public function create()
    {
        // Your code here
    }

    public function store(Request $request)
    {
        // Your code here
    }

    public function show($id)
    {
        // Your code here
    }

    public function edit($id)
    {
        // Your code here
    }

    public function update(Request $request, $id)
    {
        // Your code here
    }

    public function destroy($id)
    {
        // Your code here
    }
}
