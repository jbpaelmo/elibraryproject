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
	$user_sess = $_SESSION['user_sess']; 
	include_once 'include/sidebar.php';

if(!empty($_POST['val_books'])){
	$_SESSION['val_books'] = $_POST['val_books'];
}
?>
<body style="background-color: #fff">
	<div class="container-fluid card" id="showBooks">
		<div class="card-body">
		<form method="POST" action="">
			<?php
				
				$sql = "SELECT * FROM book_tbl WHERE book_id = '".$_SESSION['val_books']."'";
				$stmt = mysqli_stmt_init($con);
    			mysqli_stmt_prepare($stmt, $sql);
    			mysqli_stmt_execute($stmt);
    			$result = mysqli_stmt_get_result($stmt);

    			while ($row = mysqli_fetch_assoc($result)) {


			?>
			<legend>Borrowing Form</legend>
			<div class="form-group">
				<input class="form-control" type="text" name="book_id" value="<?php echo $_SESSION['books_val'] ?>">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="book_name" value="<?php echo $row['book_title'] ?>">
			</div>
			<?php
			}

    				$sqli = "SELECT * FROM account_tbl WHERE id_num = '".$_SESSION['user_sess']."'";
    				$st = mysqli_stmt_init($con);
    				mysqli_stmt_prepare($st, $sqli);
    				mysqli_stmt_execute($st);
    				$results = mysqli_stmt_get_result($st);

    				while($rows = mysqli_fetch_assoc($results)){
			
		echo' <div class="form-group">
				<input class="form-control" type="text" name="uname" value= "'.$rows['f_name']." ".$rows["l_name"].'">
			</div>';
		}
		echo'<div class="form-group">
				<input class="form-control" type="date" name="book_date">
			</div>
			<div class="form-group">
				<input class="form-control" type="date" name="book_return">
			</div>
			<div class="form-group">
				<input type="submit" name="btn_borrow" value="Borrow" class="btn btn-danger btn-block">
			</div>';

		
			
			if(isset($_POST['btn_borrow'])){
				//echo '<script>alert("Something Went dasd")</script>';
				
				$br_number = $_SESSION['user_sess'];
				$book_id = $_POST['book_id'];
				$name = $_POST['uname'];
				$item = $_POST['book_name'];
				$br_date = $_POST['book_date'];
				$rt_date = $_POST['book_return'];
				//echo $br_number . "-" . $book_id . "-" . $name . "-" . $item . "-" . $br_date . "-" . $rt_date;
				//	die();//

				#This code is to deduct 1 copy per borrow of student/teacher
				$qwe = "SELECT book_copies FROM book_tbl WHERE `book_id`='".$_SESSION['books_val']."'";
				$result = mysqli_query($con, $qwe);
				while ($row = mysqli_fetch_assoc($result)) {
					# code...
					$copies = $row['book_copies'];
					$new_count = $copies - 1;
					if($new_count >= 0){					
						$count = "UPDATE book_tbl SET book_copies = $new_count WHERE `book_id`='".$_SESSION['books_val']."'";
						if(mysqli_query($con, $count)){
							echo '<script>alert("Thank you")</script>';
						}else{
							echo '<script>alert("Error")</script>';
						}
					}else{
						echo '<script>alert("Book Unavailable")</script>';
				}
			}
			#end of book count
			#<------------------------------------------------------------------------------------>
			#For inserting the details to the database
				$save = "INSERT INTO borrow_tbl(borrow_id, borrow_number,book_id, borrow_name, borrow_item, borrow_date, return_date, book_status)
					VALUES(DEFAULT, '$br_number', '$book_id' , '$name', '$item', '$br_date', '$rt_date','Borrowed')";
				

				if(mysqli_query($con,$save)){					
					echo '<script>alert("Success");</script>';
					echo '<script>location.href="home.php"</script>';
				}else{
					echo '<script>alert("Something Went Wrong");</script>';
				
				}
			}
		
			?>
		</form>
		</div>
	</div>

</body>
<?php
	include 'footer.php';
?>