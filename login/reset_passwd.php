<?php

require_once "../config/database.php";

// if ($_POST["submit"] != "Reset Password" || $_POST["email"] == "" || $_POST["email"] == "" || $_POST["passwd"] == "") {
// 	echo "ERROR\n";
// 	echo "<br  /><a href=\"./login_index.php\">Retour</a>";
// 	return ;
// }

$email = $_POST['email'];
$key = $_POST['key'];
$password = hash("whirlpool", $_POST['password']);
// echo $_POST['password'] . "<br />";
// echo $password . "<br />";
// $password = "HELLO";

// echo $email . "<br/>";
// echo $key . "<br/>";
// echo $password . "<br/>";


try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    return ;
}
$sql = "SELECT COUNT(*) FROM USERS WHERE confirmation_key = :key AND email = :email;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':key' => $key, ':email' => $email));

if (!strcmp($sth->fetchColumn(),'0'))
		{
			echo "Error\n";
		}

else {
	echo "Congrats, password changed successfully!";
	echo "<br/>";
	echo '<a href="./login_index_pdo.php">Back to home</a>';

	$sql = "UPDATE Users SET password = :password
          WHERE email = :email;";
	$sth = $dbh->prepare($sql);
	$sth->execute(array(':password' => $password, ':email' => $email));
}
?>
