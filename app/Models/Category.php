<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function children()
    {
        return $this->hasMany('App\Models\Category','parent_id')->latest();
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Category','parent_id');
    }
    
    public function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }
    
    public function getParentsAttribute()
    {
        $parents = collect([]);
        
        $parent = $this->parent;
        
        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
        return $parents;
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class,'categorie_product','categorie_id','product_id');
    }

    public function scopeFilter($query,$category)
    {
        return $query->whereRaw('LOWER(category) =?',[strtolower($category)]);
    }
}
