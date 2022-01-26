@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Detail </div>
                <div>
                    <form action="{{ route('user.create') }}" method="put">
                        <button class="btn btn-success">Add User</button>
                    </form>
                </div>
                
                <div class="card-body">
                    <table class="table table-stripped " id="datatable_example">
                        <thead>
                            <tr>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Organization</th>
                                <th>User Status</th>
                                <th>Activation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @foreach($user->organization as $organization)
                                    <?php 
                                    $org_ids = $organization->pivot->organization_id;
                                    $org_name = App\Models\Organization::find($org_ids);
                                    echo $org_name->organization_name;
                                    echo "<br>";
                                    ?>
                                    @endforeach
                                </td>
                                <td>{{ $user->user_status == 1 ? "Active" : "Deactive"}}</td>
                                <td>{{ $user->activation == 1 ? "Activated" : "DisActivated"}}</td>
                                <td>
                                    <div class="btn btn-group" role="group" >
                                        <a href="{{ route('user.edit',$user->id ) }}" class="fa fa-pencil btn btn-info">
                                        </a>
                                        
                                        <form action="{{ route('user.destroy',$user->id ) }}" method="post" >
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
                        <tfoot>
                            <tr>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Organization</th>
                                <th>User status</th>
                                <th>Activation</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


@endsection

