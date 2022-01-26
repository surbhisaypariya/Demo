@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Shipment Detail </div>
                <div class="row" style="padding: 20px;">
                    <div class="col-md-4">
                        <form action="{{ route('shipment.create') }}" method="put">
                            <button class="btn btn-success">Shipment</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <select name="status" id="status" class="form-control">
                            <option value="">All</option>
                            <option value="In-Work">In-Work</option>
                            <option value="Posted">Posted</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="search" placeholder="search shipment" class="form-control">
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-stripped " id="datatable">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Recieved</th>
                                <th>Sender</th>
                                <th>Location</th>
                                <th>Carrier/Method</th>
                                <th>Items</th>
                                <th>Status</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/api/fnMultiFilter.js"></script>
<script type="text/javascript">
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        "ajax" : {
            url : "{{ route('ajaxfetchshipment') }}",
            method : "post",
            data : {"_token":"{{ csrf_token() }}",}
        }  
    });
    
    $("#status").change(function(){
        oTable.columns(6).search(this.value).draw();
    });
    
    $('#search').unbind().on('keyup',function(){
        var searchTerm = this.value.toLowerCase();
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //search only in column 0 , 1 and 2 
            if (~data[0].toLowerCase().indexOf(searchTerm)) return true;
            if (~data[2].toLowerCase().indexOf(searchTerm)) return true;
            if (~data[3].toLowerCase().indexOf(searchTerm)) return true;
            return false;
        });
        oTable.draw(); 
        $.fn.dataTable.ext.search.pop();
    });
</script>


@endsection
