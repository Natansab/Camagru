<?php
session_start();

require_once "./config/database.php";

$login = $_SESSION['loggued_on_user'];
$img_name = $_POST['img_name'];
$comment_text = $_POST['comment_text'];

// Connect to database
try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    return ;
}

// Like the photo in the Likes table
$sql = "INSERT INTO Comments (img_name, user_login, comment_text) VALUES (:img_name, :user_login, :comment_text);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':img_name' => $img_name, ':comment_text' => $comment_text));

$sql = "SELECT email FROM Users
        JOIN Photos ON Photos.user_login = Users.login
        WHERE img_name = :img_name;";
$sth = $dbh->prepare($sql);
$sth->execute(array(':img_name' => $img_name));

$email = $sth->fetchColumn();
// echo ($email);

if ($email)
  comment_msg($login, $email, $comment_text);


// Debugging
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $sth->errorInfo();
// print_r($arr);

header('Location: ./index.php');
?>

<?php
function comment_msg($login, $email, $comment_text) {
$message = "
Welcome " . $login . "
\r\nYou just had a new comment\r\n
Here is the comment: $comment_text\r\n";
$message = wordwrap($message, 70, "\r\n");
mail($email, "$login just comment your artwork!", $message);
}
 ?>
