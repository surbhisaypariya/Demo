<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function country()
    {
        return $this->belongsToMany(Country::class,'donation_country','donation_id','country_id');
    }
    
    public function organization()
    {
        return $this->belongsToMany(Organization::class,'donation_organization','donation_id','organization_id');
    }
    
    public function region()
    {
        return $this->belongsToMany(Region::class,'donation_region','donation_id','region_id');
    }
}
