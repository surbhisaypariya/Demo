@foreach ($subcategories as $sub)
<?php $par = count($sub->parents); ?>
<option value="{{ $sub->id }}">  <?php echo(str_repeat(' - ',$par)); ?>{{ $sub->category }}</option>
<ul>
    @if (count($sub->children) > 0)   
    <?php $par = count($sub->parents); echo $par; ?>
    @php
    $parents = $parent . ' - ' . $sub->category;
    @endphp
    
    @include('category/sub_create', ['subcategories' => $sub->children, 'parent' => $parents,'category'=>$category,'category'=>$category,'par'=>$par])

    @endif
</ul>
@endforeach