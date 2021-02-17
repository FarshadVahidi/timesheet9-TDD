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
        if($user)
            return Redirect()->route('/login');
    }

}
