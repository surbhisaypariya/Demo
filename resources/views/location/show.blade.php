@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Location Detail </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <form action="{{ route('location.create') }}" method="put">
                <button class="btn btn-success">Location</button>
            </form>
        </div>
        <div class="card-body">
            <div class="row" style="padding:5px;">
                <div class="col-md-4">
                    <select class="form-control type" id="type" name="type" >
                        <option value="">Type</option>
                        <option value="Logistics Warehouse">Logistics Warehouse</option>
                        <option value="Logistics Hub">Logistics Hub</option>
                        <option value="Company Warehouse">Company Warehouse</option>
                        <option value="3rd Party Warehouse">3rd Party Warehouse</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control status" id="status" name="status" >
                        <option value="" selected>Status</option>
                        <option value="Active">Active</option>
                        <option value="Disable">Disable</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control organization" id="organization" name="organization" >
                        <option value="" selected>organization</option>
                        @foreach($organizations as $organization)
                        <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="table table-success" id="datatable">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Organization</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    var oTable;
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        'paging' : true,
        "lengthMenu": [5, 20, 50,100],
        "columnDefs" : [{ targets: 4, visible: false }],
        "ajax" : {
            url : "{{ route('ajaxfetchlocation') }}",
            method : "post",
            data : {
                "_token":"{{ csrf_token() }}",
            },
        }
    });
    
    $('#search').change(function(){
        oTable.columns(1).search(this.value).draw();
    });
    
    $("#status").change(function(){
        oTable.columns(3).search(this.value).draw();
    });
    
    $("#type").change(function(){
        oTable.columns(2).search(this.value).draw();
    });
    
    $("#organization").change(function(){
        var id = $(this).val();
        oTable.columns(4).search(id).draw();
    });
    
</script>
@endsection
