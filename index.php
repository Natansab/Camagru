<?php
session_start();
// header( "Content-type: image/png" );
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./index.css"/>
	<script src="./index.js" async></script>

</head>
<body>
	<?php include('./menu.php') ?>
	<div id='wrapper'>
		<h2>Hello World</h2>
		<div id='wrapper_webcam'>
			<div class="camera">
				<video id="video">Video stream not available.</video>
				<br/>
				<button id="startbutton">Take photo</button>
			</div>
			<canvas id="canvas">
			</canvas>
			<div class="output">
				<img id="photo" alt="The screen capture will appear in this box.">
			</div>
			<div class="test_montage">
				<?php
					$im1 = imagecreatefrompng("./natan.png");
					imageflip($im1, IMG_FLIP_HORIZONTAL);
					$im2 = imagecreatefrompng("./vote_macron.png");
					imagecopy($im1, $im2, 0, 0, 0, 0, 320, 240);
					imagepng($im1, "./go4profilpic.png");
					// imagedestroy($im1);
				?>
				<img src="./go4profilpic.png">
			</div>
		</div>
	</div>
</body>
</html>
