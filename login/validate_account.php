<?php

require_once "../config/database.php";

$login = $_GET['login'];
$key = $_GET['key'];

$sql = 'SELECT * FROM Users WHERE login = :login AND confirmation_key = :key;';
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sth = $dbh->prepare($sql);
$sth->execute(array(':login' => $login, ':key' => $key));
if ($sth->fetch(PDO::FETCH_ASSOC)) {
  echo "account set yooohoooo";
  $sql = 'UPDATE Users SET active = 1 WHERE login = :login;';
  $sth = $dbh->prepare($sql);
  $sth->execute(array(':login' => $login));
}
else
  echo "what the fuck happend?";

?>
