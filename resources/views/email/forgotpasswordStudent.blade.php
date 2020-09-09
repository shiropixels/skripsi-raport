<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password Email</title>
</head>
<body>

	<table>
		<tr><td>Dear {{$nama}},</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Password anda berhasil direset.<br>
		Detail informasi akunnya adalah sebagai berikut:</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Email: {{$email}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>New Password: {{$password}} </tr></td>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Terima kasih & Salam,</td></tr>
		<tr><td>Admin E-Rapor</td></tr>

	</table>

</body>
</html>