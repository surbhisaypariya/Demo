@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Carrier Method Detail</div>
                <div class="row" style="padding: 20px;">
                    <div class="col-md-4">
                        <form action="{{ route('carriers.create') }}" method="put">
                            <button class="btn btn-success">Carrier Method</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="search" placeholder="search carriers" class="form-control">
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-stripped " id="datatable">
                        <thead>
                            <tr>
                                <th>Carrier Name</th>
                                <th>Methods</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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
            url : "{{ route('ajaxcarriermethod') }}",
            method : "post",
            data : {
                "_token":"{{ csrf_token() }}",
            },
        }
    });
    
    $('#search').on('keyup',function(){
        oTable.columns(0).search(this.value).draw();
    });
    
</script>
@endsection
