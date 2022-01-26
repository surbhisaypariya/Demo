@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">{{ __('Edit Donations') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('donation.update',[$donation->id]) }}" id="myForm" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="row" style="padding:5px;">
                            <div class="form-group">
                                <label for="reference_name" class="col-form-label text-md-right">{{ __('Reference Name') }}</label><span style="color:red;">*</span>
                                <br/>
                                <input id="reference_name" type="text"
                                class="form-control @error('reference_name') is-invalid @enderror" name="reference_name"
                                value="{{ $donation->reference_name }}" required autocomplete="reference_name" autofocus>
                                
                                @error('reference_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="organization" class="col-form-label text-md-right">{{ __('Organizations') }}</label><span style="color:red;">*</span>
                                <br/>
                                <?php $org_ids = $donation->organization()->pluck("organization_id")->toArray(); 
                                ?>
                                
                                <select class="form-control @error('Organization') is-invalid @enderror organization" id="organization[]" name="organization[]" required>
                                    <option value="">Please Select</option>
                                    @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}" {{ in_array($organization->id , $org_ids)?"selected":"" }}>{{ $organization->organization_name }}</option>
                                    @endforeach
                                </select>
                                @error('organization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="region" class="col-form-label text-md-right">{{ __('Region') }}</label><span style="color:red;">*</span>
                                <br/>
                                <?php   
                                $region_ids = $donation->region()->pluck('region_id')->toArray();  
                                ?>
                                <select class="form-control @error('region') is-invalid @enderror region" id="region[]" name="region[]" required multiple>
                                    <option>-- PLease Select --</option>
                                </select>
                                @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-form-label text-md-right">{{ __('Donation Restrction') }}</label><span style="color:red;">*</span>
                                <br/>
                                <?php $country_ids = $donation->country()->pluck("country_id")->toArray(); 
                                ?>
                                <select class="form-control @error('country') is-invalid @enderror country" id="country[]" name="country[]" required multiple>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id}}" {{ in_array($country->id,$country_ids)?"selected":"" }}>{{ $country->country_name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".country").select2();
        $(".region").select2();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ids = [];
        var data = $('.organization').serializeArray();
        ids.push($('.organization').val());
        
        $.ajax({
            url : "{{ route('organization_country_edit') }}",
            method: "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "values" : ids ,
            },
            success:function(data){
                $(".region").html(data.options);
            },
        });
        
    });
    
    $(".organization").change(function(){
        var ids = [];
        var data = $('.organization').serializeArray();
        ids.push($(this).val());
        $.ajax({
            url : "{{ route('organization_country') }}",
            method: "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "values" : ids ,
            },
            success:function(data){
                $(".region").html(data.options);
            },
        });
    });
    
</script>
@endsection
