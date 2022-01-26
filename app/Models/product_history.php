<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_history extends Model
{
    use HasFactory;
    protected $table = "product_history";
    protected $fillable = ['product_id',
                           'product_code_old',
                           'product_code_new',
                           'manufacture_old',
                           'manufacture_new',
                           'brand_name_old',
                           'brand_name_new',
                           'generic_name_old',
                           'generic_name_new',
                           'formulation_old',
                           'formulation_new',
                           'unit_size_old',
                           'unit_size_new',
                           'unit_of_sale_old',
                           'unit_of_sale_new',
                           'units_per_case_old',
                           'units_per_case_new',
                           'label_language_old',
                           'label_language_new',
                           'cold_chain_old',
                           'cold_chain_new',
                           'controlled_drugs_old',
                           'controlled_drugs_new',
                           'serialized_stock_old',
                           'serialized_stock_new',
                           'dangerous_goods_old',
                           'dangerous_goods_new',
                           'comments_old',
                           'comments_new',
                           'status_old',
                           'status_new',
                           'categories_old',
                           'categories_new',
                           'user_id'
                        ];
}
