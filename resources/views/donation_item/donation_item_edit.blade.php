<style>
    #close {
        float:right;
        display:inline-block;
        padding:2px 5px;
        background:#ccc;
    }
    .myForm .error {
        color: red;
    }
</style>

@if (count($match) > 0 )
<div class="card-body">
    <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'>x</span>
    <form id="myForm_{{ $donation_items->id }}"  action="" method="post" class="myForm">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="hidden" value="{{ $donation_id }}" name="donation_id" id="donation_id">
                    <label for="product_code">Product Code</label>
                    <input id="product_code" type="text"
                    class="form-control @error('product_code') is-invalid @enderror" name="product_code"
                    value="{{ $donation_items->product_code }}"  autocomplete="product_code">
                </div>
                @foreach($products as $product )
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="manufecturer">Manufecturer : </label>
                    <span ><b>{{ $product->manufacture }}</b></span>
                    <input id="manufecturer" type="hidden" name="manufecturer"
                    value="{{ $donation_items->manufecturer }}" >
                </div>
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="brand_name">Brand Name : </label>
                    <span ><b>{{ $product->brand_name }}</b></span>
                    <input id="brand_name" type="hidden" name="brand_name"
                    value="{{ $donation_items->brand_name }}" >
                </div>
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="generic_name">Generic Name : </label>
                    <span ><b>{{ $product->generic_name }}</b></span>
                    <input id="generic_name" type="hidden" name="generic_name"
                    value="{{ $donation_items->generic_name }}" >
                </div>
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="formulation">Formulation : </label><span style="color:red;">*</span>
                    <span ><b>{{ $product->formulation }}</b></span>
                    <input id="formulation" type="hidden" name="formulation"
                    value="{{ $donation_items->formulation }}" >
                </div>
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="unit_size">Unit Size : </label>
                    <span ><b>{{ $product->unit_size }}</b></span>
                    <input id="unit_size" type="hidden" name="unit_size"
                    value="{{ $donation_items->unit_size }}" >
                </div>
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="unit_of_sale">Unit Of Sale</label>
                    <span ><b>{{ $product->unit_of_sale }}</b></span>
                    <input id="unit_of_sale" type="hidden" name="unit_of_sale"
                    value="{{ $donation_items->unit_of_sale }}" >
                    
                </div>
                <div class="form-group" style="background-color:rgb(223, 214, 214);">
                    <label for="unit_per_case">Unit Per Case</label>
                    <span ><b>{{ $product->units_per_case }}</b></span>
                    <input id="unit_per_case" type="hidden" name="unit_per_case"
                    value="{{ $donation_items->unit_per_case }}" >
                </div>
                @endforeach
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pack_size">Pack Size</label>
                    <input id="pack_size" type="text"
                    class="form-control @error('pack_size') is-invalid @enderror" name="pack_size"
                    value="{{ $donation_items->pack_size }}"  autocomplete="pack_size">
                </div>
                <div class="form-group">
                    <label for="unit_pallet">Unit Pallet</label>
                    <input id="unit_pallet" type="text"
                    class="form-control @error('unit_pallet') is-invalid @enderror" name="unit_pallet"
                    value="{{ $donation_items->unit_pallet }}"  autocomplete="unit_pallet">
                </div>
                <div class="form-group">
                    <label for="pattle_guesstimate">Pattle Guesstimate</label>
                    <input id="pattle_guesstimate" type="text"
                    class="form-control @error('pattle_guesstimate') is-invalid @enderror" name="pattle_guesstimate"
                    value="{{ $donation_items->pattle_guesstimate }}"  autocomplete="pattle_guesstimate">
                </div>
                <div class="form-group">
                    <label for="batch_number">Batch Number</label><span style="color:red;">*</span>
                    <input id="batch_number" type="text"
                    class="form-control @error('batch_number') is-invalid @enderror" name="batch_number"
                    value="{{ $donation_items->batch_number }}"  autocomplete="batch_number">
                </div>
                <div class="form-group">
                    <label for="udi">UDI</label>
                    <input id="udi" type="text"
                    class="form-control @error('udi') is-invalid @enderror" name="udi"
                    value="{{ $donation_items->udi }}"  autocomplete="udi">
                </div>
                <div class="form-group">
                    @if($donation_items->pom == "1")
                    <fieldset id="pom"> POM : 
                        <input type="radio" name="pom" value = "{{ $donation_items->pom}}" checked>Yes
                        <input type="radio" name="pom" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="pom"> POM : 
                        <input type="radio" name="pom" value = "yes" >Yes
                        <input type="radio" name="pom" value="{{ $donation_items->pom}}" checked>No
                    </fieldset>
                    @endif
                </div>
                <div class="form-group">
                    @if($donation_items->cold_chain == "1")
                    <fieldset id="cold_chain"> Cold Chain : 
                        <input type="radio" name="cold_chain" value = "{{ $donation_items->cold_chain}}" checked>Yes
                        <input type="radio" name="cold_chain" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="cold_chain"> Cold Chain : 
                        <input type="radio" name="cold_chain" value = "yes" >Yes
                        <input type="radio" name="cold_chain" value="{{ $donation_items->cold_chain}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="location">Location</label><span style="color:red;">*</span>
                    <input id="location" type="text"
                    class="form-control @error('location') is-invalid @enderror" name="location"
                    value="{{ $donation_items->location }}"  autocomplete="location">
                </div>
                <div class="form-group">
                    <label for="lable_language">Lable Language</label><span style="color:red;">*</span>
                    <input id="lable_language" type="text"
                    class="form-control @error('lable_language') is-invalid @enderror" name="lable_language"
                    value="{{ $donation_items->lable_language }}"  autocomplete="lable_language">
                </div>
                <div class="form-group">
                    <label for="specific_appeal">Specific appeal</label>
                    <input id="specific_appeal" type="text"
                    class="form-control @error('specific_appeal') is-invalid @enderror" name="specific_appeal"
                    value="{{ $donation_items->specific_appeal }}"  autocomplete="specific_appeal">
                </div>
                <div class="form-group">
                    <label for="storage_req">Storage Requirements</label>
                    <input id="storage_req" type="text"
                    class="form-control @error('storage_req') is-invalid @enderror" name="storage_req"
                    value="{{ $donation_items->storage_req }}"  autocomplete="storage_req">
                </div>
                
                
                <div class="form-group">
                    <label for="expiry_date">Expiry Date </label> <span style="color:red;">*</span>
                    @if($donation_items->expiry_date)
                    <?php 
                    $date = $donation_items->expiry_date;
                    $splitdate = explode('-',$date);
                    ?> 
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="date" name="date">
                                @for($i= 01; $i <= 31; $i++)
                                <option value={{ $i }} {{ $splitdate[2]==$i?"selected":"" }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="month" id="month">
                                <option value="01" {{ $splitdate[1]== "01" ?"selected":"" }}>Jan</option>
                                <option value="02" {{ $splitdate[1]== "02" ?"selected":"" }}>Feb</option>
                                <option value="03" {{ $splitdate[1]== "03" ?"selected":"" }}>March</option>
                                <option value="04" {{ $splitdate[1]== "04" ?"selected":"" }}>April</option>
                                <option value="05" {{ $splitdate[1]== "05" ?"selected":"" }}>May</option>
                                <option value="06" {{ $splitdate[1]== "06" ?"selected":"" }}>June</option>
                                <option value="07" {{ $splitdate[1]== "07" ?"selected":"" }}>July</option>
                                <option value="08" {{ $splitdate[1]== "08" ?"selected":"" }}>August</option>
                                <option value="09" {{ $splitdate[1]== "09" ?"selected":"" }}>Sep</option>
                                <option value="10" {{ $splitdate[1]== "10" ?"selected":"" }}>Oct</option>
                                <option value="11" {{ $splitdate[1]== "11" ?"selected":"" }}>Nov</option>
                                <option value="12" {{ $splitdate[1]== "12" ?"selected":"" }}>Dec</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="year" name="year">
                                @for($i=2022; $i <=2051; $i++)
                                <option value={{ $i }} {{ $splitdate[0]==$i?"selected":"" }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="date" name="date">
                                <option value="" selected>Date</option>
                                @for($i= 01; $i <= 31; $i++)
                                <option value={{ $i }} >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="month" id="month">
                                <option value="" selected>Month</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="year" name="year">
                                <option value="" selected>Year</option>
                                @for($i=2022; $i <=2051; $i++)
                                <option value={{ $i }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="unit_offered">Units</label><span style="color:red;">*</span>
                    <input id="unit_offered" type="text"
                    class="form-control @error('unit_offered') is-invalid @enderror" name="unit_offered"
                    value="{{ $donation_items->unit_offered }}"  autocomplete="unit_offered">
                </div>
                
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="supplier_price_unit">Supplier Price Unit</label>
                    <input id="supplier_price_unit" type="text"
                    class="form-control @error('supplier_price_unit') is-invalid @enderror" name="supplier_price_unit"
                    value="{{ $donation_items->supplier_price_unit }}"  autocomplete="supplier_price_unit">
                </div>
                <div class="form-group">
                    <label for="internal_price_unit">Internal Price Unit</label>
                    <input id="internal_price_unit" type="text"
                    class="form-control @error('internal_price_unit') is-invalid @enderror" name="internal_price_unit"
                    value="{{ $donation_items->internal_price_unit }}"  autocomplete="internal_price_unit">
                </div>
                <div class="form-group">
                    @if($donation_items->dangerous_drugs == "1")
                    <fieldset id="dangerous_drugs"> Dangerous Drugs : <br>
                        <input type="radio" name="dangerous_drugs" value = "{{ $donation_items->dangerous_drugs}}" checked>Yes
                        <input type="radio" name="dangerous_drugs" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="dangerous_drugs"> Dangerous Drugs : <br>
                        <input type="radio" name="dangerous_drugs" value = "yes" >Yes
                        <input type="radio" name="dangerous_drugs" value="{{ $donation_items->dangerous_drugs}}" checked>No
                    </fieldset>
                    @endif
                </div>
                <div class="form-group">
                    @if($donation_items->controlled_drugs == "1")
                    <fieldset id="controlled_drugs"> Controlled Drugs : <br>
                        <input type="radio" name="controlled_drugs" value = "{{ $donation_items->controlled_drugs}}" checked>Yes
                        <input type="radio" name="controlled_drugs" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="controlled_drugs"> Controlled Drugs : <br>
                        <input type="radio" name="controlled_drugs" value = "yes" >Yes
                        <input type="radio" name="controlled_drugs" value="{{ $donation_items->controlled_drugs}}" checked>No
                    </fieldset>
                    @endif
                </div>
                <div class="form-group">
                    @if($donation_items->serialize_stock == "1")
                    <fieldset id="serialize_stock"> Serialize Stock : <br>
                        <input type="radio" name="serialize_stock" value = "{{ $donation_items->serialize_stock}}" checked>Yes
                        <input type="radio" name="serialize_stock" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="serialize_stock"> Serialize Stock : <br>
                        <input type="radio" name="serialize_stock" value = "yes" >Yes
                        <input type="radio" name="serialize_stock" value="{{ $donation_items->serialize_stock}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="reporting_req">Reporting Requirements</label>
                    <input id="reporting_req" type="text"
                    class="form-control @error('reporting_req') is-invalid @enderror" name="reporting_req"
                    value="{{ $donation_items->reporting_req }}"  autocomplete="reporting_req">
                </div>
                <div class="form-group">
                    <label for="intended_market">Intended Market</label>
                    <input id="intended_market" type="text"
                    class="form-control @error('intended_market') is-invalid @enderror" name="intended_market"
                    value="{{ $donation_items->intended_market }}"  autocomplete="intended_market">
                </div>
                <div class="form-group">
                    <label for="product_licence">Product Licence</label>
                    <input id="product_licence" type="text"
                    class="form-control @error('product_licence') is-invalid @enderror" name="product_licence"
                    value="{{ $donation_items->product_licence }}"  autocomplete="product_licence">
                </div>
                <div class="form-group">
                    <label for="information">Information</label>
                    <input id="information" type="text"
                    class="form-control @error('information') is-invalid @enderror" name="information"
                    value="{{ $donation_items->information }}"  autocomplete="information">
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <input id="comments" type="text"
                    class="form-control @error('comments') is-invalid @enderror" name="comments"
                    value="{{ $donation_items->comments }}"  autocomplete="comments">
                </div>
                <div class="form-group">
                    @if($donation_items->supplies == "1")
                    <fieldset id="supplies"> Supplies : <br>
                        <input type="radio" name="supplies" value = "{{ $donation_items->supplies}}" checked>Yes
                        <input type="radio" name="supplies" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="supplies"> Supplies : <br>
                        <input type="radio" name="supplies" value = "yes" >Yes
                        <input type="radio" name="supplies" value="{{ $donation_items->supplies}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success update" id="update">
                    {{ __('UPDATE') }}
                </button>
                <label id="message" class="alert alert-info" style="display: none"></label>
            </div>
        </div>
    </form>
</div>
@else
<div class="card-body">
    <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'>x</span>
    <form id="myForm_{{ $donation_items->id }}"  action="" method="post" class="myForm">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="hidden" value="{{ $donation_id }}" name="donation_id" id="donation_id">
                    <label for="product_code">Product Code</label><span style="color:red;">*</span>
                    <input id="product_code" type="text"
                    class="form-control @error('product_code') is-invalid @enderror" name="product_code"
                    value="{{ $donation_items->product_code }}"  autocomplete="product_code">
                </div>
                <div class="form-group">
                    <label for="manufecturer">Manufecturer</label><span style="color:red;">*</span>
                    <input id="manufecturer" type="text"
                    class="form-control @error('manufecturer') is-invalid @enderror" name="manufecturer"
                    value="{{ $donation_items->manufecturer }}"  autocomplete="manufecturer">
                </div>
                <div class="form-group">
                    <label for="brand_name">Brand Name</label><span style="color:red;">*</span>
                    <input id="brand_name" type="text"
                    class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                    value="{{ $donation_items->brand_name }}"  autocomplete="brand_name">
                </div>
                <div class="form-group">
                    <label for="generic_name">Generic Name</label><span style="color:red;">*</span>
                    <input id="generic_name" type="text"
                    class="form-control @error('generic_name') is-invalid @enderror" name="generic_name"
                    value="{{ $donation_items->generic_name }}"  autocomplete="generic_name">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date </label> <span style="color:red;">*</span>
                    
                    @if($donation_items->expiry_date)
                    <?php 
                    $date = $donation_items->expiry_date;
                    $splitdate = explode('-',$date);
                    ?> 
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="date" name="date">
                                @for($i= 01; $i <= 31; $i++)
                                <option value={{ $i }} {{ $splitdate[2]==$i?"selected":"" }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="month" id="month">
                                <option value="01" {{ $splitdate[1]== "01" ?"selected":"" }}>Jan</option>
                                <option value="02" {{ $splitdate[1]== "02" ?"selected":"" }}>Feb</option>
                                <option value="03" {{ $splitdate[1]== "03" ?"selected":"" }}>March</option>
                                <option value="04" {{ $splitdate[1]== "04" ?"selected":"" }}>April</option>
                                <option value="05" {{ $splitdate[1]== "05" ?"selected":"" }}>May</option>
                                <option value="06" {{ $splitdate[1]== "06" ?"selected":"" }}>June</option>
                                <option value="07" {{ $splitdate[1]== "07" ?"selected":"" }}>July</option>
                                <option value="08" {{ $splitdate[1]== "08" ?"selected":"" }}>August</option>
                                <option value="09" {{ $splitdate[1]== "09" ?"selected":"" }}>Sep</option>
                                <option value="10" {{ $splitdate[1]== "10" ?"selected":"" }}>Oct</option>
                                <option value="11" {{ $splitdate[1]== "11" ?"selected":"" }}>Nov</option>
                                <option value="12" {{ $splitdate[1]== "12" ?"selected":"" }}>Dec</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="year" name="year">
                                @for($i=2021; $i <=2051; $i++)
                                <option value={{ $i }} {{ $splitdate[0]==$i?"selected":"" }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="date" name="date">
                                <option value="" selected>Date</option>
                                @for($i= 01; $i <= 31; $i++)
                                <option value={{ $i }} >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="month" id="month">
                                <option value="" selected>Month</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="year" name="year">
                                <option value="" selected>Year</option>
                                @for($i=2021; $i <=2051; $i++)
                                <option value={{ $i }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="unit_offered">Units</label><span style="color:red;">*</span>
                    <input id="unit_offered" type="text"
                    class="form-control @error('unit_offered') is-invalid @enderror" name="unit_offered"
                    value="{{ $donation_items->unit_offered }}"  autocomplete="unit_offered">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pack_size">Pack Size</label>
                    <input id="pack_size" type="text"
                    class="form-control @error('pack_size') is-invalid @enderror" name="pack_size"
                    value="{{ $donation_items->pack_size }}"  autocomplete="pack_size">
                </div>
                <div class="form-group">
                    <label for="unit_pallet">Unit Pallet</label>
                    <input id="unit_pallet" type="text"
                    class="form-control @error('unit_pallet') is-invalid @enderror" name="unit_pallet"
                    value="{{ $donation_items->unit_pallet }}"  autocomplete="unit_pallet">
                </div>
                <div class="form-group">
                    <label for="pattle_guesstimate">Pattle Guesstimate</label>
                    <input id="pattle_guesstimate" type="text"
                    class="form-control @error('pattle_guesstimate') is-invalid @enderror" name="pattle_guesstimate"
                    value="{{ $donation_items->pattle_guesstimate }}"  autocomplete="pattle_guesstimate">
                </div>
                <div class="form-group">
                    <label for="batch_number">Batch Number</label><span style="color:red;">*</span>
                    <input id="batch_number" type="text"
                    class="form-control @error('batch_number') is-invalid @enderror" name="batch_number"
                    value="{{ $donation_items->batch_number }}"  autocomplete="batch_number">
                </div>
                <div class="form-group">
                    <label for="udi">UDI</label>
                    <input id="udi" type="text"
                    class="form-control @error('udi') is-invalid @enderror" name="udi"
                    value="{{ $donation_items->udi }}"  autocomplete="udi">
                </div>
                <div class="form-group">
                    @if($donation_items->pom == "1")
                    <fieldset id="pom"> POM : 
                        <input type="radio" name="pom" value = "{{ $donation_items->pom}}" checked>Yes
                        <input type="radio" name="pom" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="pom"> POM : 
                        <input type="radio" name="pom" value = "yes" >Yes
                        <input type="radio" name="pom" value="{{ $donation_items->pom}}" checked>No
                    </fieldset>
                    @endif
                </div>
                <div class="form-group">
                    @if($donation_items->cold_chain == "1")
                    <fieldset id="cold_chain"> Cold Chain : 
                        <input type="radio" name="cold_chain" value = "{{ $donation_items->cold_chain}}" checked>Yes
                        <input type="radio" name="cold_chain" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="cold_chain"> Cold Chain : 
                        <input type="radio" name="cold_chain" value = "yes" >Yes
                        <input type="radio" name="cold_chain" value="{{ $donation_items->cold_chain}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="location">Location</label><span style="color:red;">*</span>
                    <input id="location" type="text"
                    class="form-control @error('location') is-invalid @enderror" name="location"
                    value="{{ $donation_items->location }}"  autocomplete="location">
                </div>
                <div class="form-group">
                    <label for="lable_language">Lable Language</label><span style="color:red;">*</span>
                    <input id="lable_language" type="text"
                    class="form-control @error('lable_language') is-invalid @enderror" name="lable_language"
                    value="{{ $donation_items->lable_language }}"  autocomplete="lable_language">
                </div>
                <div class="form-group">
                    <label for="specific_appeal">Specific appeal</label>
                    <input id="specific_appeal" type="text"
                    class="form-control @error('specific_appeal') is-invalid @enderror" name="specific_appeal"
                    value="{{ $donation_items->specific_appeal }}"  autocomplete="specific_appeal">
                </div>
                <div class="form-group">
                    <label for="storage_req">Storage Requirements</label>
                    <input id="storage_req" type="text"
                    class="form-control @error('storage_req') is-invalid @enderror" name="storage_req"
                    value="{{ $donation_items->storage_req }}"  autocomplete="storage_req">
                </div>
                <div class="form-group">
                    <label for="formulation">Formulation</label><span style="color:red;">*</span>
                    <input id="formulation" type="text"
                    class="form-control @error('formulation') is-invalid @enderror" name="formulation"
                    value="{{ $donation_items->formulation }}"  autocomplete="formulation">
                </div>
                <div class="form-group">
                    @if($donation_items->controlled_drugs == "1")
                    <fieldset id="controlled_drugs"> Controlled Drugs : 
                        <input type="radio" name="controlled_drugs" value = "{{ $donation_items->controlled_drugs}}" checked>Yes
                        <input type="radio" name="controlled_drugs" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="controlled_drugs"> Controlled Drugs : 
                        <input type="radio" name="controlled_drugs" value = "yes" >Yes
                        <input type="radio" name="controlled_drugs" value="{{ $donation_items->controlled_drugs}}" checked>No
                    </fieldset>
                    @endif
                </div>
                <div class="form-group">
                    @if($donation_items->serialize_stock == "1")
                    <fieldset id="serialize_stock"> Serialize Stock : 
                        <input type="radio" name="serialize_stock" value = "{{ $donation_items->serialize_stock}}" checked>Yes
                        <input type="radio" name="serialize_stock" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="serialize_stock"> Serialize Stock : 
                        <input type="radio" name="serialize_stock" value = "yes" >Yes
                        <input type="radio" name="serialize_stock" value="{{ $donation_items->serialize_stock}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="unit_size">Unit Size</label><span style="color:red;">*</span>
                    <input id="unit_size" type="text"
                    class="form-control @error('unit_size') is-invalid @enderror unit_size" name="unit_size"
                    value="{{ $donation_items->unit_size }}"  autocomplete="unit_size">
                    <label id="unit_size_lbl" style="color: red;"></label>
                </div>
                <div class="form-group">
                    <label for="unit_of_sale">Unit Of Sale</label><span style="color:red;">*</span>
                    <input id="unit_of_sale" type="text"
                    class="form-control @error('unit_of_sale') is-invalid @enderror" name="unit_of_sale"
                    value="{{ $donation_items->unit_of_sale }}"  autocomplete="unit_of_sale">
                </div>
                <div class="form-group">
                    <label for="unit_per_case">Unit Per Case</label><span style="color:red;">*</span>
                    <input id="unit_per_case" type="text"
                    class="form-control @error('unit_per_case') is-invalid @enderror" name="unit_per_case"
                    value="{{ $donation_items->unit_per_case }}"  autocomplete="unit_per_case">
                </div>
                <div class="form-group">
                    <label for="supplier_price_unit">Supplier Price Unit</label>
                    <input id="supplier_price_unit" type="text"
                    class="form-control @error('supplier_price_unit') is-invalid @enderror" name="supplier_price_unit"
                    value="{{ $donation_items->supplier_price_unit }}"  autocomplete="supplier_price_unit">
                </div>
                <div class="form-group">
                    <label for="internal_price_unit">Internal Price Unit</label>
                    <input id="internal_price_unit" type="text"
                    class="form-control @error('internal_price_unit') is-invalid @enderror" name="internal_price_unit"
                    value="{{ $donation_items->internal_price_unit }}"  autocomplete="internal_price_unit">
                </div>
                <div class="form-group">
                    @if($donation_items->dangerous_drugs == "1")
                    <fieldset id="dangerous_drugs"> Dangerous Drugs : <br>
                        <input type="radio" name="dangerous_drugs" value = "{{ $donation_items->dangerous_drugs}}" checked>Yes
                        <input type="radio" name="dangerous_drugs" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="dangerous_drugs"> Dangerous Drugs : <br>
                        <input type="radio" name="dangerous_drugs" value = "yes" >Yes
                        <input type="radio" name="dangerous_drugs" value="{{ $donation_items->dangerous_drugs}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="reporting_req">Reporting Requirements</label>
                    <input id="reporting_req" type="text"
                    class="form-control @error('reporting_req') is-invalid @enderror" name="reporting_req"
                    value="{{ $donation_items->reporting_req }}"  autocomplete="reporting_req">
                </div>
                <div class="form-group">
                    <label for="intended_market">Intended Market</label>
                    <input id="intended_market" type="text"
                    class="form-control @error('intended_market') is-invalid @enderror" name="intended_market"
                    value="{{ $donation_items->intended_market }}"  autocomplete="intended_market">
                </div>
                <div class="form-group">
                    <label for="product_licence">Product Licence</label>
                    <input id="product_licence" type="text"
                    class="form-control @error('product_licence') is-invalid @enderror" name="product_licence"
                    value="{{ $donation_items->product_licence }}"  autocomplete="product_licence">
                </div>
                <div class="form-group">
                    <label for="information">Information</label>
                    <input id="information" type="text"
                    class="form-control @error('information') is-invalid @enderror" name="information"
                    value="{{ $donation_items->information }}"  autocomplete="information">
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <input id="comments" type="text"
                    class="form-control @error('comments') is-invalid @enderror" name="comments"
                    value="{{ $donation_items->comments }}"  autocomplete="comments">
                </div>
                <div class="form-group">
                    @if($donation_items->supplies == "1")
                    <fieldset id="supplies"> Supplies : <br>
                        <input type="radio" name="supplies" value = "{{ $donation_items->supplies}}" checked>Yes
                        <input type="radio" name="supplies" value="no" >No
                    </fieldset>
                    @else
                    <fieldset id="supplies"> Supplies : <br>
                        <input type="radio" name="supplies" value = "yes" >Yes
                        <input type="radio" name="supplies" value="{{ $donation_items->supplies}}" checked>No
                    </fieldset>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success update" id="update">
                    {{ __('UPDATE') }}
                </button>
                <label id="message" class="alert alert-info" style="display: none;"></label>
            </div>
        </div>
    </form>
</div>
@endif


<script>
    $("#myForm_{{ $donation_items->id }}").validate({
        rules : {
            'product_code' : { required : true },
            'manufecturer' : { required : true },
            'brand_name' : { required : true },
            'generic_name' : { required : true },
            'formulation' : { required : true },
            'unit_size' : { required : true ,digits: true },
            'date' : { isValid : true , required : true },
            'month' : { isValid : true , required : true },
            'year' : { isValid : true , required : true },
            'unit_of_sale' : { required : true },
            'unit_per_case' : { required : true },
            'lable_language' : { required : true },
            'batch_number' : { required : true },
            'location' : { required : true },
            'unit_offered' : { required : true },
        },
        submitHandler:function(form)
        {
            $.ajax({
                url :   "{{ route('donation_item.update',[$donation_items->id])}}",
                method : "PATCH",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    'product_code' : $("#product_code").val(),
                    'manufecturer' : $("#manufecturer").val(),
                    'brand_name' : $("#brand_name").val(),
                    'generic_name' : $("#generic_name").val(),
                    'unit_offered' : $("#unit_offered").val(),
                    'pack_size' : $("#pack_size").val(),
                    'unit_pallet' : $("#unit_pallet").val(),
                    'pattle_guesstimate' : $("#pattle_guesstimate").val(),
                    'batch_number' : $("#batch_number").val(),
                    'udi' : $("#udi").val(),
                    'location' : $("#location").val(),
                    'lable_language' : $("#lable_language").val(),
                    'specific_appeal' : $("specific_appeal").val(),
                    'storage_req' : $("#storage_req").val(),
                    'formulation' : $("#formulation").val(),
                    'unit_size' : $("#unit_size").val(),
                    'unit_of_sale' : $("#unit_of_sale").val(),
                    'unit_per_case' : $("#unit_per_case").val(),
                    'supplier_price_unit' : $("#supplier_price_unit").val(),
                    'internal_price_unit' : $("#internal_price_unit").val(),
                    'reporting_req' : $("#reporting_req").val(),
                    'intended_market' : $("#intended_market").val(),
                    'product_licence' : $("#product_licence").val(),
                    'information' : $("#information").val(),
                    'comments' : $("#comments").val(),
                    'date' : $("#date").val(),
                    'month' : $("#month").val(),
                    'year' : $("#year").val(),
                    'pom' : $("#pom").val(),
                    'cold_chain' : $("#cold_chain").val(),
                    'controlled_drugs' : $("#controlled_drugs").val(),
                    'serialize_stock' : $("#serialize_stock").val(),
                    'dangerous_drugs' : $("#dangerous_drugs").val(),
                    'donation_id' : $("#donation_id").val(),
                },
                success:function(data)
                {
                    var obj = JSON.parse(data); 
                    $("#matched").text(obj.data.matched);
                    $("#unmatched").text(obj.data.unmatched);
                    $("#error").text(obj.data.error);
                    $("#remove").text(obj.data.remove);
                    $("#message").show();
                    $("#message").text(obj.data.message);
                    // oTable.ajax.reload();
                }
            });
            
        }
    });
    
    window.onload = function(){
        document.getElementById('close').onclick = function(){
            this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
            return false;
        };
    };
    
    $.validator.addMethod("isValid",function(value,element){
        $date = $("#date").val();
        $year = $("#year").val();
        $month = $("#month").val();
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
    
</script>
