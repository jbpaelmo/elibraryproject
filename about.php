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
<body style="background-color: #fff;">
<div class="container-fluid card">
	<div class="card-body">
		<pre style="width: 100%; font-size: 18.7px; text-align: justify; margin-top: 30px; line-height: 20px; padding-top: 20px; font-family: 'Poppins', sans-serif; font-weight: bold;">
			<p >
				<h1 style="font-weight: bold; margin-left: 40px;">VISION</h1>

				CNSC as a Premier Higher Education Institution in the Bicol Region.
				
				<h1 style="font-weight: bold; margin-left: 40px;">MISSION</h1>

				The Camarines Norte State College shall provide higher and advance studies in the field of 
				education, arts and science, economics, health, engineering, management, finace, 
				accounting, business and public administration, fisheries, agriculture, natural resources 
				development and management and ladderized courses. It shall also respond to research, 
				extension and production services adherent to progressive leadership towards sustainable 
				development. 



				You can contact us in the CNSC gmail account

				<h3 style="font-weight: bold; margin-left: 40px;">EMAIL: cnsclibrary25@gmail.com</h3>
				
			</p>
		</pre>	
	</div>
</div>
</body>

<?php
	include 'footer.php';

?>