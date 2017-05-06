<?php
include "./auth_pdo.php";
session_start();
$login =  $_POST["login"];
$passorwd = hash("whirlpool", $_POST["passwd"]);

$auth_return = auth($login, $passorwd);
if ($auth_return == 0) {
	echo "Wrong Login/Password<br />";
	echo "<a href=\"./login_index_pdo.php\">Back to login</a>";
	$_SESSION["loggued_on_user"] = "";}
else if ($auth_return == 1) {
	echo "Activate account before login<br />";
	echo "<a href=\"./login_index_pdo.php\">Back to login</a>";
	$_SESSION["loggued_on_user"] = "";}
else if ($auth_return == 2) {
	$_SESSION["loggued_on_user"] = $login;
	header('Location: ../index.php');}
?>
