<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Register_customer;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;

class CustomerPasswordController extends Controller
{
    /**
     * Set a password from the dashboard while signed in.
     *
     * Accounts created at checkout are still on a random password their owner has
     * never seen, so requiring the current password would lock them out of ever
     * setting one. They prove ownership by holding the session instead. Everyone
     * else must confirm their existing password.
     */
    public function store(Request $request)
    {
        /** @var Register_customer $login */
        $login = Auth::guard('customer')->user();

        $rules = ['password' => ['required', 'confirmed', PasswordRule::defaults()]];

        if (!$login->needsPassword()) {
            $rules['current_password'] = ['required', 'string'];
        }

        $request->validate($rules, [
            'current_password.required' => 'Enter your current password.',
            'password.required' => 'Enter a new password.',
            'password.confirmed' => 'The two passwords do not match.',
        ]);

        if (!$login->needsPassword()
            && !Hash::check($request->input('current_password'), $login->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'That is not your current password.',
            ]);
        }

        $login->forceFill([
            'password' => Hash::make($request->input('password')),
            'password_set_at' => now(),
        ])->save();

        return redirect()->route('customer.dashboard')->with('success', 'Your password has been saved.');
    }

    /**
     * Show the form behind an emailed set/reset link.
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('frontend.dashboard.set-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Complete the emailed set/reset link.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ], [
            'password.confirmed' => 'The two passwords do not match.',
        ]);

        $status = Password::broker('customers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Register_customer $login, string $password) {
                $login->forceFill([
                    'password' => Hash::make($password),
                    'password_set_at' => now(),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($login));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages(['email' => [trans($status)]]);
        }

        return redirect()->route('customer.dashboard')->with('success', 'Your password has been saved. Please log in.');
    }

    /**
     * Re-send the set/reset link to the signed-in customer's own email.
     */
    public function sendLink(Request $request)
    {
        $login = Auth::guard('customer')->user();

        if (!$login->email) {
            return redirect()->back()->with('danger', 'Your account has no email address, so we cannot send you a link. Set a password below instead.');
        }

        Password::broker('customers')->sendResetLink(['email' => $login->email]);

        return redirect()->back()->with('success', 'We have emailed you a link to set your password.');
    }
}
