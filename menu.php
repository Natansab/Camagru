<?php
session_start();
$nb_items = 0;
if (isset($_SESSION['cart']))
	$nb_items = array_sum($_SESSION['cart']);
?>
<ul>
<?php if (($login = $_SESSION["loggued_on_user"])) {
	echo '<li><a href="./login/logout_pdo.php">Log Out</a></li>';
	echo '<li class="welcome"> Hello '. $login . '😎👋</a></li>';
}
else
	echo '<li><a href="./login/login_index_pdo.php">Log In</a></li>';
?>
</ul>
