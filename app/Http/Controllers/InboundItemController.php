<?php

namespace App\Http\Controllers;

use App\Models\Inbound_item;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Http\Request;

class InboundItemController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $in_bound_items = new Inbound_item;
        $pluck_batches = Inbound_item::where('location',$request->location)
        ->where('batch',$request->batch)
        ->where('product_id',$request->product)
        ->pluck('batch')->toArray();
        
        $pluck_extension = Inbound_item::where('location',$request->location)
        ->where('product_id',$request->product)
        ->where('batch',$request->batch)
        ->pluck('batch_extension')->toArray();
        
        if(in_array($request->batch,$pluck_batches))
        {
            $extention_last = end($pluck_extension);
            $in_bound_items->batch = $request->batch;
            $in_bound_items->batch_extension = ($extention_last+1);
        }
        else{
            $in_bound_items->batch = $request->batch;
        }
        
        $date = $request->year.'-'.$request->month.'-'.$request->date;
        $in_bound_items->shipment_id = $request->shipment_id;
        $in_bound_items->product_id = $request->product;
        $in_bound_items->aisle = $request->aisle;
        $in_bound_items->pallet_id = $request->pallet_id;
        $in_bound_items->location = $request->location;
        $in_bound_items->unit_value = $request->unit_value;
        $in_bound_items->donation_reference = $request->donation_reference;
        $in_bound_items->total_value = $request->total_value;
        $in_bound_items->allocation = $request->allocation;
        $in_bound_items->number_of_unit = $request->number_of_unit;
        $in_bound_items->total_no_treatment = $request->total_no_treatment;
        $in_bound_items->expiry_date = $date ;
        $in_bound_items->fmd = $request->fmd;
        $in_bound_items->status = '1';
        $in_bound_items->save();
        
        $product_id = $request->product;
        $in_bound_items->product()->attach($product_id );
        return redirect()->back();
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Inbound_item  $inbound_item
    * @return \Illuminate\Http\Response
    */
    public function show(Inbound_item $inbound_item)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Inbound_item  $inbound_item
    * @return \Illuminate\Http\Response
    */
    public function edit(Inbound_item $inbound_item)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Inbound_item  $inbound_item
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Inbound_item $inbound_item)
    {
        if($request->batch === $inbound_item->batch)
        {
            $inbound_item->update([
                'batch' => $request->batch,
            ]);
        }
        else {
            $pluck_batches = Inbound_item::where('location',$request->location)
            ->where('batch',$request->batch)
            ->where('product_id',$request->product)
            ->pluck('batch')->toArray();
            
            $pluck_extension =  Inbound_item::where('location',$request->location)
            ->where('batch',$request->batch)
            ->where('product_id',$request->product)
            ->pluck('batch_extension')->toArray();
            
            if(in_array($request->batch,$pluck_batches))
            {
                $extention_last = end($pluck_extension);
                $inbound_item->update([
                    'batch' => $request->batch,
                ]);
                $inbound_item->update([
                    'batch_extension' => ($extention_last+1),
                ]);
            }
            else{
                $inbound_item->update([
                    'batch' => $request->batch,
                ]);
                $inbound_item->update([
                    'batch_extension' => NULL,
                ]);
            }
        }
        $date = $request->year.'-'.$request->month.'-'.$request->date;
        $product_id = $request->product;
        $inbound_item->update([
            'shipment_id' => $request->get('shipment_id'),
            'product_id' => $request->get('product'),
            'aisle' => $request->get('aisle'),
            'pallet_id' => $request->get('pallet_id'),
            'location' => $request->get('location'),
            'unit_value' => $request->get('unit_value'),
            'donation_reference' => $request->get('donation_reference'),
            'total_value' => $request->get('total_value'),
            'allocation' => $request->get('allocation'),
            'fmd' => $request->get('fmd'),
            'number_of_unit' => $request->get('number_of_unit'),
            'total_no_treatment' => $request->get('total_no_treatment'),
            'expiry_date' => $date,
        ]);
        
        $inbound_item->update();
        $inbound_item->product()->sync([$product_id]);
        
        $data = array();
        $data = $inbound_item;
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Inbound_item  $inbound_item
    * @return \Illuminate\Http\Response
    */
    public function destroy(Inbound_item $inbound_item)
    {
        
    }
    
    public function add_productview(Request $request)
    {
        $shipment_id = $request->shipment_id;
        $products = Product::where('status',1)->get();
        $shipments = Shipment::where('id',$shipment_id)->first();
        $payload = view('inbound_item.add_product',compact('products','shipment_id','shipments'))->render();
        return response()->json([
            'data' => $payload,
        ]);
    }
    
    public function product_detail_add(Request $request)
    {
        $product_id = $request->id;
        $products = Product::where('id',$product_id)->first();
        $categories = $products->category()->pluck('category')->implode(', ');
        return response()->json([
            'data' => $products, $categories,
        ]);
    }
    
    public function inbound_item_view(Request $request)
    {
        $columns = array(
            0 => 'Item Number',
            1 => 'brand_name',
            2 => 'Units',
            3 => 'Batch',
            4 => 'Expiry Date',
            5 => 'Pallet Id',
            6 => 'Action',
        );
        
        $data = array();
        
        $shipment_id = $request->shipment_id;
        $inbound_items = Inbound_item::where('shipment_id',$shipment_id)->with('product')->get();
        foreach($inbound_items as $inbound_item)
        {
            $nested_data = array();
            
            $item_number = $inbound_item->product()->pluck('product_code')->implode(',');
            $brand_name = $inbound_item->product()->pluck('brand_name')->implode(',');
            
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
            
            
            $nested_data[] = $inbound_item->id;
            $nested_data[] = $item_number;
            $nested_data[] = $brand_name; 
            $nested_data[] = $inbound_item->number_of_unit;
            $nested_data[] = $batch_extension;
            $nested_data[] = $inbound_item->expiry_date;
            $nested_data[] = $inbound_item->pallet_id;
            $nested_data[] = '<div class="btn btn-group" role="group" >
            <a class="fa fa-pencil btn btn-info edit" id="edit"></a>
            <a class="fa fa-trash btn btn-danger delete" id="delete"></a>      
            <a class="fa fa-eye btn btn-primary show" id="show"></a>      
            </form>             
            </div>  ';
            $data[] = $nested_data;
        }
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
    
    public function inbound_item_viewposted(Request $request)
    {
        $columns = array(
            0 => 'Item Number',
            1 => 'brand_name',
            2 => 'Units',
            3 => 'Batch',
            4 => 'Expiry Date',
            5 => 'Pallet Id',
            6 => 'Action',
        );
        
        $data = array();
        
        $shipment_id = $request->shipment_id;
        $inbound_items = Inbound_item::where('shipment_id',$shipment_id)->with('product')->get();
        foreach($inbound_items as $inbound_item)
        {
            $nested_data = array();
            
            $item_number = $inbound_item->product()->pluck('product_code')->implode(',');
            $brand_name = $inbound_item->product()->pluck('brand_name')->implode(',');
            
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
            
            
            $nested_data[] = $inbound_item->id;
            $nested_data[] = $item_number;
            $nested_data[] = $brand_name; 
            $nested_data[] = $inbound_item->number_of_unit;
            $nested_data[] = $batch_extension;
            $nested_data[] = $inbound_item->expiry_date;
            $nested_data[] = $inbound_item->pallet_id;
            $nested_data[] = '<div class="btn btn-group" role="group" >    
            <a class="fa fa-eye btn btn-primary show" id="show"></a>      
            </form>             
            </div>  ';
            $data[] = $nested_data;
        }
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
    
    public function fetchinbound_itemedit(Request $request)
    {
        $shipment_id = $request->shipment_id;
        $inbound_items = Inbound_item::where('id',$request->id)->first();
        $products = Product::where('status',1)->get();
        
        $payload = view('inbound_item.edit_product',compact('inbound_items','products','shipment_id'))->render();
        
        return response()->json([
            'data' => $payload,
        ]);
    }
    
    public function inbound_item_destroy(Request $request)
    {
        $inbound_item_id = $request->id;
        $inbound_item = Inbound_item::where('id',$inbound_item_id)->first();
        $inbound_item->product()->sync([]);
        $inbound_item->delete();
        $data = array();
        $data = $inbound_item;
        return response()->json([
            'data' => $data,
        ]);
    }
    
    public function fetchinbound_itemshow(Request $request)
    {
        $inbound_items = Inbound_item::where('id',$request->id)->first();
        $in_pro = $inbound_items->product_id;
        
        $products = Product::where('id',$in_pro)->first();
        $category = $products->category()->pluck('category')->implode(',');
        
        $payload = view('inbound_item.show_product',compact('inbound_items','category'))->render();
        
        return response()->json([
            'data' => $payload,
        ]);
    }
    
}
