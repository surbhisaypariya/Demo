@extends('layouts.app')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product Detail </div>
                <div class="row" style="padding:20px;">
                    
                    <div class="col-md-6">
                        @if(isset($category_id))
                        <div class="form-group">
                            <form action="{{ route('product.index') }}" method="put">
                                @csrf
                                <label for="category"><strong>Category</strong></label>
                                <select class="form-control" id="category" name="category" >
                                    <option value="">please select</option>
                                    <?php $par=0; ?>
                                    @foreach ($categories as $category)
                                    <?php $par = count($category->parents); echo $par; ?>
                                    
                                    <option value="{{ $category->id }}" {{ $category_id == $category->id ? "selected":""}}> <?php echo(str_repeat(' - ',$par)); ?>{{ $category->category }}</option>
                                    
                                    @if (count($category->children) > 0)    
                                    <?php $par = count($category->parents); echo $par; ?>
                                    
                                    @include('product/sub_category', ['subcategories' => $category->children, 'parent' => $category->category ,'par'=>$par ,'category_id'=>$category_id])
                                    
                                    @endif
                                    
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary"> Get Data</button>
                            </form>
                        </div>
                        @else 
                        <div class="form-group">
                            <form action="{{ route('product.index') }}" method="put">
                                @csrf
                                <label for="category"><strong>Category</strong></label>
                                <select class="form-control" id="category" name="category" >
                                    <option value="">please select</option>
                                    <?php $par=0; ?>
                                    @foreach ($categories as $category)
                                    <?php $par = count($category->parents); echo $par; ?>
                                    
                                    <option value="{{ $category->id }}"> <?php echo(str_repeat(' - ',$par)); ?>{{ $category->category }}</option>
                                    
                                    @if (count($category->children) > 0)    
                                    <?php $par = count($category->parents); echo $par; ?>
                                    
                                    @include('product/sub-create', ['subcategories' => $category->children, 'parent' => $category->category ,'par'=>$par ])
                                    
                                    @endif
                                    
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary"> Get Data</button>
                            </form>
                        </div>
                        @endif
                        
                    </div>
                </div>
                <div class="col-md-2">
                    
                </div>
            </div>
            
            
            
        </div>
        
        <div class="col-md-4">
            <form action="{{ route('product.create') }}" method="put">
                <button class="btn btn-success">Product</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-stripped " id="datatable">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Brand Name/Manufecturer</th>
                        <th>Categories</th>
                        <th>Size</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_code}}</td>
                        <td>{{ $product->brand_name .'/'.$product->manufacture }}</td>
                        <td>
                            @foreach($product->category as $category)
                            <?php $cur_id = $category->id; 
                            $current_cat = App\Models\Category::find($cur_id);
                            $parent_cat = App\Models\Category::find($cur_id)->parents->reverse()->push($current_cat);
                            
                            ob_start();
                            foreach($parent_cat as $parent)
                            {  
                                echo  $parent->category.' / ';
                            }
                            $output = ob_get_clean();
                            echo rtrim($output,' / ');
                            echo "<br>";
                            ?> 
                            @endforeach
                        </td>
                        <td>{{ $product->unit_size}}</td>
                        <td>{{ $product->unit_of_sale}}</td>
                        <td>{{ $product->status == "1"?"Active":"Disactive"}}</td>
                        <td>
                            <div class="btn btn-group" role="group" >
                                <a href="{{ route('product.edit',$product->id ) }}" class="fa fa-pencil btn btn-info">
                                </a>
                                
                                <form action="{{ route('product.destroy',$product->id ) }}" method="post" >
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
                        <th>Product Code</th>
                        <th>Brand Name/Manufecturer</th>
                        <th>Categories</th>
                        <th>Size</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            {!! $products->links() !!}
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
@endsection
