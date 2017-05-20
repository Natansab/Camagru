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
		<?php include('../menu.php') ?>
		<div id='wrapper'>
				<h2>Log In</h2><br />
		<form action ="login_pdo.php" method="POST" class="middle">
			<label for="login">Login: </label><input type="text" name="login" id="login" value =""/>
			<br />
			<label for="passwd">Password: </lavel><input type="password" name="passwd" id="passwd" value=""/>
			<br />
			<input type="submit" name="submit" value="OK"/>
		</form>
		<br  />
		<br  />
		<a href="./create_pdo.php">Sign up</a><br />
		<a href="./reset_passwd_request.php">Forgot your password?</a><br />
	</div>
	</body>
</html>
