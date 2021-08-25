<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
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

    public function verifyEmail($email): RedirectResponse
    {
        $user = User::query()->whereHas('customer', function (Builder $builder) use ($email) {
            return $builder->where('email', $email);
        })->firstOrFail();

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        return redirect()->route('login')->with('success', 'Verify email successfully. Please login.');
    }
}
