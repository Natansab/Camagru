<?php
require_once "./config/database.php";

session_start();
$login = $_SESSION['loggued_on_user'];
$prez_name = $_POST['prez'];
$_SESSION['message_error'];

if ($_FILES["fileToUpload"]["name"] === "" || $_POST['prez'] === "") {
  header('Location: ./index.php');
}

// If fileexists, adds _+1 to the namefile
$i = 1;
$img_full_name = pathinfo($_FILES["fileToUpload"]["name"]);
$filename = $img_full_name["filename"];
while(file_exists("./src/img/tmp/" . $_FILES["fileToUpload"]["name"])) {
  $filename = $img_full_name["filename"];
  $_FILES["fileToUpload"]["name"] = $img_full_name["filename"]. "_" . $i . "." . $img_full_name["extension"];
  $i++;
}

$target_dir = "./src/img/tmp/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['message_error'] = ['File is not an image.'];
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $_SESSION['message_error'] = "Sorry, your file is too large.";
    // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    $_SESSION['message_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // header('Location: ./index.php');
  echo $_SESSION['message_error'];
  return ;
}

if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $_SESSION['message_error'] = "Sorry, there was an error uploading your file.";
    return ;
}

// Convert the image uploaded to png
$tmp_png_img = $target_file;
if ($img_full_name["extension"] != "png") {
$tmp_png_img = $target_dir . $filename . ".png";
imagepng(imagecreatefromstring(file_get_contents($target_file)), $tmp_png_img);
unlink($target_file);}

// Chose image final name
$img_name = $login . "_" . substr(hash("whirlpool", rand(0, 10000)), 1, 5);

//Create the image
$im1 = imagecreatefrompng($tmp_png_img);
$im2 = imagecreatefrompng("./src/img/vote_" . $prez_name . ".png");
imagecopy($im1, $im2, 0, 0, 0, 0, 320, 240);
imagepng($im1, "./src/img/usr/$img_name.png");
imagedestroy($im1);
imagedestroy($im2);
unlink($tmp_png_img);

// Adding the photo path in the photos table
$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql = "INSERT INTO Photos (user_login, img_name) VALUES (:user_login, :photo_path);";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_login' => $login, ':photo_path' => $img_name));
?>
