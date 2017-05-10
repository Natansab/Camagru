<?php
require_once "./config/database.php";

echo "login dans comment = " . $_SESSION['loggued_on_user'];

// Login information
// session_start();
// if (!isset($_SESSION['loggued_on_user']))
//   return ;

$login = $_SESSION['loggued_on_user'];
$comment_text = $_POST['comment_text']
?>
<div class="camera">
  <form action="./comments.php" method="post" id="post_comment">
    <input type="text" name="comment_text" value="" required><br>
    <input type="submit" value="Submit">
  </form>
</div>
