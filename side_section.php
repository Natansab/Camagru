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

$num_of_img = count($images_name);
?>

<!-- Section w/ all the photos -->
<ul>
  <?php
    for ($i = $page_num * 3 - 3; $i < $page_num * 3 && $i < $num_of_img; $i++)
      echo "<li><img src='http://localhost:8080/Camagru/src/img/usr/" . $images_name[$i] . ".png'/></li><br>";
  ?>
</ul>
<table>
  <tr>
    <?php
      for ($i = 1; $i <= ($num_of_img + $num_of_img % 3) / 3; $i++)
      echo "<td><a onclick='carousel_page($i)' href='#'>" . $i . "</a></td>"
        // echo "<td><a onclick='carousel_page($i)' href='./side_section.php?page_num='" . $i . ">" . $i . "</a></td>"
      ?>
  </tr>
</table>
