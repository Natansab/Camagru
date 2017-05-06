<?php
require_once "../config/database.php";
require_once "./reset_passwd_msg.php";

$email = $_POST['email'];

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql = "SELECT COUNT(*) FROM USERS WHERE email = :email;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':email' => $email));

if (!strcmp($sth->fetchColumn(), '0')) {
	echo "No account";}
else {

	$sql = "SELECT confirmation_key FROM USERS WHERE email = :email;";
	$sth = $dbh->prepare($sql);
	$sth->execute(array(':email' => $email));

	$confirmation_key = $sth->fetchColumn();
	reset_passwd_msg($email, $confirmation_key);
	echo "Check your mail for instructions";

}
?>
