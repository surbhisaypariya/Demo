<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{    
    protected $guarded = [];
    
    public function method()
    {
        return $this->belongsToMany(Method::class,'carrier_method','carrier_id','method_id');
    }
    
    public function shipment()
    {
        return $this->belongsToMany(Shipment::class,'shipment_carrier','carrier_id','shipment_id');
    }
}
