<?php

namespace App\Http\Controllers;

use App\Models\Country_group;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryGroupController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $country_groups = Country_Group::all();
        return view('country_group.show',compact('country_groups')) ;
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $countries = Country::all();
        return view('country_group.create',compact('countries'));
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
            'group_name' => 'required',
            'countries.*' => 'required',
        ]);
        
        $category_groups = new Country_Group;
        $category_groups->group_name = $request->group_name;
        $category_groups->save();
        
        $category_group_id = $category_groups->id;
        $countries = $request->countries;
        
        $category_groups->country()->attach($countries);
        
        return redirect()->route('country_group.index')->with('success','Record Inserted');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Country_group  $country_group
    * @return \Illuminate\Http\Response
    */
    public function show(Country_group $country_group)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Country_group  $country_group
    * @return \Illuminate\Http\Response
    */
    public function edit(Country_group $country_group)
    {
        $countries = Country::all();
        return view('country_group.edit',compact('country_group','countries'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Country_group  $country_group
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Country_group $country_group)
    {
        $request->validate([
            'group_name' => 'required',
            'countries.*' => 'required',
        ]);
        
        $country_group->update([
            "group_name" => $request->get('group_name'),
        ]);
        
        $countries = $request->get('countries');
        $country_group->country()->sync($countries);
        $country_group->update();
        
        return redirect()->route('country_group.index')->with('info','Record Updated');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Country_group  $country_group
    * @return \Illuminate\Http\Response
    */
    public function destroy(Country_group $country_group)
    {
        $country_group->country()->sync([]);
        $country_group->delete();
        return redirect()->route('country_group.index')->with('warning','Record Delete');
    }
}
