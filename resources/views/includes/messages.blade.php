@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
       <p class="text-center">
           <strong >{{ $message }}</strong>
      </p>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <p class="text-center">
           <strong >{{ $message }}</strong>
        </p>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<p class="text-center">
           <strong >{{ $message }}</strong>
    </p>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<p class="text-center">
        <strong >{{ $message }}</strong>
    </p>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
    <div class="col-md-8 offset-md-2 alert-danger">
        @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
        @break;
        @endforeach
    </div>
</div>
@endif
