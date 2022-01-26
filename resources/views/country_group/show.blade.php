@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Country Group Detail </div>
                
                <div class="col-md-4">
                    <form action="{{ route('country_group.create') }}" method="put">
                        <button class="btn btn-success">Country Group</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-stripped " id="datatable">
                        <thead>
                            <tr>
                                <th>Group Name</th>
                                <th>Country </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($country_groups as $country_group)
                            <tr>
                                <td>{{ $country_group->group_name }}</td>
                                <td>
                                    <?php $countries = array();?>
                                    @foreach($country_group->country as $country_name)
                                    <?php 
                                    $countries[] = $country_name->country_name; 
                                    ?>
                                    @endforeach
                                    <?php echo implode('/',$countries); ?>
                                </td>
                                <td>
                                    <div class="btn btn-group" role="group" >
                                        <a href="{{ route('country_group.edit',$country_group->id ) }}" class="fa fa-pencil btn btn-info">
                                        </a>
                                        
                                        <form action="{{ route('country_group.destroy',$country_group->id ) }}" method="post" >
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
