@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Country') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('country.store') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="country_code"
                            class="col-md-4 col-form-label text-md-right">{{ __('Country Code') }}</label>
                            
                            <div class="col-md-6">
                                <input id="country_code" type="text"
                                class="form-control @error('country_code') is-invalid @enderror" name="country_code"
                                value="{{ old('country_code') }}" required autocomplete="country_code" autofocus>
                                
                                @error('country_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="country_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="country_name" type="text"
                                class="form-control @error('country_name') is-invalid @enderror" name="country_name"
                                value="{{ old('country_name') }}" required autocomplete="country_name" autofocus>
                                
                                @error('country_name')
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
<script src="../assets/js/hierarchy-select.min.js"></script>
@endsection
