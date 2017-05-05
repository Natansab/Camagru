<?php

require_once('./database.php');

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

// Create dbbase if note exist
$sql = "CREATE DATABASE IF NOT EXISTS camagru_db";
$dbh->exec( $sql );

// Create User Table
$sql = "CREATE TABLE IF NOT EXISTS Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(250) NOT NULL,
password VARCHAR(250) NOT NULL
)";
$dbh->exec( $sql );

// Create First fake user
$sql = "INSERT INTO USERS (login, password) VALUES ('login3', 'password3')";
$dbh->exec( $sql );

// to end connection
$dbh = null;

?>
