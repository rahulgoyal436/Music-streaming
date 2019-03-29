<?php 
	include("function.php");
	include("views/header.php");
	if((isset($_GET['page'])=="albumsong")&&(isset($_GET['pageid']))) {
    	if(isset($_SESSION['id'])>0) {
        	albumsong();
        }
    }
	include("views/footer.php");
?>