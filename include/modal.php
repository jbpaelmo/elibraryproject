<div id="edit_form" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!--Modal Content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title">Update: </h1>
            </div>
            <div class="modal-body">
                <form method="POST" action="updatebooks.php">
                    <div class="form-group">
                        <label>Book Code:</label>
                        <input type="text" class="form-control" name="book_code" id="book_code" placeholder="Enter Book Code" required>
                    </div>
                    <div class="form-group">
                        <label>Book Title:</label>
                        <input type="text" class="form-control" name="book_title" id="book_title" placeholder="Enter Book Title" required>
                    </div>
                    <div class="form-group"> 
                        <label>Book Author:</label>
                        <input type="text" class="form-control" name="book_auth" id="book_auth" placeholder="Enter Book Author" required>
                    </div>
                    <div class="form-group">    
                        <label>Book Year:</label>
                        <input type="text" class="form-control" name="book_year" id="book_year" placeholder="Enter Book Year" required>
                    </div>
                    <div class="form-group">    
                        <label>Book Course:</label>
                        <input type="text" class="form-control" name="book_course" id="book_course" placeholder="Enter Book Course" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="value_books" value=<?php echo $_POST['value_books']; ?>>
                    </div>
                    <input type="submit" class="btn btn-primary form-control" name="update_btn" value="Update">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal" width="20%;">Close</button>
            </div>
        </div>
    </div>
</div>

