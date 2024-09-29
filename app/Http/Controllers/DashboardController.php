<?php

namespace App\Http\Controllers;

use App\Models\DeletedPartner;
use App\Models\RegisteredPartner;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count_registered_partner = RegisteredPartner::count();
        $count_user = User::count();
        $count_pks = RegisteredPartner::whereNotNull('pks')->count();
        $count_branding = RegisteredPartner::where('branding', 'Done')->count();
        $count_service = RegisteredPartner::where('service', 'Done')->count();
        $count_terminated = DeletedPartner::count();

        return view('page.dashboard')->with([
            'title' => 'IPP Tools - Dashboard',
            'count_user' => $count_user,
            'count_registered_partner' => $count_registered_partner,
            'count_pks' => $count_pks,
            'count_branding' => $count_branding,
            'count_service' => $count_service,
            'count_terminated' => $count_terminated
        ]);
    }
}
