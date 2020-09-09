<!DOCTYPE html>
<html>
<head>
	<title>Kanaan School Raport</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login-v2.css')}}">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="{{asset('/js/login-v2.js')}}"></script>
</head>
<body>
	<div class="container">
		<div class="tab">
 			<button class="btn-active" id="login-tab" onclick="login()">Login</button>
 			<button class="btn" id="register-tab" onclick="register()">Register</button>
 			<form method="POST" action="{{url('/')}}" arial label="{{('Submit')}}">
				@csrf
 		</div>
 		<div class="img">
 			<img src="{{asset('/image/login-logo.png')}}" alt="logo-kanaan-school">
 		</div>
		<div class="register">
			
			<div id="register-form">
				<input type="text" name="name" maxlength="#maxlength" size="50" id="name-field" class="register-form-field" placeholder="Name">

				<input type="text" name="nisn" maxlength="#maxlength" size="50" id="email-field" class="register-form-field" placeholder="NISN">

				<input type="text" name="nis" maxlength="#maxlength" size="50" id="email-field" class="register-form-field" placeholder="NIS">


				<input type="text" name="email" maxlength="#maxlength" size="50" id="email-field" class="register-form-field" placeholder="Email">

				

				<input type="password" name="password" maxlength="#maxlength" size="50" id="password-field" class="register-form-field" placeholder="Password">

				<input type="password" name="conf-password" maxlength="#maxlength" size="50" id="password-field" class="register-form-field" placeholder="Confirm Password">

				<input type="text" name="phone" maxlength="#maxlength" size="50" id="phone" class="register-form-field" placeholder="Phone">

			</div>

			<button type="submit" id="submit-button">
				{{('Submit')}}
			</button>


		</div>
	</div>
</body>
</html>