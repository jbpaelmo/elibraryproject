<?php
	
	include 'header.php'; 
	include_once 'include/sidebar.php';

?>
<style type="text/css">
	#prev_pdf{
		width: 250px;
	}
	#borrow_book{
		width: 250px;
	}
</style>
<body>
	<div class="container-book container-fluid" id="previewBooks">
		<legend>Home</legend>
		<div class="container-fluid">
			<div class='row'>
				<?php
					$sql = "SELECT book_cover FROM book_tbl WHERE book_id<=5";
					$query = mysqli_query($con, $sql);
					while ($data = mysqli_fetch_array($query)) {
						# code...
						$cover = $data['book_cover'];

						echo '<div class="col col-lg-6">
								<img src="images/'.$cover.'" width="250px" height="250px">
								<br>
								<button class="btn btn-danger" id="prev_pdf">Preview</button>
								<button class="btn btn-warning" id="borrow_book">Borrow</button>


							</div>';
					}
				?>
			</div>			
		</div>
	</div>
</body>