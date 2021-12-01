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
<body>
  <div class="container-fluid" id="data-live">
    <legend>Books Available</legend>
      <form>  
        <table id="borrowed_books" class="table table-responsive table-striped table-bordered" width="100%">
               
                        <thead>
                            <tr>
                               <th><center>Borrow Number</center></th>
                               <th><center>Borrower Name</center></th>
                               <th><center>Book Title</center></th>
                               <th><center>Borrowing Date</center></th>
                               <th><center>Returned Date</center></th>
                               <th width="20%"><center>Action</center></th>
                            </tr>
                        </thead>

                            <?php
                              $query = "SELECT * FROM borrow_tbl WHERE book_status = 'Borrowed'";
                                $stmt = mysqli_stmt_init($con);
                                mysqli_stmt_prepare($stmt, $query);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                              while($row = mysqli_fetch_assoc($result)){
                                echo'
                                <tr>

                                    <td>'.$row['borrow_number'].'</td>
                                    <td>'.$row['borrow_name'].'</td>
                                    <td>'.$row['borrow_item'].'</td>
                                    <td>'.$row['borrow_date'].'</td>
                                    <td>'.$row['return_date'].'</td>

                                    ';

                                    ?>
                                    <td>
                                      <div class="row">
                                        <div class="col col-md-6">  
                                          <form method="POST">
                                            <button type="submit" name="return_books" value="'.$row['book_id'].'" class="btn btn-block btn-primary " style="width: 200px;" ><span class="glyphicon glyphicon-ok"></span> Return</button>
                                          </form>
                                        </div>
                                      </div>

                              <?php 
                                echo '</tr>';  

                              }

                            if(isset($_POST['return_books'])){  
                              $q = "SELECT book_copies FROM book_tbl LEFT JOIN borrow_tbl ON book_tbl.book_code = borrow_tbl.book_code WHERE book_id = '".$_POST['return_books']."'";
                              $res = mysqli_query($con, $q);
                              while($row = mysqli_fetch_assoc($res)){  
                                $copies = $row['book_copies'];
                                $counter = $copies + 1;

                                if($counter>=0){
                                  $count = "UPDATE book_tbl SET book_copies = $counter 
                                  WHERE `book_id`='".$_POST['return_books']."'";
                                    // if(isset($_POST['return_books'])){

                                    //   $sql = "UPDATE book_tbl SET book_copies "
                                    // }
                                  if(mysqli_query($con,$count)){
                                    echo '<script>alert("Book Returned");</script>';
                                  }else{
                                    echo '<script>alert("Something Went Wrong")</script>';
                                  }
                                }
                              }
                            }
                            #create a new page to catch the value of this form. for checking of fines and other important tasks.        
                              ?>
                              
                      
                    <script>  
                        $(document).ready(function(){  
                            $('#borrowed_books').DataTable();  
                        });
                    </script>
            </table>  
        </form>                          
      </div>
</body>
<?php
  include 'footer.php';
?>