<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function organization()
    {
        return $this->belongsToMany(Organization::class,'organization_region','organization_id','region_id');
    }
    
    public function donation()
    {
        return $this->belongsToMany(Donation::class,'donation_region','region_id','donation_id');
    }
}
