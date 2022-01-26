@if(!empty($regions))
@foreach ($regions as $region)
@if (count($regions) > 1)
<option value="{{ $region->id }}" >{{ $region->name }}</option>
@else
<option value="{{ $region->id }}" selected>{{ $region->name }}</option>
@endif
@endforeach
@endif