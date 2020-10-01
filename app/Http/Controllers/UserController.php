<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class UserController extends Controller
{
    public function loginIndex()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('user.login');
        }
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials, true)) {
            return redirect()->back()->withInput($request->except('password'))->withErrors('Wrong email and/or password');
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.login');
    }
}
