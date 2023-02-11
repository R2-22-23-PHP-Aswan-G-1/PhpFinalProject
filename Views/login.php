<?php

// Append the requested resource location to the URL   
$page = explode('/', $_SERVER['REQUEST_URI']);
$url = end($page);

if ($url == "login.php") {
	$redirect_to_register = "register.php";
	$redirect_to = "../Controllers/validateController.php";
} else {
	$redirect_to = "Controllers/validateController.php";
	$redirect_to_register = "Views/register.php";
}
if (isset($_GET['msg'])) {
	echo $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="Views/style.css">
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<div class="login-wrap" style=" margin-top:70px; ">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"> <a href="<?= $redirect_to_register?>" class="tab">Register</a>
			<div class="login-form">
				<!-- login form -->
				<form action="<?= $redirect_to ?>" method="post">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" class="label">Email</label>
							<input id="user" type="text" class="input" name="email" 
							value="<?php if (isset($_COOKIE['email'])) {echo $_COOKIE['email'];																						} ?>">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" type="password" class="input" data-type="password" name="password" 
							value="<?php if (isset($_COOKIE['password'])) {	echo $_COOKIE['password'];} ?>">
						</div>
						<div class="group">
							<input id="check" type="checkbox" class="check" name="rememberme">
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
						</div>
						<div class="group">
							<input type="hidden" name="validationType" value="login">
							<input type="submit" class="button" value="Sign In" name="submit">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>