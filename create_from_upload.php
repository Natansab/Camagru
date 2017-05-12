<?php

require_once "./config/database.php";

// Login information
session_start();
if (!isset($_SESSION['loggued_on_user']))
  return ;
$login = $_SESSION['loggued_on_user'];

// Chose image name
$img_name = $login . "_" . substr(hash("whirlpool", rand(0, 10000)), 1, 5);
// var_dump ($img_name);

// Create artwork
$rawData = json_decode($_POST['imgBase64'])->image;
$filteredData = str_replace('data:image/png;base64,', '', $rawData);
$filteredData = str_replace(' ', '+', $filteredData);
$unencoded = base64_decode($filteredData);

$prez_name = $_POST['prez'];

//Create the image
file_put_contents('./src/img/usr/' . $img_name . '.png', $unencoded);

$im1 = imagecreatefrompng("./src/img/usr/$img_name.png");
imageflip($im1, IMG_FLIP_HORIZONTAL);
$im2 = imagecreatefrompng("./src/img/vote_" . $prez_name . ".png");
imagecopy($im1, $im2, 0, 0, 0, 0, 320, 240);
imagepng($im1, "./src/img/usr/$img_name.png");
imagedestroy($im1);
imagedestroy($im2);

// Adding the photo path in the photos table
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql = "INSERT INTO Photos (user_login, img_name) VALUES (:user_login, :photo_path);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':photo_path' => $img_name));

// Debugging
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $sth->errorInfo();
// print_r($arr);

// $dbh = null;
?>
