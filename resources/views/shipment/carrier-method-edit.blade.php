@if(!empty($methods))
@foreach ($methods as $method)
<?php 
$method_id = $shipments->method()->pluck('method_id')->toArray();
?>
<option value="{{ $method->id }}" {{ in_array($method->id , $method_id)?"selected":"" }}>{{ $method->method_name }}</option>
@endforeach
@endif