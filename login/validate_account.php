<?php
session_start();
require_once "../config/database.php";

$login = $_GET['login'];
$key = $_GET['key'];

$sql = 'SELECT COUNT(*) FROM Users WHERE login = :login AND confirmation_key = :key;';
try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    return ;
}
$sth = $dbh->prepare($sql);
$sth->execute(array(':login' => $login, ':key' => $key));
if (strcmp($sth->fetchColumn(),'0')) {
  $sql = 'UPDATE Users SET active = 1 WHERE login = :login;';
  $sth = $dbh->prepare($sql);
  $sth->execute(array(':login' => $login));
  $_SESSION["loggued_on_user"] = $login;
  header('Location: ../index.php');
}
else
{
  $_SESSION["loggued_on_user"] = "";
  header('Location: ../index.php');
}
?>
