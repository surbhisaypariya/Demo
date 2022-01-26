@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="padding: 20px;"> 
                    <form action="{{ route('importExcelviewCategory') }}">
                        <button class="btn btn-success"> importExcel </button>
                    </form>
                </div>
                <div class="card-header">{{ __('Category') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="category"
                            class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            
                            <div class="col-md-6">
                                <input id="category" type="text"
                                class="form-control @error('category') is-invalid @enderror" name="category"
                                value="{{ old('category') }}" required autocomplete="category" autofocus>
                                
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="description"
                            class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            
                            <div class="col-md-6">
                                <textarea id="description"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description') }}" required autocomplete="description"
                                autofocus></textarea>
                                
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Parent_id') }}</label>
                            <div class="col-md-6 form-fld">
                                <select class="form-control" id="parent_id" name="parent_id" old="{{ 'parent_id' }}">
                                    <option value="">please select</option>
                                    <?php $par=0; ?>
                                    @foreach ($categories as $category)
                                    <?php $par = count($category->parents); echo $par; ?>
                                    
                                    <option value="{{ $category->id }}"> <?php echo(str_repeat(' - ',$par)); ?>{{ $category->category }}</option>
                                    
                                    @if (count($category->children) > 0)    
                                    <?php $par = count($category->parents); echo $par; ?>
                                    
                                    @include('category/sub_create', ['subcategories' => $category->children, 'parent' => $category->category ,'par'=>$par])
                                    
                                    @endif
                                    
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../assets/js/hierarchy-select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {   
        $('#parent-category').hierarchySelect({
            width: 'auto',
        });
    });
</script>
@endsection
