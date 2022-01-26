@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('category.update',[$category->id]) }}">
                        @method('PATCH')
                        @csrf
                        
                        <div class="form-group row">
                            <label for="category"
                            class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            
                            <div class="col-md-6">
                                <input id="category" type="text"
                                class="form-control @error('category') is-invalid @enderror" name="category"
                                value="{{ $category->category }}" required autocomplete="category" autofocus>
                                
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
                                class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description"
                                autofocus>{{ $category->description }}</textarea>
                                
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Parent_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Parent_id') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="parent_id" name="parent_id" old="{{ 'parent_id' }}" value="{{ $category->parent_id}}">
                                    <option value="">Please Select</option>
                                    <?php $par=0; ?>
                                    <?php $parent_cat_id=$category->parent_id ?>
                                    @foreach ($categories as $categorie)
                                    <?php $par = count($categorie->parents); ?>
                                    
                                   <option value="{{ $categorie->id }}"{{ $parent_cat_id == $categorie->id?"selected":"" }}>{{ $categorie->category }} </option>
                                    
                                    @if (count($categorie->children) > 0)    
                                    <?php $par = count($categorie->parents); ?>
                                    
                                    @include('category/subcategories', ['subcategories' => $categorie->children, 'parent' => $categorie->category ,'par'=>$par,'category'=>$category,'parent_cat_id'=>$parent_cat_id])
                                    
                                    @endif
                                    
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection