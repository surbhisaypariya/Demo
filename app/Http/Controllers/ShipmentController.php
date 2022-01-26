<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Organization;
use App\Models\Location;
use App\Models\Carrier;
use App\Models\Method;
use App\Models\Comment;
use App\Models\Inbound_item;
use App\Models\Adjust;
use Illuminate\Http\Request;
use Auth;
use DB;

class ShipmentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('shipment.show');
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $organizations = Organization::where('status','1')->get();
        $locations = Location::where('status','1')->get();
        $carriers = Carrier::all();
        return view('shipment.create',compact('organizations','locations','carriers'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    
    
    public function store(Request $request )
    {
        $date_recieved = $request->year.'-'.$request->month.'-'.$request->date;
        
        $last = Shipment::latest()->first();
        $shipments = new Shipment;
        if($last)
        {   
            $last_str = $last->reference;
            $numeric = preg_replace("/[^0-9]/","",$last_str);
            $shipments->reference = "IB".($numeric+1);
        }
        else {
            $shipments->reference = 'IB20000' ;
        }
        
        $shipments->date_recieved = $date_recieved;
        $shipments->user_id = Auth::user()->id;
        $shipments->status = '0';
        $shipments->save();
        
        $organization = $request->organization;
        $location = $request->location;
        $carrier = $request->carrier;
        $method = $request->method;
        
        $shipments->organization()->attach($organization);
        $shipments->location()->attach($location);
        $shipments->carrier()->attach($carrier);
        $shipments->method()->attach($method);
        
        if(!empty($request->comment))
        {
            $comments = new Comment;
            $comments->description = $request->comment;
            $comments->user_id = Auth::user()->id;
            $comments->save();
            $comments->shipment()->attach($shipments->id);
        }
        
        return redirect()->route('shipment.edit',$shipments->id);
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Shipment  $shipment
    * @return \Illuminate\Http\Response
    */
    public function show(Shipment $shipment)
    {
        $organizations = Organization::where('status','1')->get();
        $locations = Location::where('status','1')->get();
        $carriers = Carrier::all();
        $methods = Method::all();
        return view('shipment.showposted',compact('shipment','organizations','locations','carriers'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Shipment  $shipment
    * @return \Illuminate\Http\Response
    */
    public function edit(Shipment $shipment)
    {
        $organizations = Organization::where('status','1')->get();
        $locations = Location::where('status','1')->get();
        $carriers = Carrier::all();
        return view('shipment.edit',compact('shipment','organizations','locations','carriers'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Shipment  $shipment
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Shipment $shipment)
    {
        $date_recieved = $request->year.'-'.$request->month.'-'.$request->date;
        
        $shipment->update([
            "reference" => $request->refrence,
            "date_recieved" => $date_recieved,
            "user_id" => Auth::user()->id,
        ]);
        $shipment->update();
        
        $organization = $request->organization;
        $location = $request->location;
        $carrier = $request->carrier;
        $method = $request->method;
        
        $shipment->organization()->sync($organization);
        $shipment->location()->sync($location);
        $shipment->carrier()->sync($carrier);
        $shipment->method()->sync($method);
        
        return redirect()->route('shipment.index');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Shipment  $shipment
    * @return \Illuminate\Http\Response
    */
    public function destroy(Shipment $shipment)
    {
        $inbound_items = Inbound_item::where('shipment_id',$shipment->id)->get();
        
        foreach($inbound_items as $inbound_item)
        {
            $inbound_item->delete();
        }
        $ids = $inbound_items->pluck('id');
        $adjusts = Adjust::whereIn('inbounceitem_id',$ids)->delete();
        
        $shipment->delete();
        $shipment->organization()->sync([]);
        $shipment->location()->sync([]);
        $shipment->carrier()->sync([]);
        $shipment->method()->sync([]);
        
        foreach($shipment->comment as $comment)
        {
            $comment->delete();
        }
        
        $shipment->comment()->sync([]);
        
        
        return redirect()->route('shipment.index')->with('error','Record Deleted Successflly');
    }
    
    public function carrier_method_data(Request $request)
    {
        $carriers = Carrier::where('id',$request->values)->get();
        $methods = Array();
        foreach($carriers as $carrier)
        {
            $methods = $carrier->method()->pluck('method_id');
        }
        $methods = Method::whereIn('id',$methods)->get();
        $data = view('shipment/carrier-method',compact('methods'))->render();
        return response()->json(['options'=>$data]);
        
    }
    
    public function carrier_method_dataedit(Request $request)
    {
        $shipment_id = $request->shipment_id;
        $shipments = Shipment::where('id',$shipment_id)->first();
        $carriers = Carrier::where('id',$request->values)->get();
        $methods = Array();
        foreach($carriers as $carrier)
        {
            $methods = $carrier->method()->pluck('method_id');
        }
        $methods = Method::whereIn('id',$methods)->get();
        $data = view('shipment/carrier-method-edit',compact('methods','shipments'))->render();
        return response()->json(['options'=>$data]);
        
    }
    
    // add_comments
    public function add_comments(Request $request)
    {
        if($request->comment)
        {
            $comments = new Comment;
            $comments->description = $request->comment;
            $comments->user_id = Auth::user()->id;
            $comments->save();
            $shipment_id = $request->shipment_id;
            $comments->shipment()->attach($shipment_id);
        }
        return redirect()->back();
    }
    
    public function ajaxfetchshipment(Request $request)
    {
        $perpage = 5;
        $columns = array(
            0 => 'Reference',
            1 => 'Recieved',
            2 => 'Sender',
            3 => 'Location',
            4 => 'Carrier/Method',
            5 => 'Items',
            6 => 'Status',
            7 => 'Action',
        );
        
        $data = array();
        $limit=(!empty($request['length']))?$request['length']:$perpage;
        $offset=(!empty($request['start']))?$request['start']:0;
        $total_data = 0;
        
        $shipments = Shipment::all();
        
        foreach($shipments as $shipment)
        {
            $item_count = Inbound_item::where('shipment_id',$shipment->id)->get();
            $organization_name = "";
            $location = "";
            $carrier = "";
            $method = "";
            
            foreach($shipment->organization as $organization)
            {
                $organization = $organization->organization_name .'<br><label style="color:grey;">'.$organization->organization_initials.'</label>';
            }
            foreach($shipment->location as $location)
            {
                $location = $location->name.'<br><label style="color:grey;">'.$location->	location_code.'</label>';
            }
            foreach($shipment->carrier as $carrier)
            {
                $carrier = $carrier->carrier_name;
            }
            foreach($shipment->method as $method)
            {
                $method = $method->method_name;
            }
            
            $nested_data = array();
            $nested_data[] = $shipment->reference;
            $nested_data[] = $shipment->date_recieved;
            $nested_data[] = $organization;
            $nested_data[] = $location ; 
            $nested_data[] = $carrier.'/'.$method;;
            $nested_data[] = count( $item_count);
            $nested_data[] = $shipment->status ==0?"In-Work":"Posted";
            
            if($shipment->status == 1)
            {
                $nested_data[] =  '<div class="btn btn-group" role="group" >
                <a href="'. route('shipment.show',$shipment->id ).'" class="fa fa-eye btn btn-success">
                </a>
                <form action="'.route('shipment.destroy',$shipment->id ) .'" method="post" >
                '.csrf_field().method_field('DELETE').'
                <button class="fa fa-trash btn btn-danger" id="delete">
                </button>
                </form>             
                </div>  ';
            }
            else {
                $nested_data[] =  '<div class="btn btn-group" role="group" >
                <a href="'. route('shipment.edit',$shipment->id ).'" class="fa fa-pencil btn btn-info">
                </a>
                <form action="'.route('shipment.destroy',$shipment->id ) .'" method="post" >
                '.csrf_field().method_field('DELETE').'
                <button class="fa fa-trash btn btn-danger" id="delete">
                </button>
                </form>             
                </div>  ';
            }
            
            $data[] = $nested_data;
        }
        
        
        $shipments=$shipments->skip($offset)->take($limit);
        $total_data = $shipments->count();
        $total_filtered = $shipments->count();
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($total_data),  // total number of records
            "recordsFiltered" => intval($total_filtered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
    
    public function markaspost($id)
    {
        $shipments = Shipment::where('id',$id)->first();
        if($shipments->date_recieved !=  "--------")
        {
            $shipments->update(['status'=> '1' ]);
            return redirect()->route('shipment.index')->with('success','Record Mark as posted');
        }
        return redirect()->route('shipment.index')->with('warning','Sorry Recieved date is null');
        
    }
    
}
