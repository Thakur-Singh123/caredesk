<?php

namespace App\Http\Controllers\FI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Function for show dashboard
    public function dashboard() {
        return view('fi.dashboard');
    }
}
