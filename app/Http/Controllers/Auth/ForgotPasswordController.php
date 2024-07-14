<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
        ]);

        $otp = rand(100000, 999999);
        $request->session()->put('otp', $otp);
        $request->session()->put('email', $request->email);

        Mail::to($request->email)->send(new SendOtpMail($otp));

        return redirect()->route('verify-otp.form');
    }

    public function showVerifyOtpForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        if ($request->otp == $request->session()->get('otp')) {
            return redirect()->route('reset-password.form');
        } else {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', Auth::user()->email)->first();
        $user->password = $request->password;
        $user->save();

        return redirect()->route('home')->with('status', 'Password reset successfully');
    }
}
