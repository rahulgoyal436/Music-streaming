<?php 
	include("function.php");
	include("views/header.php");
	if(isset($_GET['page'])=="album") {
    	if(isset($_SESSION['id'])>0) {
        	albumimage();
        }
    }
	include("views/footer.php");
?>
