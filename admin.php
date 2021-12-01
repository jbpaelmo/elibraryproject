<?php
	
	include 'header.php';
	session_start();
if(!isset($_SESSION["user_sess"])){
	header("location:index.php");
	exit();
}else if ($_SESSION["user_type"] != "admin"){
	header("location:index?access=denied");
	session_unset();
    session_destroy();
    session_start();
	exit();
} 
?>

<body style="background: #fff;">
	<?php
		include_once 'include/sidebar.php';
	?>
	<div><br>
    <div class="container-fluid">
        <legend>Dashboard:</legend>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col col-lg-3">
                        <div class="icon" style="background-color: #800000;">
                        <i class="fas fa-list  " style="color:white;font-size: 30px;padding: 10px;">&nbsp;&nbsp;&nbsp; 
                        </i>
                        </div>       
                    <h4 class="font">Queue for Book Borrowing</h4>
                        
                                
                    </div>
                    <div class="col col-lg-3">
                        <div class="icon" style="background-color: #800000;">
                        <i class="fas fa-tasks" style="color:white;font-size: 30px;padding: 10px;">&nbsp;&nbsp;&nbsp; 
                        </i>
                        </div>       
                            <h4 class="font">Returned Books <?php echo "0"; ?></h4>
                    
                            </div>
                    <div class="col col-lg-3">
                        <div class="icon" style="background-color: #800000;">
                        <i class="fas fa-chart-area" style="color:white;font-size: 30px;padding: 10px;">&nbsp;&nbsp;&nbsp;
                        </i>
                        </div>       
                    <h4 class="font">Total Book Borrowed <?php echo "0"; ?></h4>

                    </div>
                    <div class="col col-lg-3">
                        <div class="icon" style="background-color: #800000;">
                        <i class="far fa-calendar-check" style="color:white;font-size: 30px;padding: 10px;">
                        </i>
                        </div>    
                        <h4 class="font">Total Transaction <?php echo "0"; ?></h4>   
                                    
                                
                    </div>
                </div>
            </div>
        </div>
        <br><hr>

    <div id="data-live">
            <legend>Books Available</legend>
                    <table id="avail_books" class="table table-responsive table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                               <th><center>Catalog</center></th>
                               <th><center>Call Number</center></th>
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
                                        <td>'.$row['book_catalog'].'</td>
                                        <td>'.$row['book_callnum'].'</td>
                                        <td>'.$row['book_title'].'</td>
                                        <td>'.$row['book_author'].'</td>
                                        <td>'.$row['book_year'].'</td>
                                        <td>'.$row['book_copies'].'</td>
                                        <td>
                                            <div class="row">
                                                <div class="col col-md-6">
                                                    <form method="POST" action="updatebooks.php">
                                                    <button type="submit" data-toggle="modal" data-target="#edit_form" name="value_books" value="'.$row['book_id'].'" class="btn btn-primary edit_btn" style="width:250px;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Edit</button>
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
        </div>
        <br><hr>
    </div>
</div>

</body>
<?php 
  include_once 'footer.php';
?>
</body>
</html>