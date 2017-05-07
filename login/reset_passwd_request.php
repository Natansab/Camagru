<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../index.css"/>
	</head>
	<body>
		<?php include('../menu.php') ?>
		<div id='wrapper'>
		<h1>Reset you password</h1>
		<form action ="_reset_passwd_request.php" method="POST">
			<label for="email">E-mail: </label><input type="email" name="email" id="email" value =""/><br />
			<input type="submit" name="submit" value="Reset Password"/>
		</form>
		<br />
		<a href="./login_index_pdo.php">Back to home</a>
	</div>
</body>
</html>
