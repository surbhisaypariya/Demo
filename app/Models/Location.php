<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsToMany(User::class,'location_user','location_id','user_id');
    }
    
    public function organization()
    {
        return $this->belongsToMany(Organization::class,'location_organization','location_id','organization_id');
    }
    
    public function shipment()
    {
        return $this->belongsToMany(Shipment::class,'shipment_location','location_id','shipment_id');
    }
}
