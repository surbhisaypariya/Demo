<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function location()
    {
        return $this->belongsToMany(Location::class,'shipment_location','shipment_id','location_id');
    }
    
    public function carrier()
    {
        return $this->belongsToMany(Carrier::class,'shipment_carrier','shipment_id','carrier_id');
    }
    
    public function method()
    {
        return $this->belongsToMany(Method::class,'shipment_method','shipment_id','method_id');
    }
    
    public function comment()
    {
        return $this->belongsToMany(Comment::class,'shipment_comments','shipment_id','comment_id');
    }
    
    public function organization()
    {
        return $this->belongsToMany(Organization::class,'shipment_organization','shipment_id','organization_id');
    }
}
