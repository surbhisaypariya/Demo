@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Product') }}</div>
                
                <div class="card-body">
                    <form method="POST" id="myForm" name="myForm" action="{{ route('product.update',[$product->id]) }}" enctype="multipart/form-data" >
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-6" style="padding-right:100px;">
                                <div class="form-group">
                                    <label for="product_code" class="col-form-label text-md-right">{{ __('Product code') }}</label>
                                    <br/>
                                    <input id="product_code" type="text"
                                    class="form-control @error('product_code') is-invalid @enderror" name="product_code"
                                    value="{{ $product->product_code }}" required autocomplete="product_code" autofocus>
                                    
                                    @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="manufacture" class="col-form-label text-md-right">{{ __('Manufacture') }}</label>
                                    <br/>
                                    <input id="manufacture" type="text"
                                    class="form-control @error('manufacture') is-invalid @enderror" name="manufacture"
                                    value="{{ $product->manufacture }}" required autocomplete="manufacture" autofocus>
                                    
                                    @error('manufacture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_name" class="col-form-label text-md-right">{{ __('Brand Name') }}</label>
                                    <br/>
                                    <input id="brand_name" type="text"
                                    class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                                    value="{{ $product->brand_name }}" required autocomplete="brand_name" autofocus>
                                    
                                    @error('brand_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="generic_name" class="col-form-label text-md-right">{{ __('Generic Name') }}</label>
                                    <br/>
                                    <input id="generic_name" type="text"
                                    class="form-control @error('generic_name') is-invalid @enderror" name="generic_name"
                                    value="{{ $product->generic_name }}" required autocomplete="generic_name" autofocus>
                                    
                                    @error('generic_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formulation" class="col-form-label text-md-right">{{ __('Formulation') }}</label>
                                    <br/>
                                    <input id="formulation" type="text"
                                    class="form-control @error('formulation') is-invalid @enderror" name="formulation"
                                    value="{{ $product->formulation }}" required autocomplete="formulation" autofocus>
                                    
                                    @error('formulation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-form-label text-md-right">{{ __('Description') }}</label>
                                    <br/>
                                    <input id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ $product->description }}"  autocomplete="description" autofocus>
                                    
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-header">{{ __('Packing & Size') }}</div>
                        <div class="row">
                            <div class="col-md-6" style="padding-right:100px;">
                                <div class="form-group">
                                    <label for="unit_size" class="col-form-label text-md-right">{{ __('Unit Size') }}</label>
                                    <br/>
                                    <input id="unit_size" type="text"
                                    class="form-control @error('unit_size') is-invalid @enderror" name="unit_size"
                                    value="{{ $product->unit_size }}" required autocomplete="unit_size" autofocus>
                                    
                                    @error('unit_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="unit_of_sale" class="col-form-label text-md-right">{{ __('Unit of Sale') }}</label>
                                    <br/>
                                    <input id="unit_of_sale" type="text"
                                    class="form-control @error('unit_of_sale') is-invalid @enderror" name="unit_of_sale"
                                    value="{{ $product->unit_of_sale }}" required autocomplete="unit_of_sale" autofocus>
                                    
                                    @error('unit_of_sale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="treatment" class="col-form-label text-md-right">{{ __('Treatments') }}</label>
                                    <br/>
                                    <input id="treatment" type="text"
                                    class="form-control @error('treatment') is-invalid @enderror" name="treatment"
                                    value="{{ $product->treatment }}"  autocomplete="treatment" autofocus>
                                    
                                    @error('treatment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="units_per_case" class="col-form-label text-md-right">{{ __('Units Per Case') }}</label>
                                    <br/>
                                    <input id="units_per_case" type="text"
                                    class="form-control @error('units_per_case') is-invalid @enderror" name="units_per_case"
                                    value="{{ $product->units_per_case }}" required autocomplete="units_per_case" autofocus>
                                    
                                    @error('units_per_case')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="label_language" class="col-form-label text-md-right">{{ __('Label Language') }}</label>
                                    <br/>
                                    <input id="label_language" type="text"
                                    class="form-control @error('label_language') is-invalid @enderror" name="label_language"
                                    value="{{ $product->label_language }}" required autocomplete="label_language" autofocus>
                                    
                                    @error('label_language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="limits" class="col-form-label text-md-right">{{ __('Limits') }}</label>
                                    <br/>
                                    <input id="limits" type="text"
                                    class="form-control @error('limits') is-invalid @enderror" name="limits"
                                    value="{{ $product->limits }}"  autocomplete="limits" autofocus>
                                    
                                    @error('limits')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-header">{{ __('Cost & Market') }}</div>
                        <div class="row">
                            <div class="col-md-6" style="padding-right:100px;">
                                <div class="form-group">
                                    <label for="original_approved" class="col-form-label text-md-right">{{ __('Original & Approved') }}</label>
                                    <br/>
                                    <input id="original_approved" type="text"
                                    class="form-control @error('original_approved') is-invalid @enderror" name="original_approved"
                                    value="{{ $product->original_approved }}"  autocomplete="original_approved" autofocus>
                                    
                                    @error('original_approved')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="standard_cost" class="col-form-label text-md-right">{{ __('Standard Code ($) ') }}</label>
                                    <br/>
                                    <input id="standard_cost" type="text"
                                    class="form-control @error('standard_cost') is-invalid @enderror" name="standard_cost"
                                    value="{{ $product->standard_cost }}"  autocomplete="standard_cost" autofocus>
                                    
                                    @error('standard_cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tax_val" class="col-form-label text-md-right">{{ __('Tax Value') }}</label>
                                    <br/>
                                    <input id="tax_val" type="text"
                                    class="form-control @error('tax_val') is-invalid @enderror" name="tax_val"
                                    value="{{ $product->tax_val }}"  autocomplete="tax_val" autofocus>
                                    
                                    @error('tax_val')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product_licence" class="col-form-label text-md-right">{{ __('Product Licence') }}</label>
                                    <br/>
                                    <input id="product_licence" type="text"
                                    class="form-control @error('product_licence') is-invalid @enderror" name="product_licence"
                                    value="{{ $product->product_licence }}"  autocomplete="product_licence" autofocus>
                                    
                                    @error('product_licence')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="hs_code" class="col-form-label text-md-right">{{ __('HS Code') }}</label>
                                    <br/>
                                    <input id="hs_code" type="text"
                                    class="form-control @error('hs_code') is-invalid @enderror" name="hs_code"
                                    value="{{ $product->hs_code }}"  autocomplete="hs_code" autofocus>
                                    
                                    @error('hs_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="intended_market" class="col-form-label text-md-right">{{ __('Intended Market') }}</label>
                                    <br/>
                                    <input id="intended_market" type="text"
                                    class="form-control @error('intended_market') is-invalid @enderror" name="intended_market"
                                    value="{{ $product->intended_market }}"  autocomplete="intended_market" autofocus>
                                    
                                    @error('intended_market')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="extended_cost" class="col-form-label text-md-right">{{ __('Extended Cost') }}</label>
                                    <br/>
                                    <input id="extended_cost" type="text"
                                    class="form-control @error('extended_cost') is-invalid @enderror" name="extended_cost"
                                    value="{{ $product->extended_cost }}"  autocomplete="extended_cost" autofocus>
                                    
                                    @error('extended_cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fair_market_val" class="col-form-label text-md-right">{{ __('Fair Market Value') }}</label>
                                    <br/>
                                    <input id="fair_market_val" type="text"
                                    class="form-control @error('fair_market_val') is-invalid @enderror" name="fair_market_val"
                                    value="{{ $product->fair_market_val }}"  autocomplete="fair_market_val" autofocus>
                                    
                                    @error('fair_market_val')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country_manufecture" class="col-form-label text-md-right">{{ __('Country of Manufecture') }}</label>
                                    <br/>
                                    <select id="country_manufecture" name="country_manufecture" class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->country_name }}" {{ $country->country_name == $product->country_manufecture?"selected":""}}>{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('country_manufecture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-6" style="padding-right:100px;">
                                <div class="card-header">{{ __('Categories') }}</div>
                                <div class="form-group">
                                    <label for="Categories" class="col-form-label text-md-right">{{ __('Categories') }}</label>
                                    <br/>
                                    <?php $product_cat_id = $product->category()->pluck("categorie_id")->toArray(); 
                                    ?>
                                    <select class="form-control" id="categorie[]" name="categorie[]" old="{{ 'categorie[]' }}" value="" multiple>
                                        <option value="">Please Select</option>
                                        <?php $par=0; ?>
                                        @foreach ($categories as $categorie)
                                        <?php $par = count($categorie->parents); ?>
                                        
                                        <option value="{{ $categorie->id }}"{{ in_array($categorie->id , $product_cat_id)?"selected":"" }}>{{ $categorie->category }} </option>
                                        
                                        @if (count($categorie->children) > 0)    
                                        <?php $par = count($categorie->parents); ?>
                                        
                                        @include('product/subcategories', ['subcategories' => $categorie->children, 'parent' => $categorie->category ,'par'=>$par,'product_cat_id' => $product_cat_id])
                                        
                                        @endif
                                        
                                        @endforeach
                                        
                                    </select>
                                    
                                    @error('categorie[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header">{{ __('Storage and restriction') }}</div>
                                <div class="form-group">
                                    <label for="storage_req" class="col-form-label text-md-right">{{ __('Storage Requirement') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="storage_req" type="text"
                                    class="form-control @error('storage_req') is-invalid @enderror" name="storage_req"
                                    value="{{ $product->storage_req }}" required autocomplete="storage_req" autofocus>
                                    
                                    @error('storage_req')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        @if($product->cold_chain == "yes")
                                        <fieldset id="cold_chain"> Cold Chain : 
                                            <input type="radio" name="cold_chain" value = "{{ $product->cold_chain}}" checked>Yes
                                            <input type="radio" name="cold_chain" value="no" >No
                                        </fieldset>
                                        @else
                                        <fieldset id="cold_chain"> Cold Chain : 
                                            <input type="radio" name="cold_chain" value = "yes" >Yes
                                            <input type="radio" name="cold_chain" value="{{ $product->cold_chain}}" checked>No
                                        </fieldset>
                                        @endif
                                        
                                        @if($product->controlled_drugs == "yes")
                                        <fieldset id="controlled_drugs"> Controlled Drugs : 
                                            <input type="radio" name="controlled_drugs" value = "{{ $product->controlled_drugs}}" checked>Yes
                                            <input type="radio" name="controlled_drugs" value="no">No
                                        </fieldset>
                                        @else
                                        <fieldset id="controlled_drugs"> Controlled Drugs : 
                                            <input type="radio" name="controlled_drugs" value = "yes" >Yes
                                            <input type="radio" name="controlled_drugs" value="{{ $product->controlled_drugs}}" checked>No
                                        </fieldset>
                                        @endif
                                        
                                        @if($product->serialized_stock == "yes")
                                        <fieldset id="serialized_stock"> Serialized Stock : 
                                            <input type="radio" name="serialized_stock" value="{{ $product->serialized_stock }}" checked>Yes
                                            <input type="radio" name="serialized_stock" value="no">No
                                        </fieldset>
                                        @else 
                                        <fieldset id="serialized_stock"> Serialized Stock : 
                                            <input type="radio" name="serialized_stock" value="yes">Yes
                                            <input type="radio" name="serialized_stock"  value="{{ $product->serialized_stock }}" checked>No
                                        </fieldset>
                                        @endif
                                        
                                        @if($product->dangerous_goods == "yes")
                                        <fieldset id="dangerous_goods"> Dangerous Goods : 
                                            <input type="radio" name="dangerous_goods"  value="{{ $product->dangerous_goods }}" checked>Yes
                                            <input type="radio" name="dangerous_goods" value="no">No
                                        </fieldset>
                                        @else 
                                        <fieldset id="dangerous_goods"> Dangerous Goods : 
                                            <input type="radio" name="dangerous_goods"  value="yes">Yes
                                            <input type="radio" name="dangerous_goods" value="{{ $product->dangerous_goods }}" checked>No
                                        </fieldset>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-header">{{ __('Comments') }}</div>
                                <div class="form-group">
                                    <label for="comments" class="col-form-label text-md-right">{{ __('comments') }}</label>
                                    <br/>
                                    <textarea class="form-control" name="comments" id="comments" autofocus autocomplete="comments">{{ $product->comments }}</textarea>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="" id="message" style="display: none"></div>
                                    <div style="padding:10px;">
                                        <input type="file" id="upload_input" name="upload_input" style="display:none">
                                        <input id="file_upload" class="btn btn-primary" type="button" value="Attatchment">
                                        <br/>
                                        
                                        @include('product/product_attatchment')
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card-header">{{ __('status') }}</div>
                                @if($product->status == "1")
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  id="status" name="status" value="{{ $product->status }}" checked/>
                                        <label class="form-check-label" for="flexCheckDefault">Status </label>
                                    </div>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @elseif($product->status == "0")
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  id="status" name="status" value="{{ $product->status }}" />
                                        <label class="form-check-label" for="flexCheckDefault">Status </label>
                                    </div>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card-header">{{ __('History') }}</div>
                                <?php 
                                $user_id = $product->user_id;
                                $username = App\Models\User::find($user_id);
                                ?>
                                Created By <strong>{{ $username->email }}</strong>on
                                {{ date("d M Y H:i",strtotime($product->created_at)) }}
                                <br>
                                <span>
                                    @foreach($product_attatchment as $attatchment)
                                    <?php  
                                    $user_id = $attatchment->user_id ;
                                    $username = App\Models\User::find($user_id); 
                                    ?>
                                    Uploaded By <strong>{{ $username->email }}</strong>
                                    on {{ date("d M Y H:i",strtotime($attatchment->created_at)) }}<br>
                                    @endforeach
                                </span>
                                
                                @foreach ($product_histories as $history)
                                <?php 
                                $user_id = $history->user_id; 
                                $username = App\Models\User::find($user_id);
                                ?> 
                                <p>Edited By <strong>{{ $username->email }}</strong>
                                    on {{ date("d M Y H:i",strtotime($history->created_at)) }}
                                    <?php 
                                    $history_fields=history_fields_changed_list($history,$categories_list); 
                                    echo "<br>";
                                    echo $history_fields;
                                    ?>
                                </p>
                                @endforeach
                            </div>
                            
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('UPDATE') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#file_upload").click(function(){
        $("#upload_input").trigger('click');
    });
    
    
    $("#upload_input").change(function(){
        var form = $("#myForm")[0];
        var method = document.forms['myForm']['_method'];
        method.setAttribute('Value','POST');
        var formData = new FormData(form);
        $.ajax({
            data : formData,
            method : "POST",
            url : "{{ route('uploadAttatchment',$product->id) }}",
            processData: false,
            contentType: false,
            success:function(data)
            {
                $('#message').css('display', 'block');
                $('#message').html(data.message);
                $('#message').removeClass('alert-success');
                $('#message').removeClass('alert-danger');
                $('#message').addClass(data.class_name);
                $('#uploaded_file').html(data.upload_image);
            }
        });
    });
    
    $("#standard_cost").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    
    $("#extended_cost").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    
    $("#tax_val").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    
    $("#fair_market_val").keypress(function(e){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>
@endsection
<?php 
function history_fields_changed_list($history ,$categories )
{
    $old_fields = array();
    $new_fields = array();
    
    if($history->categories_old != $history->categories_new)
    {
        $old_categories="-";
        $new_categories="-";
        if(!empty($history->categories_old))
        {
            $old_cat_array = explode(",",$history->categories_old);
            $old_categories = $categories->find($old_cat_array)->pluck("category")->implode(",");
        }
        if(!empty($history->categories_new))
        {
            $new_cat_array = explode(",",$history->categories_new);
            $new_categories = $categories->find($new_cat_array)->pluck("category")->implode(",");
        }
        
        $old_fields[] = "Category : ".$old_categories;
        $new_fields[] = "Category : ".$new_categories;
    }
    
    if($history->product_code_old != $history->product_code_new)
    {
        $product_code_old = !empty($history->product_code_old)?$history->product_code_old:"-";
        $product_code_new = !empty($history->product_code_new)?$history->product_code_new:"-";
        
        $old_fields[] = "Product Code : ".$product_code_old;
        $new_fields[] = "Product Code : ".$product_code_new;
    }
    
    if($history->manufacture_old != $history->manufacture_new)
    {
        $manufacture_old = !empty($history->manufacture_old)?$history->manufacture_old:"-";
        $manufacture_new = !empty($history->manufacture_new)?$history->manufacture_new:"-";
        
        $old_fields[] = "Manufacture : ".$manufacture_old;
        $new_fields[] = "Manufacture : ".$manufacture_new;
    }
    
    if($history->brand_name_old != $history->brand_name_new)
    {
        $brand_name_old = !empty($history->brand_name_old)?$history->brand_name_old:"-";
        $brand_name_new = !empty($history->brand_name_new)?$history->brand_name_new:"-";
        
        $old_fields[] = "Brand Name : ".$brand_name_old;
        $new_fields[] = "Brand Name : ".$brand_name_new;
    }
    
    if($history->generic_name_old != $history->generic_name_new)
    {
        $generic_name_old = !empty($history->generic_name_old)?$history->generic_name_old:"-";
        $generic_name_new = !empty($history->generic_name_new)?$history->generic_name_new:"-";
        
        $old_fields[] = "Generic Name : ".$generic_name_old;
        $new_fields[] = "Generic Name : ".$generic_name_new;
    }
    
    if($history->formulation_old != $history->formulation_new)
    {
        $formulation_old = !empty($history->formulation_old)?$history->formulation_old:"-";
        $formulation_new = !empty($history->formulation_new)?$history->formulation_new:"-";
        
        $old_fields[] = "Formulation : ".$formulation_old;
        $new_fields[] = "Formulation : ".$formulation_new;
    }
    
    if($history->unit_size_old != $history->unit_size_new)
    {
        $unit_size_old = !empty($history->unit_size_old)?$history->unit_size_old:"-";
        $unit_size_new = !empty($history->unit_size_new)?$history->unit_size_new:"-";
        
        $old_fields[] = "Unit Size : ".$unit_size_old;
        $new_fields[] = "Unit Size : ".$unit_size_new;
    }
    
    if($history->unit_of_sale_old != $history->unit_of_sale_new)
    {
        $unit_of_sale_old = !empty($history->unit_of_sale_old)?$history->unit_of_sale_old:"-";
        $unit_of_sale_new = !empty($history->unit_of_sale_new)?$history->unit_of_sale_new:"-";
        
        $old_fields[] = "Unit of Sale : ".$unit_of_sale_old;
        $new_fields[] = "Unit of Sale : ".$unit_of_sale_new;
    }
    
    if($history->units_per_case_old != $history->units_per_case_new)
    {
        $units_per_case_old = !empty($history->units_per_case_old)?$history->units_per_case_old:"-";
        $units_per_case_new = !empty($history->units_per_case_new)?$history->units_per_case_new:"-";
        
        $old_fields[] = "Unit Per Case : ".$units_per_case_old;
        $new_fields[] = "Unit Per Case : ".$units_per_case_new;
    }
    
    if($history->label_language_old != $history->label_language_new)
    {
        $label_language_old = !empty($history->label_language_old)?$history->label_language_old:"-";
        $label_language_new = !empty($history->label_language_new)?$history->label_language_new:"-";
        
        $old_fields[] = "Label Language : ".$label_language_old;
        $new_fields[] = "Label Language : ".$label_language_new;
    }
    
    if($history->cold_chain_old != $history->cold_chain_new)
    {
        $cold_chain_old = !empty($history->cold_chain_old)?$history->cold_chain_old:"-";
        $cold_chain_new = !empty($history->cold_chain_new)?$history->cold_chain_new:"-";
        
        $old_fields[] = "Cold Chain : ".$cold_chain_old;
        $new_fields[] = "Cold Chain : ".$cold_chain_new;
    }
    
    if($history->controlled_drugs_old != $history->controlled_drugs_new)
    {
        $controlled_drugs_old = !empty($history->controlled_drugs_old)?$history->controlled_drugs_old:"-";
        $controlled_drugs_new = !empty($history->controlled_drugs_new)?$history->controlled_drugs_new:"-";
        
        $old_fields[] = "Controlled Drugs : ".$controlled_drugs_old;
        $new_fields[] = "Controlled Drugs : ".$controlled_drugs_new;
    }
    
    if($history->serialized_stock_old != $history->serialized_stock_new)
    {
        $serialized_stock_old = !empty($history->serialized_stock_old)?$history->serialized_stock_old:"-";
        $serialized_stock_new = !empty($history->serialized_stock_new)?$history->serialized_stock_new:"-";
        
        $old_fields[] = "Serialized Stock : ".$serialized_stock_old;
        $new_fields[] = "Serialized Stock : ".$serialized_stock_new;
    }
    
    if($history->dangerous_goods_old != $history->dangerous_goods_new)
    {
        $dangerous_goods_old = !empty($history->dangerous_goods_old)?$history->dangerous_goods_old:"-";
        $dangerous_goods_new = !empty($history->dangerous_goods_new)?$history->dangerous_goods_new:"-";
        
        $old_fields[] = "Dangerous Goods : ".$dangerous_goods_old;
        $new_fields[] = "Dangerous Goods : ".$dangerous_goods_new;
    }
    
    if($history->comments_old != $history->comments_new)
    {
        $comments_old = !empty($history->comments_old)?$history->comments_old:"-";
        $comments_new = !empty($history->comments_new)?$history->comments_new:"-";
        
        $old_fields[] = "Comments : ".$comments_old;
        $new_fields[] = "Comments : ".$comments_new;
    }
    
    if($history->status_old != $history->status_new)
    {
        $status_old = !empty($history->status_old)?$history->status_old:"-";
        $status_new = !empty($history->status_new)?$history->status_new:"-";
        
        $old_fields[] = "Status : ".$status_old = 1?"Active":"Disactive";
        $new_fields[] = "Status : ".$status_new = 0?"Disactive":"Active";
    }
    
    $old_value_string="From: ".implode(", ",$old_fields)."";
    $new_value_string="To: ".implode(", ",$new_fields)."";
    return $old_value_string."<br>".$new_value_string;
}
?>