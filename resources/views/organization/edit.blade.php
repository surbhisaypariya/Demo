@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">{{ __('Organization') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('organization.update',[$organization->id]) }}">
                        @method('PATCH')
                        @csrf
                        
                        
                        <div class="card">
                            <div class="card-header bg-secondary text-white">{{ __('Organization Details') }}</div>
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    <div class="form-group">
                                        <label for="organization_name" class="col-form-label text-md-right">{{ __('Organization Name') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="organization_name" type="text"
                                        class="form-control @error('organization_name') is-invalid @enderror" name="organization_name"
                                        value="{{ $organization->organization_name }}" required autocomplete="organization_name" autofocus>
                                        
                                        @error('organization_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="organization_type" class="col-form-label text-md-right">{{ __('Organization Type') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <select class="form-control @error('organization_type') is-invalid @enderror" id="organization_type" name="organization_type" value="{{ $organization->organization_type}}" required>
                                            <option value="" >-- Please Select --</option>
                                            <option value="OPCO" {{ $organization->organization_type == "OPCO"?"selected":"" }}>OPCO</option>
                                            <option value="External Partner" {{ $organization->organization_type == "External Partner"?"selected":"" }}>External Partner</option>
                                            <option value="Donor" {{ $organization->organization_type == "Donor"?"selected":"" }}>Donor</option>
                                            <option value="Logistics" {{ $organization->organization_type == "Logistics"?"selected":"" }}>Logistics</option>
                                            <option value="NGO" {{ $organization->organization_type == "NGO"?"selected":"" }}>NGO</option>
                                            <option value="Healthcare" {{ $organization->organization_type == "Healthcare"?"selected":"" }}>Healthcare</option>
                                            <option value="EHP Carrier" {{ $organization->organization_type == "EHP Carrier"?"selected":"" }}>EHP Carrier</option>
                                        </select>
                                        @error('organization_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_initials" class="col-form-label text-md-right">{{ __('Organization Initials') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="organization_initials" type="text"
                                        class="form-control @error('organization_initials') is-invalid @enderror" name="organization_initials"
                                        value="{{ $organization->organization_initials }}" required autocomplete="organization_initials" autofocus maxlength="5">
                                        
                                        @error('organization_initials')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="col-form-label text-md-right">{{ __('Regions') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <?php $region_ids = $organization->region()->pluck("region_id")->toArray(); ?>
                                        <select class="form-control @error('organization_type') is-invalid @enderror regions" id="regions[]" name="regions[]" required multiple="multiple">
                                            @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ in_array($region->id , $region_ids)?"selected":""}}>{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary text-white">{{ __('Organization Operating Restrictions') }}</div>
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    <div class="form-group">
                                        <label for="countries" class="col-form-label text-md-right">{{ __('Restrictions') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <?php 
                                        $country_group_id = $organization->country()->pluck('country_id')->toArray();
                                        ?>
                                        <select class="form-control @error('countries') is-invalid @enderror countries" id="countries[]" name="countries[]" required multiple="multiple">
                                            @foreach($country_groups as $country_group)
                                            <optgroup label="{{ $country_group->group_name }}">
                                                @foreach($country_group->country as $country)
                                                <option value="{{ $country->id }}"{{ in_array($country->id , $country_group_id)?"selected":"" }}>{{ $country->country_name }}</option>
                                                @endforeach
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('countries')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary text-white">{{ __('Organization Address') }}</div>
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    <div class="form-group">
                                        <label for="address_line_1" class="col-form-label text-md-right">{{ __('Address Line 1') }}</label>
                                        <br/>
                                        <input id="address_line_1" type="text"
                                        class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1"
                                        value="{{ $organization->address_line_1 }}"  autocomplete="address_line_1" autofocus>
                                        
                                        @error('address_line_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-form-label text-md-right">{{ __('Town/City') }}</label>
                                        <br/>
                                        <input id="city" type="text"
                                        class="form-control @error('city') is-invalid @enderror" name="city"
                                        value="{{ $organization->city }}"  autocomplete="city" autofocus>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="post_code" class="col-form-label text-md-right">{{ __('Post Code') }}</label>
                                        <br/>
                                        <input id="post_code" type="text"
                                        class="form-control @error('post_code') is-invalid @enderror" name="post_code"
                                        value="{{ $organization->post_code }}"  autocomplete="post_code" autofocus>
                                        @error('post_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address_line_2" class="col-form-label text-md-right">{{ __('Address Line 2') }}</label>
                                        <br/>
                                        <input id="address_line_2" type="text"
                                        class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2"
                                        value="{{ $organization->address_line_2 }}"  autocomplete="address_line_2" autofocus>
                                        @error('address_line_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="col-form-label text-md-right">{{ __('Regions/Area') }}</label>
                                        <br/>
                                        <input id="region" type="text"
                                        class="form-control @error('region') is-invalid @enderror" name="region"
                                        value="{{ $organization->region }}"  autocomplete="region" autofocus>
                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                        <br/>
                                        <select class="form-control @error('country') is-invalid @enderror country" id="country" name="country"  >
                                            <option value="" selected>-- Please Select --</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->country_name }}" {{ $organization->country == $country->country_name?"selected":""}}>{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary text-white">{{ __('Contact Details') }}</div>
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    <div class="form-group">
                                        <label for="primary_contact_name" class="col-form-label text-md-right">{{ __('Primary Contact Name') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="primary_contact_name" type="text"
                                        class="form-control @error('primary_contact_name') is-invalid @enderror" name="primary_contact_name"
                                        value="{{ $organization->primary_contact_name }}" required autocomplete="primary_contact_name" autofocus>
                                        
                                        @error('primary_contact_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="primary_contact_email" class="col-form-label text-md-right">{{ __('Primary Contact Email') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="primary_contact_email" type="email"
                                        class="form-control @error('primary_contact_email') is-invalid @enderror" name="primary_contact_email"
                                        value="{{ $organization->primary_contact_email }}" required autocomplete="primary_contact_email" autofocus>
                                        @error('primary_contact_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="primary_contact_phone" class="col-form-label text-md-right">{{ __('Primary Contact Phone') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="primary_contact_phone" type="text"
                                        class="form-control @error('primary_contact_phone') is-invalid @enderror" name="primary_contact_phone"
                                        value="{{ $organization->primary_contact_phone }}" required autocomplete="primary_contact_phone" autofocus>
                                        @error('primary_contact_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="secondary_contact_name" class="col-form-label text-md-right">{{ __('Secondary Contact Name') }}</label>
                                        <br/>
                                        <input id="secondary_contact_name" type="text"
                                        class="form-control @error('secondary_contact_name') is-invalid @enderror" name="secondary_contact_name"
                                        value="{{ $organization->secondary_contact_name }}"  autocomplete="secondary_contact_name" autofocus>
                                        
                                        @error('secondary_contact_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="secondary_contact_email" class="col-form-label text-md-right">{{ __('Secondary Contact Email') }}</label>
                                        <br/>
                                        <input id="secondary_contact_email" type="email"
                                        class="form-control @error('secondary_contact_email') is-invalid @enderror" name="secondary_contact_email"
                                        value="{{ $organization->secondary_contact_email }}"  autocomplete="secondary_contact_email" autofocus>
                                        @error('secondary_contact_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="secondary_contact_phone" class="col-form-label text-md-right">{{ __('Secondary Contact Phone') }}</label>
                                        <br/>
                                        <input id="secondary_contact_phone" type="text"
                                        class="form-control @error('secondary_contact_phone') is-invalid @enderror" name="secondary_contact_phone"
                                        value="{{ $organization->secondary_contact_phone }}"  autocomplete="secondary_contact_phone" autofocus>
                                        @error('secondary_contact_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-header">{{ __('status') }}</div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  id="status" name="status" {{ $organization->status ==1?"checked":""}}/>
                                    <label class="form-check-label" for="flexCheckDefault">Status </label>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {   
        $('.countries').select2(); 
        $('.regions').select2();
    });
</script>
@endsection
