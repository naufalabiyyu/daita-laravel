<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardProfileController extends Controller
{
    public function index()
    {
        return view('pages.dashboard-profile');
    }
}
