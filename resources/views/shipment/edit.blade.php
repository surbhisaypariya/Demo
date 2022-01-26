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
                <div class="card-header">{{ __('Shipment Edit') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('shipment.update',[$shipment->id]) }}" id="myForm">
                        @method('PATCH')
                        @csrf                        
                        
                        <input type="text" hidden name="refrence" value="{{ $shipment->reference }}">
                        @if(!empty($shipment->date_recieved))
                        <?php 
                        $fulldate = $shipment->date_recieved;
                        $splitdate = explode('-',$fulldate);
                        $date = $splitdate[2];
                        $month = $splitdate[1];
                        $year = $splitdate[0];
                        ?>   
                        @else
                        <?php
                        $date = '--';
                        $month = '--';
                        $year = '--';
                        ?>
                        @endif
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
                                                <option value="--" {{ $date == '--' ? "selected":"" }}>Date</option>
                                                @for($i= 01; $i <= 31; $i++)
                                                <option value={{ $i }} {{ $date==$i?"selected":"" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="month" id="month">
                                                <option value="--" {{ $month == '--' ? "selected":"" }}>Month</option>
                                                @for($i= 01; $i <= 12; $i++)
                                                <?php 
                                                $dateObj   = DateTime::createFromFormat('!m', $i);
                                                $monthName = $dateObj->format('F'); 
                                                ?>
                                                <option value={{ $i }} {{ $month==$i?"selected":"" }}><?php echo $monthName; ?></option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" id="year" name="year">
                                                <option value="--" {{ $year == '--' ? "selected":"" }}>Year</option>
                                                @for($i=2022; $i <=2051; $i++)
                                                <option value={{ $i }} {{ $year==$i?"selected":"" }}>{{ $i }}</option>
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
                                    <?php $org_id = $shipment->organization()->pluck('organization_id')->toArray();
                                    ?>
                                    <select id="organization" name="organization" class="form-control organization">
                                        @foreach($organizations as $organization)
                                        <option value="{{ $organization->id }}" {{ in_array($organization->id , $org_id)?"selected":"" }}>{{ $organization->organization_name }}</option>
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
                                    <?php $loc_id = $shipment->location()->pluck('location_id')->toArray();
                                    ?>
                                    <select id="location" name="location" class="form-control location" placeholder="PLease Select">
                                        <option value="" disabled selected hidden>Please Select</option>
                                        @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ in_array($location->id , $loc_id)?"selected":"" }}>{{ $location->name }}</option>
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
                                    <?php $carrier_id = $shipment->carrier()->pluck('carrier_id')->toArray();
                                    ?>
                                    <select id="carrier" name="carrier" class="form-control carrier" placeholder="PLease Select">
                                        <option value="" disabled selected hidden>Please Select</option>
                                        @foreach($carriers as $carrier)
                                        <option value="{{ $carrier->id }}" {{ in_array($carrier->id , $carrier_id)?"selected":"" }}>{{ $carrier->carrier_name }}</option>
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
                                    </select>
                                    @error('method')
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
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="{{ route('markaspost',[$shipment->id]) }}" class="btn btn-primary">Mark As Posted</a><br>
        </form>
        
        <?php 
        $comments_id = $shipment->comment()->pluck('comment_id')->toArray();
        $comments = App\Models\Comment::whereIn('id',$comments_id)->get();;
        ?>
        
        @foreach ($comments as $comment)
        <div style="background-color: rgb(232, 232, 232);box-shadow: 5px 10px 8px #888888;padding:10px;">
            <b>
                <?php  
                $user_id = $comment->user_id ;
                $user_name = App\Models\User::where('id',$user_id)->first();  
                echo $user_name->firstname; 
                echo "&nbsp;";
                echo $user_name->lastname;
                ?>
            </b>
            <label class="fa fa-circle fa-xs"></label>
            {{ date("d M Y ",strtotime($comment->created_at)) }}
            <label class="fa fa-circle fa-xs"></label>
            {{ date("H:i A ",strtotime($comment->created_at)) }}
            <br>
            {{ $comment->description }}
        </div>
        @endforeach
        
        <form method="POST" action="{{ route('add_comments') }}">
            @csrf
            <input name="shipment_id" value="{{ $shipment->id }}" type="hidden">
            <div class="form-group" style="padding: 20px;">
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
                        {{ __('Add Comments') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Products</div>
    <div class="card-body">
        <table class="table table-stripped " id="datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Item Number</th>
                    <th>Brand Name</th>
                    <th>Units</th>
                    <th>Batch</th>
                    <th>Expiry</th>
                    <th>Pallet Id</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th><b>Total Units :<label id="total_of_units"></label></b></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="buttonDiv">
                <button class="btn btn-success add_product_btn" id="add_product_btn">Add Product</button>
            </div>
            
        </div>
        <span id="bind_data"></span>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/api/sum().js"></script>

<script>
    
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        'paging' : false,
        'searching': false,
        "columnDefs" : [{ targets: 0, visible: false }],
        "ajax" : {
            url : "{{ route('inbound_item_view') }}",
            method : "post",
            data : {
                "_token":"{{ csrf_token() }}",
                "shipment_id" : '{{ $shipment->id }}', },
            }, 
            drawCallback: function () {
                var api = this.api();
                $total_of_units = api.column( 3 ).data().sum();
                var total_units = parseFloat($total_of_units).toFixed(2);
                $("#total_of_units").text(total_units);
            } 
        });
        
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
        
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var ids = $("#carrier").val();
            var shipment = "<?php echo $shipment->id; ?>" ;
            
            $.ajax({
                url : "{{ route('carrier_method_dataedit') }}",
                method: "POST",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "values" : ids,
                    "shipment_id" : shipment,
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
        
        $("#buttonDiv").on('click', '#add_product_btn', function(e) {
            e.preventDefault();
            $.ajax({
                cache: false,
                type : "POST",
                url : "{{ route('add_productview') }}",
                data: { 
                    "shipment_id" : '{{ $shipment->id }}',
                    "_token":"{{ csrf_token() }}",
                },
                success:function(data)
                {
                    $("#bind_data").show();
                    $("#bind_data").html(data.data);
                }
            });
        });
        
        
        $("#datatable").on('click','.edit',function(e){
            e.preventDefault();
            var tr = $(this).parents('tr');
            var row = oTable.row( tr );
            
            var ids = oTable.row($(this).parents('tr')).data();
            id = ids[0];
            code = ids[1];
            
            $.ajax({
                type : "POST",
                url : "{{ route('fetchinbound_itemedit') }}",
                data: { 
                    id: id ,
                    shipment_id : '{{ $shipment->id }}',
                    "_token":"{{ csrf_token() }}",
                },
                success:function(data)
                {
                    row.child(data.data).show();
                }
            });
        });
        
        $("#datatable").on('click','.show',function(e){
            e.preventDefault();
            var tr = $(this).parents('tr');
            var row = oTable.row( tr );
            
            var ids = oTable.row($(this).parents('tr')).data();
            id = ids[0];
            code = ids[1];
            
            $.ajax({
                type : "POST",
                url : "{{ route('fetchinbound_itemshow') }}",
                data: { 
                    id: id ,
                    shipment_id : '{{ $shipment->id }}',
                    "_token":"{{ csrf_token() }}",
                },
                success:function(data)
                {
                    row.child(data.data).show();
                }
            });
        });
        
        
        $("#datatable").on('click','.delete',function(e){
            e.preventDefault();
            var tr = $(this).parents('tr');
            var row = oTable.row( tr );
            
            var ids = oTable.row($(this).parents('tr')).data();
            id = ids[0];
            code = ids[1];
            
            $.ajax({
                type : "POST",
                url : "{{ route('inbound_item_destroy')}}",
                data: { 
                    id: id ,
                    "_token":"{{ csrf_token() }}",
                },
                success:function(data)
                {
                    oTable.ajax.reload();
                }
            });
        });
        
    </script>
    @endsection
    