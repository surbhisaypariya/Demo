@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <div class="card-header" >{{ __(' Add Product Using CSV') }}</div>
                    
                        <div class="row" style="padding:20px;">
                            <div class="col-md-6" style="padding-right:100px;">
                                <form method='post' action="{{ route('importData') }}" enctype='multipart/form-data' >
                                    {{ csrf_field() }}
                                    <input type='file' name='csvfile' id="csvfile">
                                    <input type='submit' name='submit' value='Import' class="btn btn-success">
                                  </form>
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection
