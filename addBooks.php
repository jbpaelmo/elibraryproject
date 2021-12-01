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
include_once 'include/sidebar.php';
?>

<body style="background: #fff;">
  <div class="container-fluid addBody" id="addBooks">
    		<legend>Add Books:</legend>
        		<form action="" method="POST" enctype="multipart/form-data">
         			 <div class="form-group">
         			 	<label for="bookCatalog">Catalog Number:</label>
            			<input type="text" class="form-control" name="bookCatalog" placeholder="Catalog Number" required>
         			 </div>
               <div class="form-group">
                <label for="bookCall">Call Number:</label>
                  <input type="text" class="form-control" name="bookCall" placeholder="Call Number" required>
               </div>
               <div class="form-group">
                <label for="num_cop">Number of copies:</label>
                  <select name="num_cop">
                      <option disabled selected>-- Select --</option>
                       <option value=1>1</option>
                       <option value=2>2</option>
                       <option value=3>3</option>
                       <option value=4>4</option>
                       <option value=5>5</option>
                     </select>
               </div>
         			 <div class="form-group"> 
         				<label for="bookTitle">Book Title:</label> 
           				<input type="text" class="form-control" name="bookTitle" placeholder="Book Title" required>
          			</div>
          			 <div class="form-group">  
          			 	<label for="bookChapter">Chapter: </label>
           				   <select name="bookChapter">
                      <option disabled selected>-- Select --</option>
                       <option value="chapter1">Chapter 1</option>
                       <option value="chapter2">Chapter 2</option>
                       <option value="chapter3">Chapter 3</option>
                       <option value="chapter4">Chapter 4</option>
                       <option value="chapter5">Chapter 5</option>
                     </select>
          			</div>
                <div class="form-group">  
                  <label for="bookAuthor">Book Author:</label>
                  <input type="text" class="form-control" name="bookAuthor" placeholder="Book Author" required>
                </div>
          			 <div class="form-group"> 
          			 	<label for="bookYear">Published Year:</label> 
           				<input type="text" class="form-control" name="bookYear" placeholder="Book Year" required>
          			</div>
          			 <div class="form-group"> 
          			 	<label for="bookCourse">Course:</label> 
           				<input type="text" class="form-control" name="bookCourse" placeholder="Book Course" required>
          			</div>
                <div class="form-group"> 
                  <label for="image">Cover Upload</label> 
                  <input type="file" class="form-control" name="image" required>
                </div>
                <div class="form-group"> 
                  <label for="file">Upload Contents</label> 
                  <input type='file' id='file' class="form-control" required name='file[]' multiple>
                </div>
          			<div class="form-group">
            			<input type="submit" name="btn_submit" value="Add Books" class="btn btn-danger form-control">
          			</div>
        		</form>
    </div>
</body>
	<?php
  if(isset($_POST['btn_submit'])){
  //pre_r($_FILES);
  
    $phpFileUploadErrors = array(
      0 => 'There is no error, the file uploaded with success',
      1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      3 => 'The uploaded file was only partially uploaded',
      4 => 'No file was uploaded',
      6 => 'Missing a temporary folder',
      7 => 'Failed to write file to disk',
      8 => 'A PHP extension stopped the file upload.',

    );
    

    $ext_error = false;
    
    $count = count($_FILES['file']['name']);
    $code = $_POST['bookCatalog'];
    $call = $_POST['bookCall'];
    $select = $_POST['num_cop'];
    $title = $_POST['bookTitle'];
    $chap = $_POST['bookChapter'];
    $author = $_POST['bookAuthor'];
    $year = $_POST['bookYear'];
    $course = $_POST['bookCourse'];
    $book_cover = $_FILES['image']['name'];
    
    for($i=0;$i<$count;$i++){

    $extensions = array('pdf','jpg','jpeg','png','gif');
    $file_ext = explode('.',$_FILES['file']['name'][$i]);
    $file_ext = end($file_ext);

      if (!in_array($file_ext, $extensions)) {
    # code...
      $ext_error = true;
      }
      if($_FILES['file']['error'] && $_FILES['image']['name']){
        echo '<script>alert('.$phpFileUploadErrors[$_FILES['file']['error'][$i]].')</script>';
      }else if($ext_error){
        echo "Invalid File Extension";
      }else{
        echo "Success";
      }

      $countFile = $_FILES['file']['name'][$i];

      $sql1 = "INSERT INTO `chapter_tbl`(book_code, book_chapter)VALUES('$code','$countFile')";

      if($con->query($sql1)===TRUE){

        echo '<script>alert("File Successfully Saved")</script>';
      }else{
        echo '<script>alert("File Not Saved")</script>';

      }
      move_uploaded_file($_FILES['file']['tmp_name'][$i], 'images/'.$countFile);

     
    }

      $sql = "INSERT INTO `book_tbl`(book_catalog,book_callnum,book_copies,book_title,book_author,book_year,book_course,book_cover)
      VALUES('$code','$call','$select','$title','$author','$year','$course','$book_cover')";

      if($con->query($sql)===TRUE){

        echo '<script>alert("File Successfully Saved")</script>';
      }else{
        echo '<script>alert("File Not Saved")</script>';

      }
     move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);

     $query = "INSERT INTO `parts_tbl`(book_catalog, book_chapter)VALUES('$code', '$chap')";

     if($con->query($query)===TRUE){
        echo '<script>alert("File Successfully Saved");</script>';
     }else{
        echo '<script>alert("File Not Saved")</script>';

      }
  }
    


  /*function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }*/
?>