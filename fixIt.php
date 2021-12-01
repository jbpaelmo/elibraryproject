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
	include_once 'include/sidebar.php';

?>
<body style="background: #fff">
	<div class="container-fluid card shadow mb-4" id="showBooks">
		<form method="POST">
            <?php
    #This set of code is to fetch the data from the book_tbl
    //$bookId = $_POST['val_books'];
    //$sql = "SELECT * FROM book_tbl WHERE `book_id` = '".$bookId."'";
    $sql = "SELECT * FROM book_tbl WHERE `book_id` = 1";
    $stmt = mysqli_stmt_init($con);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
    
        
    #code to fetch the data in account_tbl
        $query = "SELECT f_name, l_name FROM account_tbl WHERE id_num = '18-0459'";
        $stmts = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmts, $query);
        mysqli_stmt_execute($stmts);    
        $results = mysqli_stmt_get_result($stmts);
        while ($rows = mysqli_fetch_assoc($results)){
                               
            ?>
			<legend>Borrowing Form</legend>
			<div class="container-fluid card-body">
				<div class="form-group">
            		<input type="text" name="value_books" value=<?php echo $bookId ?>>
            	</div>
            	<div class="form-group">
            		<label for="user_id">Student Number: </label>
            		<input class="form-control" type="text" name="user_id" id="user_id" disabled value=<?php echo $_SESSION['user_sess'];?>>
            	</div>
            	<div class="form-group">
            		<label for=user_name>Name: </label>
            		<input class="form-control" type="text" name="user_name" id="name_id"disabled value="<?php echo $rows['f_name']." ".$rows['l_name'];?>">
            	</div>
            	<div class="form-group">
            		<label for="book_name">Book Title:</label>
            		<input class="form-control" type="text" name="book_name" id="book_id" disabled value="<?php echo $row['book_title']?>">
            	</div>
            	<div class="form-group">
            		<label for="borrow_date">Date to be borrowed:</label>
            		<input class="form-control" name="borrow_id" type="date" id="borrow_id" name="borrow_date">
            	</div>
            	<div class="form-group">
            		<label for="return_date">Date to be returned:</label>
            		<input class="form-control" name="return_id" type="date" id="return_id" name="return_date">
            	</div>

                
                <?php
                    if(isset($_POST['borrow_btn'])){

                        
                        $name = $_POST['user_name'];
                        $studnum = $_SESSION['user_sess'];
                        $book_title = $_POST['book_name'];
                        $borrow = $_POST['borrow_id'];
                        $return = $_POST['return_id'];
                        $qwr = "INSERT INTO `borrow_tbl`(borrow_number,book_id, borrow_name, borrow_item, borrow_date, return_date) 
                        VALUES ('$studnum','$bookId','$name','$book_title','$book_title','$borrow','$return')";

                        if(mysqli_query($con,$qwr)){
                            echo '<script>alert("Reservation Success");</script>';
                            echo '<script>location.href="home.php"</script>';
                        }else{
                            echo '<script>alert("Sorry, Something Went Wrong");</script>';
                        }
                    }

                ?>
                <input type="submit" name="borrow_btn" class="btn btn-block btn-danger" value="Borrow Book">
			</div>
		</form>
	</div>
</body>

<?php
       }
        
    }  
    include 'footer.php';
?>