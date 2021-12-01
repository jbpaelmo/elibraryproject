<?php
	include_once 'links.php';
	session_start();
	//include_once 'functions.php'
?>
<!DOCTYPE html>
<html>
<head>
	<title>CNSC E-Library</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
  	
</head>
<body>
<div class="jumbotron" style="margin-bottom: 0px; background: #800000;">
	<h1 align="center" style="color: white;" class="welcome_lbl"> Camarines Norte State College </h1>
	<h2 align="center" style="color: white;" class="welcome_lbl"> E-Library </h2>
</div>

	<div class="container-fluid form" >	
		<form class="form-container form_size" action="functions.php" method="POST">
			<img class="img-responsive img_size" src="images/cnsc_logo.png" alt="cnsc_logo">				
			<div class="form-row">
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control text_radius" style="border-radius: 25px; border: 1px solid black;" type="text" name="username"  placeholder="Enter Username" required/>
				</div>
			</div>
			<div class="form-row ">
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control "style="border-radius: 25px; border: 1px solid black;" type="password" name="password" placeholder="Enter Password" />
				</div>
			</div>
			<div class="form-row">
				<label>
					<input type="checkbox" checked autocomplete="off" name=""> Remember Me?</label>
				</label>
				

			</div>
			<div class="form-row">
				<div class="form-group">
					<input type="submit" class="btn btn-danger btn-block" style="border-radius: 25px; border: 1px solid red;" name="login_btn" value="Login">
				</div>
				<div class="form-group">
					<a type="submit" class="btn btn-warning btn-block" style="border-radius: 25px; border: 1px solid yellow;" href="home.php">Guest</a>
				</div>
			</div>
		</form>
	</div>


</body>
</html>