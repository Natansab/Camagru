<?php

function auth($login, $password) {

	require_once "../config/database.php";

	$sql = 'SELECT COUNT(*) FROM Users WHERE login = :login AND password = :password;';
	$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$sth = $dbh->prepare($sql);
	$sth->execute(array(':login' => $login, ':password' => $password));

	if (!strcmp($sth->fetchColumn(),'0'))
			return (0);

	$sql = 'SELECT COUNT(*) FROM Users WHERE login = :login AND active = 1;';
	$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$sth = $dbh->prepare($sql);
	$sth->execute(array(':login' => $login));

	if (!strcmp($sth->fetchColumn(),'0'))
			return (1);

		return (2);


}
?>
