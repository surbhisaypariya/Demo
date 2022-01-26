<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbound_item extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function product()
    {
        return $this->belongsToMany(Product::class,'inbound_product','inbound_id','product_id');
    }
}
