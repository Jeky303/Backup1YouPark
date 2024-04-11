<?php
include '../check_login_status.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<link rel="icon" href="../icona.png" type="image/x-icon"/>
	<link rel="stylesheet" href="../general.css">
	<link rel="stylesheet" href="style.css">
	<title>Login di YouPark</title>
</head>

<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="../sign.php" method="POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="cognome" placeholder="Cognome" required="">
					<input type="text" name="nome" placeholder="Nome" required="">
					<input type="text" name="domicilio" placeholder="Indirizzo di domicilio" required="">
					<input type="text" name="residenza" placeholder="Indirizzo di residenza" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<input type="submit" value="Sign up" class="button"/>
				</form>
			</div>

			<div class="login">
				<form action="../log.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<input type="submit" value="Login" class="button"/>
				</form>
			</div>
	</div>

</body>

</html>