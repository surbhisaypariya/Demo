<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Country;
use App\Models\Organization;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $organizations = Organization::all();
        return view('location.show',compact('organizations'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $countries = Country::all();
        $organizations = Organization::all();
        return view('location.create',compact('countries','organizations'));
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
            'name' => 'required',
            'location_code' => 'required|unique:locations',
            'display_name' => 'required',
            'location_type' => 'required',
            'address_line_1' => 'required',
            'post_code' => 'required|numeric',
            'country' => 'required',
            'organization.*' => 'required',
            'general_inquiry_phone' => 'nullable|regex:/[0-9]{9}/',
            'primary_contact_phone' => 'nullable|regex:/[0-9]{9}/',
            'secondary_contact_phone' => 'nullable|regex:/[0-9]{9}/',
            'primary_contact_email' => 'nullable|email',
            'general_inquiry_email' => 'nullable|email',
            'secondary_contact_email' => 'nullable|email',
        ]);
        
        $locations = new location;
        $locations->name = $request->name;
        $locations->display_name = $request->display_name;
        $locations->location_code = $request->location_code;
        $locations->location_type = $request->location_type;
        $locations->address_line_1 = $request->address_line_1;
        $locations->city = $request->city;
        $locations->post_code = $request->post_code;
        $locations->address_line_2 = $request->address_line_2;
        $locations->region = $request->region;
        $locations->country = $request->country;
        $locations->general_inquiry_phone = $request->general_inquiry_phone;
        $locations->primary_contact_name = $request->primary_contact_name;
        $locations->primary_contact_email = $request->primary_contact_email;
        $locations->primary_contact_phone = $request->primary_contact_phone;
        $locations->general_inquiry_email = $request->general_inquiry_email;
        $locations->secondary_contact_name = $request->secondary_contact_name;
        $locations->secondary_contact_email = $request->secondary_contact_email;
        $locations->secondary_contact_phone = $request->secondary_contact_phone;
        
        $isChecked = $request->has('status');
        if($isChecked == "on")
        {
            $locations->status = 1 ;
        }
        else
        {
            $locations->status = 0;
        }
        $locations->save();
        
        $organization = $request->organization;
        $locations->organization()->attach($organization);
        
        if($request->users)
        {
            $users = $request->users;
            $locations->user()->attach($users);
            
        }
        
        return redirect()->route('location.index')->with('success','Record Inserted Successfully');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function show(Location $location)
    {
        
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function edit(Location $location)
    {
        $countries = Country::all();
        $organizations = Organization::all();
        return view('location.edit',compact('location','countries','organizations'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'location_code' => 'required|unique:locations,location_code,'.$location->id,
            'display_name' => 'required',
            'location_type' => 'required',
            'address_line_1' => 'required',
            'post_code' => 'required|numeric',
            'country' => 'required',
            'organization.*' => 'required',
            'general_inquiry_phone' => 'nullable|regex:/[0-9]{9}/',
            'primary_contact_phone' => 'nullable|regex:/[0-9]{9}/',
            'secondary_contact_phone' => 'nullable|regex:/[0-9]{9}/',
            'primary_contact_email' => 'nullable|email',
            'general_inquiry_email' => 'nullable|email',
            'secondary_contact_email' => 'nullable|email',
            
        ]);
        
        $location->update([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'location_code' => $request->get('location_code'),
            'location_type' => $request->get('location_type'),
            'address_line_1' => $request->get('address_line_1'),
            'city' => $request->get('city'),
            'post_code' => $request->get('post_code'),
            'address_line_2' => $request->get('address_line_2'),
            'region' => $request->get('region'),
            'country' => $request->get('country'),
            'general_inquiry_phone' => $request->get('general_inquiry_phone'),
            'primary_contact_name' => $request->get('primary_contact_name'),
            'primary_contact_email' => $request->get('primary_contact_email'),
            'primary_contact_phone' => $request->get('primary_contact_phone'),
            'general_inquiry_email' => $request->get('general_inquiry_email'),
            'secondary_contact_name' => $request->get('secondary_contact_name'),
            'secondary_contact_email' => $request->get('secondary_contact_email'),
            'secondary_contact_phone' => $request->get('secondary_contact_phone'),
        ]);
        $isChecked = $request->has('status');
        $location_status = ($isChecked == "on") ? '1' : '0';
        $location->status = $location_status;
        
        $organization = $request->organization;
        $location->organization()->sync($organization);
        if($request->user)
        {
            $users = $request->users;
            $location->user()->sync($users);
        }
        $location->update();
        
        return redirect()->route('location.index')->with('info','Updated Successfully');
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Location  $location
    * @return \Illuminate\Http\Response
    */
    public function destroy(Location $location)
    {
        $location->update(['status'=> "0"]);
        return redirect()->back()->with('warning','Location Diactive');
    }
    
    public function ajaxuserfetch(Request $request)
    {    
        $organizations = Organization::whereIn('id',$request->values[0])->get();
        
        $payload = view('location.organization_data',compact('organizations'))->render();
        return response()->json([
            'data' => $payload,
        ]);
    }
    
    public function ajaxuserfetchedit(Request $request)
    {    
        $organizations = Organization::whereIn('id',$request->values[0])->get();
        
        $payload = view('location.organization_data_edit',compact('organizations'))->render();
        return response()->json([
            'data' => $payload,
        ]);
    }
    
    public function location_show()
    {
        $organizations = Organization::all();
        return view('location.show',compact('organizations'));
    }
    
    public function ajaxfetchlocation(Request $request)
    {
        $perpage = 10;
        
        $columns = array(
            0 => 'Location',
            1 => 'Address',
            3 => 'Type',
            4 => 'Status',
            5 => 'Organization',
            6 => 'Action',
        );
        
        $data = array();
        $limit=(!empty($request['length']))?$request['length']:$perpage;
        $offset=(!empty($request['start']))?$request['start']:0;
        $total_data = 0;
        $ids = (!empty($request['columns']['4']['search']['value']))?$request['columns']['4']['search']['value']:"";
        if(!empty($ids))
        {
            $locations = Location::with(array('organization' => function($query) use ($ids){
                $query->wherePivot('organization_id',$ids);
            }))->get();
        }
        else{
            $locations = Location::get();
        }
        foreach($locations as $location)
        {
            $organization_id = array();
            $nested_data = array();
            foreach($location->organization as $organization){
                $organization_id[] = $organization->pivot->organization_id;
            }
            
            $nested_data[] = '<b>'.$location->display_name.'</b><br>'.$location->location_code;
            $nested_data[] = $location->country.'<br>'.$location->address_line_1.'<br>'.$location->post_code;
            $nested_data[] = $location->location_type;
            $nested_data[] = $location->status == 1?"Active":"Disable";
            $nested_data[] = $organization_id;
            
            if($location->status == 0){
                $nested_data[] = '<div class="btn btn-group" role="group" >
                <a href="'. route('location.edit',$location->id ).'" class="fa fa-pencil btn btn-info">
                </a></div>  ';
            }
            else{
                $nested_data[] = '<div class="btn btn-group" role="group" >
                <a href="'. route('location.edit',$location->id ).'" class="fa fa-pencil btn btn-info">
                </a>
                <form action="'.route('location.destroy',$location->id ) .'" method="post" >
                '.csrf_field().method_field('DELETE').'
                <button class="fa fa-trash btn btn-danger" id="delete">
                </button>
                </form>             
                </div>  ';
            }
            $data[] = $nested_data;
        }
        $locations=$locations->skip($offset)->take($limit);
        $total_data = $locations->count();
        $total_filtered = $locations->count();
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($total_data),  // total number of records
            "recordsFiltered" => intval($total_filtered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
}