<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyImportController extends Controller
{
    public function index()
    {
        // Return your policy import view here
        return view('admin.policies.import');
    }

    public function store(Request $request)
    {
        // Handle the policy import logic here
    }
}