<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\product_history;
use App\Models\Attatchment;
use Illuminate\Http\Request;
use validate;
use hash;
use DataTables;
use Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use Auth;
use DB;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $category_id = $request->category; 
        $parent_categories = Category::parents()->get();
        $categories = Category::parents()->get();
        $productie = Product::with('category')->get();
        
        if(isset($category_id))
        {
            foreach($productie as $product)
            {
                foreach($product->category as $category)
                {
                    $categories_id = $category->pivot->categorie_id = $category_id;
                    $product_ids = $category->pivot->where('categorie_id',$category_id)->pluck('product_id');                
                }
            }
            $products = Product::whereIn('id',$product_ids)->paginate(5);
            return view('product.show',compact('products','parent_categories','categories','category_id')); 
        }
        else
        {
            $products = Product::with('category')->paginate(5);
            return view('product.show',compact('products','parent_categories','categories')); 
        }
        
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $categories = Category::parents()->get();
        $countries = Country::all();
        // dd($countries);
        return view('product.create',compact('categories','countries'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|unique:products',
            'manufacture' => 'required|string',
            'brand_name' => 'required|string',
            'generic_name' => 'required|string',
            'formulation' => 'required|string',
            'unit_size' => 'required|string|numeric',
            'unit_of_sale' => 'required|string|numeric',
            'units_per_case' => 'required|numeric|string',
            'label_language' => 'required|string',
            'storage_req' =>'required',
        ]);
        
        $user_id = Auth::user('id');
        
        $products = new Product;
        $products->product_code = $request->product_code;
        $products->manufacture = $request->manufacture;
        $products->brand_name = $request->brand_name;
        $products->generic_name = $request->generic_name;
        $products->formulation = $request->formulation;
        $products->description = $request->description;
        $products->unit_size = $request->unit_size;
        $products->unit_of_sale = $request->unit_of_sale;
        $products->treatment = $request->treatment;
        $products->units_per_case = $request->units_per_case;
        $products->label_language = $request->label_language;
        $products->limits = $request->limits;
        $products->original_approved = $request->original_approved;
        $products->standard_cost = $request->standard_cost;
        $products->tax_val = $request->tax_val;
        $products->product_licence = $request->product_licence;
        $products->hs_code = $request->hs_code;
        $products->intended_market = $request->intended_market;
        $products->extended_cost = $request->extended_cost;
        $products->fair_market_val = $request->fair_market_val;
        $products->country_manufecture = $request->country_manufecture;
        $products->storage_req = $request->storage_req;
        $products->cold_chain = $request->cold_chain;
        $products->controlled_drugs = $request->controlled_drugs;
        $products->serialized_stock = $request->serialized_stock;
        $products->dangerous_goods = $request->dangerous_goods;
        $products->comments = $request->comments;
        $products->user_id = $user_id->id;
        
        $isChecked = $request->has('status');
        if($isChecked == "on")
        {
            $products->status = 1;
        }
        else
        {
            $products->status = 0;
        }
        $products->save();
        
        $categories = $request->categorie;
        $category_parent = category::whereIn('id',$categories)->pluck('parent_id');
        
        if(!empty($categories[0]))
        {
            $product_id = $products->id;  
            $products->category()->attach($categories);
        }
        else{
            $products->category()->sync([]);
        }
        
        return redirect()->route('product.index')->with('success','Inserted Successfully');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function show(Product $product)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function edit(Product $product)
    {   
        $categories = Category::parents()->get();
        $products = Product::where('id','=',$product->id)->with('category')->get();
        $product_attatchment=$product->attatchment;
        
        $categories_list = Category::all();
        $countries = Country::all();
        
        $product_histories = product_history::where('product_id',$product->id)->get();
        return view('product.edit',compact('product','products','categories','product_attatchment','product_histories','categories_list','countries'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Product $product)
    {
        $product_categories = $product->category;
        $product_original_categories = $product_categories->pluck('id')->toArray();
        $product_original = $product->getRawOriginal();
        
        $request->validate([
            'product_code' => 'required|unique:products,product_code,'.$product->id,
            'manufacture' => 'required|string',
            'brand_name' => 'required|string',
            'generic_name' => 'required|string',
            'formulation' => 'required|string',
            'unit_size' => 'required|numeric',
            'unit_of_sale' => 'required|string',
            'units_per_case' => 'required|numeric',
            'label_language' => 'required|string',
            'storage_req' =>'required',
        ]);
        
        $product->update([
            "product_code" => $request->get('product_code'),
            "manufacture" => $request->get('manufacture'),
            "brand_name" => $request->get('brand_name'),
            "generic_name" => $request->get('generic_name'),
            "formulation" => $request->get('formulation'),
            "description" => $request->get('description'),
            "unit_size" => $request->get('unit_size'),
            "unit_of_sale" => $request->get('unit_of_sale'),
            "treatment" => $request->get('treatment'),
            "units_per_case" => $request->get('units_per_case'),
            "label_language" => $request->get('label_language'),
            "limits" => $request->get('limits'),
            "original_approved" => $request->get('original_approved'),
            "standard_cost" => $request->get('standard_cost'),
            "tax_val" => $request->get('tax_val'),
            "product_licence" => $request->get('product_licence'),
            "hs_code" => $request->get('hs_code'),
            "intended_market" => $request->get('intended_market'),
            "extended_cost" => $request->get('extended_cost'),
            "fair_market_val" => $request->get('fair_market_val'),
            "country_manufecture" => $request->get('country_manufecture'),
            "storage_req" => $request->get('storage_req'),
            "cold_chain" => $request->get('cold_chain'),
            "controlled_drugs" => $request->get('controlled_drugs'),
            "serialized_stock" => $request->get('serialized_stock'),
            "dangerous_goods" => $request->get('dangerous_goods'),
            "comments" => $request->get('comments'),
        ]);
        $isChecked = $request->has('status');
        
        $product_status = ($isChecked == "true") ? '1' : '0';
        
        $product->status = $product_status;
        $requested_categories = $request->get('categorie');
        $categories = $request->categorie;
        if(!empty($categories[0]))
        {
            $product->category()->sync($categories);
        }
        else{
            $product->category()->sync([]);
        }
        $this->product_history_store($product ,$product_original ,$product_original_categories, $requested_categories );
        
        $product->update();
        
        return redirect()->route('product.index')->with('info','Updated Successfully');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function destroy(Product $product)
    {
        $pro_id = $product->id;
        $product_history = product_history::where('product_id',$pro_id)->get();
        $product_history->each->delete();
        
        $product = Product::where('id',$pro_id)->first();
        $attatchment = $product->attatchment;
        $attatchment->each->delete();
        
        $product->category()->sync([]);
        $product->delete();
        return redirect()->route('product.index')->with('danger','Record Deleted Successfully');
    }
    
    public function importData(Request $request)
    {
        $request->validate([
            "csvfile" => "required",
        ]);
        
        $file = $request->file('csvfile');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        
        //file  validation
        $valid_extension = array('csv','xlsx');
        $maxFileSize = 2097152; 
        
        if(in_array(strtolower($extension),$valid_extension))
        {
            if($fileSize <= $maxFileSize)
            {
                $location = 'uploads';
                $file->move($location,$filename);
                $filepath = $location."/".$filename;
                $file = fopen($filepath,"r");
                
                $importData_arr = array();
                $i = 0;
                
                while(($filedata = fgetcsv($file , 1000 , ",")) !== FALSE)
                {
                    $num = count($filedata);
                    
                    if($i == 0)
                    {
                        $i++;
                        continue;
                    }
                    for($c=0; $c<$num;$c++)
                    {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                $j = 0;
                
                foreach($importData_arr as $importData)
                {
                    $products = new Product;
                    $products->product_code = $importData['0'];
                    $products->manufacture = $importData['1'];
                    $products->brand_name = $importData['2'];
                    $products->generic_name = $importData['3'];
                    $products->formulation = $importData['4'];
                    $products->unit_size = $importData['5'];
                    $products->unit_of_sale = $importData['6'];
                    $products->units_per_case = $importData['7'];
                    $products->label_language = $importData['8'];
                    $products->storage_restriction = $importData['9'];
                    $products->comments = $importData['10'];
                    $products->status = $importData['11'];
                    $products->save();
                    $product_id = $products->id;
                    $categories = array(
                        $importData['12'],
                        $importData['13'],
                        $importData['14'],
                    );
                    $products->category()->attach($categories);
                    
                }
                return redirect()->route('product.index')->with('success','Record Inserted Successfully!');
            }
        }
        else{
            return "Invalid File Extention";
        }
    }
    
    public function importExcelData(Request $request)
    {
        $data = Excel::import(new ProductImport, $request->file('csvfile'));
        
        return redirect()->route('product.index')->with('success','Record Inserted Successfully');
        
    }
    
    public function product_history_store($product ,$product_original, $product_original_categories, $requested_categories )
    {
        $product_changes = $product->getChanges();
        $changes_array=array();
        
        if(count($product_changes) > 0)
        {
            foreach ($product_changes as $key => $value) {
                if($key!= "updated_at")
                {
                    $old_value = !empty($product_original[$key])?$product_original[$key]:"";
                    $new_value = !empty($value)?$value:"";
                    
                    if($old_value != $new_value)
                    {
                        $changes_array[$key."_old"] = $product_original[$key];
                        $changes_array[$key."_new"] = $value;
                    }
                }
            }  
        }          
        $original_categories=$product_original_categories;
        if(!empty($requested_categories) && $product_original_categories){
            $categories_diff_array_1=array_diff($requested_categories,$original_categories);
            $categories_diff_array_2=array_diff($original_categories,$requested_categories);
            
            if(count($categories_diff_array_1)>0 || count($categories_diff_array_2)>0){
                $changes_array["categories_old"]= implode(',',$original_categories);
                $changes_array["categories_new"]= implode(',',$requested_categories) ;
                
            }
        }
        else if(!empty($requested_categories) && $product_original_categories){
            $changes_array["categories_old"]= "";
            $changes_array["categories_new"]= implode(',',$requested_categories);
        }
        else if(empty($requested_categories) && $product_original_categories){
            $changes_array["categories_old"]=implode(',',$original_categories);
            $changes_array["categories_new"]="";
            
        }
        
        if(count($changes_array)>0){
            $changes_array['user_id']=Auth::user()->id;
            $changes_array['product_id']=$product->id;
            product_history::create($changes_array);
        }
    }
    
}