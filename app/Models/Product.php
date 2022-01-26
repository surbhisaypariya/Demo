<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsToMany(Category::class,'categorie_product','product_id','categorie_id');
    }
    
    public function attatchment()
    {
        return $this->belongsToMany(Attatchment::class,'attatchment_product','product_id','attatchment_id');
    }
    
    public function inbound()
    {
        return $this->belongsToMany(Product::class,'inbound_product','product_id','inbound_id');
    }
    
}
