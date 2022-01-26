<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function shipment()
    {
        return $this->belongsToMany(Shipment::class,'shipment_comments','comment_id','shipment_id');
    }
}
