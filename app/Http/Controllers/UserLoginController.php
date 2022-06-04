<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('userLogin', [
            'title' => 'Login',
        ]);
    }


    public function authenticate(Request $request)
    {
        $credentials = $validate = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:5', 'max:255']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        };

        return back()->with('loginError', 'Login Failed!');
    }
}
