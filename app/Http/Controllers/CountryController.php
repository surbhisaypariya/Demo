<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $countries = Country::all();
        return view('country.show',compact('countries'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('country.create');
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
            'country_code' => 'required|unique:countries',
            'country_name' => 'required',
        ]);
        
        $countries = new Country;
        $countries->country_code = $request->country_code;
        $countries->country_name = $request->country_name;
        $countries->save();
        
        return redirect()->route('country.index')->with('success','inserted Successfully!!!');
        
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Country  $country
    * @return \Illuminate\Http\Response
    */
    public function show(Country $country)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Country  $country
    * @return \Illuminate\Http\Response
    */
    public function edit(Country $country)
    {
        return view('country.edit',compact('country'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Country  $country
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country_code' => 'required|unique:countries,country_code,'.$country->id,
            'country_name' => 'required',
        ]);
        
        $country->update([
            "country_code" => $request->get('country_code'),
            "country_name" => $request->get('country_name'),
        ]);
        
        $country->update();
        return redirect()->route('country.index')->with('info','Record Updated');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Country  $country
    * @return \Illuminate\Http\Response
    */
    public function destroy(Country $country)
    {
        $country->delete();
        
        return redirect()->route('country.index')->with('warning','Deleted!!!');
    }
}
