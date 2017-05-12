<?php
session_start();

require_once "./config/database.php";

$login = $_SESSION['loggued_on_user'];
$img_name = $_POST['img_name'];
$comment_text = $_POST['comment_text'];

// Connect to database
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

// Like the photo in the Likes table
$sql = "INSERT INTO Comments (img_name, user_login, comment_text) VALUES (:img_name, :user_login, :comment_text);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name, ':comment_text' => $comment_text));

// // Debugging
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $sth->errorInfo();
// print_r($arr);

header('Location: ./index.php');
?>
