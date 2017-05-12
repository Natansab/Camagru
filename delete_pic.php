<?php
session_start();

require_once "./config/database.php";

$login = $_SESSION['loggued_on_user'];
$img_name = $_POST['img_name'];

// Connect to database
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

// Like the photo in the Likes table
$sql = "UPDATE Photos
        SET display = :display
        WHERE img_name = :img_name;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':display' => 0, 'img_name' => $img_name));

// // Debugging
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $sth->errorInfo();
// print_r($arr);

header('Location: ./index.php');
?>
