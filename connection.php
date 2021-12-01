<?php
	$con = mysqli_connect('localhost','root','','elibrary_db')or die("Connection Failed!");
	if($con->connect_error){
		die("Connection Failed: " . $con->connect_error);
	}
	
?>