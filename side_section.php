<?php
session_start();

require_once "./config/database.php";
// echo "login dans side = " . $_SESSION['loggued_on_user'];
$images_name = null;

$login = $_SESSION['loggued_on_user'];

$page_num = 1;
if (isset($_GET['page_num']))
$page_num = $_GET['page_num'];

// Connection to database
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

// Getting all the images
$sql = "SELECT `img_name`, `user_login` FROM Photos
WHERE display = 1
ORDER BY id_photos DESC;";

foreach ($dbh->query($sql) as $row)
$images_name[] = array($row['img_name'], $row['user_login']);

// Getting like count by image
$sql = "SELECT Likes.img_name, COUNT(Likes.img_name) AS 'nb_of_likes' FROM Likes
JOIN Photos ON Photos.img_name = Likes.img_name
WHERE Photos.display = 1
GROUP BY Likes.img_name";

foreach ($dbh->query($sql) as $row)
$images_likes[$row['img_name']] = $row['nb_of_likes'];


// Getting comments by image
$sql = "SELECT * FROM Comments";

foreach ($dbh->query($sql) as $row)
$images_comments[] = array($row['img_name'], $row['comment_text'], $row['user_login']);

if (empty($images_name))
return ;

$num_of_img = count($images_name);
?>
<!-- Navitation -->
<table id="navigation">
  <tr>
    <?php
    if ($num_of_img > 3)
    for ($i = 1; $i <= ($num_of_img + 3 - $num_of_img % 3) / 3; $i++)
    echo "<td><a onclick='carousel_select_page($i)' href='#'>" . $i . "</a></td>";
    ?>
  </tr>
</table>

<!-- Section w/ all the photos -->
<ul>
  <?php
  // Loop to display each image + likes + comments
  for ($i = $page_num * 3 - 3; $i < $page_num * 3 && $i < $num_of_img; $i++) {
    // curr_img = is our img object that we are using
    $curr_img = $images_name[$i][0];?>
    <li>
      <img class="img_side" id="<?php echo $curr_img ?>" src="http://localhost:8080/Camagru/src/img/usr/<?php echo $curr_img ?>.png"/><br>
      <span class="post_by">Artwork posted by <?php echo $images_name[$i][1] ?></span>
      <?php
      if ($login === $images_name[$i][1]) { ?>
        <form action="./delete_pic.php" method="POST">
          <input type="hidden" name="img_name" value="<?php echo $curr_img ?>">
          <button id="delete_img_<?php echo $curr_img ?>" type="submit">Delete Artwork</button>
        </form>
      <?php }
      ?>
      <div id="like_image_<?php echo $curr_img ?>" onclick='like_image("<?php echo $curr_img ?>")'>Like <?php if ($images_likes[$curr_img]) {echo "($images_likes[$curr_img])";}?></div>
      <div id="comment_image_<?php echo $curr_img ?>"> Comments section:</div>
      <?php
      // Display all comments for the curr img if there are comments cast w/ (array)
      foreach ((array)$images_comments as $row) {
        if ($row[0] === $curr_img)
        echo $row[1] . " - by: " . $row[2] . "<br /> ";
      }
      ?>
      <hr />
      <div class="comments_form">
        <form action="./comments.php" method="post" id="post_comment">
          <input type="text" name="comment_text" value="" required>
          <input type="hidden" name="img_name" value="<?php echo $curr_img ?>">
          <input type="submit" value="Comment">
        </form>
      </div>
      <?php
      echo "</li><br>";
    }
    ?>
  </ul>
