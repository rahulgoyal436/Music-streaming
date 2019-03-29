<?php 
	include("function.php");
	include("views/header.php");
	if(isset($_GET['page'])=="playlist") {
    	if(isset($_SESSION['id'])>0) {
   			playlistimage();
          	removeduplicate();
        }
    }
	if((isset($_GET['page'])=="removeplaylist")&&(isset($_GET['playlistid']))) {
    	if(isset($_SESSION['id'])>0) {
        	removeplaylist();
        }
    }
	if((isset($_GET['page'])=="removeplaylistsong")&&(isset($_GET['removeplaylistsongid']))) {
    	if(isset($_SESSION['id'])>0) {
        	removeplaylistsong();
        }
    }
	include("views/footer.php");
?>