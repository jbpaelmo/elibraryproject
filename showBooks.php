<?php
	
	include 'header.php';
	session_start();
	if(!isset($_SESSION["user_sess"])){
		header("location:index.php");
		exit();
	}else if ($_SESSION["user_type"] != "user"){
		header("location:index?access=denied");
		session_unset();
	    session_destroy();
	    session_start();
		exit();
	} 

	if(!empty($_POST['books_val'])){
		$_SESSION['books_val'] = $_POST['books_val'];

	}	
	include_once 'include/sidebar.php';
	$sql = "SELECT * FROM book_tbl LEFT JOIN chapter_tbl ON book_tbl.book_catalog = chapter_tbl.book_code WHERE `book_id` = '".$_SESSION['books_val']."' LIMIT 1";

    $stmt = mysqli_stmt_init($con);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
?>
<body style="background: #fff">
	<div class="container-fluid" id="showBooks">
		<form method="POST">
			<div class="container-fluid" id="addBooks">

				<div class="form-group">
            		<input type="hidden" name="value_books" value=<?php echo $_SESSION['books_val']; ?>>
        	
				<?php
					echo "<img src = 'images/".$row['book_cover']."'>";
					echo "<legend>".$row['book_title']."</legend>";
					}
				?>
							
				</div>
				<select name="choose">
					<option disabled selected>-- Select --</option>
					<option value="Chapter 1">Chapter 1</option>
					<option value="Chapter 2">Chapter 2</option>
					<option value="Chapter 3">Chapter 3</option>
					<option value="Chapter 4">Chapter 4</option>
					<option value="Chapter 5">Chapter 5</option>
				</select>
				<input class="btn btn-danger" type="submit" value="Read" name="view">	
			</div>
		</form>
	</div>
</body>
