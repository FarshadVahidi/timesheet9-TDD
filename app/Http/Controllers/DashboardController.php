<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('user'))
           return view('user.dashboard');
        elseif($user->hasRole('administrator'))
            return view('admin.dashboard');
        elseif($user->hasRole('superadministrator'))
            return view('super.dashboard');
        else
            return redirect('/login');
    }

}
