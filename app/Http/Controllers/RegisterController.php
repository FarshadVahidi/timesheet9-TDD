<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('superadministrator'))
            return redirect('super.registration');
        else
            return back();
    }
}
