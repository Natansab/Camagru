<?php
function confirmation_msg($login, $email, $key) {
$message = "
Welcome " . $login . "
\r\nYou'll see, camagru is awesome\r\n
Click here to confirm your e-mail address:\r\n
http://localhost:8080/Camagru/login/validate_account.php?login=$login&key=$key";
$message = wordwrap($message, 70, "\r\n");
mail($email, 'Confirm your email', $message);
}
?>
