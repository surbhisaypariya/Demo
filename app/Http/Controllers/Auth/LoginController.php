<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    protected $maxAttempts = 5; 
    protected $decayMinutes = 1; 
    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function authanticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $input = $request->all();
        $users = User::all();
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if ($this->hasTooManyLoginAttempts($request))
        {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        
        $this->incrementLoginAttempts($request);
        
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {   
            return view('home'); 
        }
        else{
            return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
        }
    }
}
