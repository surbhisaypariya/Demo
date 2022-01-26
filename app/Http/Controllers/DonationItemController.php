<?php

namespace App\Http\Controllers;

use App\Models\Donation_item;
use App\Models\Donation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;

class DonationItemController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function donation_item_index($id)
    {
        $donation_id = $id;
        $donation = Donation::where('id',$donation_id)->first();
        $donation_items = Donation_item::where('donation_id',$donation_id)->get();
        $matched = 0;
        $unmatched = 0;
        $error = 0;
        $removed = 0;
        $commited = 0;
        
        
        $match  = Donation_item::where('donation_id',$donation_id)
        ->where('status','1')
        ->where('commit_status','0')
        ->wherehas('product_code',function($query){
            $query->WhereNotNull('manufecturer')
            ->WhereNotNull('brand_name')
            ->WhereNotNull('generic_name')
            ->WhereNotNull('unit_offered')
            ->WhereNotNull('batch_number')
            ->WhereNotNull('expiry_date')
            ->WhereNotNull('location')
            ->WhereNotNull('lable_language')
            ->WhereNotNull('unit_size')
            ->WhereNotNull('unit_of_sale')
            ->WhereNotNull('unit_per_case');
        })->get();   
        
        $err = Donation_item::where('donation_id',$donation_id)
        ->where(function ($query){
            $query->Where('manufecturer',NULL)
            ->orWhere('brand_name',NULL)
            ->orWhere('generic_name',NULL)
            ->orWhere('unit_offered',NULL)
            ->orWhere('batch_number',NULL)
            ->orWhere('expiry_date',NULL)
            ->orWhere('location',NULL)
            ->orWhere('lable_language',NULL)
            ->orWhere('unit_size',NULL)
            ->orWhere('unit_of_sale',NULL)
            ->orWhere('unit_per_case',NULL);
        })
        ->where('status','1')
        ->where('commit_status','0')
        ->get();
        
        $unmatch = Donation_item::whereDoesntHave('product_code')
        ->where('donation_id',$donation_id)
        ->WhereNotNull('manufecturer')
        ->WhereNotNull('brand_name')
        ->WhereNotNull('generic_name')
        ->WhereNotNull('unit_offered')
        ->WhereNotNull('batch_number')
        ->WhereNotNull('expiry_date')
        ->WhereNotNull('location')
        ->WhereNotNull('lable_language')
        ->WhereNotNull('unit_size')
        ->WhereNotNull('unit_of_sale')
        ->WhereNotNull('unit_per_case')
        ->where('status','1')
        ->where('commit_status','0')
        ->get();    
        
        $remove = Donation_item::where('donation_id',$donation_id)->where('status','0')->where('commit_status','0')->get();
        $commit = Donation_item::where('donation_id',$donation_id)->where('commit_status','1')->get();
        
        $matched = count($match);
        $error = count($err);
        $unmatched = count($unmatch);
        $removed = count($remove);
        $commited = count($commit);
        
        return view('donation_item.show',compact('donation','donation_items','matched','unmatched','error','removed','commited'));
    }
    
    public function index(Request $request)
    {   
        
    }
    
    public function update(Request $request, Donation_item $donation_item)
    {
        $request->validate([
            'unit_size' => 'nullable|integer',
        ]);
        
        $donation_item->update([
            'product_code' => $request->get('product_code'),
            'manufecturer' => $request->get('manufecturer'),
            'brand_name' => $request->get('brand_name'),
            'generic_name' => $request->get('generic_name'),
            'unit_offered' => $request->get('unit_offered'),
            'pack_size' => $request->get('pack_size'),
            'unit_pallet' => $request->get('unit_pallet'),
            'pattle_guesstimate' => $request->get('pattle_guesstimate'),
            'batch_number' => $request->get('batch_number'),
            'udi' => $request->get('udi'),
            'location' => $request->get('location'),
            'lable_language' => $request->get('lable_language'),
            'specific_appeal' => $request->get('specific_appeal'),
            'storage_req' => $request->get('storage_req'),
            'formulation' => $request->get('formulation'),
            'unit_size' => $request->get('unit_size'),
            'unit_of_sale' => $request->get('unit_of_sale'),
            'unit_per_case' => $request->get('unit_per_case'),
            'supplier_price_unit' => $request->get('supplier_price_unit'),
            'internal_price_unit' => $request->get('internal_price_unit'),
            'reporting_req' => $request->get('reporting_req'),
            'intended_market' => $request->get('intended_market'),
            'product_licence' => $request->get('product_licence'),
            'information' => $request->get('information'),
            'comments' => $request->get('comments'),
        ]);
        
        $date = $request->date;
        $month = $request->month;
        $year = $request->year;
        
        $expiry_date = $year.'-'.$month.'-'.$date;
        $donation_item->expiry_date = $expiry_date;
        
        if($request->pom == "yes"){
            $donation_item->pom = 1;
        }else{
            $donation_item->pom = 1;
        }
        
        if($request->cold_chain == "yes"){
            $donation_item->cold_chain = 1;
        }else{
            $donation_item->cold_chain = 1;
        }
        
        if($request->controlled_drugs == "yes"){
            $donation_item->controlled_drugs = 1;
        }else{
            $donation_item->controlled_drugs = 1;
        }
        
        if($request->serialize_stock == "yes"){
            $donation_item->serialize_stock = 1;
        }else{
            $donation_item->serialize_stock = 1;
        }
        
        if($request->dangerous_drugs == "yes"){
            $donation_item->dangerous_drugs = 1;
        }else{
            $donation_item->dangerous_drugs = 1;
        }
        $donation_item->update();
        
        $donation_id = $request->donation_id;
        $donation = Donation::where('id',$donation_id)->first();
        $donation_items = Donation_item::where('donation_id',$donation_id)->get();
        
        $matched = 0;
        $unmatched = 0;
        $error = 0;
        $removed = 0;
        $commited = 0;
        
        $match  = Donation_item::where('donation_id',$donation_id)
        ->where('status','1')
        ->where('commit_status','0')
        ->wherehas('product_code',function($query){
            $query->WhereNotNull('manufecturer')
            ->WhereNotNull('brand_name')
            ->WhereNotNull('generic_name')
            ->WhereNotNull('unit_offered')
            ->WhereNotNull('batch_number')
            ->WhereNotNull('expiry_date')
            ->WhereNotNull('location')
            ->WhereNotNull('lable_language')
            ->WhereNotNull('unit_size')
            ->WhereNotNull('unit_of_sale')
            ->WhereNotNull('unit_per_case');
        })->get();
        
        $err = Donation_item::where('donation_id',$donation_id)
        ->where(function ($query){
            $query->Where('manufecturer',NULL)
            ->orWhere('brand_name',NULL)
            ->orWhere('generic_name',NULL)
            ->orWhere('unit_offered',NULL)
            ->orWhere('batch_number',NULL)
            ->orWhere('expiry_date',NULL)
            ->orWhere('location',NULL)
            ->orWhere('lable_language',NULL)
            ->orWhere('unit_size',NULL)
            ->orWhere('unit_of_sale',NULL)
            ->orWhere('unit_per_case',NULL);
        })
        ->where('status','1')
        ->where('commit_status','0')
        ->get();
        
        $unmatch = Donation_item::whereDoesntHave('product_code')
        ->where('donation_id',$donation_id)
        ->WhereNotNull('manufecturer')
        ->WhereNotNull('brand_name')
        ->WhereNotNull('generic_name')
        ->WhereNotNull('unit_offered')
        ->WhereNotNull('batch_number')
        ->WhereNotNull('expiry_date')
        ->WhereNotNull('location')
        ->WhereNotNull('lable_language')
        ->WhereNotNull('unit_size')
        ->WhereNotNull('unit_of_sale')
        ->WhereNotNull('unit_per_case')
        ->where('status','1')
        ->where('commit_status','0')
        ->get();    
        
        $remove = Donation_item::where('donation_id',$donation_id)->where('status','0')->where('commit_status','0')->get();
        $commit = Donation_item::where('donation_id',$donation_id)->where('commit_status','1')->get();
        
        $matched = count($match);
        $error = count($err);
        $unmatched = count($unmatch);
        $removed = count($remove);
        $commited = count($commit);
        
        
        $data = array();
        $data = $donation_items;
        $data = [ 
            'donation' => $donation,
            'matched' => $matched ,
            'unmatched' => $unmatched ,
            'error' => $error ,
            'remove' => $removed,
            'commited' => $commited,
            'message' => "Record Updated Successfully!" ];
            
            $json_data = array(
                "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "data" => $data   // total data array
            );
            echo json_encode($json_data);  // send data as json format
            
        }
        
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Donation_item  $donation_item
        * @return \Illuminate\Http\Response
        */
        public function destroy(Donation_item $donation_item)
        {
            //
        }
        
        public function ajaxfetchdonationitem(Request $request)
        {
            $donation_id = $request->id;
            $perpage = 5;
            $columns = array(
                0 => 'ID',
                1 => 'Product Code',
                2 => 'Brand Name',
                3 => 'Units',
                4 => 'Batch',
                5 => 'Expiry',
                6 => 'Location',
                7 => 'Action',
            );
            
            $data = array();
            $limit=(!empty($request['length']))?$request['length']:$perpage;
            $offset=(!empty($request['start']))?$request['start']:0;
            $total_data = 0;
            
            $donation_items = Donation_item::where('donation_id',$donation_id)->with('product_code')->get();
            // dd($donation_items);
            
            foreach($donation_items as $donation_item)
            {
                // dd($donation_item->product_code);
                $raw_class ="";
                $nested_data = array();
                
                if($donation_item->status  == "0")
                {
                    // Remove
                    $raw_class = "background-color:#8A8B8C"; //grey
                }
                elseif($donation_item->status == "1" && $donation_item->product_code()->exists() && !empty($donation_item->manufecturer) && !empty($donation_item->brand_name) && !empty($donation_item->generic_name) &&  !empty($donation_item->unit_offered) &&  !empty($donation_item->batch_number) &&  !empty($donation_item->expiry_date) &&  !empty($donation_item->location) &&  !empty($donation_item->lable_language) &&  !empty($donation_item->unit_size) &&  !empty($donation_item->unit_of_sale) &&  !empty($donation_item->unit_per_case))
                {
                    // matched
                    $raw_class = "background-color:#59afcc"; //Blue
                }
                elseif($donation_item->status == "1" && $donation_item->DoesntHave('product_code') && empty($donation_item->manufecturer) || empty($donation_item->brand_name) || empty($donation_item->generic_name) || empty($donation_item->unit_offered) || empty($donation_item->batch_number) || empty($donation_item->expiry_date) || empty($donation_item->location) || empty($donation_item->lable_language) || empty($donation_item->unit_size) || empty($donation_item->unit_of_sale) || empty($donation_item->unit_per_case))
                {
                    // error
                    $raw_class = "background-color:#FF7F7F"; //red
                    
                }
                else{
                    // Unmatched
                    $raw_class = "background-color:#ffc107"; //orange
                }
                
                
                $nested_data[] = $donation_item->id;
                $nested_data[] = $donation_item->product_code;
                $nested_data[] = $donation_item->brand_name;
                $nested_data[] = $donation_item->unit_offered;
                $nested_data[] = $donation_item->batch_number;
                $nested_data[] = $donation_item->expiry_date;
                $nested_data[] = $donation_item->location;
                $nested_data[] = $donation_item->status == 1?"Active":"Disable";;
                
                if($donation_item->commit_status == 1 )
                {
                    $nested_data[] = '<div class="btn btn-group" role="group" >         
                    <a class="fa fa-eye btn btn-success show" id="show"></a>     
                    </div>  ';
                }
                elseif($donation_item->status == 1 )
                {
                    $nested_data[] = '<div class="btn btn-group" role="group" >
                    <a class="fa fa-pencil btn btn-info edit" id="edit"></a>
                    <a class="fa fa-trash btn btn-danger delete" id="delete"></a>          
                    <a class="fa fa-eye btn btn-success show" id="show"></a>    
                    <a class="fa fa-check btn btn-secondary commit" id="commit"></a>    
                    </div>  ';
                }
                else{
                    $nested_data[] = '<div class="btn btn-group" role="group" >
                    <a class="fa fa-pencil btn btn-info edit" id="edit"> </a>
                    <a class="fa fa-trash-restore btn btn-warning restore" id="restore"></a>
                    <a class="fa fa-eye btn btn-success show" id="show"></a>
                    <a class="fa fa-check btn btn-secondary commit" id="commit"></a>     
                    </div>  ';
                }
                $nested_data[] = $raw_class;
                $data[] = $nested_data;
            }
            
            $donation_items=$donation_items->skip($offset)->take($limit);
            $total_data = $donation_items->count();
            $total_filtered = $donation_items->count();
            
            $json_data = array(
                "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval($total_data),  // total number of records
                "recordsFiltered" => intval($total_filtered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $data   // total data array
            );
            echo json_encode($json_data);  // send data as json format
        }
        
        public function ajaxfetchdonationitemedit(Request $request)
        {
            $donation_id = $request->donation_id;
            $id = $request->id;
            $donation_items = Donation_item::where('id',$id)->first();
            
            $products = Product::where('product_code',$request->code)->get();
            
            $match =  Donation_item::where('id',$id)
            ->where('status','1')
            ->wherehas('product_code',function($query){
                $query->WhereNotNull('manufecturer')
                ->WhereNotNull('brand_name')
                ->WhereNotNull('generic_name')
                ->WhereNotNull('unit_offered')
                ->WhereNotNull('batch_number')
                ->WhereNotNull('expiry_date')
                ->WhereNotNull('location')
                ->WhereNotNull('lable_language')
                ->WhereNotNull('unit_size')
                ->WhereNotNull('unit_of_sale')
                ->WhereNotNull('unit_per_case');
            })->get();
            
            
            $payload = view('donation_item.donation_item_edit',compact('donation_items','donation_id','products','match'))->render();
            return response()->json([
                'data' => $payload,
            ]);
        }
        
        public function donation_item_destroy(Request $request)
        {
            $id = $request->id;
            $donation_item = Donation_item::where('id',$id)->first();
            $donation_item->update(['status' => '0']);
            
            $donation_id = $request->donation_id;
            $donation = Donation::where('id',$donation_id)->first();
            $donation_items = Donation_item::where('donation_id',$donation_id)->get();
            
            $matched = 0;
            $unmatched = 0;
            $error = 0;
            $removed = 0;
            $commited = 0;
            
            
            $match  = Donation_item::where('donation_id',$donation_id)
            ->where('status','1')
            ->where('commit_status','0')
            ->wherehas('product_code',function($query){
                $query->WhereNotNull('manufecturer')
                ->WhereNotNull('brand_name')
                ->WhereNotNull('generic_name')
                ->WhereNotNull('unit_offered')
                ->WhereNotNull('batch_number')
                ->WhereNotNull('expiry_date')
                ->WhereNotNull('location')
                ->WhereNotNull('lable_language')
                ->WhereNotNull('unit_size')
                ->WhereNotNull('unit_of_sale')
                ->WhereNotNull('unit_per_case');
            })->get();
            
            $err = Donation_item::where('donation_id',$donation_id)
            ->where(function ($query){
                $query->Where('manufecturer',NULL)
                ->orWhere('brand_name',NULL)
                ->orWhere('generic_name',NULL)
                ->orWhere('unit_offered',NULL)
                ->orWhere('batch_number',NULL)
                ->orWhere('expiry_date',NULL)
                ->orWhere('location',NULL)
                ->orWhere('lable_language',NULL)
                ->orWhere('unit_size',NULL)
                ->orWhere('unit_of_sale',NULL)
                ->orWhere('unit_per_case',NULL);
            })
            ->where('status','1')
            ->where('commit_status','0')
            ->get();
            
            $unmatch = Donation_item::whereDoesntHave('product_code')
            ->where('donation_id',$donation_id)
            ->WhereNotNull('manufecturer')
            ->WhereNotNull('brand_name')
            ->WhereNotNull('generic_name')
            ->WhereNotNull('unit_offered')
            ->WhereNotNull('batch_number')
            ->WhereNotNull('expiry_date')
            ->WhereNotNull('location')
            ->WhereNotNull('lable_language')
            ->WhereNotNull('unit_size')
            ->WhereNotNull('unit_of_sale')
            ->WhereNotNull('unit_per_case')
            ->where('status','1')
            ->where('commit_status','0')
            ->get();    
            
            $remove = Donation_item::where('donation_id',$donation_id)->where('status','0')->where('commit_status','0')->get();
            $commit = Donation_item::where('donation_id',$donation_id)->where('commit_status','1')->get();
            
            $matched = count($match);
            $error = count($err);
            $unmatched = count($unmatch);
            $removed = count($remove);
            $commited = count($commit);
            
            $data = array();
            $data = $donation_items;
            $data = [ 
                'donation' => $donation,
                'matched' => $matched ,
                'unmatched' => $unmatched ,
                'error' => $error ,
                'remove' => $removed,
                'commited' => $commited,
            ];
            
            $json_data = array(
                "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "data" => $data   // total data array
            );
            echo json_encode($json_data);  // send data as json format
            
        }
        
        public function donation_item_show(Request $request)
        {
            $donation_id = $request->donation_id;
            $id = $request->id;
            $donation_items = Donation_item::where('id',$id)->first();
            $payload = view('donation_item.showdata',compact('donation_items','donation_id'))->render();
            return response()->json([
                'data' => $payload,
            ]);
        }
        public function donation_item_restore(Request $request)
        {
            $id = $request->id;
            $donation_item = Donation_item::where('id',$id)->first();
            $donation_item->update(['status' => '1']);
            
            $donation_id = $request->donation_id;
            $donation = Donation::where('id',$donation_id)->first();
            $donation_items = Donation_item::where('donation_id',$donation_id)->get();
            
            $matched = 0;
            $unmatched = 0;
            $error = 0;
            $removed = 0;
            $commited = 0;
            
            $match  = Donation_item::where('donation_id',$donation_id)
            ->where('status','1')
            ->where('commit_status','0')
            ->wherehas('product_code',function($query){
                $query->WhereNotNull('manufecturer')
                ->WhereNotNull('brand_name')
                ->WhereNotNull('generic_name')
                ->WhereNotNull('unit_offered')
                ->WhereNotNull('batch_number')
                ->WhereNotNull('expiry_date')
                ->WhereNotNull('location')
                ->WhereNotNull('lable_language')
                ->WhereNotNull('unit_size')
                ->WhereNotNull('unit_of_sale')
                ->WhereNotNull('unit_per_case');
            })->get();
            
            $err = Donation_item::where('donation_id',$donation_id)
            ->where(function ($query){
                $query->Where('manufecturer',NULL)
                ->orWhere('brand_name',NULL)
                ->orWhere('generic_name',NULL)
                ->orWhere('unit_offered',NULL)
                ->orWhere('batch_number',NULL)
                ->orWhere('expiry_date',NULL)
                ->orWhere('location',NULL)
                ->orWhere('lable_language',NULL)
                ->orWhere('unit_size',NULL)
                ->orWhere('unit_of_sale',NULL)
                ->orWhere('unit_per_case',NULL);
            })
            ->where('status','1')
            ->where('commit_status','0')
            ->get();
            
            $unmatch = Donation_item::whereDoesntHave('product_code')
            ->where('donation_id',$donation_id)
            ->WhereNotNull('manufecturer')
            ->WhereNotNull('brand_name')
            ->WhereNotNull('generic_name')
            ->WhereNotNull('unit_offered')
            ->WhereNotNull('batch_number')
            ->WhereNotNull('expiry_date')
            ->WhereNotNull('location')
            ->WhereNotNull('lable_language')
            ->WhereNotNull('unit_size')
            ->WhereNotNull('unit_of_sale')
            ->WhereNotNull('unit_per_case')
            ->where('status','1')
            ->where('commit_status','0')
            ->get();    
            
            $remove = Donation_item::where('donation_id',$donation_id)->where('status','0')->where('commit_status','0')->get();
            $commit = Donation_item::where('donation_id',$donation_id)->where('commit_status','1')->get();
            
            $matched = count($match);
            $error = count($err);
            $unmatched = count($unmatch);
            $removed = count($remove);
            $commited = count($commit); 
            
            $data = array();
            $data = $donation_items;
            $data = [ 
                'donation' => $donation,
                'matched' => $matched ,
                'unmatched' => $unmatched ,
                'error' => $error ,
                'remove' => $removed,
                'commited' => $commited,
            ];
            
            $json_data = array(
                "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "data" => $data   // total data array
            );
            echo json_encode($json_data);  // send data as json format
        }
        
        public function donation_item_commit(Request $request)
        {
            $donation_id = $request->donation_id;
            $id = $request->id;
            $donation_item_data = Donation_item::where('id',$id)->with('product_code')->first();
            
            $data = array();
            
            if( $donation_item_data->status == "1" && $donation_item_data->DoesntHave('product_code') && empty($donation_item_data->manufecturer) || empty($donation_item_data->brand_name) || empty($donation_item_data->generic_name) || empty($donation_item_data->unit_offered) || empty($donation_item_data->batch_number) || empty($donation_item_data->expiry_date) || empty($donation_item_data->location) || empty($donation_item_data->lable_language) || empty($donation_item_data->unit_size) || empty($donation_item_data->unit_of_sale) || empty($donation_item_data->unit_per_case))
            {
                $message = " Record not commited";
            }
            else {
                $donation_item_data->update(["commit_status" => '1']);
                $message = "Record Commited Successfully ";
            }
            
            $matched = 0;
            $unmatched = 0;
            $error = 0;
            $removed = 0;
            $commited = 0;
            
            $match  = Donation_item::where('donation_id',$donation_id)
            ->where('status','1')
            ->where('commit_status','0')
            ->wherehas('product_code',function($query){
                $query->WhereNotNull('manufecturer')
                ->WhereNotNull('brand_name')
                ->WhereNotNull('generic_name')
                ->WhereNotNull('unit_offered')
                ->WhereNotNull('batch_number')
                ->WhereNotNull('expiry_date')
                ->WhereNotNull('location')
                ->WhereNotNull('lable_language')
                ->WhereNotNull('unit_size')
                ->WhereNotNull('unit_of_sale')
                ->WhereNotNull('unit_per_case');
            })->get();
            
            $err = Donation_item::where('donation_id',$donation_id)
            ->where(function ($query){
                $query->Where('manufecturer',NULL)
                ->orWhere('brand_name',NULL)
                ->orWhere('generic_name',NULL)
                ->orWhere('unit_offered',NULL)
                ->orWhere('batch_number',NULL)
                ->orWhere('expiry_date',NULL)
                ->orWhere('location',NULL)
                ->orWhere('lable_language',NULL)
                ->orWhere('unit_size',NULL)
                ->orWhere('unit_of_sale',NULL)
                ->orWhere('unit_per_case',NULL);
            })
            ->where('status','1')
            ->where('commit_status','0')
            ->get();
            
            $unmatch = Donation_item::whereDoesntHave('product_code')
            ->where('donation_id',$donation_id)
            ->WhereNotNull('manufecturer')
            ->WhereNotNull('brand_name')
            ->WhereNotNull('generic_name')
            ->WhereNotNull('unit_offered')
            ->WhereNotNull('batch_number')
            ->WhereNotNull('expiry_date')
            ->WhereNotNull('location')
            ->WhereNotNull('lable_language')
            ->WhereNotNull('unit_size')
            ->WhereNotNull('unit_of_sale')
            ->WhereNotNull('unit_per_case')
            ->where('status','1')
            ->where('commit_status','0')
            ->get();    
            
            $remove = Donation_item::where('donation_id',$donation_id)->where('status','0')->where('commit_status','0')->get();
            $commit = Donation_item::where('donation_id',$donation_id)->where('commit_status','1')->get();
            // dd($commit);
            
            $matched = count($match);
            $error = count($err);
            $unmatched = count($unmatch);
            $removed = count($remove);
            $commited = count($commit); 
            
            $data = [ 
                'matched' => $matched ,
                'unmatched' => $unmatched ,
                'error' => $error ,
                'remove' => $removed,
                'commited' => $commited,
                'message' => $message,
            ];
            $json_data = array(
                "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "data" => $data   // total data array
            );
            echo json_encode($json_data);  // send data as json format
        }
    }
    