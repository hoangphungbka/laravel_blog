<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate

        $user = User::query()->create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
        ]);

        $customer = $user->customer()->create(
            $request->only('name', 'email', 'phone', 'address')
        );

        // Send mail verify

        return redirect()->route('login')
            ->with('success', 'Register successfully. Please verify your email.');
    }
}
