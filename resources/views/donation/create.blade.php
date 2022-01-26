@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

<style>
    #myForm .error {
        color: red;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">{{ __('Import Donations') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('donation.store') }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="padding:5px;">
                            <p>To import donations please use the sample file which you can <a href="{{ route('download_excel_samle') }}" class="text-danger">download here</a></p>
                            
                            <div class="form-group">
                                <label for="reference_name" class="col-form-label text-md-right">{{ __('Reference Name') }}</label><span style="color:red;">*</span>
                                <input id="reference_name" type="text"
                                class="form-control @error('reference_name') is-invalid @enderror" name="reference_name"
                                value="{{ old('reference_name') }}"  autocomplete="reference_name" autofocus>
                                
                                @error('reference_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="organization" class="col-form-label text-md-right">{{ __('Organizations') }}</label><span style="color:red;">*</span>
                                <select class="form-control js-states @error('Organization') is-invalid @enderror organization" id="organization[]" name="organization[]" >
                                    <option value=''>-- PLease Select --</option>
                                    @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
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
                                <select class="form-control @error('region') is-invalid @enderror region" id="region[]" name="region[]"  multiple>
                                </select>
                                @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-form-label text-md-right">{{ __('Donation Restrction') }}</label><span style="color:red;">*</span>
                                <select class="form-control @error('country') is-invalid @enderror country" id="country[]" name="country[]"  multiple>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id}}">{{ $country->country_name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-form-label text-md-right">{{ __('Select Excel File') }}</label><span style="color:red;">*</span>
                                <input type="file" name="file" class="form-control file">
                                <p>Selected File Must be excel(.xlsx or .xls)</p>
                                @error('file')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".country").select2({
            placeholder: "Select a country"
        });
        $(".region").select2({
            placeholder: "Select a region"
        });
    });
    $.validator.setDefaults({
        ignore: []
    });
    $("#myForm").validate({
        rules: {
            "reference_name" : { 
                required : true,
            },
            "file" : { 
                required : true,
            },
            "organization[]" : {
                required : true,
            },
            "region[]" : {
                required : true,
            },
            "country[]" : {
                required : true,
            },
        },
        messages : {
            "reference_name" : {
                required: "This field is required...",
            },
            "file" : {
                required: "This field is required...",
            },
            "organization[]" : {
                required: "This field is required...",
            },
            "region[]" : {
                required: "This field is required...",
            },
            "country[]" : {
                required: "This field is required...",
            },
        },
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            elem.removeClass(errorClass);
        },
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
