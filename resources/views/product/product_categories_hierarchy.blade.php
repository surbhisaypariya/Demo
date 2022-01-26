@foreach($children as $child)
        @if(count($child->children->find($current_ids)))
            @include('product.product_categories_hierarchy',['children' => $child->children->find($current_ids),'current_ids' => $current_ids])
        @else
            {{$child->getParentsNames()->reverse()->pluck('name')->implode(' / ')}} / {{$child->name}} <br>
        @endif
@endforeach