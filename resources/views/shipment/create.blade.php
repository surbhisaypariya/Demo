@extends('layouts.app')
<style>
    #myForm .error {
        color: red;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shipment') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('shipment.store') }}" id="myForm">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="date_recieved"
                                    class="col-form-label text-md-right">{{ __('Date Recieved') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control" id="date" name="date">
                                                <option value="--">Date</option>
                                                @for($i= 01; $i <= 31; $i++)
                                                <option value={{ $i }} >{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="month" id="month">
                                                <option value="--">Month</option>
                                                @for($i= 01; $i <= 12; $i++)
                                                <?php 
                                                $dateObj   = DateTime::createFromFormat('!m', $i);
                                                $monthName = $dateObj->format('F'); 
                                                ?>
                                                <option value={{ $i }}><?php echo $monthName; ?></option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" id="year" name="year">
                                                <option value="--">Year</option>
                                                @for($i=2022; $i <=2051; $i++)
                                                <option value={{ $i }} >{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="organization"
                                    class="col-form-label text-md-right">{{ __('Sender') }}</label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-7">
                                    <select id="organization" name="organization" class="form-control organization" placeholder="PLease Select">
                                        <option value="" disabled selected hidden>Please Select</option>
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
                                <div class="col-md-2">
                                    <a href="{{ route('organization.create') }}" class="fa fa-plus btn btn-primary"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="location"
                                    class="col-form-label text-md-right">{{ __('Location') }}</label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-7">
                                    <select id="location" name="location" class="form-control location" placeholder="PLease Select">
                                        <option value="" disabled selected hidden>Please Select</option>
                                        @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('location.create') }}" class="fa fa-plus btn btn-primary"></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="carrier"
                                    class="col-form-label text-md-right">{{ __('Carrier') }}</label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-7">
                                    <select id="carrier" name="carrier" class="form-control carrier" placeholder="PLease Select">
                                        <option value="" disabled selected hidden>Please Select</option>
                                        @foreach($carriers as $carrier)
                                        <option value="{{ $carrier->id }}">{{ $carrier->carrier_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('carrier')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('carriers.create') }}" class="fa fa-plus btn btn-primary"></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="method"
                                    class="col-form-label text-md-right">{{ __('Method') }}</label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-7">
                                    <select id="method" name="method" class="form-control method" placeholder="PLease Select">
                                        <option value="" disabled selected hidden>Please Select</option>
                                    </select>
                                    @error('method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="comments"
                                    class="col-form-label text-md-right">{{ __('Comment') }}</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="comment" id="comment" autofocus  autocomplete="comment"></textarea>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(".carrier").change(function(){
        var ids = $(this).val();
        $.ajax({
            url : "{{ route('carrier_method_data') }}",
            method: "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "values" : ids ,
            },
            success:function(data){
                $(".method").html(data.options);
            },
        });
    });
    
    $.validator.addMethod("isValid",function(value,element){
        $date = $("#date").val();
        $year = $("#year").val();
        $month = $("#month").val();
        
        if((!isNaN($year)) && ($date == '--' || $month == '--' ))
        {
            return false;
        }
        if((!isNaN($date)) && ($year == '--' || $month == '--' ))
        {
            return false;
        }
        if((!isNaN($month)) && ($year == '--' || $date == '--' ))
        {
            return false;
        }
        
        if (($month == 04 || $month == 06 || $month == 09 || $month == 11) && $date == 31)
        {
            return false;
        }
        else if($month == 02)
        {
            $isleap = ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0));
            if($date > 29 || ($date == 29 && !$isleap))
            {
                return false;
            }
            return true;
        }
        return true;  
    },'Invalid Date'); 
    
    
    $("#myForm").validate({
        rules : {
            'date' : { isValid : true  },
            'month' : { isValid : true  },
            'year' : { isValid : true  },
            'organization' : { required : true },
            'location' : { required : true },
            'carrier' : { required : true },
            'method' : { required : true },
        }
    });
    
</script>
@endsection
