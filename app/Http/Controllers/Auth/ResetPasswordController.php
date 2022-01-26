<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    
    use ResetsPasswords;
    
    /**
    * Where to redirect users after resetting their password.
    *
    * @var string
    */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function password_email($email)
    {
        $emails = [
            'email' => $email,
        ];
        
        $status = Password::sendResetLink(
            $emails
        );
        
        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }
    
    public function password_update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $users = User::where('email',$request->email)->first();
        
        $users->password = Hash::make($request->password);
        $users->update();
        return back();
    }
}
