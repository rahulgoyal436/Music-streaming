<?php 
     include("function.php");
     include("views/header.php");
   	 if(isset($_GET['page'])=="song") {
    	if(isset($_SESSION['id'])>0) {
        	playmusic();
        }
    }
    include("views/footer.php");
?>