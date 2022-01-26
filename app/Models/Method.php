<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function carrier()
    {
        return $this->belongsToMany(Carrier::class,'carrier_method','method_id','carrier_id');
    }
    
    public function shipment()
    {
        return $this->belongsToMany(Shipment::class,'shipment_method','method_id','shipment_id');
    }
}
