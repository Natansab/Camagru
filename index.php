<?php
session_start();
	$im1 = imagecreatefrompng("./src/img/max.png");
	imageflip($im1, IMG_FLIP_HORIZONTAL);
	$im2 = imagecreatefrompng("./src/img/vote_lepen.png");
	imagecopy($im1, $im2, 0, 0, 0, 0, 320, 240);
	if (file_exists("./src/img/go4profilpic.png"))
		unlink("./src/img/go4profilpic.png");
	imagepng($im1, "./src/img/go4profilpic.png");
	imagedestroy($im1);
	imagedestroy($im2);
	echo time();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./index.css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="./index.js" async></script>
</head>
<body>
	<?php include('./menu.php') ?>
	<div id='wrapper'>
		<div id='main'>
			<h3>Main Section</h3>
			<div id='wrapper_webcam'>
			<div class="camera">
				<form action="./index.php" method="post" id="form1">
					<label for="1"><input type="radio" name="prez" value="MARINE" 		id="1">MARINE</label><br>
					<label for="2"><input type="radio" name="prez" value="MELENCHON" id="2">MELENCHON</label><br>
					<label for="3"><input type="radio" name="prez" value="MACRON" id="3">MACRON</label><br>
					<input type="submit" form="form1" value="Submit" id="startbutton">
				</form>
				<video id="video" width="320px" height="240px">Video stream not available.</video>
				<br/>
			</div>
			<canvas id="canvas">
			</canvas>
			<div class="output">
				<img id="photo" alt="The screen capture will appear in this box.">
			</div>
			<div class="test_montage">
				<img src="./src/img/go4profilpic.png">
			</div>
		</div>
	</div>
	<div id='side'>
		<h3>Side Section</h3>
	</div>
	</div>
</body>
</html>
