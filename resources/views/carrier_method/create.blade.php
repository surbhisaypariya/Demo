@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Carrier Method') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('carriers.store') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="carrier_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Carrier Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="carrier_name" type="text"
                                class="form-control @error('carrier_name') is-invalid @enderror" name="carrier_name"
                                value="{{ old('carrier_name') }}" autocomplete="carrier_name" autofocus>
                                
                                @error('carrier_name')
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
