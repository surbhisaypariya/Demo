@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">{{ __('Add Location') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('location.store') }}" id="myForm">
                        @csrf
                        <div class="card">
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="display_name" class="col-form-label text-md-right">{{ __('Display Name') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="display_name" type="text"
                                        class="form-control @error('display_name') is-invalid @enderror" name="display_name"
                                        value="{{ old('display_name') }}" required autocomplete="name" autofocus>
                                        
                                        @error('display_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location_code" class="col-form-label text-md-right">{{ __('Location Code') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="location_code" type="text"
                                        class="form-control @error('location_code') is-invalid @enderror" name="location_code"
                                        value="{{ old('location_code') }}" required autocomplete="location_code" autofocus >
                                        
                                        @error('location_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="location_type" class="col-form-label text-md-right">{{ __('Location Type') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <select class="form-control @error('location_type') is-invalid @enderror location_type" id="location_type" name="location_type" required >
                                            <option value="">Please Select</option>
                                            <option value="Logistics Warehouse">Logistics Warehouse</option>
                                            <option value="Logistics Hub">Logistics Hub</option>
                                            <option value="Company Warehouse">Company Warehouse</option>
                                            <option value="3rd Party Warehouse">3rd Party Warehouse</option>
                                        </select>
                                        @error('location_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary text-white">{{ __('Location Address') }}</div>
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    <div class="form-group">
                                        <label for="address_line_1" class="col-form-label text-md-right">{{ __('Address Line 1') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="address_line_1" type="text"
                                        class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1"
                                        value="{{ old('address_line_1') }}"  autocomplete="address_line_1" autofocus>
                                        
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
                                        value="{{ old('city') }}"  autocomplete="city" autofocus>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="post_code" class="col-form-label text-md-right">{{ __('Post Code') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <input id="post_code" type="text"
                                        class="form-control @error('post_code') is-invalid @enderror" name="post_code"
                                        value="{{ old('post_code') }}"  autocomplete="post_code" autofocus>
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
                                        value="{{ old('address_line_2') }}"  autocomplete="address_line_2" autofocus>
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
                                        value="{{ old('region') }}"  autocomplete="region" autofocus>
                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <select class="form-control @error('country') is-invalid @enderror country" id="country" name="country"  >
                                            <option value="" selected>-- Please Select --</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
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
                                        <label for="general_inquiry_phone" class="col-form-label text-md-right">{{ __('General Inquiry Phone') }}</label>
                                        <br/>
                                        <input id="general_inquiry_phone" type="text"
                                        class="form-control @error('general_inquiry_phone') is-invalid @enderror" name="general_inquiry_phone"
                                        value="{{ old('general_inquiry_phone') }}"   autocomplete="general_inquiry_phone" autofocus>
                                        
                                        @error('general_inquiry_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="primary_contact_name" class="col-form-label text-md-right">{{ __('Primary Contact Name') }}</label>
                                        <br/>
                                        <input id="primary_contact_name" type="text"
                                        class="form-control @error('primary_contact_name') is-invalid @enderror" name="primary_contact_name"
                                        value="{{ old('primary_contact_name') }}"   autocomplete="primary_contact_name" autofocus>
                                        
                                        @error('primary_contact_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="primary_contact_email" class="col-form-label text-md-right">{{ __('Primary Contact Email') }}</label>
                                        <br/>
                                        <input id="primary_contact_email" type="email"
                                        class="form-control @error('primary_contact_email') is-invalid @enderror" name="primary_contact_email"
                                        value="{{ old('primary_contact_email') }}"  autocomplete="primary_contact_email" autofocus>
                                        @error('primary_contact_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="primary_contact_phone" class="col-form-label text-md-right">{{ __('Primary Contact Phone') }}</label>
                                        <br/>
                                        <input id="primary_contact_phone" type="text"
                                        class="form-control @error('primary_contact_phone') is-invalid @enderror" name="primary_contact_phone"
                                        value="{{ old('primary_contact_phone') }}"  autocomplete="primary_contact_phone" autofocus>
                                        @error('primary_contact_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="general_inquiry_email" class="col-form-label text-md-right">{{ __('General Inquiry Email') }}</label>
                                        <br/>
                                        <input id="general_inquiry_email" type="text"
                                        class="form-control @error('general_inquiry_email') is-invalid @enderror" name="general_inquiry_email"
                                        value="{{ old('general_inquiry_email') }}"   autocomplete="general_inquiry_email" autofocus>
                                        
                                        @error('general_inquiry_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="secondary_contact_name" class="col-form-label text-md-right">{{ __('Secondary Contact Name') }}</label>
                                        <br/>
                                        <input id="secondary_contact_name" type="text"
                                        class="form-control @error('secondary_contact_name') is-invalid @enderror" name="secondary_contact_name"
                                        value="{{ old('secondary_contact_name') }}"  autocomplete="secondary_contact_name" autofocus>
                                        
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
                                        value="{{ old('secondary_contact_email') }}"  autocomplete="secondary_contact_email" autofocus>
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
                                        value="{{ old('secondary_contact_phone') }}"  autocomplete="secondary_contact_phone" autofocus>
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
                                    <input class="form-check-input" type="checkbox"  id="status" name="status"/>
                                    <label class="form-check-label" for="flexCheckDefault">Status </label>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card">
                            <div class="row" style="padding:5px;">
                                <div class="col-md-6" style="padding-right:100px;">
                                    
                                    <div class="form-group">
                                        <label for="organization" class="col-form-label text-md-right">{{ __('Organization') }}</label><span style="color:red;">*</span>
                                        <br/>
                                        <select class="form-control @error('Organization') is-invalid @enderror organization" id="organization[]" name="organization[]" required multiple="multiple" >
                                            <option value="">Please Select</option>
                                            @foreach($organizations as $organization)
                                            <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('organization')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        
                                        <span id="binddata">
                                        </span>
                                    </div>
                                    
                                </div>
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
<script src="../assets/js/hierarchy-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.organization').select2();
        
        $(".organization").change(function(){
            var ids = [];
            var data = $('.organization').serializeArray();
            ids.push($(this).val());
            $.ajax({
                url : "{{ route('ajaxuserfetch') }}",
                method: "POST",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "values" : ids ,
                },
                success:function(data){
                    $("#binddata").html(data.data);
                },
            });
        });
    });
    
    
    
</script>
@endsection
