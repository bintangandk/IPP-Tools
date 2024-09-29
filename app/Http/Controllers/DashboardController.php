<?php

namespace App\Http\Controllers;

use App\Models\RegisteredPartner;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count_registered_partner = RegisteredPartner::count();
        $count_user = User::count();
        return view('page.dashboard')->with([
            'title' => 'IPP Tools - Dashboard',
            'count_user' => $count_user,
            'count_registered_partner' => $count_registered_partner
        ]);
    }
}
