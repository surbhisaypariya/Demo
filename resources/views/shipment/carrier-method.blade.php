@if(!empty($methods))
@foreach ($methods as $method)
<option value="{{ $method->id }}">{{ $method->method_name }}</option>
@endforeach
@endif