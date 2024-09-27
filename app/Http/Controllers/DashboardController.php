<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('page.dashboard')->with([
            'title' => 'IPP Tools - Dashboard',
        ]);
    }
}
