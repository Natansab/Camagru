<?php
session_start();
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
		<?php if(isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "")
		{
			// echo "login dans main = " . $_SESSION['loggued_on_user'];
		?>
			<div id='main'>
				<h3>Main Section</h3>
						<form action="./index.php" method="post" id="form1">
							<span id="made_selection">
								<label for="1"><img src="./src/filter/pp_lepen.png" width="70px"/>
								<input type="radio" name="prez" value="lepen" id="1"></label>
								<label for="2"><img src="./src/filter/pp_melenchon.png" width="70px"/>
								<input type="radio" name="prez" value="melenchon" id="2"></label>
								<label for="3"><img src="./src/filter/pp_macron.png" width="70px"/>
								<input type="radio" name="prez" value="macron" id="3"></label>
								<label for="4"><img src="./src/filter/pp_trump.jpg" width="70px"/>
								<input type="radio" name="prez" value="trump" id="4"></label>
								<label for="5"><img src="./src/filter/pp_bernie.jpg" width="70px"/>
								<input type="radio" name="prez" value="bernie" id="5"></label>
								<label for="6"><img src="./src/filter/pp_hilary.jpg" width="70px"/>
								<input type="radio" name="prez" value="hilary" id="6"></label>
							</span>
						</form>
						<video id="video" width="600px" height="450px">Video stream not available.</video>
						<input type="submit" form="form1" value="Submit" name="startbutton" id="startbutton" disabled="disabled">
						<br/>
					<form method="post" enctype="multipart/form-data" id="form2" action="./upload.php">
					    Select image to upload:
					    <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" disabled="disabled">
					</form>
					<canvas id="canvas">
					</canvas>
			</div>
			<div id='side'>
				<h3>Side Section</h3>
				<div id="img_carousel">
					<?php include ("./side_section.php") ?>
				</div>
			</div>
		</div>
			<?php }
			else {?>
				<div id='main'>
					<h3>Main Section</h3>
					<h4>Log in please</h4>
					<?php }?>
				</div>
				<div id='footer'>
					<h4>Made with 🍻 from Fremont by nsabbah</h4>
				</div>
			</body>
			</html>
