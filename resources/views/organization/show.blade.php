@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Organization Detail </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <form action="{{ route('organization.create') }}" method="put">
                <button class="btn btn-success">Organization</button>
            </form>
        </div>
        <div class="card-body">
            <div class="row" style="padding:5px;">
                <div class="col-md-4">
                    <select class="form-control type" id="type" name="type" required >
                        <option value="" selected>Type</option>
                        <option value="OPCO">OPCO</option>
                        <option value="External Partner">External Partner</option>
                        <option value="Donor">Donor</option>
                        <option value="Logistics">Logistics</option>
                        <option value="NGO">NGO</option>
                        <option value="Healthcare">Healthcare</option>
                        <option value="EHP Carrier">EHP Carrier</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control status" id="status" name="status" required >
                        <option value="" selected>Status</option>
                        <option value="Active">Active</option>
                        <option value="Disable">Disable</option>
                    </select>
                </div>
            </div>
            <table class="table table-success" id="datatable">
                <thead>
                    <tr>
                        <th >Name</th>
                        <th>Contact</th>
                        <th>Members</th>
                        <th>Type</th>
                        <th>Status</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    var oTable;
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        "ajax" : {
            url : "{{ route('ajaxfetchorganization') }}",
            method : "post",
            data : {"_token":"{{ csrf_token() }}",}
        } 
    });
    
    $('#search').change(function(){
        oTable.columns(1).search(this.value).draw();
    });
    
    $("#type").change(function(){
        oTable.columns(3).search(this.value).draw();
    });
    
    $("#status").change(function(){
        oTable.columns(4).search(this.value).draw();
    });
    
</script>
@endsection
