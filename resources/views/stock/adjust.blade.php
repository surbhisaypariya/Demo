<style>
    .myForm .error {
        color: red;
    }
</style>
<form action="" id="addAdjust{{$inbound_item->id}}" method="POST" class="myForm">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <input type="hidden" name="inbound_id" value="{{ $inbound_item->id }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label>Item Number</label>
                <input type="text" class="form-control" value="{{ $product->product_code }}" readonly>
            </div>
            <div class="form-group">
                <label>Product Licence</label>
                <input type="text" class="form-control" value="{{$product->product_licence }}" readonly>
            </div>
            <div class="form-group">
                <label>Unit Size</label>
                <input type="text" class="form-control" value="{{$product->unit_size }}" readonly>
            </div>
            <div class="form-group">
                <label>Aisle</label>
                <input type="text" class="form-control" value="{{$inbound_item->aisle }}" name="aisle">
            </div>
            <div class="form-group">
                @if($inbound_item->fmd == 1)
                <fieldset id="fmd"> FMD : 
                    <input type="radio" value="1" name="fmd" checked>Yes
                    <input type="radio" value="0" name="fmd" >No
                </fieldset>
                @else
                <fieldset id="fmd"> FMD : 
                    <input type="radio" value="1" name="fmd" >Yes
                    <input type="radio" value="0" name="fmd" checked>No
                </fieldset>
                @endif
            </div>
            <div class="form-group">
                <label>Number of Units</label>
                <input type="text" class="form-control" value="{{ $inbound_item->number_of_unit }}" readonly name="number_of_unit" id="number_of_unit{{$inbound_item->id}}">
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Manufecturer</label>
                <input type="text" class="form-control" value="{{$product->manufacture }}" readonly>
            </div>
            <div class="form-group">
                <label>UNIT</label>
                <input type="text" class="form-control" value="{{$product->unit_of_sale }}" readonly>
            </div>
            <div class="form-group">
                <label>HS Code</label>
                <input type="text" class="form-control" value="{{$product->hs_code }}" readonly>
            </div>
            <div class="form-group">
                <label>Pallet ID</label><span style="color: red">*</span>
                <input type="text" class="form-control" value="{{$inbound_item->pallet_id }}" name="pallet_id" required>
            </div>
            <div class="form-group">
                <label for="Expiry">Expiry</label><span style="color: red">*</span>
                @if(!empty($inbound_item->expiry_date))
                <?php 
                $fulldate = $inbound_item->expiry_date;
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
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" id="date{{$inbound_item->id}}" name="date" >
                            <option value="--" {{ $date== "--" ?"selected":"" }} >--</option>
                            @for($i= 01; $i <= 31; $i++)
                            <option value={{ $i }} {{ $date==$i?"selected":"" }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="month" id="month{{$inbound_item->id}}">
                            <option value="--" {{ $month== "--" ?"selected":"" }}>--</option>
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
                        <select class="form-control" id="year{{$inbound_item->id}}" name="year">
                            <option value="--" {{ $year== "--" ?"selected":"" }}>--</option>
                            @for($i=2021; $i <=2051; $i++)
                            <option value={{ $i }} {{ $year==$i?"selected":"" }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Total no of treatments</label>
                <input type="text" class="form-control" value="{{$inbound_item->total_no_treatment }}" name="total_no_treatment" id="total_no_treatment{{$inbound_item->id}}" readonly>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" class="form-control" value="{{$product->brand_name }}" readonly>
            </div>
            <div class="form-group">
                <label>Country of Manufecturer</label>
                <input type="text" class="form-control" value="{{$product->country_manufecture }}" readonly>
            </div>
            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" value="{{ $category }}" readonly>
            </div>
            <div class="form-group">
                <label>Unit Value</label>
                <input type="text" class="form-control" value="{{ $inbound_item->unit_value }}" name="unit_value" id="unit_value{{$inbound_item->id}}">
            </div>
            <div class="form-group">
                <label>Donation Reference</label><span style="color: red">*</span>
                <input type="text" class="form-control" value="{{ $inbound_item->donation_reference }}" name="donation_reference" required>
            </div>
            <div class="form-group">
                <label>Batch</label><span style="color: red">*</span>
                <input type="text" class="form-control" value="{{ $inbound_item->batch }}" name="batch" required>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Generic name</label>
                <input type="text" class="form-control" value="{{ $product->generic_name }}" readonly>
            </div>
            <div class="form-group">
                <label>Number of Treatments</label>
                <input type="text" class="form-control" value="{{$product->treatment }}" readonly>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" value="{{$inbound_item->location }}" readonly name="location">
            </div>
            <div class="form-group">
                <label>Total Value</label>
                <input type="text" class="form-control" value="{{ $inbound_item->total_value }}" name="total_value" id="total_value{{$inbound_item->id}}" readonly>
            </div>
            <div class="form-group">
                <label>Allocation</label><span style="color: red">*</span>
                <input type="text" class="form-control" value="{{ $inbound_item->allocation }}" name="allocation" required>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <label> Adjust </label>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" name="math_icon">
                        <option value="0" selected>-</option>
                        <option value="1" >+</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="unit{{$inbound_item->id}}" name="unit" placeholder="Unit" >
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label>Reason</label>
            <select name="reason" class="form-control" id="reason_6504">
                <option value="">Please select reason</option>
                <option value="Damaged">Damaged</option>
                <option value="Data Error">Data Error</option>
                <option value="Expired">Expired</option>
                <option value="Picking Error">Picking Error</option>
                <option value="Destruction">Destruction</option>
                <option value="Return">Return</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Comment</label>
            <textarea id="comments" class="form-control" name="comment"></textarea>
        </div>
        
        <div class="form-group" style="padding: 10px; ">
            <button type="submit" class="btn btn-success">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</form>

<script type="text/javascript">
    
    $("#addAdjust{{$inbound_item->id}}").validate({
        rules : {
            'pallet_id' : { required : true },
            'donation_reference' : { required : true },
            'allocation' : { required : true },
            'number_of_unit' : { required : true },
            'batch' : { required : true },
            'date' : { isValid : true , required : true },
            'month' : { isValid : true , required : true },
            'year' : { isValid : true , required : true },
        },
        submitHandler:function(form)
        {
            $.ajax({
                url :   "{{ route('adjust_store')}}",
                method : "POST",
                data : $("#addAdjust{{$inbound_item->id}}").serialize(),  
                success:function(data)
                {
                    location.reload();
                }
            });
            return false;
        }
    });
    
    $.validator.addMethod("isValid",function(value,element){
        $date = $("#date{{$inbound_item->id}}").val();
        $year = $("#year{{$inbound_item->id}}").val();
        $month = $("#month{{$inbound_item->id}}").val();
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
        if (($month == 04 || $month == 06 || $month == 09 || $month == 11 ) && $date == 31)
        {
            return false;
        }
        else if($month == 02 )
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
    
    $("#unit{{$inbound_item->id}}").keypress(function(e){
        if ((e.which < 48 || e.which > 57)) 
        { e.preventDefault(); }
    });
    
    $("#unit_value{{$inbound_item->id}}").keyup(function(){
        var unit_val = $(this).val();
        console.log(unit_val);
        var no_unit = $("#number_of_unit{{$inbound_item->id}}").val();
        $("#total_value{{$inbound_item->id}}").val(parseFloat(no_unit*unit_val).toFixed(2));
    });
    
</script>