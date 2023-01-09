<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function inlog()
    {
        return view("Auth.inlog");
    }


    public function inlogPost()
    {
        $credentials =  request()->validate([
            'email' => ["required", "email"],
            'password' => ['required']
        ]);

        session()->flush();
        if (!Auth::attempt($credentials)) return redirect()->route('login');
        return redirect()->route('home');
    }

    public function signUp()
    {
        return view('Auth.signUp');
    }


    public function signUpPost()
    {

        $data = request()->validate([
            'name' => ['required'],
            'email' => ["required", "email", "unique:users,email"],
            'password' => ['required', 'min:8', 'max:64', 'same:confirm_password'],
            // 'confirm_password' => ['required']
        ]);


        $data['password'] = Hash::make($data['password']);

        session()->flush();
        $user = User::create($data);
        if (!Auth::login($user)) return redirect()->route('login');
        return redirect('/');
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();

        return redirect('/');
    }
}
