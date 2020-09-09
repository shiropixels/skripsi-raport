@extends('template.internal_master')
@section('title', 'Lupa Password')
@section('js_before')
	@if(Session::has('error'))
    		<script type="text/javascript">
				alert("{{ Session::get('error') }}");
    		</script>
	@endif
@endsection
@section('content')
	<div class="container-header">
		<div class="container-fluid pl-4 pt-2">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Lupa Password</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid p-4">
		<div class="row">
			<div class="col-12">
				<form method="post" action="{{url('/change-password/'.$type)}}">
					@csrf
					<input type="email" name="email" maxlength="#maxlength" size="50" id="email-field" class="form-control mb-3" placeholder="Email">
					<button type="submit" id="login-button" class="btn btn-primary">
						Submit
					</button>
				</form>
			</div>
		</div>
	</div>
@endsection