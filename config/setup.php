<?php

require_once('./database.php');

$dbh = new PDO('mysql:host=localhost;dbname=camagru_db', $DB_USER, $DB_PASSWORD);
// Create dbbase if note exist
$sql = "CREATE DATABASE IF NOT EXISTS camagru_db";
$dbh->exec( $sql );
$dbh = null;

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
// Create User Table
$sql = "CREATE TABLE IF NOT EXISTS Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(250) NOT NULL,
email VARCHAR(250) NOT NULL,
password VARCHAR(250) NOT NULL,
confirmation_key CHAR(32) NOT NULL,
active BOOLEAN DEFAULT FALSE
)";
$dbh->exec( $sql );

$dbh = null;
?>
