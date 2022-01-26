<style>
    .addProduct .error {
        color: red;
    }
    #close {
        float:right;
        display:inline-block;
        padding:2px 5px;
        background:#ccc;
    }
</style>
<form id="addProduct" action="" method="post" class="addProduct">
    @csrf
    <div class="container-fluid" style="background-color: rgb(232, 232, 232);box-shadow: 5px 10px 8px #888888;padding:10px;"> 
        <span class="label label-success"><b>Product Information</b></span>
        <div class="row">
            <input type="hidden" name="shipment_id" value="{{ $shipments->id }}">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="generic_name">Item Number</label>
                    <select class="form-control" id="product" name="product"> 
                        <option value="" selected>-- please Select</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_code }}  {{ $product->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="generic_name">Generic Name</label>
                            <input type="text" id="generic_name" name="generic_name" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="treatments">Number Of Treatments</label>
                            <input type="text" id="treatments" name="treatments" readonly class="form-control"> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_licence">Product Licence</label>
                            <input type="text" id="product_licence" name="product_licence" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="unit_size">Unit Size</label>
                            <input type="text" id="unit_size" name="unit_size" readonly class="form-control"> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="manufecturer">Manufecturer</label>
                            <input type="text" id="manufecturer" name="manufecturer" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="unit">UNIT</label>
                            <input type="text" id="unit" name="unit" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="hs_code">HS Code</label>
                            <input type="text" id="hs_code" name="hs_code" readonly class="form-control"> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" id="brand_name" name="brand_name" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="country_manufecturer">Country Of Manufecture</label>
                            <input type="text" id="country_manufecturer" name="country_manufecturer" readonly class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" id="type" name="type" readonly class="form-control"> 
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
                    <?php $location_name = $shipments->location()->pluck('name')->implode(', '); ?>
                    <input type="text" id="location" name="location" readonly class="form-control" value="{{ $location_name }}"> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="Aisle">Aisle</label>
                    <input type="text" id="aisle" name="aisle"  class="form-control" > 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pallet_id">Pallet Id</label><span style="color: red">*</span>
                    <input type="text" id="pallet_id" name="pallet_id"  class="form-control" > 
                </div>
            </div>
        </div>
        <span class="label label-success"><b>Additional Product Information</b></span>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="unit_value">Unit Value (&#8356;)</label>
                    <input type="text" id="unit_value" name="unit_value"  class="form-control" > 
                </div>
                <div class="form-group">
                    <label for="donation_reference">Donation Reference</label><span style="color: red">*</span>
                    <input type="text" id="donation_reference" name="donation_reference"  class="form-control" > 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="total_value">Total Value(&#8356;)</label>
                    <input type="text" id="total_value" name="total_value"  class="form-control" readonly> 
                </div>
                <div class="form-group">
                    <label for="allocation">Allocation</label><span style="color: red">*</span>
                    <input type="text" id="allocation" name="allocation"  class="form-control" > 
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <fieldset id="fmd"> FMD : 
                        <input type="radio" value="1" name="fmd">Yes
                        <input type="radio" value="0" name="fmd" checked>No
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4">
                <label for="Expiry">Expiry</label><span style="color: red">*</span>
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control" id="adddate" name="date">
                            <option value="" selected hidden>dd</option>
                            <option value="--" >--</option>
                            @for($i= 01; $i <= 31; $i++)
                            <option value={{ $i }} >{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="month" id="addmonth">
                            <option value="" selected hidden>mm</option>
                            <option value="--" >--</option>
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
                        <select class="form-control" id="addyear" name="year">
                            <option value="" selected hidden>yy</option>
                            <option value="--" >--</option>
                            @for($i=2022; $i <=2051; $i++)
                            <option value={{ $i }}>{{ $i }}</option>
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
                    <input type="text" id="number_of_unit" name="number_of_unit"  class="form-control" > 
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="total_no_treatment">Total number of treatments</label>
                    <input type="text" id="total_no_treatment" name="total_no_treatment"  class="form-control" readonly> 
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="batch">Batch</label><span style="color: red">*</span>
                    <input type="text" id="batch" name="batch"  class="form-control" > 
                </div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Add Product') }}
                </button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    
    $("#product").change(function(){
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
                $("#generic_name").val(data.data.generic_name);
                $("#treatments").val(data.data.treatment);
                $("#product_licence").val(data.data.product_licence);
                $("#unit_size").val(data.data.unit_size);
                $("#manufecturer").val(data.data.manufacture);
                $("#unit").val(data.data.unit_of_sale);
                $("#hs_code").val(data.data.hs_code);
                $("#brand_name").val(data.data.brand_name);
                $("#country_manufecturer").val(data.data.country_manufecture);
                $("#type").val(data[0]);
                
                var no_unit = $("#number_of_unit").val();
                var pro_treatment = $("#treatments").val();
                $("#total_no_treatment").val(parseFloat(no_unit*pro_treatment).toFixed(2));
                
            }
        });
    }); 
    
    $("#addProduct").validate({
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
                url :   "{{ route('inbound_item.store')}}",
                method : "POST",
                data : $("#addProduct").serialize(),
                success:function(data)
                {
                    $("#bind_data").hide();
                    oTable.ajax.reload();
                }
            });
            return false;
        }
    });
    
    $.validator.addMethod("isValid",function(value,element){
        $date = $("#adddate").val();
        $year = $("#addyear").val();
        $month = $("#addmonth").val();
        
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
    
    
    $("#unit_value").keyup(function(){
        var unit_val = $(this).val();
        var no_unit = $("#number_of_unit").val();
        $("#total_value").val(parseFloat(no_unit*unit_val).toFixed(2));
    });
    
    $("#number_of_unit").keyup(function(){
        var no_unit = $(this).val();
        var  unit_val= $("#unit_value").val();
        $("#total_value").val(parseFloat(no_unit*unit_val).toFixed(2));
        
        var pro_treatment = $("#treatments").val();
        $("#total_no_treatment").val(parseFloat(no_unit*pro_treatment).toFixed(2));
    });
    
    $("#unit_value").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    
    $("#number_of_unit").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>