<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attatchment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsToMany(Product::class,'attatchment_product','attatchment_id','product_id');
    }
}
