<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\Country_group;
use App\Models\Country;

class OrganizationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $organizations = Organization::all();
        return view('organization.show',compact('organizations'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $country_groups = Country_group::all();
        $countries = Country::all();
        $regions = Region::all();
        return view('organization.create',compact('regions','country_groups','countries'));
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
            'organization_name' => 'required',
            'organization_initials' => 'required',
            'organization_type' => 'required',
            'primary_contact_name' => 'required',
            'primary_contact_email' => 'required|email',
            'secondary_contact_email' => 'nullable|email',
            'primary_contact_phone' => 'required|regex:/[0-9]{9}/',
            'secondary_contact_phone' => 'nullable|regex:/[0-9]{9}/',
            'regions.*' => 'required',
            'countries.*' => 'required',
        ]);
        
        $organizations = new Organization;
        $organizations->organization_name  = $request->organization_name ;
        $organizations->organization_type  = $request->organization_type ;
        $organizations->organization_initials  = $request->organization_initials ;
        $organizations->address_line_1  = $request->address_line_1 ;
        $organizations->city  = $request->city ;
        $organizations->post_code  = $request->post_code ;
        $organizations->address_line_2  = $request->address_line_2 ;
        $organizations->region  = $request->region ;
        $organizations->country  = $request->country ;
        $organizations->primary_contact_name  = $request->primary_contact_name ;
        $organizations->primary_contact_email  = $request->primary_contact_email ;
        $organizations->primary_contact_phone  = $request->primary_contact_phone ;
        $organizations->secondary_contact_name  = $request->secondary_contact_name ;
        $organizations->secondary_contact_email  = $request->secondary_contact_email ;
        $organizations->secondary_contact_phone  = $request->secondary_contact_phone ;
        
        $isChecked = $request->has('status');
        if($isChecked == "on")
        {
            $organizations->status = 1 ;
        }
        else
        {
            $organizations->status = 0;
        }
        
        $organizations->save();
        
        $regions = $request->regions;
        $countries = $request->countries;
        $organizations->region()->attach($regions);
        $organizations->country()->attach($countries);
        return redirect()->route('organization.index')->with('success','Record Insert Successful');
        
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Organization  $organization
    * @return \Illuminate\Http\Response
    */
    public function show(Organization $organization)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Organization  $organization
    * @return \Illuminate\Http\Response
    */
    public function edit(Organization $organization)
    {
        $country_groups = Country_group::all();
        $countries = Country::all();
        $regions = Region::all();
        return view('organization.edit',compact('organization','country_groups','countries','regions'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Organization  $organization
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'organization_name' => 'required',
            'organization_initials' => 'required',
            'organization_type' => 'required',
            'primary_contact_name' => 'required',
            'primary_contact_email' => 'required|email',
            'secondary_contact_email' => 'nullable|email',
            'primary_contact_phone' => 'required|regex:/[0-9]{9}/',
            'secondary_contact_phone' => 'nullable|regex:/[0-9]{9}/',
            'regions.*' => 'required',
            'countries.*' => 'required',
        ]);
        
        $organization->update([
            'organization_name' => $request->get('organization_name'),
            'organization_initials' => $request->get('organization_initials'),
            'organization_type' => $request->get('organization_type'),
            'address_line_1' => $request->get('address_line_1'),
            'address_line_2' => $request->get('address_line_2'),
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'post_code' => $request->get('post_code'),
            'primary_contact_name' => $request->get('primary_contact_name'),
            'secondary_contact_name' => $request->get('secondary_contact_name'),
            'primary_contact_email' => $request->get('primary_contact_email'),
            'secondary_contact_email' => $request->get('secondary_contact_email'),
            'primary_contact_phone' => $request->get('primary_contact_phone'),
            'secondary_contact_phone' => $request->get('secondary_contact_phone'),
        ]);
        
        $isChecked = $request->has('status');
        $organization_status = ($isChecked == "on") ? '1' : '0';
        
        $organization->status = $organization_status;
        $regions = $request->regions;
        $countries = $request->countries;
        $organization->region()->sync($regions);
        $organization->country()->sync($countries);
        $organization->update();
        
        return redirect()->route('organization.index')->with('info','Updated Successfully');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Organization  $organization
    * @return \Illuminate\Http\Response
    */
    public function destroy(Organization $organization)
    {
        $organization->update(['status'=> "0"]);
        return redirect()->back()->with('warning','Organization Diactive');
    }
    
    public function organization_show()
    {
        return view('organization.show');
    }
    
    public function ajaxfetchorganization(Request $request)
    {
        $columns = array(
            0 => 'Name',
            1 => 'Contact',
            2 => 'Members',
            3 => 'Type',
            4 => 'Status',
            5 => 'Action',
        );
        
        $data = array();
        
        $organizations = Organization::all();
        
        
        foreach($organizations as $organization)
        {
            $users = $organization->user()->count('user_id');
            
            $raw_class ="";
            $nested_data = array();
            if($organization->status == 0)
            {
                $raw_class = "background-colod:lightgrey";
            }
            $nested_data[] = $organization->organization_name."<br><b>".$organization->organization_initials."</b>";
            $nested_data[] = $organization->primary_contact_name."<br>".$organization->primary_contact_email."<br>".$organization->primary_contact_phone;
            $nested_data[] = $users;
            $nested_data[] = $organization->organization_type;
            $nested_data[] = $organization->status ==1?"Active":"Disable";
            
            if($organization->status == 0)
            {
                $nested_data[] = '<div class="btn btn-group" role="group" >
                <a href="'. route('organization.edit',$organization->id ).'" class="fa fa-pencil btn btn-info">
                </a>             
                </div>  ';
            }
            else{
                $nested_data[] = '<div class="btn btn-group" role="group" >
                <a href="'. route('organization.edit',$organization->id ).'" class="fa fa-pencil btn btn-info">
                </a>
                <form action="'.route('organization.destroy',$organization->id ) .'" method="post" >
                '.csrf_field().method_field('DELETE').'
                <button class="fa fa-trash btn btn-danger" id="delete">
                </button>
                </form>             
                </div>  ';
            }
            $nested_data[] = $raw_class;
            $data[] = $nested_data;
        }
        $json_data = array(
            "draw" => intval($request['draw']),
            "data" => $data
        );
        echo  json_encode($json_data);
    }
}
