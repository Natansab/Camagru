<?php
session_start();
$login = $_SESSION['loggued_on_user'];
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../index.css"/>
	</head>
	<body>
		<div id='wrapper'>
				<?php include('../menu.php') ?>
				<h2>Log In</h2>
		<form action ="login_pdo.php" method="POST">
			<label for="login">Login: </label><input type="text" name="login" id="login" value =""/>
			<br />
			<label for="passwd">Password: </lavel><input type="password" name="passwd" id="passwd" value=""/>
			<br />
			<input type="submit" name="submit" value="OK"/>
		</form>
		<br  />
		<br  />
		<a href="./create_pdo.html">Sign up</a><br />
		<a href="./reset_passwd_request.html">Forgot your password?</a><br />
	</div>
	</body>
</html>
