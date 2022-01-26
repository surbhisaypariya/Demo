@if ($message = Session('success'))
<div class="alert alert-success alert-alert">
<button type="button" class="close" data-bs-dismiss="alert" >×</button>	
<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session('error'))
<div class="alert alert-danger alert-alert">
<button type="button" class="close" data-bs-dismiss="alert">×</button>	
<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session('warning'))
<div class="alert alert-warning alert-alert">
<button type="button" class="close" data-bs-dismiss="alert">×</button>	
<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session('info'))
<div class="alert alert-info alert-alert">
<button type="button" class="close" data-bs-dismiss="alert">×</button>	
<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger alert-alert">
<button type="button" class="close" data-bs-dismiss="alert">×</button>	
Please check the form below for errors
</div>
@endif