<?php
$rawData = $_POST['imgBase64'];
// $prez_name = 'melenchon';
// if (isset($_POST['prez_name']))
$prez_name = $_POST['prez'];
var_dump($_POST['prez']);
$filteredData = explode(',', $rawData);
$unencoded = base64_decode($filteredData[1]);
$img_name = 'resultat';
//Create the image
$fp = fopen('./src/img/' . $img_name . '.png', 'w');
fwrite($fp, $unencoded);
fclose($fp);

$im1 = imagecreatefrompng("./src/img/resultat.png");
imageflip($im1, IMG_FLIP_HORIZONTAL);
echo ($prez_name);
$im2 = imagecreatefrompng("./src/img/vote_" . $prez_name . ".png");
imagecopy($im1, $im2, 0, 0, 0, 0, 320, 240);
if (file_exists("./src/img/go4profilpic1.png"))
  unlink("./src/img/go4profilpic1.png");
imagepng($im1, "./src/img/go4profilpic1.png");
imagedestroy($im1);
imagedestroy($im2);
?>
