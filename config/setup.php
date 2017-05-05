<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "camagru_db";


// require_once('./ft_tools.php');

$conn = mysqli_connect($servername, $username, $password);

echo "<br  />";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
echo "<br  />";

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
echo "<br  />";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
echo "<br  />";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
echo "<br  />";

// User Table
$sql = "CREATE TABLE IF NOT EXISTS Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(250) NOT NULL,
password VARCHAR(250) NOT NULL
)";

echo "<br  />";
if (mysqli_query($conn, $sql)) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br  />";

mysqli_close($conn);
?>
