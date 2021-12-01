<?php
   session_start();
   session_unset();
   session_destroy();
 	header('Location: ../Elibrary/index.php?logout=success');
 ?>