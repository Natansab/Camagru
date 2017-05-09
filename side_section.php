<?php

require_once "./config/database.php";

$images_name = null;

$page_num = 1;
if (isset($_GET['page_num']))
  $page_num = $_GET['page_num'];


// Getting all the images
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql = "SELECT * FROM Photos WHERE display = 1 ORDER BY id_photos DESC;";

// var_dump($dbh->query($sql));

foreach ($dbh->query($sql) as $row)
  $images_name[] = $row['img_name'];

if (empty($images_name))
  return ;
?>

<!-- Section w/ all the photos -->
<ul>
  <?php
  // var_dump($images_name);
    for ($i = 0; $i < 3; $i++)
      echo "<li><img src='http://localhost:8080/Camagru/src/img/usr/" . $images_name[$i] . ".png'/></li><br>";
  ?>
</ul>
