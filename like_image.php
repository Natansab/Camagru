<?php

require_once "./config/database.php";

// Login information
session_start();
if (!isset($_SESSION['loggued_on_user']))
  return ;
$login = $_SESSION['loggued_on_user'];

$img_name = $_POST['img_name'];

// Connect to database
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

// Check if user already liked image
$sql = "SELECT COUNT(*) FROM Likes
        WHERE `img_name` = :img_name AND `user_login` = :login";
$sth = $dbh->prepare($sql);
$sth->execute(array(':img_name' => $img_name, ':login' => $login));

$val = $sth->fetchColumn();

if (strcmp($val,'0')) {
// Unlike the photo in the Likes table
// echo "unlike";
$sql = "DELETE FROM `Likes`
        WHERE `img_name` = :img_name
        AND `user_login` = :user_login;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name));
}
else {
// Like the photo in the Likes table
// echo "like";
$sql = "INSERT INTO Likes (img_name, user_login) VALUES (:img_name, :user_login);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name));
}

// // Debugging
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $sth->errorInfo();
// print_r($arr);

$dbh = null;
?>
