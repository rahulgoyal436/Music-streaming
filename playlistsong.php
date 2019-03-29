<?php 
	include("function.php");
	include("views/header.php");
	if((isset($_GET['page'])=="playlistsong")&&(isset($_GET['playlistid']))) {
    	if(isset($_SESSION['id'])>0) {
        	playlistsong();
        }
    }
	include("views/footer.php");
?>
