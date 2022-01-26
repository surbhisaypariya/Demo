@foreach ($subcategories->where('id' , '!=' , $category->id) as $sub)
<?php $par = count($sub->parents); ?>
<option value="{{ $sub->id }}" {{ $parent_cat_id == $sub->id?"selected":"" }} >  <?php echo(str_repeat(' - ',$par)); ?>{{ $sub->category }}</option>
<ul>
    @if (count($sub->children) > 0)   
    <?php $par = count($sub->parents); echo $par; ?>
    @php
    $parents = $parent . ' - ' . $sub->category;
    @endphp
    
    @include('category/subcategories', ['subcategories' => $sub->children, 'parent' => $parents,'category'=>$category,'category'=>$category,'par'=>$par,'parent_cat_id'=>$parent_cat_id])

    @endif
</ul>
@endforeach