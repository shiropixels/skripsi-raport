<!DOCTYPE html>
<html>
<head>
	<title>Global School Mandiri Raport</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="{{asset('/css/login-v3.css')}}">
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="{{asset('/js/login-v2.js')}}"></script>

	@if (Session::has('success'))
     <div class="alert alert-info">{{ Session::get('success') }}</div>
 @endif
</head>
<body>
	<!-- <div class="bg-img"></div> -->
	<div class="container">
		<div class="img">
			<img src="{{asset('/image/logo global.png')}}" alt="Global Mandiri School">
		</div>

		<form method="post" action="/student/StudentLoginPage">
			@csrf
			<div class="login">
				<div id="login-form">
					<input type="email" name="email" maxlength="#maxlength" size="50" id="email-field" class="login-form-field" placeholder="Email">

					<input type="password" name="password" minlength="6"  size="50" id="password-field" class="login-form-field" placeholder="Password">
				</div>
			</div>

		
			<button type="submit" id="login-button">
				Login
			</button>
		</form>

		<div class="row">
			<div class="col-12">
				<p class="info">Jika anda lupa password. Harap hubungi admin.</p>
				<p class="info-admin">Admin@gmail.com</p>
			</div>
		</div>


		<!-- <label class="forgot-password">
			<button id="fp-button"><img src="{{asset('/image/lock.png')}}">
				<a href="{{url('/forgot_password_student')}}">Forgot password</a>
			</button>
		</label> -->
	</div>

@if(Session::has('error'))
    <script type="text/javascript">
		alert("{{ Session::get('error') }}");
    </script>
@endif
</body>
</html>