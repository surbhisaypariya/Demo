<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboundItem_History extends Model
{
    use HasFactory;
    protected $table = "inbound_history";
    protected $fillable = ['product_id',
    'inbounditem_id',
    'old_aisle',
    'new_aisle',
    'old_pallet_id',
    'new_pallet_id',
    'old_unit_value',
    'new_unit_value',
    'old_expiry_date',
    'new_expiry_date',
    'old_donation_reference',
    'new_donation_reference',
    'old_allocation',
    'new_allocation',
    'old_number_of_unit',
    'new_number_of_unit',
    'old_total_no_treatment',
    'new_total_no_treatment',
    'old_batch',
    'new_batch',
    'old_batch_extension',
    'new_batch_extension',
    'old_fmd',
    'new_fmd',
    'old_total_value',
    'new_total_value',
    'user_id'
];
}
