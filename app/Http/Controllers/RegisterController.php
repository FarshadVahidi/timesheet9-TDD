<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('superadministrator'))
            return view('super.registration');
        else{
            Auth::logout();
            return redirect('/home');
        }


    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $this->validateRequest();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->save();
        $user->attachRole($data['role_id']);

        return back()->with('user_added', 'User added successfully.');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequest(): array
    {
        return request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|string'
        ]);
    }

}
