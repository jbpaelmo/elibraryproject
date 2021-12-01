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
    $sql = "SELECT * FROM book_tbl WHERE `book_id` = '".$_POST['value_books']."'";
    $stmt = mysqli_stmt_init($con);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="container-fluid addBody" id="addBooks">
    <legend>Update Books:</legend>
    <form method="POST" action="updatebooks.php">
        <div class="form-group">
            <label>Book Code:</label>
                <input type="text" class="form-control" name="book_code" id="book_code" placeholder="Enter Book Code" required value= <?php echo $row['book_catalog']?>>
        </div>
        <div class="form-group">
            <label>Book Title:</label>
                <input type="text" class="form-control" name="book_title" id="book_title" placeholder="Enter Book Title" required value="<?php echo $row['book_title']?>">
        </div>
        <div class="form-group"> 
            <label>Book Author:</label>
            <input type="text" class="form-control" name="book_auth" id="book_auth" placeholder="Enter Book Author" required value= "<?php echo $row['book_author']?>">
        </div>
        <div class="form-group">    
            <label>Book Year:</label>
            <input type="text" class="form-control" name="book_year" id="book_year" placeholder="Enter Book Year" required value= <?php echo $row['book_year']?>>
        </div>
        <div class="form-group">    
            <label>Book Course:</label>
            <input type="text" class="form-control" name="book_course" id="book_course" placeholder="Enter Book Course" required value= "<?php echo $row['book_course']?>">
        </div>
        <div class="form-group">
            <input type="hidden" name="value_books" value=<?php echo $_POST['value_books']; ?>>
        </div>
            <input type="submit" class="btn btn-danger form-control" name="update_btn" value="Update">
    </form>
</div>
</body>

<?php
}
    if(isset($_POST['update_btn'])){
        $id=$_POST['value_books'];
        $book_code=$_POST['book_code'];
        $book_title=$_POST['book_title'];
        $book_auth=$_POST['book_auth'];
        $book_year=$_POST['book_year'];
        $book_course=$_POST['book_course'];

        $sql = "UPDATE `book_tbl` SET book_code = '$book_code', book_title = '$book_title', book_author = '$book_auth', book_year = '$book_year', book_course = '$book_course' WHERE book_id = '$id'";

        if(mysqli_query($con, $sql)){
            echo '<script>alert("UPDATE: Success");</script>';
            echo '<script>location.href="admin.php"</script>';
        }else{
            echo '<script>alert("UPDATE: Failed");</script>';
            }
        }
?>
