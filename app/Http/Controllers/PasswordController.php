<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class PasswordController extends Controller
{
    public function sendMailForgot(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $customer = Customer::with('user')->where($request->only('email'))->first();

        if (is_null($customer) || !$customer->user->hasVerifiedEmail()) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => trans('passwords.user')]);
        }

        Notification::route('mail', $customer->email)->notify(new ResetPasswordNotification());

        return back()->with('status', trans('passwords.sent'));
    }

    public function resetPassword(Request $request, string $email): RedirectResponse
    {
        $request->validate(['password' => 'required|min:8|confirmed']);

        $customer = Customer::with('user')->where('email', $email)->first();

        $customer->user->update(['password' => Hash::make($request->input('password'))]);

        return redirect()->route('login');
    }
}
