<?php
session_start();
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
					<label for="1">MARINE</label>
					<input type="radio" name="prez" value="lepen" id="1" required><br>
					<label for="2">MELENCHON</label>
					<input type="radio" name="prez" value="melenchon" id="2" required><br>
					<label for="3">MACRON</label>
					<input type="radio" name="prez" value="macron" id="3" required><br>
					<input type="submit" form="form1" value="Submit" name="startbutton" id="startbutton">
				</form>
				<video id="video" width="320px" height="240px">Video stream not available.</video>
				<br/>
			</div>
			<canvas id="canvas">
			</canvas>
			<div class="output">
				<img id="photo" alt="The screen capture will appear in this box.">
			</div>
		</div>
	</div>
	<div id='side'>
		<h3>Side Section</h3>
	</div>
	</div>
</body>
</html>
