@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                {{-- <form action="{{ route('csvfileview') }}">
                    <button class="btn btn-success"> Add Product using csv</button>
                </form> --}}
                
                <form action="{{ route('importExcelview') }}">
                    <button class="btn btn-success"> importExcel </button>
                </form>
                
            </div>
            <div class="card">
                <div class="card-header">{{ __('Product') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('product.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6" style="padding-right:100px;">
                                <div class="form-group">
                                    <label for="product_code" class="col-form-label text-md-right">{{ __('Product code') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="product_code" type="text"
                                    class="form-control @error('product_code') is-invalid @enderror" name="product_code"
                                    value="{{ old('product_code') }}" required autocomplete="product_code" autofocus>
                                    
                                    @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="manufacture" class="col-form-label text-md-right">{{ __('Manufacture') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="manufacture" type="text"
                                    class="form-control @error('manufacture') is-invalid @enderror" name="manufacture"
                                    value="{{ old('manufacture') }}" required autocomplete="manufacture" autofocus>
                                    
                                    @error('manufacture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_name" class="col-form-label text-md-right">{{ __('Brand Name') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="brand_name" type="text"
                                    class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                                    value="{{ old('brand_name') }}" required autocomplete="brand_name" autofocus>
                                    
                                    @error('brand_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="generic_name" class="col-form-label text-md-right">{{ __('Generic Name') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="generic_name" type="text"
                                    class="form-control @error('generic_name') is-invalid @enderror" name="generic_name"
                                    value="{{ old('generic_name') }}" required autocomplete="generic_name" autofocus>
                                    
                                    @error('generic_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formulation" class="col-form-label text-md-right">{{ __('Formulation') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="formulation" type="text"
                                    class="form-control @error('formulation') is-invalid @enderror" name="formulation"
                                    value="{{ old('formulation') }}" required autocomplete="formulation" autofocus>
                                    
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
                                    value="{{ old('description') }}"  autocomplete="description" autofocus>
                                    
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
                                    <label for="unit_size" class="col-form-label text-md-right">{{ __('Unit Size') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="unit_size" type="text"
                                    class="form-control @error('unit_size') is-invalid @enderror" name="unit_size"
                                    value="{{ old('unit_size') }}" required autocomplete="unit_size" autofocus>
                                    
                                    @error('unit_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="unit_of_sale" class="col-form-label text-md-right">{{ __('Unit of Sale') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="unit_of_sale" type="text"
                                    class="form-control @error('unit_of_sale') is-invalid @enderror" name="unit_of_sale"
                                    value="{{ old('unit_of_sale') }}" required autocomplete="unit_of_sale" autofocus>
                                    
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
                                    value="{{ old('treatment') }}"  autocomplete="treatment" autofocus>
                                    
                                    @error('treatment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="units_per_case" class="col-form-label text-md-right">{{ __('Units Per Case') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="units_per_case" type="text"
                                    class="form-control @error('units_per_case') is-invalid @enderror" name="units_per_case"
                                    value="{{ old('units_per_case') }}" required autocomplete="units_per_case" autofocus>
                                    
                                    @error('units_per_case')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="label_language" class="col-form-label text-md-right">{{ __('Label Language') }}</label><span style="color:red;">*</span>
                                    <br/>
                                    <input id="label_language" type="text"
                                    class="form-control @error('label_language') is-invalid @enderror" name="label_language"
                                    value="{{ old('label_language') }}" required autocomplete="label_language" autofocus>
                                    
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
                                    value="{{ old('limits') }}"  autocomplete="limits" autofocus>
                                    
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
                                    value="{{ old('original_approved') }}"  autocomplete="original_approved" autofocus>
                                    
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
                                    value="{{ old('standard_cost') }}"  autocomplete="standard_cost" autofocus>
                                    
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
                                    value="{{ old('tax_val') }}"  autocomplete="tax_val" autofocus>
                                    
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
                                    value="{{ old('product_licence') }}"  autocomplete="product_licence" autofocus>
                                    
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
                                    value="{{ old('hs_code') }}"  autocomplete="hs_code" autofocus>
                                    
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
                                    value="{{ old('intended_market') }}"  autocomplete="intended_market" autofocus>
                                    
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
                                    value="{{ old('extended_cost') }}"  autocomplete="extended_cost" autofocus>
                                    
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
                                    value="{{ old('fair_market_val') }}"  autocomplete="fair_market_val" autofocus>
                                    
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
                                        <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
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
                                    <select class="form-control" id="categorie[]" name="categorie[]" old="{{ 'Categorie' }}" multiple>
                                        <option selected value="">-- Please Select -- </option>
                                        <?php $par=0; ?>
                                        @foreach ($categories as $category)
                                        <?php $par = count($category->parents); echo $par; ?>
                                        
                                        <option value="{{ $category->id }}"> <?php echo(str_repeat(' - ',$par)); ?>{{ $category->category }}</option>
                                        
                                        @if (count($category->children) > 0)    
                                        <?php $par = count($category->parents); echo $par; ?>
                                        
                                        @include('category/sub_create', ['subcategories' => $category->children, 'parent' => $category->category ,'par'=>$par])
                                        
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
                                    value="{{ old('storage_req') }}" required autocomplete="storage_req" autofocus>
                                    
                                    @error('storage_req')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <fieldset id="cold_chain"> Cold Chain : 
                                        <input type="radio" value="yes" name="cold_chain">Yes
                                        <input type="radio" value="no" name="cold_chain" checked>No
                                    </fieldset>
                                    <fieldset id="controlled_drugs"> Controlled Drugs : 
                                        <input type="radio" value="yes" name="controlled_drugs">Yes
                                        <input type="radio" value="no" name="controlled_drugs" checked>No
                                    </fieldset>
                                    <fieldset id="Serialized Stock"> Serialized Stock : 
                                        <input type="radio" value="yes" name="serialized_stock">Yes
                                        <input type="radio" value="no" name="serialized_stock" checked>No
                                    </fieldset>
                                    <fieldset id="dangerous_goods"> Dangerous Goods : 
                                        <input type="radio" value="yes" name="dangerous_goods">Yes
                                        <input type="radio" value="no" name="dangerous_goods" checked>No
                                    </fieldset>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header">{{ __('Comments') }}</div>
                                <div class="form-group">
                                    <label for="comments" class="col-form-label text-md-right">{{ __('comments') }}</label>
                                    <br/>
                                    <textarea class="form-control" name="comments" id="comments" autofocus  autocomplete="comments"></textarea>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header">{{ __('status') }}</div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  id="status" name="status"/>
                                        <label class="form-check-label" for="flexCheckDefault">Status </label>
                                    </div>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
<script src="../assets/js/hierarchy-select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {   
        $('#parent-category').hierarchySelect({
            width: 'auto',
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
