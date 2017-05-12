<?php
require_once "./config/database.php";

// Login information
session_start();

var_dump($_POST);
// var_dump($_POST["img_path"]);
var_dump($_FILES);
// If fileexists, adds _+1 to the namefile
if ($_FILES["fileToUpload"]["name"] === "") {
  header('Location: ./index.php');
}

$i = 1;
$img_full_name = pathinfo($_FILES["fileToUpload"]["name"]);
while(file_exists($_FILES["fileToUpload"]["name"])) {
  $filename = $img_full_name["filename"];
  $_FILES["fileToUpload"]["name"] = $img_full_name["filename"]. "_" . $i . "." . $img_full_name["extension"];
  $i++;
}

$target_dir = "./";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    var_dump($_POST["img_path"]);
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  return ;
}
else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $_SESSION["img_uploaded"] = $target_file;
          header('Location: ./index.php');
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
}

$login = $_SESSION['loggued_on_user'];

// Chose image name
$img_name = $login . "_" . substr(hash("whirlpool", rand(0, 10000)), 1, 5);
// var_dump ($img_name);

// Create artwork
// $rawData = json_decode($_POST['imgBase64'])->image;
// $filteredData = str_replace('data:image/png;base64,', '', $rawData);
// $filteredData = str_replace(' ', '+', $filteredData);
// $unencoded = base64_decode($filteredData);

$prez_name = $_POST['prez'];

//Create the image
file_put_contents('./src/img/usr/' . $img_name . '.png', $filename);

$im1 = imagecreatefrompng("./src/img/usr/$img_name.png");
// imageflip($im1, IMG_FLIP_HORIZONTAL);
$im2 = imagecreatefrompng("./src/img/vote_" . $prez_name . ".png");
imagecopy($im1, $im2, 0, 0, 0, 0, 320, 240);
imagepng($im1, "./src/img/usr/$img_name.png");
imagedestroy($im1);
imagedestroy($im2);

// Adding the photo path in the photos table
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql = "INSERT INTO Photos (user_login, img_name) VALUES (:user_login, :photo_path);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':photo_path' => $img_name));
?>
