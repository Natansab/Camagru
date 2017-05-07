<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../index.css"/>
	</head>
	<body>
		<?php include('../menu.php') ?>
		<div id='wrapper'>
		<h2>Create Account</h2>
		<form action ="_create_pdo.php" method="POST">
			<label for="login">Login: </label><input type="text" name="login" id="login" value =""/><br />
			<label for="email">E-mail: </label><input type="email" name="email" id="email" value =""/><br />
			<label for="passwd">Password: </lavel><input type="password" name="passwd" id="passwd" value=""/><br />
			<input type="submit" name="submit" value="Create Account"/>
		</form>
		<br />
		<a href="./login_index_pdo.php">Back to home</a>
	</div>
</body>
</html>
