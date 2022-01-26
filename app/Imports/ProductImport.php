<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Auth;

class ProductImport implements ToModel ,WithValidation ,WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function rules():array{
        return [
            'product_code' => 'required | unique:products',
            'manufacture' => 'required',
            'brand_name' => 'required',
            'generic_name' => 'required',
            'formulation' => 'required',
            'unit_size' => 'required',
            'unit_of_sale' => 'required',
            'units_per_case' => 'required | numeric',
            'label_language' => 'required',
            'cold_chain' => 'required',
            'controlled_drugs' => 'required',
            'serialized_stock' => 'required',
            'dangerous_goods' => 'required',
            'status' => 'required | numeric',
            'standard_cost' => 'nullable|numeric',
            'extended_cost' => 'nullable|numeric',
            'tax_val' => 'nullable|numeric',
            'fair_market_val' => 'nullable|numeric',
        ];
    }
    
    
    public function model(array $row)
    {
        $user_id = Auth::user('id');
        $products = new Product;
        $products->product_code = $row['product_code'];
        $products->manufacture = $row['manufacture'];
        $products->brand_name = $row['brand_name'];
        $products->generic_name = $row['generic_name'];
        $products->formulation = $row['formulation'];
        $products->description = $row['description'];
        $products->unit_size = $row['unit_size'];
        $products->unit_of_sale = $row['unit_of_sale'];
        $products->treatment = $row['treatment'];
        $products->units_per_case = $row['units_per_case'];
        $products->label_language = $row['label_language'];
        $products->limits = $row['limits'];
        $products->original_approved = $row['original_approved'];
        $products->standard_cost = $row['standard_cost'];
        $products->tax_val = $row['tax_val'];
        $products->product_licence = $row['product_licence'];
        $products->hs_code = $row['hs_code'];
        $products->intended_market = $row['intended_market'];
        $products->extended_cost = $row['extended_cost'];
        $products->fair_market_val = $row['fair_market_val'];
        $products->country_manufecture = $row['country_manufecture'];
        $products->storage_req = $row['storage_req'];
        $products->cold_chain = $row['cold_chain'];
        $products->controlled_drugs = $row['controlled_drugs'];
        $products->serialized_stock = $row['serialized_stock'];
        $products->dangerous_goods = $row['dangerous_goods'];
        $products->comments = $row['comments'];
        $products->status = $row['status'];
        $products->user_id = $user_id->id;
        $products->save();
        $category = Category::all();
        
        $categories = array([
            $row['categorie_1'],
            $row['categorie_2'],
            $row['categorie_3'],
            ]) ;
            
            $categorie = category::whereIn('category',$categories[0])->pluck('id','parent_id');
            $product_id = $products->id;
            $products->category()->attach($categorie);
            
            return $products;    
        }
    }
    