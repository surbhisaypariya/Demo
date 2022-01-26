@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 border">
            <p class="text text-primary font-weight-bold">Recieved</p>
            <label id="recieved" style="font-size: 150%;"> {{ $inbound_items->number_of_unit }} </label>
            <?php 
            $in_id = $inbound_items->id ;
            $shipment_ref = App\Models\Inbound_item::where('id',$in_id)->get('shipment_id')->first();
            $shipment_id =  $shipment_ref->shipment_id ;
            $shipment_Data = App\Models\Shipment::where('id',$shipment_id)->first();
            $user_id =  $shipment_Data->user_id;
            $username = App\Models\User::where('id',$user_id)->get(['firstname','lastname'])->first();
            ?>
            <p> 
                Recieved By <text class="text-primary">{{ $shipment_Data->reference }}</text>
                at {{ date(" H:i",strtotime($shipment_Data->created_at)) }}
                on {{ date("d M Y ",strtotime($shipment_Data->created_at)) }}
            </p>
            <p> 
                Added By <text class="text-primary">{{ $username->firstname }}{{ $username->lastname }}</text>
                at {{ date("H:i",strtotime($shipment_Data->created_at)) }}
                on {{ date("d M Y ",strtotime($shipment_Data->created_at)) }}
            </p>
            <p> 
                Posted By <text class="text-primary">{{ $shipment_Data->reference }}</text>
                at {{ date("H:i",strtotime($shipment_Data->created_at)) }} 
                on {{ date("d M Y ",strtotime($shipment_Data->created_at)) }} 
                By <text class="text-primary">{{ $username->firstname }}{{ $username->lastname }}</text>
            </p>
        </div>
        <div class="col-md-4 border">
            <p class="text text-warning font-weight-bold">Adjusted</p>
            <label id="adjusted" style="font-size: 150%;">
                <?php 
                $adjusts = App\Models\Adjust::where('inbounceitem_id',$inbound_items->id)->latest()->first();
                ?>
                @if(!empty($adjusts))
                {{ $adjusts->adjusted }}
                @else
                0 
                @endif
                <?php 
                $histories =  App\Models\InboundItem_History::where('inbounditem_id',$inbound_items->id)->get();
                ?>
                @foreach($histories as $history)
                
                <p style="font-size: medium;">
                    adjusted
                    <?php 
                    $history_fields = history_adjusts($history);
                    echo '<b>'.$history_fields.'</b>';
                    $username = App\Models\User::where('id',$history->user_id)->first('username'); 
                    echo 'by <text class="text-warning">'.$username->username.'</text>';
                    ?>
                    
                    at {{ date("H:i",strtotime($history->created_at)) }} 
                    on {{ date("d M Y ",strtotime($history->created_at)) }} 
                    
                </p>
                @endforeach
                <?php 
                $adjusts = App\Models\Adjust::where('inbounceitem_id',$inbound_items->id)->get();
                ?>
                
                @foreach($adjusts as $adjust)
                <?php 
                if($adjust->math_icon == 0)
                {
                    $math_icon = '-' ;
                }
                else {
                    $math_icon = '+' ;
                }
                $user = App\Models\User::where('id',$adjust->user_id)->get('username')->first();
                ?>
                <p style="font-size: medium;">
                    adjusted <b>{{ $math_icon.''.$adjust->units }}</b> by <text class="text-warning">{{ $user->username }}</text> 
                    at {{ date("H:i",strtotime($adjust->created_at)) }} 
                    on {{ date("d M Y ",strtotime($adjust->created_at)) }} 
                    <?php 
                    $reason = '';
                    if(!empty($adjust->reason))
                    {
                        $reason = $adjust->reason ;
                    }
                    ?>
                    <text class="text-danger"> {{ $reason }}</text>
                </p>
                @endforeach
            </label>
        </div>
        <div class="col-md-4 border">
            <p class="text text-info font-weight-bold">Available</p>
            <label id="available" style="font-size: 150%;">
                <?php 
                $adjusts = App\Models\Adjust::where('inbounceitem_id',$inbound_items->id)->latest()->first();
                ?>
                @if(!empty($adjusts))
                {{ $adjusts->available }}
                @else
                {{ $inbound_items->number_of_unit }}
                @endif
                
            </label>
        </div>
    </div>
    
    <div class="row" id="data{{ $inbound_items->id}}">
        <div class="col-md-3">
            <div class="form-group">
                <label>Item Number</label>
                <input type="text" readonly value="{{ $products->product_code }}" class="form-control" id="">
            </div>
            <div class="form-group">
                <label>Product Licence</label>
                <input type="text" readonly value="{{ $products->product_licence }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit Size</label> 
                <input type="text" readonly value="{{ $products->unit_size }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Aisle</label>
                <input type="text" readonly value="{{ $inbound_items->aisle }}" class="form-control">
                <input type="hidden" value="{{ $inbound_items->id }}" class="form-control" id="product_id">
            </div>
            <div class="form-group">
                <label>FMD</label>
                <input type="text" readonly value="{{ $inbound_items->fmd == 1?"Yes":"No" }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Number of Units</label>
                <input type="text" readonly value="{{ $inbound_items->number_of_unit }}" class="form-control" id="number_of_unit{{$inbound_items->id}}">
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Manufecturer</label>
                <input type="text" readonly value="{{ $products->manufacture }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit</label>
                <input type="text" readonly value="{{ $products->unit_of_sale }}" class="form-control">
            </div>
            <div class="form-group">
                <label>HS Code</label>
                <input type="text" readonly value="{{ $products->hs_code }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Pallet Id</label>
                <input type="text" readonly value="{{ $inbound_items->pallet_id }}" class="form-control">
                <input type="hidden" value="{{ $inbound_items->id }}" class="form-control" id="inbound_id{{$inbound_items->id}}">
            </div>
            <div class="form-group">
                <label>Expiry Date</label>
                <input type="text" readonly value="{{ $inbound_items->expiry_date }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Total Number of Treatments</label>
                <input type="text" readonly value="{{ $inbound_items->total_no_treatment }}" class="form-control" id="total_no_treatment">
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" readonly value="{{ $products->brand_name }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Country of Manufecturer</label>
                <input type="text" readonly value="{{ $products->country_manufecture }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Type</label>
                <input type="text" readonly value="{{ $category }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Unit Value</label>
                <input type="text" readonly value="{{ $inbound_items->unit_value }}" class="form-control" id="unit_value">
            </div>
            <div class="form-group">
                <label>Donation Reference</label>
                <input type="text" readonly value="{{ $inbound_items->donation_reference }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Batch</label>
                <input type="text" readonly value="{{ $inbound_items->batch }}" class="form-control">
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Generic Name</label>
                <input type="text" readonly value="{{ $products->generic_name }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Number of Treatments</label>
                <input type="text" readonly value="{{ $products->treatment }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" readonly value="{{ $inbound_items->location }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Total Value</label>
                <input type="text" readonly value="{{ $inbound_items->total_value }}" class="form-control" id="total_value">
            </div>
            <div class="form-group">
                <label>Allocation </label>
                <input type="text" readonly value="{{ $inbound_items->allocation }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Batch Extension</label>
                <input type="text" readonly value="{{ $inbound_items->batch_extension }}" class="form-control">
            </div>
        </div>
        <label id="message" class="alert alert-success" style="display: none;"></label>
        
        @if($inbound_items->status == 1)
        <div class="form-group" id="adjust">
            <button class="btn btn-success adjust" id="adjust{{ $inbound_items->id }}">Adjust</button>
            <button class="btn btn-danger hold" id="hold{{ $inbound_items->id }}">Hold</button>
        </div>
        @endif
        @if($inbound_items->status == 0)
        <div class="form-group" id="unhold">
            <button class="btn btn-danger unhold" id="unhold{{ $inbound_items->id }}">UnHold</button>
        </div>
        @endif
        @if($inbound_items->status == 2)
        <div class="form-group" id="adjust">
            <button class="btn btn-success adjust" id="adjust{{ $inbound_items->id }}">Adjust</button>
            <button class="btn btn-danger hold" id="hold{{ $inbound_items->id }}">Hold</button>
        </div>
        @endif
        
        <div class="form-group" id="adjust" style="display: none;">
            <button class="btn btn-success adjust" id="adjust{{ $inbound_items->id }}">Adjust</button>
            <button class="btn btn-danger hold" id="hold{{ $inbound_items->id }}">Hold</button>
        </div>
        <div class="form-group" id="unhold" style="display: none;">
            <button class="btn btn-danger unhold" id="unhold{{ $inbound_items->id }}">UnHold</button>
        </div>
    </div>
    <span id="bindData{{ $inbound_items->id }}"></span>
</div>

<script>
    
    $(document).on('click','#adjust{{ $inbound_items->id }}',function(){
        var id = $("#inbound_id{{$inbound_items->id}}").val();
        $.ajax({
            type : "POST",
            url : "{{ route('calladjustview') }}",
            data: { 
                id : id,
                "_token":"{{ csrf_token() }}",
            },
            success:function(data)
            {
                $("#data{{ $inbound_items->id}}").hide();
                $("#bindData{{ $inbound_items->id }}").html(data.data);
            }
        }); 
    });
    
    $(document).on('click','#hold{{ $inbound_items->id }}',function(){
        var id = $("#inbound_id{{$inbound_items->id}}").val();
        $.ajax({
            type : "POST",
            url : "{{ route('markashold') }}",
            data: { 
                id : id,
                "_token":"{{ csrf_token() }}",
            },
            success:function(data)
            {
                $("#adjust").hide();
                $("#unhold").show();
                $("#message").show();
                $("#message").text("Item Mark as Hold");
            }
        }); 
    });
    
    $(document).on('click','#unhold{{ $inbound_items->id }}',function(){
        var id = $("#inbound_id{{$inbound_items->id}}").val();
        $.ajax({
            type : "POST",
            url : "{{ route('markasunhold') }}",
            data: { 
                id : id,
                "_token":"{{ csrf_token() }}",
            },
            success:function(data)
            {
                $("#unhold").hide();
                $("#adjust").show();
                $("#message").show();
                $("#message").text("Item Mark as unHold");
            }
        }); 
    });
</script>

<?php 

function history_adjusts($history)
{
    $fields = array();
    
    if(!empty($history))
    {
        if($history->old_aisle != $history->new_aisle)
        {
            $fields[] = "Aisle ";
        }
        if($history->old_pallet_id != $history->new_pallet_id)
        {
            $fields[] = "Pallet Id ";
        }
        if($history->old_unit_value != $history->new_unit_value)
        {
            $fields[] = "Unit Value ";
        }
        if($history->old_expiry_date != $history->new_expiry_date)
        {
            $fields[] = "Expiry Date ";
        }
        if($history->old_donation_reference != $history->new_donation_reference)
        {
            $fields[] = "Donation Reference ";
        }
        if($history->old_allocation != $history->new_allocation)
        {
            $fields[] = "Allocation ";
        }
        if($history->old_number_of_unit != $history->new_number_of_unit)
        {
            $fields[] = "Number of Unit ";
        }
        if($history->old_total_no_treatment != $history->new_total_no_treatment)
        {
            $fields[] = "Total no Treatment " ;
        }
        if($history->old_batch != $history->new_batch)
        {
            $fields[] = "Batch ";
        }
        if($history->old_fmd != $history->new_fmd)
        {
            $fields[] = " FMD ";
        }
        if($history->old_total_value != $history->new_total_value)
        {
            $fields[] = " Total Value ";
        }
        return implode(',',$fields);
    }
    
}
?>

@endsection