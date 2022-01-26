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
                <div class="card-header">{{ __('Shipment posted') }}</div>
                <div class="card-body">
                    
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
                                        <select class="form-control" id="date" name="date" readonly>
                                            <option value="--" {{ $date == '--' ? "selected":"" }}>Date</option>
                                            @for($i= 01; $i <= 31; $i++)
                                            <option value={{ $i }} {{ $date==$i?"selected":"" }} >{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="month" id="month" readonly>
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
                                        <select class="form-control" id="year" name="year" readonly>
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
                                <select id="organization" name="organization" class="form-control organization" readonly>
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
                                <select id="location" name="location" class="form-control location" placeholder="PLease Select" readonly>
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
                                <select id="carrier" name="carrier" class="form-control carrier" placeholder="PLease Select" readonly>
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
                            <?php $method_name = $shipment->method()->pluck('method_name')->toArray();
                            ?>
                            <div class="col-md-7">
                                <select id="method" name="method" class="form-control method" placeholder="PLease Select" readonly>
                                    <option selected>{{ implode(',',$method_name) }}</option>
                                </select>
                                @error('method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
            
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">Items</div>
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
                url : "{{ route('inbound_item_viewposted') }}",
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
            
        </script>
        @endsection
        