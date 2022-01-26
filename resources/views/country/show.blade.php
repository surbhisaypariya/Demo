@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Country Detail </div>
                
                <div class="col-md-4">
                    <form action="{{ route('country.create') }}" method="put">
                        <button class="btn btn-success">Country</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-stripped " id="datatable">
                        <thead>
                            <tr>
                                <th>Country Code</th>
                                <th>Country Name</th>
                                <th>Country Group</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                            <tr>
                                <td>{{ $country->country_code }}</td>
                                <td>{{ $country->country_name }}</td>
                                <td>
                                    @foreach($country->country_group as $group)
                                        {{ $group->group_name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn btn-group" role="group" >
                                        <a href="{{ route('country.edit',$country->id ) }}" class="fa fa-pencil btn btn-info">
                                        </a>
                                        
                                        <form action="{{ route('country.destroy',$country->id ) }}" method="post" >
                                            @csrf
                                            @method('DELETE')
                                            <button class="fa fa-trash btn btn-danger" id="delete" onclick="return confirm('Are you sure?')">
                                            </button>
                                        </form>             
                                    </div>    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection
