@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Donation Item Detail / 
                    <label id="ref_name">{{ $donation->reference_name}}</label>
                    <input type="hidden" name="donation_id" id="donation_id" value="{{ $donation->id }}"/>
                </div>
                
                <div class="row ">
                    <div class="col-md-2 border">
                        <p class="text text-primary font-weight-bold">Items</p >
                            <label id="donation_item">{{ count($donation_items)}}</label>
                        </div>
                        <div class="col-md-2 border">
                            <p class="text text-primary font-weight-bold">Matched</p>
                            <label id="matched">{{ $matched }}</label>
                        </div>
                        <div class="col-md-2 border">
                            <p class="text text-warning font-weight-bold">Unmatched</p>
                            <label id="unmatched"> {{ $unmatched }}</label>
                        </div>
                        <div class="col-md-2 border">
                            <p class="text text-danger font-weight-bold">Error</p>
                            <label id="error">{{ $error }}</label>
                        </div>
                        <div class="col-md-2 border">
                            <p class="text text-success font-weight-bold">Commited</p>
                            <label id="commited">{{ $commited }}</label>
                        </div>
                        <div class="col-md-2 border">
                            <p class="font-weight-bold">Removed/Unrequired</p>
                            <label id="remove">{{ $removed }}</label>
                        </div>
                    </div>
                    <label>
                        <b> Restrictions  : </b><br>
                        @foreach($donation->country as $country)
                        - {{ $country->country_name }}<br>
                        @endforeach
                    </label>
                    <label id="commit" style="display: none;" class="alert alert-info"></label>
                    <div class="card-body">
                        <table class="table table-stripped " id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Code</th>
                                    <th>Brand Name</th>
                                    <th>Units</th>
                                    <th>Batch</th>
                                    <th>Expiry</th>
                                    <th>Location</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $donation_id = $("#donation_id").val();
        
        oTable = $("#datatable").DataTable({
            'processing' : true,
            'serverside' : true,
            'paging' : true,
            "columnDefs" : [{ targets: 0, visible: false }],
            "ajax" : {
                url : "{{ route('ajaxfetchdonationitem') }}",
                method : "post",
                data : {
                    "_token":"{{ csrf_token() }}",
                    "id" : $donation_id, },
                },
                drawCallback: function () {
                    var api = this.api();
                    api.rows({ page: "current" }).every(function (idx, t, i) {
                        var rowData = this.data();
                        var raw_class = rowData[9];
                        $(this.node()).attr("style",raw_class);
                    });
                }    
            });
            
            $("#datatable").on('click','.edit',function(e){
                e.preventDefault();
                var tr = $(this).parents('tr');
                var row = oTable.row( tr );
                
                var ids = oTable.row($(this).parents('tr')).data();
                id = ids[0];
                code = ids[1];
                
                $.ajax({
                    type : "POST",
                    url : "{{ route('ajaxfetchdonationitemedit') }}",
                    data: { 
                        id: id ,
                        code : code,
                        donation_id : $donation_id,
                        "_token":"{{ csrf_token() }}",
                    },
                    success:function(data)
                    {
                        row.child(data.data).show();
                    }
                });
            });
            
            
            
            $('body').on('click','.delete',function(){
                var ids = oTable.row($(this).parents('tr')).data();
                id = ids[0];
                
                $.ajax({
                    type : "POST",
                    url : "{{ route('donation_item_destroy') }}",
                    data: { 
                        id: id ,
                        donation_id : $donation_id,
                        "_token":"{{ csrf_token() }}",
                    },
                    success:function(data)
                    {
                        console.log(data);
                        var obj = JSON.parse(data); 
                        $("#matched").text(obj.data.matched);
                        $("#unmatched").text(obj.data.unmatched);
                        $("#error").text(obj.data.error);
                        $("#remove").text(obj.data.remove);
                        $("#commited").text(obj.data.commited);
                        oTable.ajax.reload();
                    }
                });
            });
            
            $('body').on('click','.show',function(e){
                e.preventDefault();
                var tr = $(this).parents('tr');
                var row = oTable.row( tr );
                
                var ids = oTable.row($(this).parents('tr')).data();
                id = ids[0];
                
                $.ajax({
                    type : "POST",
                    url : "{{ route('donation_item_show') }}",
                    data: { 
                        id: id ,
                        donation_id : $donation_id,
                        "_token":"{{ csrf_token() }}",
                    },
                    success:function(data)
                    {
                        row.child(data.data).show();
                    }
                });
            });
            
            
            $('body').on('click','.restore',function(e){
                e.preventDefault();
                var tr = $(this).parents('tr');
                var row = oTable.row( tr );
                
                var ids = oTable.row($(this).parents('tr')).data();
                id = ids[0];
                
                $.ajax({
                    type : "POST",
                    url : "{{ route('donation_item_restore') }}",
                    data: { 
                        id: id ,
                        donation_id : $donation_id,
                        "_token":"{{ csrf_token() }}",
                    },
                    success:function(data)
                    {
                        var obj = JSON.parse(data); 
                        $("#matched").text(obj.data.matched);
                        $("#unmatched").text(obj.data.unmatched);
                        $("#error").text(obj.data.error);
                        $("#remove").text(obj.data.remove);
                        $("#commited").text(obj.data.commited);
                        oTable.ajax.reload();
                    }
                });
            });
            
            $('body').on('click','.commit',function(e){
                e.preventDefault();
                var tr = $(this).parents('tr');
                var row = oTable.row( tr );
                
                var ids = oTable.row($(this).parents('tr')).data();
                id = ids[0];
                
                $.ajax({
                    type : "POST",
                    url : "{{ route('donation_item_commit') }}",
                    data: { 
                        id: id ,
                        donation_id : $donation_id,
                        "_token":"{{ csrf_token() }}",
                    },
                    success:function(data)
                    {
                        var obj = JSON.parse(data); 
                        $("#matched").text(obj.data.matched);
                        $("#unmatched").text(obj.data.unmatched);
                        $("#error").text(obj.data.error);
                        $("#remove").text(obj.data.remove);
                        $("#commited").text(obj.data.commited);
                        $("#commit").show();
                        $("#commit").text(obj.data.message);
                        oTable.ajax.reload();
                    }
                });
            });
            
        </script>
        @endsection
        