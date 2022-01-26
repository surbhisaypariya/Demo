@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Stock Detail </div>
                <div class="row" style="padding: 20px;">
                    <div class="col-md-4">
                        <input type="text" id="search" placeholder="search item" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <select name="location" id="location" class="form-control">
                            <option value="">Locations</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="status" id="status" class="form-control">
                            <option value="">Status</option>
                            <option value="Adjusted">Adjusted</option>
                            <option value="Archived">Archived</option>
                            <option value="Hold">Hold</option>
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-stripped " id="datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Shipment_id</th>
                                    <th>Item Number</th>
                                    <th>Brand Name</th>
                                    <th>Location</th>
                                    <th>Units</th>
                                    <th>Batch</th>
                                    <th>Pallet Id</th>
                                    <th>Expiry Date</th>
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
</div>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/api/fnMultiFilter.js"></script>
<script type="text/javascript">
    
    oTable = $("#datatable").DataTable({
        'processing' : true,
        'serverside' : true,
        "columnDefs" : [{ targets: [0,1], visible: false }],
        "ajax" : {
            url : "{{ route('ajaxfetchsstock') }}",
            method : "post",
            data : {"_token":"{{ csrf_token() }}",}
        }  
    });
    
    $("#status").change(function(){
        oTable.columns(9).search(this.value).draw();
    });
    
    $("#location").change(function(){
        oTable.columns(4).search(this.value).draw();
    });
    
    $('#search').unbind().on('keyup',function(){
        var searchTerm = this.value.toLowerCase();
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //search only in column 0 and 1  
            if (~data[2].toLowerCase().indexOf(searchTerm)) return true;
            if (~data[3].toLowerCase().indexOf(searchTerm)) return true;
            return false;
        });
        oTable.draw(); 
        $.fn.dataTable.ext.search.pop();
    });
    
    $("#datatable").on('click','.show',function(e){
        e.preventDefault();
        var tr = $(this).parents('tr');
        var row = oTable.row( tr );
        
        var ids = oTable.row($(this).parents('tr')).data();
        id = ids[0];
        shipment_id = ids[1];
        
        $.ajax({
            type : "POST",
            url : "{{ route('stockitem_detail') }}",
            data: { 
                id: id ,
                shipment_id : shipment_id,
                "_token":"{{ csrf_token() }}",
            },
            success:function(data)
            {
                row.child(data.data).show();
            }
        });
    });
    
    
</script>
@endsection
