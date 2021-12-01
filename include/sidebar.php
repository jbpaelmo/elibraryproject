<?php
	include_once 'connection.php';
	include_once 'links.php';

?>
<style>
#mySidenav{
	width: 250px !important;
}
.sidebar {
	left: 0px !important;
}
</style>
	<!-- <input type="checkbox" id="check"> -->
    <!-- <label for="check">
      <i class="fas fa-bars" id="btn" onclick="openNav()"></i>
      <i class="fas fa-times" id="cancel" onclick="closeNav()"></i>
    </label>	 -->
	<div class="sidebar" id="mysideNav">
		<?php
			
			$sql = "SELECT f_name, l_name FROM account_tbl WHERE `id_num`= '".$_SESSION["user_sess"] . "'";
			$stmt = mysqli_stmt_init($con);
			mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
			while($row = mysqli_fetch_assoc($result)){

				echo '<h2><b>WELCOME, <br>'.$row['f_name']. " " .$row['l_name']."</b></h2>";
			
			}
		?>			
	
		<?php
			if($_SESSION['user_type'] == "user"){
				echo '
					<ol>
					 	<li><a href="home.php"><i class="fas fa-home"></i>Home</a></li><br>
					 	<li><a href="about.php"><i class="far fa-comment"></i>About</a></li><br>
						<li><a href="library.php"><i class="fas fa-book-open"></i>Your Library</a></li><br>
	
					</ol>

				';
			}else if($_SESSION['user_type'] == "admin"){
				echo '
					<ol>
					 	<li><a href="admin.php"><i class="fas fa-qrcode"></i><span>Dashboard</span></a></li>
					 	<li><a href="addBooks.php"><i class="fas fa-book"></i>Add Books</a></li>
						<li><a href="checkBooks.php"><i class="fas fa-clock"></i>Check Books</a></li>
						<li><a href="viewBooks.php"><i class="fas fa-book-open"></i>Books</a></li>
					</ol>

				';

			}

		?>

		<ol>
			<li>
				<a href="logout.php">
				<i class="fas fa-sign-out-alt"></i>Sign Out</a>
			</li>
		</ol>

	</div>
