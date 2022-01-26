<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donation_item;
use App\Models\Organization;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DonationItemImport;
use Carbon\Carbon;

class DonationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('donation.show');
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $organizations = Organization::all();
        $countries = Country::all();
        return view('donation.create',compact('organizations','countries'));
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
            'reference_name' => 'required|unique:donations',
            'organization' => 'required',
            'region.*' => 'required',
            'country.*' => 'required',
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $donations = new Donation;
        $donations->reference_name = $request->reference_name;
        $donations->save();
        
        $donation_id = $donations->id;
        
        $file = $request->file('file');
        try{
            Excel::import(new DonationItemImport($donation_id) , $file);
            $organizations = $request->organization;
            $donations->organization()->attach($organizations);
            
            $countries = $request->country;
            $donations->country()->attach($countries);
            
            $regions = $request->region;
            $donations->region()->attach($regions);
            return redirect()->route('donation_item_index',$donation_id)->with('success','Data Save Successfully');
        }
        catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures  = $e->failures();
            $errormessage = "";
            foreach($failures  as $failure)
            {
                $errormess = "";
                foreach($failure->errors() as $error)
                {
                    $errormess = $errormess.$error;
                }
                $errormessage = $errormessage." \n At Row ".$failure->row().", ".$errormess;
            }
            Donation::where('id',$donation_id)->delete();
            return back()->with('error',$errormess);
        }
        
        
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Donation  $donation
    * @return \Illuminate\Http\Response
    */
    public function show(Donation $donation)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Donation  $donation
    * @return \Illuminate\Http\Response
    */
    public function edit(Donation $donation)
    {
        $organizations = Organization::all();
        $countries = Country::all();
        return view('donation.edit',compact('donation','organizations','countries'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Donation  $donation
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'reference_name' => 'required|unique:donations,reference_name,'.$donation->id,
            'organization' => 'required',
            'region.*' => 'required',
            'country.*' => 'required',
        ]);
        
        $donation->update([
            'reference_name' => $request->get('reference_name'),
        ]);
        
        $organization = $request->organization;
        $region = $request->region;
        $country = $request->country;
        
        $donation->organization()->sync($organization);
        $donation->region()->sync($region);
        $donation->country()->sync($country);
        $donation->update();
        
        return redirect()->route('donation.index')->with('info','Record Update Successfull');
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Donation  $donation
    * @return \Illuminate\Http\Response
    */
    public function destroy(Donation $donation)
    {
        $donation_id = $donation->id;
        $donation_item = Donation_item::where('donation_id', $donation_id)->delete();
        $donation->organization()->sync([]);
        $donation->country()->sync([]);
        $donation->region()->sync([]);
        $donation->delete();
        return redirect()->route('donation_show')->with('danger','Record Deleted Successfully');
    }
    
    public function organization_country(Request $request)
    {
        $organizations = Organization::whereIn('id',$request->values)->get();
        $regions = Array();
        foreach($organizations as $organization)
        {
            $regions = $organization->region()->pluck('region_id');
        }
        $regions = Region::whereIn('id',$regions)->get();
        $data = view('donation/organization-region',compact('regions'))->render();
        return response()->json(['options'=>$data]);
    }
    
    public function organization_country_edit(Request $request)
    {
        $organizations = Organization::whereIn('id',$request->values)->get();
        
        $regions = Array();
        foreach($organizations as $organization)
        {
            $regions = $organization->region()->pluck('region_id');
        }
        $regions = Region::whereIn('id',$regions)->get();
        $data = view('donation/organization-region_edit',compact('regions'))->render();
        return response()->json(['options'=>$data]);
    }
    
    public function donation_show()
    {
        return view('donation.show');
    }
    
    public function ajaxfetchdonation(Request $request)
    {
        $perpage = 5;
        $columns = array(
            0 => 'ID',
            1 => 'Date',
            3 => 'Organization',
            4 => 'Region',
            5 => 'Reference',
            6 => 'Item',
            7 => 'Action',
        );
        
        $data = array();
        $limit=(!empty($request['length']))?$request['length']:$perpage;
        $offset=(!empty($request['start']))?$request['start']:0;
        $total_data = 0;
        
        $donations = Donation::get();
        
        foreach($donations as $donation)
        {
            $organization_name = array();
            $region_name = array();
            foreach($donation->organization as $organization)
            {
                $organization_name[] = $organization->organization_name;
            }
            foreach($donation->region as $region)
            {
                $region_name[] = $region->name;
            }            
            
            $nested_data = array();
            $nested_data[] = $donation->id;
            $nested_data[] = date("d M Y H:i",strtotime($donation->created_at));
            
            $nested_data[] = $organization_name;
            $nested_data[] = $region_name;
            $nested_data[] = $donation->reference_name;
            
            $donation_items = Donation_item::where('donation_id',$donation->id)->get();
            $nested_data[] = count($donation_items);
            
            $nested_data[] = '<div class="btn btn-group" role="group" >
            
            <a href="'.route('donation_item_index',$donation->id) .'" method="get" >
            <button class="fa fa-pencil btn btn-info" id="edit">
            </button>
            </a>
            </form>     
            <form action="'.route('donation.destroy',$donation->id ) .'" method="post" >
            '.csrf_field().method_field('DELETE').'
            <button class="fa fa-trash btn btn-danger" id="delete">
            </button>
            </form>             
            </div>  ';
            
            $data[] = $nested_data;
        }
        $donations=$donations->skip($offset)->take($limit);
        $total_data = $donations->count();
        $total_filtered = $donations->count();
        
        $json_data = array(
            "draw" => intval($request['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($total_data),  // total number of records
            "recordsFiltered" => intval($total_filtered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        echo json_encode($json_data);  // send data as json format
    }
}
