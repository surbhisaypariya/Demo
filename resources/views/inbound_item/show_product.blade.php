<span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'>x</span>

<div class="container-fluid" style="background-color: rgb(232, 232, 232);box-shadow: 5px 10px 8px #888888;padding:10px;"> 
    <span class="label label-success"><b>Product Information</b></span>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="generic_name">Item Number</label>
                <?php 
                $pro_id = $inbound_items->product()->pluck('product_id')->toArray(); 
                $products = App\Models\Product::whereIn('id',$pro_id)->first();
                
                ?>
                <input type="text" readonly class="form-control" value="{{ $products->product_code}}{{ $products->brand_name }}"> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="generic_name">Generic Name</label>
                        <input type="text"  readonly class="form-control" value="{{ $products->generic_name}}"> 
                    </div>
                    <div class="form-group">
                        <label for="treatments">Number Of Treatments</label>
                        <input type="text" readonly class="form-control" value="{{ $products->treatment }}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_licence">Product Licence</label>
                        <input type="text" readonly class="form-control" value="{{ $products->product_licence }}"> 
                    </div>
                    <div class="form-group">
                        <label for="unit_size">Unit Size</label>
                        <input type="text" readonly class="form-control" value="{{ $products->unit_size }}"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="manufecturer">Manufecturer</label>
                        <input type="text" readonly class="form-control" value="{{ $products->manufacture }}"> 
                    </div>
                    <div class="form-group">
                        <label for="unit">UNIT</label>
                        <input type="text" readonly class="form-control" value="{{ $products->units_per_case }}"> 
                    </div>
                    <div class="form-group">
                        <label for="hs_code">HS Code</label>
                        <input type="text" readonly class="form-control" value="{{ $products->hs_code }}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" readonly class="form-control" value="{{ $products->brand_name }}"> 
                    </div>
                    <div class="form-group">
                        <label for="country_manufecturer">Country Of Manufecture</label>
                        <input type="text" readonly class="form-control" value="{{ $products->country_manufecture }}"> 
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" readonly class="form-control" value="{{ $category }}"> 
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
                <input type="text"  readonly class="form-control" value="{{ $inbound_items->location }}"> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="Aisle">Aisle</label>
                <input type="text" readonly class="form-control" value="{{ $inbound_items->aisle }}"> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="pallet_id">Pallet Id</label><span style="color: red">*</span>
                <input type="text" readonly class="form-control" value="{{ $inbound_items->pallet_id }}"> 
            </div>
        </div>
    </div>
    <span class="label label-success"><b>Additional Product Information</b></span>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="unit_value">Unit Value (&#8356;)</label>
                <input type="text" readonly class="form-control" value="{{ $inbound_items->unit_value }}" > 
            </div>
            <div class="form-group">
                <label for="donation_reference">Donation Reference</label><span style="color: red">*</span>
                <input type="text" readonly class="form-control" value="{{ $inbound_items->donation_reference }}" > 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="total_value">Total Value(&#8356;)</label>
                <input type="text" readonly class="form-control" readonly value="{{ $inbound_items->total_value }}" > 
            </div>
            <div class="form-group">
                <label for="allocation">Allocation</label><span style="color: red">*</span>
                <input type="text" readonly class="form-control" value="{{ $inbound_items->allocation }}"> 
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                
            </div>
        </div>
        <div class="col-md-4">
            <label for="Expiry">Expiry</label><span style="color: red">*</span>
            <input type="text" readonly class="form-control" value="{{ $inbound_items->expiry_date }}"> 
            
        </div>
    </div>
    <span class="label label-success"><b>Quality</b></span>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="number_of_unit">Number Of Units</label><span style="color: red">*</span>
                <input type="text" readonly  class="form-control" value="{{ $inbound_items->number_of_unit }}"> 
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="total_no_treatment">Total number of treatments</label>
                <input type="text" readonly class="form-control" readonly value="{{ $inbound_items->total_no_treatment }}"> 
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="batch">Batch</label><span style="color: red">*</span>
                <input type="text" readonly  class="form-control" value="{{ $inbound_items->batch }}" > 
            </div>
        </div>
    </div>
</div>
