<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function region()
    {
        return $this->belongsToMany(Region::class,'organization_region','organization_id','region_id');
    }
    
    public function country()
    {
        return $this->belongsToMany(Country::class,'country_organization','organization_id','country_id');
    }
    
    public function user()
    {
        return $this->belongsToMany(User::class,'organization_user','organization_id','user_id');
    }
    
    public function location()
    {
        return $this->belongsToMany(Location::class,'location_user','location_id','user_id');
    }
    
    public function donation()
    {
        return $this->belongsToMany(Donation::class,'donation_organization','organization_id','donation_id');
    }
    
    public function shipment()
    {
        return $this->belongsToMany(Shipment::class,'shipment_organization','organization_id','shipment_id');
    }
}
