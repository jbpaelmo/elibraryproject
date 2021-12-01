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
<div ><br>
    <div class="container-fluid" id="data-live">
        <fieldset>
            <legend>Books Available</legend>
                <form>
                    <table id="avail_books" class="table table-responsive table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                               <th><center>Catalog Number</center></th>
                               <th><center>Call Number</center></th>
                               <th><center>Number of Copies</center></th>
                               <th><center>Book Title</center></th>
                               <th><center>Book Author</center></th>
                               <th><center>Book Year</center></th>
                               <th><center>Book Course</center></th> 
                            </tr>
                        </thead>
                            <?php
                                $sql = "SELECT * FROM book_tbl";
                                $stmt = mysqli_stmt_init($con);
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    # code...
                                    echo '
                                    <tr>
                                        <td>'.$row['book_catalog'].'</td>
                                        <td>'.$row['book_callnum'].'</td>
                                        <td>'.$row['book_copies'].'</td>
                                        <td>'.$row['book_title'].'</td>
                                        <td>'.$row['book_author'].'</td>
                                        <td>'.$row['book_year'].'</td>
                                        <td>'.$row['book_course'].'</td>
                                       
                                    </tr>' ;
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
        <br><hr>
    </div>
</div>

</body>
<?php 
  include_once 'footer.php';
?>