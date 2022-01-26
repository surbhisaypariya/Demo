@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product Detail </div>
                
                <div class="card-body">
                    <table class="table table-stripped " id="datatable">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Brand Name/Manufecturer</th>
                                <th>File Name</th>
                                <th>Date</th>
                                <th>Uploaded By</th>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    var oTable;
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        "ajax" : {
            url : "{{ route('ajaxFetchData') }}",
            method : "post",
            data : {"_token":"{{ csrf_token() }}",
        }
    } 
});

$('#search').change(function(){
    oTable.columns(2).search(this.value).draw();
});
</script>
@endsection
