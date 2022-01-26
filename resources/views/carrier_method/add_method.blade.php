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
                    <form method="POST" action="{{ route('add_method') }}" id="myForm">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="carrier_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Carrier Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="carrier_id" type="hidden" name="carrier_id" value="{{ $carriers->id }}" readonly>
                                <input id="carrier_name" type="text"
                                class="form-control @error('carrier_name') is-invalid @enderror" name="carrier_name"
                                value="{{ $carriers->carrier_name }}" required autocomplete="carrier_name" autofocus readonly>
                                
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
                                <div class="form-group" id="append">
                                    <input type="text"
                                    class="form-control @error('method_name') is-invalid @enderror" name="method_name[]"
                                    value="{{ $carriers->method_name }}" autocomplete="method_name" autofocus>
                                    <br>
                                </div>
                                <a class="btn btn-success" id="add_input">Add Method</a>
                                
                                @error('method_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
    var no = 1 ;
    $("#add_input").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
                html += '<input type="text" name="method_name['+no+']" class="form-control @error('method_name') is-invalid @enderror" required>';
                html += '<div class="input-group-append">';
                    html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
                    html += '</div>';
                    html += '</div>';
                    $('#append').append(html);
                    no ++ ;
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
            