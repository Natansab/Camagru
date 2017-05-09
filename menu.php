<div id="header">
	<ul>
	<li><a href="http://localhost:8080/Camagru/index.php">Home</a></li>
<?php if (($login = $_SESSION["loggued_on_user"])) {

	echo '<li><a href="http://localhost:8080/Camagru/login/logout_pdo.php">Log Out</a></li>';
	echo '<li class="welcome"> Hello '. $login . '😎👋</a></li>';
}
else
	echo '<li><a href="http://localhost:8080/Camagru/login/login_index_pdo.php">Log In</a></li>';
?>
</ul>
</div>
