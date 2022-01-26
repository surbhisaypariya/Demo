@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Donation Detail </div>
                
                <div class="col-md-4">
                    <form action="{{ route('donation.create') }}" method="put">
                        <button class="btn btn-success">Donation</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-stripped " id="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Organization</th>
                                <th>Region</th>
                                <th>Reference</th>
                                <th>Items</th>
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
<script>
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        'paging' : true,
        "order": [ 0, "desc" ],
        "ajax" : {
            url : "{{ route('ajaxfetchdonation') }}",
            method : "post",
            data : {
                "_token":"{{ csrf_token() }}",
            },
        }
    });
</script>
@endsection
