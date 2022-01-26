<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjust extends Model
{
    use HasFactory;
    protected $table = "adjusts";
    protected $fillable = ['inbounceitem_id',
    'math_icon',
    'total_unit',
    'units',
    'reason',
    'comments',
    'user_id',
    'adjusted',
    'available',
];
}
