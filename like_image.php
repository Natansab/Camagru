<?php

require_once "./config/database.php";

// Login information
session_start();
if (!isset($_SESSION['loggued_on_user']))
  return ;

// This file will update the like for each image given in the $_POST
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
$sql = "DELETE FROM `Likes`
        WHERE `img_name` = :img_name
        AND `user_login` = :user_login;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name));
}
else {
// Like the photo in the Likes table
$sql = "INSERT INTO Likes (img_name, user_login) VALUES (:img_name, :user_login);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name));
}

// Getting nb of likes for this image
$sql = "SELECT COUNT(Likes.img_name) AS 'nb_of_likes' FROM Likes
        WHERE `img_name` = :img_name";
$sth = $dbh->prepare($sql);
$sth->execute(array(':img_name' => $img_name));
$f = $sth->fetch();
$nb_of_likes = $f['nb_of_likes'];

// Echo number of like after like or unlike
echo "Like ($nb_of_likes)";

$dbh = null;
?>
