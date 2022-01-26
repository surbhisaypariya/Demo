<span id="uploaded_file" style="padding:10px;">
    <div style="background-color: rgb(245, 232, 232);border-radius:10px;">
        @foreach($product_attatchment as $products) 
        
        @if($products->status == 0)
        <span style="color: red;">{{ $products->image_name }}</span>
        <a  href="{{ route('image_download',$products->image_name ) }}"  class="btn btn-success btn-xs fa fa-download"></a>
        <a  href="{{ route('image_restore',$products->id ) }}" class="btn btn-success btn-xs fa fa-plus"></a>
        @else
        {{ $products->image_name }}
        <a  href="{{ route('image_download',$products->image_name ) }}"  class="btn btn-success btn-xs fa fa-download"></a>
        <a  href="{{ route('image_remove',$products->id ) }}" class="btn btn-success btn-xs fa fa-times"></a>
        @endif
        
        <br/>
        @endforeach
    </div>
</span>