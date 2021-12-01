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
<div class="container-fluid" id="showBooks" style="">	
	<div class="" id="data-live" style="border-color: #FFD700; border-radius: 25px;">
        <fieldset>
            <form method="POST" action="">
            <legend>Books Available</legend>
                    <table id="avail_books" class="table table-striped table-responsive table-bordered table-dark" width="">
                        <thead class="thead-dark">
                            <tr>
                               <th><center>Book Title</center></th>
                               <th><center>Book Author</center></th>
                               <th><center>Book Year</center></th>
                               <th><center>Number of Copies</center></th>
                               <th width="20%"><center>Action</center></th>
                            </tr>
                        </thead>
                            <?php
                                $sql = "SELECT * FROM book_tbl";
                                $stmt = mysqli_stmt_init($con);
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <tr>
                                        <td style="width:100px;">'.$row['book_title'].'</td>
                                        <td style="width:80px;">'.$row['book_author'].'</td>
                                        <td style="width:50px;">'.$row['book_year'].'</td>
                                        <td style="width:50px;">'.$row['book_copies'].'</td>
                                        <td style="width:290px;">
                                            <div class="row">
                                                <div class="col col-md-6">
                                                    <form method="POST" action="showBooks.php">
                                                        <button type="submit" name="books_val" value="'.$row['book_id'].'" class="btn btn-primary edit_btn" style="width:120px;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View</button>
                                                    </form>
                                                </div>
                                                <div class="col col-md-6">
                                                    <form method="POST" action="booksBorrow.php">
                                                    <button type="submit" name="val_books" value="'.$row['book_id'].'" class="btn btn-danger edit_btn" style="width:120px;"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Borrow</button>
                                                    </form>
                                                </div>   
                                            </div>
                                        </td>
                                    </tr>                                        
                                   	';
                                     
                                }
                            ?>
                     <script>  
                        $(document).ready(function(){  
                            $('#avail_books').DataTable();  
                        });
                    </script>
                </table>
                </form>    
            </fieldset>
        </div>
</div>
</body>
</html>