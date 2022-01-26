<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country_group extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function country()
    {
        return $this->belongsToMany(Country::class,'country_country_group','country_group_id','country_id');
    }
}
