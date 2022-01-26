<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;

use Illuminate\Http\Request;
use Auth;
use Validator , Hash;
use Illuminate\Validation\Rule;
use Notification;
use App\Notifications\UserActivation;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $id = Auth::User();
        $role = $id->role;
        
        if($role=="super_admin"){
            $users = User::paginate(5);
            
        }
        else if($role=="admin"){
            $users = User::whereIn('role',["customer",'admin'])->paginate(5);
            
        }
        else if($role == "customer"){
            $users = User::whereIn('role',["customer"])->paginate(5);
        }
        
        return view('user.show',compact('users'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $organizations = Organization::where('status','1')->get();
        $data = Auth::user();
        return view('user.create',compact('data','organizations'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users|without_spaces',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'oranizations.*' =>'required',
        ]);
        
        $users = new User;
        $users->firstname = $request->firstname;
        $users->lastname = $request->lastname;
        $users->email = $request->email;
        $users->username = $request->username;
        $users->role = $request->role;
        $users->phone = $request->phone;
        $users->address = $request->address;
        $users->city = $request->city;
        $users->state = $request->state;
        $users->postal_code = $request->postal_code;
        
        $users->activation = 0;
        $isChecked = $request->has('user_status');
        if($isChecked == "true")
        {
            $users->user_status = 1 ;
        }
        else
        {
            $users->user_status = 0;
        }
        
        
        $organizations = $request->oranizations;
        $users->save();
        
        $user_id = $users->id;  
        $users->organization()->attach($organizations);
        
        if(Auth::user())
        {
            return redirect()->route('password_set',[$users->email])->with('success','User Created Successfully!');
        }
        else
        {
            return redirect('login');
        }
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        $organizations = Organization::all();
        $auth_id = Auth::user();
        $auth_role = $auth_id->role;
        $user_role = $user->role;
        
        if(($auth_role == "admin") && ($user_role == "admin" || $user_role == "customer"))
        {
            return view('user.edit',compact('user','user_role','organizations'));
        }
        elseif(($auth_role == "customer") && ($user_role == "customer" ))
        {
            return view('user.edit',compact('user','user_role','organizations'));
        }
        elseif(($auth_role == "super_admin") && ($user_role == "admin" || $user_role == "customer" || $user_role == "super_admin" ))
        {
            return view('user.edit',compact('user','user_role','organizations'));
        }
        else
        {
            return redirect()->route('user.index')->with('error','you can not edit');
        }
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    { 
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);
        
        $user->update([
            "firstname" => $request->get('firstname'),
            "lastname" => $request->get('lastname'),
            "email" => $request->get('email'),
            "username" => $request->get('username'),
            "role" => $request->get('role'),
            "phone" => $request->get('phone'),
            "address" => $request->get('address'),
            "city" => $request->get('city'),
            "state" => $request->get('state'),
            "postal_code" => $request->get('postal_code')
        ]);
        
        $isChecked = $request->has('user_status');
        
        $user_status = ($isChecked == "true") ? '1' : '0';
        
        $user->user_status = $user_status;
        $user->update();
        
        $organizations = $request->oranizations;
        $user->organization()->sync($organizations);
        
        return redirect()->route('user.index')->with('success','Record Updated Successfully');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        
        $auth_id = Auth::id();
        if($auth_id == $user->id)
        {
            return redirect()->route('user.index')->with('error','Sorry you could not delete this record');
        }
        else{
            $user->update(["user_status"=> 0 ]);
            
            return redirect()->route('user.index')->with('warning','Record Deleted Successfully');
        }
    }
    
    public function password_set_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $users = User::where('email',$request->email)->first();
        
        $users->password = Hash::make($request->password);
        $users->activation = 1;
        $users->update();
        return redirect()->route('user.index')->with('success','Password Set Successfully');
    }
    
    public function password_set($email)
    {
        Notification::route('mail',$email)->notify(new UserActivation($email));
        return redirect()->route('user.index')->with('success','Mail Sent Successfully');
        
    }
    
    public function password_setview($email)
    {
        return view('user.set_user_password',compact('email'));
    }
}
