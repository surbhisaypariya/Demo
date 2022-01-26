@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqtree/1.6.1/jqtree.min.css" />
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    User Detail 
                </div>
                <div style="padding-top:10px;">
                    <form action="{{ route('category.create') }}" method="put">
                        <button class="btn btn-success">Add category</button>
                    </form>
                </div>
                
                <div class="card-body">
                    <div class="main-listing-data" id="category-sort-tree">
                    </div>
                    
                    <div class="form-cover">
                        <div class="form-row">
                            <div class="form-col-1">
                                <div class="form-fld submit-fld">
                                    <div class="sortview-cat-save">
                                        <input type="submit" id="save" class="submit-btn btn btn-success submit-btn" value="SAVE">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqtree/1.6.1/tree.jquery.min.js"> </script>
<form action="" id="frm-del" method="POST">@csrf @method("DELETE")</form>
<script type="text/javascript">
    var tree = $('#category-sort-tree');
    $(document).ready(function ($){
        $.getJSON(' {{ asset('public/storage/json/categories.json') }}?{{ time() }}',
        function(data){
            tree.tree({
                data : data,
                autoOpen : false,
                dragAndDrop : true,
                useContextMenu : false,
                onCreateLi : function(node , $li)
                {
                    $li.find('.jqtree-title').append(' <span class="products-count"><a href="{{ route('category.index') }}"></a></span>');
                    
                    $li.find('.jqtree-element').append(
                    '<div class="action-btn" ><a href="{{url("/")}}/category/'+node.id+'/edit" title="edit"><span class="fa fa-pencil" style="padding-left:10px;"></span></a><a href="Javascript:void(0);" class="tab-delete-user del-btn" data-key="{{url("/")}}/category/'+node.id+'" title="delete" ><span class="fa fa-trash del-btn" style="padding-left:10px;"></span></a></div>'
                    );
                }
                
            })
        }
        );
        $(document).on('click', ".submit-btn", function (e) {
            var con = confirm('Are You sure?');
            if(con == true)
            {
                categories_ajaxstore();
            }
        });
        
        $(document).on('click', ".del-btn", function (e) {
            var data_key=$(this).attr("data-key");
            var con = confirm('Are you Sure?',data_key);
            if(con == true)
            {
                $('#frm-del').attr('action', data_key).submit();
            }
            
        });  
        
        function categories_ajaxstore(){
            var tree_data = tree.tree('getTree');
            var set_data=tree_data.getData();
            console.log(set_data);
            var _token = $("input[name=_token]").val();
            $.ajax({
                url:"{{ route('categories_ajaxstore') }}",
                method:"POST",
                data:{_token:_token, data:set_data},
                beforeSend: function (xhr) {
                    $('#loader').show();
                },
                success:function(data)
                {
                    location.reload(true);
                    
                }
            });
        }
    } )
    
</script>
@endsection

