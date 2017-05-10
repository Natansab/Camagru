<?php
require_once "./config/database.php";

echo "<br />login dans comment = " . $_SESSION['loggued_on_user'];

$login = $_SESSION['loggued_on_user'];

// Check if there was some comments before

// Get the comment that was sent
$comment_text = $_POST['comment_text'];

?>
<div class="comments">
  <form action="./comments.php" method="post" id="post_comment">
    <input type="text" name="comment_text" value="" required><br>
    <input type="submit" value="Comment">
  </form>
</div>
