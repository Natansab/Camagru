<?php

require_once('./database.php');

$dbh = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD);
// Create dbbase if note exist
$sql = "CREATE DATABASE IF NOT EXISTS camagru_db";
$dbh->exec( $sql );
$dbh = null;

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
// Create User Table
$sql = "CREATE TABLE IF NOT EXISTS Users (
id_users INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(250) NOT NULL,
email VARCHAR(250) NOT NULL,
password VARCHAR(250) NOT NULL,
confirmation_key CHAR(32) NOT NULL,
active BOOLEAN DEFAULT FALSE
)";
$dbh->exec( $sql );

$sql = "CREATE TABLE IF NOT EXISTS Photos (
id_photos INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_login VARCHAR(250) NOT NULL,
img_name VARCHAR(250) NOT NULL,
display INT(1) DEFAULT 1
)";
$dbh->exec( $sql );

$sql = "CREATE TABLE IF NOT EXISTS Likes (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
img_name VARCHAR(250) NOT NULL,
user_login VARCHAR(250) NOT NULL
)";
$dbh->exec( $sql );

$sql = "CREATE TABLE IF NOT EXISTS Comments (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
img_name VARCHAR(250) NOT NULL,
user_login VARCHAR(250) NOT NULL,
comment_text VARCHAR(250) NOT NULL,
date_post DATE
)";
$dbh->exec( $sql );

$dbh = null;
?>
