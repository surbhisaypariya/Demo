<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbound_item;
use App\Models\InboundItem_History;
use App\Models\Shipment;
use App\Models\Product;
use App\Models\Adjust;
use App\Models\User;
use Auth;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $locations = Inbound_item::distinct('location')->pluck('location');
        return view('stock.show',compact('locations'));
    }
    
    public function ajaxfetchsstock(Request $request)
    {
        $perpage = 5;
        $columns = array(
            0 => 'Id',
            1 => 'Shipment Id',
            2 => 'Item Number',
            3 => 'brand_name',
            4 => 'Location',
            5 => 'Units',
            6 => 'Batch',
            7 => 'Pallet Id',
            8 => 'Expiry Date',
            9 => 'Status',
            10 => 'Action',
        );
        
        $data = array();
        $limit=(!empty($request['length']))?$request['length']:$perpage;
        $offset=(!empty($request['start']))?$request['start']:0;
        $total_data = 0;
        
        $shipment_id = Shipment::where('status','1')->pluck('id');
        $inbound_items = Inbound_item::whereIn('shipment_id',$shipment_id)->with('product')->get();
        
        foreach($inbound_items as $inbound_item)
        {
            $nested_data = array();
            
            $item_number = $inbound_item->product()->pluck('product_code')->implode(',');
            $brand_name = $inbound_item->product()->pluck('brand_name')->implode(',');
            
            $adjusts = Adjust::where('inbounceitem_id',$inbound_item->id)->latest()->first();
            
            $batch_ext = $inbound_item->batch_extension;
            $batch_extension = "";
            if(!empty($batch_ext))
            {
                $batch_extension = $inbound_item->batch.'/'.$inbound_item->batch_extension;
            }
            else
            {
                $batch_extension = $inbound_item->batch;
            }
            $status = "";
            
            if($inbound_item->status == 0)
            {
                $status = "Hold";
            }
            if($inbound_item->status == 1)
            {
                $status = "Adjusted";
            }
            if($inbound_item->status == 2)
            {
                $status = "Archived";
            }
            $available = "";
            if(!empty($adjusts))
            {
                $available = '/('.$adjusts->available.')';
            }
            
            
            $nested_data[] = $inbound_item->id;
            $nested_data[] = $inbound_item->shipment_id;
            $nested_data[] = $item_number;
            $nested_data[] = $brand_name; 
            $nested_data[] = $inbound_item->location; 
            $nested_data[] = $inbound_item->number_of_unit . $available;
            $nested_data[] = $batch_extension;
            $nested_data[] = $inbound_item->pallet_id;
            $nested_data[] = $inbound_item->expiry_date;
            
            $nested_data[] = $status;
            $nested_data[] = '<div class="btn btn-group" role="group" >   
            <a class="fa fa-eye btn btn-primary show" id="show"></a>      
            </form>             
            </div>  ';
            $data[] = $nested_data;
        }
        
        $inbound_items=$inbound_items->skip($offset)->take($limit);
        $total_data = $inbound_items->count();
        $total_filtered = $inbound_items->count();
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($total_data),  // total number of records
            "recordsFiltered" => intval($total_filtered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
    
    public function stockitem_detail(Request $request)
    {
        $inbound_items = Inbound_item::where('id',$request->id)->first();
        $in_pro = $inbound_items->product_id;
        
        $products = Product::where('id',$in_pro)->first();
        $category = $products->category()->pluck('category')->implode(',');
        
        $payload = view('stock.stockitem_detail',compact('inbound_items','category','products'))->render();
        
        return response()->json([
            'data' => $payload,
        ]);
    }
    
    public function calladjustview(Request $request)
    {
        $inbound_item = Inbound_item::where('id',$request->id)->first();
        $product = Product::where('id',$inbound_item->product_id)->first();
        
        $category = $product->category()->pluck('category')->implode(',');
        
        $payload = view('stock.adjust',compact('inbound_item','product','category'))->render();
        
        return response()->json([
            'data' => $payload,
        ]);
    }
    
    public function adjust_store(Request $request)
    {
        $data = array();
        $inbound_items = Inbound_item::findOrFail($request->inbound_id);
        $old_data = $inbound_items->getRawOriginal();
        $expiry_date = $request->year.'-'.$request->month.'-'.$request->date;
        
        $inbound_items->update([
            'aisle' => $request->aisle ,
            'fmd' => $request->fmd ,
            'number_of_unit' => $request->number_of_unit ,
            'pallet_id' => $request->pallet_id ,
            'total_no_treatment' => $request->total_no_treatment ,
            'unit_value' => $request->unit_value ,
            'donation_reference' => $request->donation_reference ,
            'total_value' => $request->total_value ,
            'allocation' => $request->allocation ,
            'expiry_date' => $expiry_date
        ]);
        
        if($request->batch === $inbound_items->batch)
        {
            $inbound_items->update([
                'batch' => $request->batch,
            ]);
        }
        else {
            $pluck_batches = Inbound_item::where('location',$request->location)
            ->where('batch',$request->batch)
            ->where('product_id',$request->product_id)
            ->pluck('batch')->toArray();
            
            $pluck_extension =  Inbound_item::where('location',$request->location)
            ->where('batch',$request->batch)
            ->where('product_id',$request->product)
            ->pluck('batch_extension')->toArray();
            
            if(in_array($request->batch,$pluck_batches))
            {
                $extention_last = end($pluck_extension);
                $inbound_items->update([
                    'batch' => $request->batch,
                ]);
                $inbound_items->update([
                    'batch_extension' => ($extention_last+1),
                ]);
            }
            else{
                $inbound_items->update([
                    'batch' => $request->batch,
                ]);
                $inbound_items->update([
                    'batch_extension' => NULL,
                ]);
            }
        }
        
        if(!empty($request->unit))
        {
            $adjusts = Adjust::where('inbounceitem_id',$request->inbound_id)->latest()->first();
            $adjusted = 0;
            $available = "";
            if(!empty($adjusts->id))
            {
                if($request->math_icon == 0)
                {
                    $available = $adjusts->available - $request->unit;
                }
                if($request->math_icon == 1)
                {
                    $available = $adjusts->available + $request->unit;
                }
                
                if($request->math_icon == 0)
                {
                    $adjusted = $adjusts->adjusted - $request->unit;
                }
                if($request->math_icon == 1)
                {
                    $adjusted = $adjusts->adjusted + $request->unit;
                }
            }
            else {
                if($request->math_icon == 0)
                {
                    $available = $request->number_of_unit - $request->unit;
                }
                if($request->math_icon == 1)
                {
                    $available = $request->number_of_unit + $request->unit;
                }                
                if($request->math_icon == 0)
                {
                    $adjusted = 0 - $request->unit;
                }
                if($request->math_icon == 1)
                {
                    $adjusted = 0 + $request->unit;
                }
            }
            $adjusts = new Adjust;
            $adjusts->inbounceitem_id = $request->inbound_id;
            $adjusts->math_icon = $request->math_icon;
            $adjusts->units = $request->unit;
            $adjusts->reason = $request->reason;
            $adjusts->comments = $request->comment;
            $adjusts->total_unit = $request->number_of_unit;
            $adjusts->available = $available;
            $adjusts->adjusted = $adjusted;
            $adjusts->user_id = Auth::user()->id;
            $adjusts->save();
            
            if($adjusts->available == 0)
            {
                $inbound_items->status = '2';
            }
            else {
                $inbound_items->status = '1';
            }
            $data[] = $adjusts;
        }
        $this->inbound_history_store($inbound_items , $old_data);        
        
        $inbound_items->update();
        $data[] = $inbound_items;
        // return response()->json([
        //     'data' => $data,
        // ]);
    }
    
    public function inbound_history_store($inbound_items , $old_data)
    {   
        
        $new_data = $inbound_items;
        $changes_array = array();
        
        if($new_data->aisle != $old_data['aisle'])
        {
            $changes_array['old_aisle'] = $old_data['aisle'] ;
            $changes_array['new_aisle'] = $new_data->aisle ;
        }
        if($new_data->pallet_id != $old_data['pallet_id'])
        {
            $changes_array['old_pallet_id'] = $old_data['pallet_id'] ;
            $changes_array['new_pallet_id'] = $new_data->pallet_id ;
        }
        if($new_data->unit_value != $old_data['unit_value'])
        {
            $changes_array['old_unit_value'] = $old_data['unit_value'];
            $changes_array['new_unit_value'] = $new_data->unit_value;
            
            $changes_array['old_total_value'] = $old_data['total_value'] ;
            $changes_array['new_total_value'] = $new_data->total_value ;
        }
        if($new_data->expiry_date != $old_data['expiry_date'])
        {
            $changes_array['old_expiry_date'] = $old_data['expiry_date'] ;
            $changes_array['new_expiry_date'] = $new_data->expiry_date ;
        }
        if($new_data->donation_reference != $old_data['donation_reference'])
        {
            $changes_array['old_donation_reference'] = $old_data['donation_reference'];
            $changes_array['new_donation_reference'] = $new_data->donation_reference ;
        }
        if($new_data->allocation != $old_data['allocation'])
        {
            $changes_array['old_allocation'] = $old_data['allocation'] ;
            $changes_array['new_allocation'] = $new_data->allocation ;
        }
        if($new_data->number_of_unit != $old_data['number_of_unit'])
        {
            $changes_array['old_number_of_unit'] = $old_data['number_of_unit'] ;
            $changes_array['new_number_of_unit'] = $new_data->number_of_unit ;
        }
        if($new_data->total_no_treatment != $old_data['total_no_treatment'])
        {
            $changes_array['old_total_no_treatment'] = $old_data['total_no_treatment'] ;
            $changes_array['new_total_no_treatment'] = $new_data->total_no_treatment ;
        }        
        if($new_data->batch != $old_data['batch'])
        {
            $changes_array['old_batch'] = $old_data['batch'];
            $changes_array['new_batch'] = $new_data->batch;
        }
        if($new_data->fmd != $old_data['fmd'])
        {
            $changes_array['old_fmd'] = $old_data['fmd'] ;
            $changes_array['new_fmd'] = $new_data->fmd ;
        }
        if(count($changes_array)>0)
        {
            $changes_array['user_id'] = Auth::user()->id;
            $changes_array['inbounditem_id'] = $new_data->id;
            InboundItem_History::create($changes_array);
        }
    }
    
    public function markashold(Request $request)
    {
        $inbound_item = Inbound_item::where('id',$request->id)->update(['status'=>'0']);
        return response()->json([
            'data' => $inbound_item,
        ]);
    }
    
    public function markasunhold(Request $request)
    {
        $inbound_item = Inbound_item::where('id',$request->id)->update(['status'=>'1']);
        return response()->json([
            'data' => $inbound_item,
        ]);
    }
    
    public function view_detail($id)
    {
        $inbound_items = Inbound_item::where('id',$id)->first();
        $in_pro = $inbound_items->product_id;
        
        $products = Product::where('id',$in_pro)->first();
        $category = $products->category()->pluck('category')->implode(',');
        
        return view('stock.view_detail',compact('inbound_items','products','category'));
    }
}