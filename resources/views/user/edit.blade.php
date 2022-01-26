@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',[$user->id]) }}">
                        @method('PATCH')
                        @csrf
                        
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>
                            
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>
                                
                                @error('firstname`')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>
                            
                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('Lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>
                                
                                @error('lastname`')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                <center> <a class="btn btn-success" href="{{ route('password.email',($user->email)) }}">
                                    {{ __('Reset Password') }}
                                </a></center>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>
                                
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            @if($user_role == "customer")
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control" id="role" name="role" value="{{ $user->role }}">
                                    <option value="customer" selected>customer</option>
                                </select>
                            </div>
                        </div>
                        @elseif($user_role == "admin")
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control" id="role" name="role" value="{{ $user->role }}">
                                    <option value="admin" selected>Admin</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>
                        </div>
                        @elseif($user_role == "super_admin")
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control" id="role" name="role" value="{{ $user->role }}">
                                    <option value="admin">Admin</option>
                                    <option value="customer">Customer</option>
                                    <option value="super_admin" selected>Super Admin</option>
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group row">
                        <label for="oranizations" class="col-md-4 col-form-label text-md-right">{{ __('Organization') }}</label>
                        
                        <div class="col-md-6">
                            <?php $organisation_ids = $user->organization()->pluck('organization_id')->toArray(); ?>
                            <select class="form-control organization" id="oranizations[]" name="oranizations[]" old="{{ 'oranizations' }}" multiple="multiple">
                                @foreach($organizations as $organization)
                                <option value="{{ $organization->id}}" {{ in_array($organization->id , $organisation_ids)?"Selected":"" }}>{{ $organization->organization_name}}</option>
                                @endforeach
                            </select>
                            
                            @error('oranizations`')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                        
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
                            
                            @error('phone`')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        
                        <div class="col-md-6">
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address"
                            required autocomplete="address" autofocus>{{ $user->address }}</textarea>
                            
                            @error('address`')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                        
                        <div class="col-md-6">
                            <input id="city" type="city" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="city" value="{{ $user->city }}">
                            
                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="State" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                        
                        <div class="col-md-6">
                            <input id="state" type="state" class="form-control @error('state') is-invalid @enderror" name="state" required autocomplete="state" value="{{ $user->state }}">
                            
                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal_code') }}</label>
                        
                        <div class="col-md-6">
                            <input id="postal_code" type="postal_code" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" required autocomplete="postal_code" value="{{ $user->postal_code }}">
                            
                            @error('postal_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    @if($user->user_status == "1")
                    <div class="form-group row">
                        <label for="user_status" class="col-md-4 col-form-label text-md-right">{{ __('User status') }}</label>
                        
                        <div class="col-md-6 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="user_status" 
                            value="{{ $user->user_status}}" checked/> 
                            
                            <label class="custom-control-label" for="customSwitch1"></label>
                            @error('user_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @elseif($user->user_status == "0")
                    <div class="form-group row">
                        <label for="user_status" class="col-md-4 col-form-label text-md-right">{{ __('User status') }}</label>
                        
                        <div class="col-md-6 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="user_status" 
                            value="{{ $user->user_status}}" /> 
                            
                            <label class="custom-control-label" for="customSwitch1"></label>
                            @error('user_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif
                    
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {  
        $(".organization").select2();
    });
</script>
@endsection