<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword as ResetPassword;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var string[]
    */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'username',
        'role',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'user_status',
        'password',
    ];
        
    public function sendPasswordResetNotification($token)
    {
        $request = request();
        $this->notify(new ResetPassword($token,$request));
        return redirect()->back()->with('info','Email sent successfully');
    }
    
    public function routeNotificationForMail()
    {
        return $this->email;
    }
    
    
    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function organization()
    {
        return $this->belongsToMany(User::class,'organization_user','user_id','organization_id');
    }
    
    public function location()
    {
        return $this->belongsToMany(Location::class,'location_user','user_id','location_id');
    }
}
