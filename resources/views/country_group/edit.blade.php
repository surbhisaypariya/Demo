@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Country Group') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('country_group.update',[$country_group->id]) }}">
                        @method('PATCH')
                        @csrf       
                                         
                        <div class="form-group row">
                            <label for="group_name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Group Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="group_name" type="text"
                                class="form-control @error('group_name') is-invalid @enderror" name="group_name"
                                value="{{ $country_group->group_name }}" required autocomplete="group_name" autofocus>
                                
                                @error('group_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="countries[]"
                            class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <?php $group_country_id =$country_group->country()->pluck("country_id")->toArray(); ?>
                                <select id="countries[]" name="countries[]" class="form-control countries" multiple="multiple" value="">
                                    <option value="">-- Please Select --</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ in_array($country->id , $group_country_id)?"selected":"" }}>{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                                
                                @error('countries[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {   
        $('.countries').select2(); 
    });
</script>
@endsection
