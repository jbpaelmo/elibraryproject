<?php 
	include_once 'connection.php';
	include_once 'links.php';

	if(isset($_POST['login_btn'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$login = mysqli_query($con, "SELECT * FROM `account_tbl` WHERE `id_num`='$username' AND `password`= '$password'")
		or die("Failed to execute query");

		$row = mysqli_fetch_array($login);

		if($row['id_num']==$username && $row['password']==$password){
			echo'<script>alert("Login Successful")</script>';
			
			$_SESSION['user_sess'] = $username;
			$_SESSION['user_type'] = $row['acc_type'];

			if($row['acc_type']=="admin"){
				header("location: admin.php");
			}else if($row['acc_type']=="user"){
				echo "<script type='text/javascript'>location.href = 'home.php';</script>";

			}

		}else{
			echo '<script>alert("Incorrect Username or Password")</script>';
		}
	}





 ?>
