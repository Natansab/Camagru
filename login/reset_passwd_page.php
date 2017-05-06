<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../index.css"/>
	</head>
	<body>
		<div id='wrapper'>
		<h1>Reset Password</h1>
		<form action ="reset_passwd.php" method="POST">
			<label for="password">New Password: </lavel><input type="password" name="password" id="password" value=""/><br />
			<input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']) ?>"/><br />
			<input type="hidden" name="key" value="<?php echo htmlspecialchars($_GET['key']) ?>"/><br />
			<input type="submit" name="submit" value="Reset Password"/>
		</form>
		<br />
		<a href="./login_index_pdo.php">Back to home</a>
	</div>
</body>
</html>
