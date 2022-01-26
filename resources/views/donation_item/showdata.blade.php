<style>
    #close {
        float:right;
        display:inline-block;
        padding:2px 5px;
        background:#ccc;
    }
</style>
<div class="card-body">
    <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'>x</span>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="product_code">Product Code</label>
                <input class="form-control" value="{{ $donation_items->product_code }}" disabled>
            </div>
            <div class="form-group">
                <label for="manufecturer">Manufecturer</label>
                <input class="form-control" value="{{ $donation_items->manufecturer }}" disabled>
            </div>
            <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input class="form-control" value="{{ $donation_items->brand_name }}" disabled>
            </div>
            <div class="form-group">
                <label for="generic_name">Generic Name</label>
                <input class="form-control" value="{{ $donation_items->generic_name }}" disabled>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input class="form-control" value="{{ $donation_items->expiry_date }}" disabled>
            </div>
            <div class="form-group">
                <label for="unit_offered">Units</label>
                <input class="form-control" value="{{ $donation_items->unit_offered }}" disabled>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="pack_size">Pack Size</label>
                <input class="form-control" value="{{ $donation_items->pack_size }}" disabled>
            </div>
            <div class="form-group">
                <label for="unit_pallet">Unit Pallet</label>
                <input class="form-control" value="{{ $donation_items->unit_pallet }}" disabled>
            </div>
            <div class="form-group">
                <label for="pattle_guesstimate">Pattle Guesstimate</label>
                <input class="form-control" value="{{ $donation_items->pattle_guesstimate }}" disabled>
            </div>
            <div class="form-group">
                <label for="batch_number">Batch Number</label>
                <input class="form-control" value="{{ $donation_items->batch_number }}" disabled>
            </div>
            <div class="form-group">
                <label for="udi">UDI</label>
                <input class="form-control" value="{{ $donation_items->udi }}" disabled>
            </div>
            <div> 
                <label for="udi">POM</label>
                <input class="form-control" value="{{ $donation_items->pom == 1 ?"Yes":"No" }}" disabled>
            </div>
            <div> 
                <label for="cold_chain">Cold Chain</label>
                <input class="form-control" value="{{ $donation_items->cold_chain == 1 ?"Yes":"No" }}" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="location">Location</label>
                <input class="form-control" value="{{ $donation_items->location }}" disabled>
            </div>
            <div class="form-group">
                <label for="lable_language">Lable Language</label>
                <input class="form-control" value="{{ $donation_items->lable_language }}" disabled>
            </div>
            <div class="form-group">
                <label for="specific_appeal">Specific appeal</label>
                <input class="form-control" value="{{ $donation_items->specific_appeal }}" disabled>
            </div>
            <div class="form-group">
                <label for="storage_req">Storage Requirements</label>
                <input class="form-control" value="{{ $donation_items->storage_req }}" disabled>
            </div>
            <div class="form-group">
                <label for="formulation">Formulation</label>
                <input class="form-control" value="{{ $donation_items->formulation }}" disabled>
            </div>
            <div> 
                <label for="controlled_drugs">Controlled Drugs</label>
                <input class="form-control" value="{{ $donation_items->controlled_drugs == 1 ?"Yes":"No" }}" disabled>
            </div>
            <div> 
                <label for="serialize_stock">Serialize Stock</label>
                <input class="form-control" value="{{ $donation_items->serialize_stock == 1 ?"Yes":"No" }}" disabled>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="unit_size">Unit Size</label>
                <input class="form-control" value="{{ $donation_items->unit_size }}" disabled>
            </div>
            <div class="form-group">
                <label for="unit_of_sale">Unit Of Sale</label>
                <input class="form-control" value="{{ $donation_items->unit_of_sale }}" disabled>
            </div>
            <div class="form-group">
                <label for="unit_per_case">Unit Per Case</label>
                <input class="form-control" value="{{ $donation_items->unit_per_case }}" disabled>
            </div>
            <div class="form-group">
                <label for="supplier_price_unit">Supplier Price Unit</label>
                <input class="form-control" value="{{ $donation_items->supplier_price_unit }}" disabled>
            </div>
            <div class="form-group">
                <label for="internal_price_unit">Internal Price Unit</label>
                <input class="form-control" value="{{ $donation_items->internal_price_unit }}" disabled>
            </div>
            <div> 
                <label for="dangerous_drugs">Dangerous Drugs</label>
                <input class="form-control" value="{{ $donation_items->dangerous_drugs == 1 ?"Yes":"No" }}" disabled>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="reporting_req">Reporting Requirements</label>
                <input class="form-control" value="{{ $donation_items->reporting_req }}" disabled>
            </div>
            <div class="form-group">
                <label for="intended_market">Intended Market</label>
                <input class="form-control" value="{{ $donation_items->intended_market }}" disabled>
            </div>
            <div class="form-group">
                <label for="product_licence">Product Licence</label>
                <input class="form-control"  value="{{ $donation_items->product_licence }}"   disabled>
            </div>
            <div class="form-group">
                <label for="information">Information</label>
                <input class="form-control" value="{{ $donation_items->information }}"  disabled>
            </div>
            <div class="form-group">
                <label for="comments">Comments</label>
                <input class="form-control" value="{{ $donation_items->comments }}" disabled>
            </div>
            <div> 
                <label for="supplies">Supplies</label>
                <input class="form-control" value="{{ $donation_items->supplies == 1 ?"Yes":"No" }}" disabled>
            </div>
            <div class="form-group">
                <label for="status">Status : </label>
                <input class="form-control" value="{{ $donation_items->status==1?"Active":"Disable"}}" disabled/>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function(){
        document.getElementById('close').onclick = function(){
            this.parentNode.parentNode.parentNode
            .removeChild(this.parentNode.parentNode);
            return false;
        };
    };
</script>