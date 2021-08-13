<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->has('remember_me'))) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withInput()->withErrors([
            'username' => 'The provided credentials do not match our records.'
        ]);
    }
}
