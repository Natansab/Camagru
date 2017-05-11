<?php
session_start();


require_once "./config/database.php";

// echo "<br />login dans comment = " . $_SESSION['loggued_on_user'];

$login = $_SESSION['loggued_on_user'];
$img_name = $_POST['img_name'];
$comment_text = $_POST['comment_text'];

// var_dump($_POST);

// Connect to database
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

// Like the photo in the Likes table
$sql = "INSERT INTO Comments (img_name, user_login, comment_text) VALUES (:img_name, :user_login, :comment_text);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name, ':comment_text' => $comment_text));

// Debugging
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $sth->errorInfo();
// print_r($arr);

// Check if there was some comments before

header('Location: ./index.php');
?>
