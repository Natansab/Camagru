<?php

require_once "../config/database.php";
require_once "./confirmation_msg.php";

if ($_POST["submit"] != "Create Account" || $_POST["login"] == "" || $_POST["email"] == "" || $_POST["passwd"] == "") {
	echo "ERROR\n";
	echo "<br  /><a href=\"./login_index.php\">Retour</a>";
	return ;
}

$login = $_POST['login'];
$email = $_POST['email'];
$password = hash("whirlpool", $_POST['passwd']);

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql = "SELECT COUNT(*) FROM USERS WHERE login = :login OR email = :email;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':login' => $login, ':email' => $email));

if (strcmp($sth->fetchColumn(),'0'))
		{
			echo "Username or mail not available\n";
			echo "<br  /><a href=\"./login_index_pdo.php\">Retour</a>";
		}
else {
	echo "Check your mails to activate your account!";
	echo "<br/>";
	echo '<a href="./login_index_pdo.php">Back to home</a>';

	//create a random key
	$key = $login . $email . date('mY');
	$key = md5($key);

	$sql = "INSERT INTO Users (login, email, password, confirmation_key) VALUES (:login, :email, :password, :key);";
	$sth = $dbh->prepare($sql);
	$sth->execute(array(':login' => $login, ':email' => $email, ':password' => $password, ':key' => $key));
	confirmation_msg($login, $email, $key);
}
?>
