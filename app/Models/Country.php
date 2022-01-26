<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function country_group()
    {
        return $this->belongsToMany(Country_Group::class,'country_country_group','country_id','country_group_id');
    }
    
    public function organization()
    {
        return $this->belongsToMany(Organization::class,'country_organization','country_id','organization_id');
    }
    
    public function donation()
    {
        return $this->belongsToMany(Donation::class,'donation_country','country_id','donation_id');
    }
    
}
