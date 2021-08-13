<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
//use App\Mail\VerifyEmail;
use App\Models\User;
//use Illuminate\Http\Request;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

//use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
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
//        Mail::to($customer->email)->send(new VerifyEmail($customer)); // using mailable class
        Notification::route('mail', $customer->email)->notify(new VerifyEmail());

        return redirect()->route('login')
            ->with('success', 'Register successfully. Please verify your email.');
    }
}
