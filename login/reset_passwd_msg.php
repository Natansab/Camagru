<?php
function reset_passwd_msg($email, $key) {
$message = "
Welcome " . $login . "
\r\nYou'll see, camagru is awesome\r\n
Click here to reset your password:\r\n
http://localhost:8080/Camagru/login/reset_passwd_page.php?email=$email&key=$key";
$message = wordwrap($message, 70, "\r\n");
mail($email, 'Reset your password', $message);
}
?>
