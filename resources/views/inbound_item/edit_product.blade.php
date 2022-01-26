<style>
    .editProduct .error {
        color: red;
    }
    #close {
        float:right;
        display:inline-block;
        padding:2px 5px;
        background:#ccc;
    }
</style>
<span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'>x</span>
<form id="editProduct{{$inbound_items->id}}" action="" method="post" class="editProduct">
    @method('PATCH')
    @csrf
    <div class="container-fluid" style="background-color: rgb(232, 232, 232);box-shadow: 5px 10px 8px #888888;padding:10px;"> 
        <span class="label label-success"><b>Product Information</b></span>
        <div class="row">
            <input type="hidden" name="shipment_id" value="{{ $shipment_id }}">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="generic_name">Item Number</label>
                    <select class="form-control" id="product{{$inbound_items->id}}" name="product"> 
                        <?php $pro_id = $inbound_items->product()->pluck('product_id')->toArray(); ?>
                        <option value="" selected>-- please Select</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ in_array($product->id , $pro_id)?"selected":"" }}>{{ $product->product_code }}  {{ $product->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="generic_name">Generic Name</label>
                            <input type="text" id="generic_name{{$inbound_items->id}}" name="generic_name" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="treatments">Number Of Treatments</label>
                            <input type="text" id="treatments{{$inbound_items->id}}" name="treatments" readonly class="form-control"> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_licence">Product Licence</label>
                            <input type="text" id="product_licence{{$inbound_items->id}}" name="product_licence" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="unit_size">Unit Size</label>
                            <input type="text" id="unit_size{{$inbound_items->id}}" name="unit_size" readonly class="form-control"> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="manufecturer">Manufecturer</label>
                            <input type="text" id="manufecturer{{$inbound_items->id}}" name="manufecturer" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="unit">UNIT</label>
                            <input type="text" id="unit{{$inbound_items->id}}" name="unit" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="hs_code">HS Code</label>
                            <input type="text" id="hs_code{{$inbound_items->id}}" name="hs_code" readonly class="form-control"> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" id="brand_name{{$inbound_items->id}}" name="brand_name" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="country_manufecturer">Country Of Manufecture</label>
                            <input type="text" id="country_manufecturer{{$inbound_items->id}}" name="country_manufecturer" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" id="type{{$inbound_items->id}}" name="type" readonly class="form-control"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="label label-success"><b>Location</b></span>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" readonly class="form-control" value="{{ $inbound_items->location }}"> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="Aisle">Aisle</label>
                    <input type="text" id="aisle" name="aisle"  class="form-control" value="{{ $inbound_items->aisle }}"> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pallet_id">Pallet Id</label><span style="color: red">*</span>
                    <input type="text" id="pallet_id" name="pallet_id"  class="form-control" value="{{ $inbound_items->pallet_id }}"> 
                </div>
            </div>
        </div>
        <span class="label label-success"><b>Additional Product Information</b></span>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="unit_value">Unit Value (&#8356;)</label>
                    <input type="text" id="unit_value{{$inbound_items->id}}" name="unit_value"  class="form-control" value="{{ $inbound_items->unit_value }}" > 
                </div>
                <div class="form-group">
                    <label for="donation_reference">Donation Reference</label><span style="color: red">*</span>
                    <input type="text" id="donation_reference" name="donation_reference"  class="form-control" value="{{ $inbound_items->donation_reference }}" > 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="total_value">Total Value(&#8356;)</label>
                    <input type="text" id="total_value{{$inbound_items->id}}" name="total_value"  class="form-control" readonly value="{{ $inbound_items->total_value }}" > 
                </div>
                <div class="form-group">
                    <label for="allocation">Allocation</label><span style="color: red">*</span>
                    <input type="text" id="allocation" name="allocation"  class="form-control" value="{{ $inbound_items->allocation }}"> 
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    @if($inbound_items->fmd == 1)
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
            </div>
            <div class="col-md-4">
                <label for="Expiry">Expiry</label><span style="color: red">*</span>
                @if(!empty($inbound_items->expiry_date))
                <?php 
                $fulldate = $inbound_items->expiry_date;
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
                        <select class="form-control" id="date{{$inbound_items->id}}" name="date">
                            <option value="--" {{ $date== "--" ?"selected":"" }} >--</option>
                            @for($i= 01; $i <= 31; $i++)
                            <option value={{ $i }} {{ $date==$i?"selected":"" }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="month" id="month{{$inbound_items->id}}">
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
                        <select class="form-control" id="year{{$inbound_items->id}}" name="year">
                            <option value="--" {{ $year== "--" ?"selected":"" }}>--</option>
                            @for($i=2021; $i <=2051; $i++)
                            <option value={{ $i }} {{ $year==$i?"selected":"" }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
        <span class="label label-success"><b>Quality</b></span>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="number_of_unit">Number Of Units</label><span style="color: red">*</span>
                    <input type="text" id="number_of_unit{{$inbound_items->id}}" name="number_of_unit"  class="form-control" value="{{ $inbound_items->number_of_unit }}"> 
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="total_no_treatment">Total number of treatments</label>
                    <input type="text" id="total_no_treatment{{$inbound_items->id}}" name="total_no_treatment"  class="form-control" readonly value="{{ $inbound_items->total_no_treatment }}"> 
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="batch">Batch</label><span style="color: red">*</span>
                    <input type="text" id="batch" name="batch"  class="form-control" value="{{ $inbound_items->batch }}" > 
                </div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Update Product') }}
                </button>
                <label id="message{{$inbound_items->id}}" class="alert alert-info" style="display: none;"></label>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    
    $(document).ready(function(){
        $id = $("#product{{$inbound_items->id}}").val();
        $.ajax({
            type : "POST",
            url : "{{ route('product_detail_add') }}",
            data: { 
                'id' : $id,
                "_token":"{{ csrf_token() }}",
            },
            success:function(data)
            {
                $("#generic_name{{$inbound_items->id}}").val(data.data.generic_name);
                $("#treatments{{$inbound_items->id}}").val(data.data.treatment);
                $("#product_licence{{$inbound_items->id}}").val(data.data.product_licence);
                $("#unit_size{{$inbound_items->id}}").val(data.data.unit_size);
                $("#manufecturer{{$inbound_items->id}}").val(data.data.manufacture);
                $("#unit{{$inbound_items->id}}").val(data.data.unit_of_sale);
                $("#hs_code{{$inbound_items->id}}").val(data.data.hs_code);
                $("#brand_name{{$inbound_items->id}}").val(data.data.brand_name);
                $("#country_manufecturer{{$inbound_items->id}}").val(data.data.country_manufecture);
                $("#type{{$inbound_items->id}}").val(data[0]);
                
                var no_unit = $("#number_of_unit{{$inbound_items->id}}").val();
                var pro_treatment = $("#treatments{{$inbound_items->id}}").val();
                $("#total_no_treatment{{$inbound_items->id}}").val(no_unit*pro_treatment);
                
            }
        });
    });
    $("#product{{$inbound_items->id}}").change(function(){
        $id = $(this).val();
        $.ajax({
            type : "POST",
            url : "{{ route('product_detail_add') }}",
            data: { 
                'id' : $id,
                "_token":"{{ csrf_token() }}",
            },
            success:function(data)
            {
                $("#generic_name{{$inbound_items->id}}").val(data.data.generic_name);
                $("#treatments{{$inbound_items->id}}").val(data.data.treatment);
                $("#product_licence{{$inbound_items->id}}").val(data.data.product_licence);
                $("#unit_size{{$inbound_items->id}}").val(data.data.unit_size);
                $("#manufecturer{{$inbound_items->id}}").val(data.data.manufacture);
                $("#unit{{$inbound_items->id}}").val(data.data.unit_of_sale);
                $("#hs_code{{$inbound_items->id}}").val(data.data.hs_code);
                $("#brand_name{{$inbound_items->id}}").val(data.data.brand_name);
                $("#country_manufecturer{{$inbound_items->id}}").val(data.data.country_manufecture);
                $("#type{{$inbound_items->id}}").val(data[0]);
                
                var no_unit = $("#number_of_unit{{$inbound_items->id}}").val();
                var pro_treatment = $("#treatments{{$inbound_items->id}}").val();
                $("#total_no_treatment{{$inbound_items->id}}").val(parseFloat(no_unit*pro_treatment).toFixed(2));
                
            }
        });
    }); 
    
    $("#editProduct{{$inbound_items->id}}").validate({
        rules : {
            'product' : { required : true },
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
                url :   "{{ route('inbound_item.update',[$inbound_items->id])}}",
                method : "POST",
                data : $("#editProduct{{$inbound_items->id}}").serialize(),
                success:function(data)
                {
                    $("#message{{$inbound_items->id}}").show();
                    $("#message{{$inbound_items->id}}").text('Record Update Successfully!!');
                }
            });
            return false;
        }
    });
    
    $.validator.addMethod("isValid",function(value,element){
        $date = $("#date{{$inbound_items->id}}").val();
        $year = $("#year{{$inbound_items->id}}").val();
        $month = $("#month{{$inbound_items->id}}").val();
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
    
    $("#unit_value{{$inbound_items->id}}").keyup(function(){
        var unit_val = $(this).val();
        var no_unit = $("#number_of_unit{{$inbound_items->id}}").val();
        $("#total_value{{$inbound_items->id}}").val(parseFloat(no_unit*unit_val).toFixed(2));
    });
    
    $("#number_of_unit{{$inbound_items->id}}").keyup(function(){
        var no_unit = $(this).val();
        var  unit_val= $("#unit_value{{$inbound_items->id}}").val();
        $("#total_value{{$inbound_items->id}}").val(parseFloat(no_unit*unit_val).toFixed(2));
        
        var pro_treatment = $("#treatments{{$inbound_items->id}}").val();
        $("#total_no_treatment{{$inbound_items->id}}").val(parseFloat(no_unit*pro_treatment).toFixed(2));
    });
    
    window.onload = function(){
        document.getElementById('close').onclick = function(){
            this.parentNode.parentNode.removeChild(this.parentNode.parentNode);
            return false;
        };
    };
    
    $("#unit_value{{$inbound_items->id}}").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    
    $("#number_of_unit{{$inbound_items->id}}").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>