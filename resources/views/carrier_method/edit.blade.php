@extends('layouts.app')

<style>
    #myForm .error {
        color: red;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Carrier Method') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('carriers.update',[$carriers->id]) }}" id="myForm">
                        @method('PATCH')
                        @csrf
                        
                        <div class="form-group row">
                            <label for="carrier_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Carrier Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="carrier_name" type="text"
                                class="form-control @error('carrier_name') is-invalid @enderror" name="carrier_name"
                                value="{{ $carriers->carrier_name }}" required autocomplete="carrier_name" autofocus>
                                
                                @error('carrier_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="method_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Method Name') }}</label>
                            
                            <div class="col-md-6">
                                <div class="form-group"  id="append">
                                    <?php $no = 0; ?>
                                    @foreach ($carriers->method as $method)                               
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3" >
                                            <input type="text" name="method_name[<?php  echo($no); ?> , {{  $method->id }}]" class="form-control @error('method_name') is-invalid @enderror" required value="{{ $method->method_name }}">
                                            <div class="input-group-append">
                                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                            </div>
                                        </div>
                                        <?php $no++; ?>
                                    </div>
                                    @endforeach
                                    @error('method_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <a class="btn btn-success" id="add_input">Add Method</a>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    var ji = '<?php  echo $no; ?>';
    var i = parseInt(ji);
    
    $("#add_input").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
                html += '<input type="text" name="method_name['+ i +']" class="form-control @error('method_name') is-invalid @enderror" required>';
                html += '<div class="input-group-append">';
                    html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                    html += '</div>';
                    html += '</div>';
                    $('#append').append(html);
                    i++;
                });
                
                $(document).on('click', '#removeRow', function () {
                    $(this).closest('#inputFormRow').remove();
                });
                
                $("#myForm").validate({
                    rules: {
                        "carrier_name" : { required : true },
                        "method_name[]" : { required : true },
                    },
                });
                
            </script>
            
            @endsection
            