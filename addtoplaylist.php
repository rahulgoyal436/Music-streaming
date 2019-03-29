<?php 
	include("function.php");
	if(isset($_GET['page'])=="addtoplaylist") {
    	if(isset($_SESSION['id'])>0) {
          	$error="";
        	if(!$_POST['playlistname']) {
            	$error="Please enter a playlist name.";
            }
          	if($error!=="")  {
            	echo $error;
            	exit();
            }
          	if(!empty($_GET['songid'])) {
          		$query="select * from playlists where name='".mysqli_real_escape_string($link,$_POST['playlistname'])."' and userid='".$_SESSION['id']."'";
            	$result=mysqli_query($link,$query);
          		$row=mysqli_fetch_array($result);
          		if(mysqli_num_rows($result)>0) {
              		$query="select * from playlistsongs where playlistid='".$row['id']."' and songid='".$_GET['songid']."'";
              		$result=mysqli_query($link,$query);
              		if(mysqli_num_rows($result)>0) {
                		echo "That song is already present in the playlist.";
                	}
              		else {
                		$query="select * from playlists where name='".mysqli_real_escape_string($link,$_POST['playlistname'])."' and userid='".$_SESSION['id']."'";
            			$result=mysqli_query($link,$query);
              			$row=mysqli_fetch_array($result);
            			$query="insert into playlistsongs(`playlistid`,`songid`) values('".$row['id']."','".$_GET['songid']."')";
              			mysqli_query($link,$query);
              			echo 1;
                	}  
            	}
          		else {
          			$query="insert into playlists(`userid`,`name`) values('".$_SESSION['id']."','".mysqli_real_escape_string($link,$_POST['playlistname'])."')";
          			mysqli_query($link,$query);
              		$query="insert into playlistsongs(`playlistid`,`songid`) values('".mysqli_insert_id($link)."','".$_GET['songid']."')";
              		mysqli_query($link,$query);
            		echo 1;
            	}
        	}
          	if(!empty($_GET['albumid'])) {
          		$query1="select * from playlists where name='".mysqli_real_escape_string($link,$_POST['playlistname'])."' and userid='".$_SESSION['id']."'";
            	$result1=mysqli_query($link,$query1);
          		$row1=mysqli_fetch_array($result1);
          		if(mysqli_num_rows($result1)>0) {
                	$query2="select * from songs where albumid='".$_GET['albumid']."'";
                  	$result2=mysqli_query($link,$query2);
                  	if(mysqli_num_rows($result2)==0) {
                    	echo "There is no song in the album";
                    }
                  	else {
                    	while($row2=mysqli_fetch_array($result2)) {
                        	$query3="insert into playlistsongs(`playlistid`,`songid`) values('".$row1['id']."','".$row2['id']."')";
                          	mysqli_query($link,$query3);
                        }
                      	echo 1;
                    }
                }
              	else {
          			$query4="insert into playlists(`userid`,`name`) values('".$_SESSION['id']."','".mysqli_real_escape_string($link,$_POST['playlistname'])."')";
          			mysqli_query($link,$query4);
          			$query5="select * from playlists where name='".mysqli_real_escape_string($link,$_POST['playlistname'])."' and userid='".$_SESSION['id']."'";
            		$result5=mysqli_query($link,$query5);
          			$row5=mysqli_fetch_array($result5);
                	$query6="select * from songs where albumid='".$_GET['albumid']."'";
                  	$result6=mysqli_query($link,$query6);
                  	if(mysqli_num_rows($result6)==0) {
                    	echo "There is no song in the album";
                    }
                  	else {
                    	while($row6=mysqli_fetch_array($result6)) {
                        	$query7="insert into playlistsongs(`playlistid`,`songid`) values('".$row5['id']."','".$row6['id']."')";
                          	mysqli_query($link,$query7);
                        }
                      	echo 1;
                    }
                }
            }
        }
    }
?>