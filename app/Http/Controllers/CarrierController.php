<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\Method;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // $carriers = Carrier::with('method')->get();
        return view('carrier_method.show');
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('carrier_method.create');
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
            'carrier_name' => 'required',
        ]);
        
        $carriers = new Carrier;
        $carriers->carrier_name = $request->carrier_name;
        $carriers->save();
        
        return view('carrier_method.add_method',compact('carriers'));
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Carrier  $carrier
    * @return \Illuminate\Http\Response
    */
    public function show(Carrier $carrier)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Carrier  $carrier
    * @return \Illuminate\Http\Response
    */
    public function edit(Carrier $carrier)
    {
        $carriers = Carrier::where('id',$carrier->id)->with('method')->first();
        return view('carrier_method.edit',compact('carriers'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Carrier  $carrier
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Carrier $carrier)
    {
        $carrier->method()->sync([]);
        $carrier_id = $carrier->id;
        foreach($request->method_name as $key => $method)
        {
            $pattern = "/,/";
            $comma = preg_match($pattern, $key);
            if(!empty($comma))
            {
                $comma = explode(',',$key);
                $id = end($comma);
                $methods = Method::findOrFail($id);
                $methods->update([
                    'method_name'=> $method,
                ]);
                $methods->carrier()->sync($carrier_id);
                $methods->update();
            }
            else{
                $methods = new Method;
                $methods->method_name = $method;
                $methods->save();
                $methods->carrier()->sync($carrier_id);
            }
        }
        
        $carrier->update([
            'carrier_name' => $request->carrier_name,
        ]);
        $carrier->update();
        return redirect()->route('carriers.index')->with('info','Record Updated successfully');
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Carrier  $carrier
    * @return \Illuminate\Http\Response
    */
    public function destroy(Carrier $carrier)
    {
        foreach($carrier->method as $method)
        {
            $method->delete();
        }
        $carrier->delete();
        
        $carrier->method()->sync([]);
        return redirect()->route('carriers.index')->with('error','Record Deleted Successfully');
    }
    
    public function add_method(Request $request)
    {
        $request->validate([
            'carrier_name' => 'required',
            'method_name.*' => 'required',
        ]);
        
        foreach($request->method_name as $method_name)
        {
            $methods = new Method;
            $methods->method_name = $method_name;
            $methods->save();
            
            $carrier_id = $request->carrier_id;
            $methods->carrier()->attach($carrier_id);
        }
        return redirect()->route('carriers.index')->with('message','Record Inserted Successfully');
    }
    
    public function ajaxcarriermethod(Request $request)
    {
        $perpage = 5;
        $columns = array(
            0 => 'Carrier Name',
            1 => 'Methods',
            3 => 'Action',
        );
        
        $data = array();
        $limit=(!empty($request['length']))?$request['length']:$perpage;
        $offset=(!empty($request['start']))?$request['start']:0;
        $total_data = 0;
        
        $carriers = Carrier::with('method')->get();
        
        foreach($carriers as $carrier)
        {
            $methods = array();
            
            foreach($carrier->method as $method)
            {
                $methods[] = $method->method_name;
            }
            $nested_data = array();
            $nested_data[] = $carrier->carrier_name;
            $nested_data[] = $methods;
            
            $nested_data[] = '<div class="btn btn-group" role="group" >
            <a href="'.route('carriers.edit',$carrier) .'" method="get" >
            <button class="fa fa-pencil btn btn-info" id="edit">
            </button>
            </a>
            </form>     
            <form action="'.route('carriers.destroy',$carrier) .'" method="post" >
            '.csrf_field().method_field('DELETE').'
            <button class="fa fa-trash btn btn-danger" id="delete">
            </button>
            </form>             
            </div>  ';
            
            $data[] = $nested_data;
        }
        $carriers=$carriers->skip($offset)->take($limit);
        $total_data = $carriers->count();
        $total_filtered = $carriers->count();
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($total_data),  // total number of records
            "recordsFiltered" => intval($total_filtered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
        
    }
}
