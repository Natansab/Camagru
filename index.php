<?php
session_start();
// echo $_SESSION["img_uploaded"];
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
		<?php if(isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "")
		{
			// echo "login dans main = " . $_SESSION['loggued_on_user'];
		?>
			<div id='main'>
				<h3>Main Section</h3>
				<div id='wrapper_webcam'>
					<div class="camera">
						<form action="./index.php" method="post" id="form1">
							<span id="made_selection">
							<label for="1">MARINE
							<input type="radio" name="prez" value="lepen" id="1" required></label><br>
							<label for="2">MELENCHON
							<input type="radio" name="prez" value="melenchon" id="2" required></label><br>
							<label for="3">MACRON
							<input type="radio" name="prez" value="macron" id="3" required></label><br>
						</span>
							<input type="submit" form="form1" value="Submit" name="startbutton" id="startbutton" disabled="disabled">
						</form>
						<video id="video" width="320px" height="240px">Video stream not available.</video>
						<br/>
					</div>
					<form method="post" enctype="multipart/form-data" id="form2" action="#">
					    Select image to upload:
					    <input type="file" name="fileToUpload" id="fileToUpload">
					    <input type="submit" value="Upload Image" id="file2Upload" name="submit">
					</form>
					<canvas id="canvas">
					</canvas>
				</div>
			</div>
			<div id='side'>
				<h3>Side Section</h3>
				<div id="img_carousel">
					<?php include ("./side_section.php") ?>
				</div>
			</div>
			<?php }
			else {?>
				<div id='main'>
					<h3>Main Section</h3>
					<h4>Log in fucker</h4>
					<?php }?>
				</div>
			</body>
			</html>
