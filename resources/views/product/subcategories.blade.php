@foreach ($subcategories as $sub)
<?php $par = count($sub->parents); ?>
<option value="{{ $sub->id }}" {{ in_array($sub->id , $product_cat_id)?"selected":"" }} >  <?php echo(str_repeat(' - ',$par)); ?>{{ $sub->category }}</option>
<ul>
    @if (count($sub->children) > 0)   
    <?php $par = count($sub->parents); echo $par; ?>
    @php
    $parents = $parent . ' - ' . $sub->category;
    @endphp
    
    @include('product/subcategories', ['subcategories' => $sub->children, 'parent' => $parents,'par'=>$par])

    @endif
</ul>
@endforeach