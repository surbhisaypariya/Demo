<div >
    <div class="row">
        <div class="col-md-4 border">
            <p class="text text-primary font-weight-bold">Recieved</p>
            <label id="recieved" style="font-size: 150%;"> {{ $inbound_items->number_of_unit }} </label>
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
</div>
<div class="row">
    <div class="col-md-3">
        <a id="view_detail{{ $inbound_items->id }}" class="btn btn-primary" target="_blank" href="{{ route('view_detail',[$inbound_items->id])}}">View Detail</a>
    </div>
</div>
<input id="inbound_id{{ $inbound_items->id }}" value="{{ $inbound_items->id }}" type="hidden">
