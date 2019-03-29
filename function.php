<?php
	session_start();
	$link=mysqli_connect("shareddb1e.hosting.stackcp.net","musicstreaming-363740ff","rahul1234~?","musicstreaming-363740ff");
	if(mysqli_connect_error()) {
    	print_r(mysqli_connect_error());
      	exit();
    }
	if(isset($_GET['function'])=="logout") {
    	session_unset();
    }
	function playmusic() {
    	global $link;
        $query="select * from songs order by `name`";
        $result=mysqli_query($link,$query);
       	if(mysqli_num_rows($result)==0) {
        	echo '<div class="container">
            	  	<div class="alert alert-dark" role="alert" id="text">There is no music to play.</div>
                  </div>'; 
        }
        else {
        	while($row=mysqli_fetch_array($result)) {
            	echo '<div class="container">
    				  	<div class="music">
                        	<img src="'.$row['imagepath'].'"class="songimage">
                        	<div class="clear"></div>
                            <div class="songname">'.$row['name'].'
  								<button class="btn btn-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+
  								</button>
  								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    								<button class="dropdown-item" data-toggle="modal" data-target="#playlistmodal" data-id="'.$row['id'].'" id="buttonsongid">Add to playlist</button>
								</div>
                            </div>
      						<audio controls preload="none" loop>
            					<source src="'.$row['songpath'].'" type="audio/mp3">
            					please upgarde your browser!
        					</audio>
  						</div>
					  </div>';
            }
        }
    }
	function albumimage() {
    	global $link;
        $query="select * from albums order by `name`";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)==0) {
        	echo '<div class="container">
            	  	<div class="alert alert-dark" role="alert" id="text">There is no album available.</div>
                  </div>'; 
        }
        else {
        	while($row=mysqli_fetch_array($result)) {
            	echo '<div class="container">
               		 	<div class="album">
      				  		<a href="http://rahulgoyalproject14-com.stackstaging.com/albumsong.php?page=albumsong&pageid='.$row['id'].'">
                        		<img src="'.$row['imagepath'].'" class="albumimage">
                        	</a>
                        	<div class="albumname">'.$row['name'].'
  								<button class="btn btn-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+
  								</button>
  								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    								<button class="dropdown-item" data-toggle="modal" data-target="#playlistmodal" data-id="'.$row['id'].'" id="buttonalbumid">Add to playlist</button>
								</div>
                            </div>
                        </div>
					 </div>';
            }
        }
    }
	function albumsong() {
    	global $link;
        $query="select * from songs where `albumid`='".$_GET['pageid']."'";
        $result=mysqli_query($link,$query);
       	if(mysqli_num_rows($result)==0) {
        	echo '<div class="container">
            	  	<div class="alert alert-dark" role="alert" id="text">There is no music in the album.</div>
                  </div>'; 
        }
        else {
        	while($row=mysqli_fetch_array($result)) {
            	echo '<div class="container">
    				  	<div class=" music">
                        	<img src="'.$row['imagepath'].'" class="songimage">
                        	<div class="clear"></div>
                            <div class="songname">'.$row['name'].'
                            	<button class="btn btn-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+
  								</button>
  								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    								<button class="dropdown-item" data-toggle="modal" data-target="#playlistmodal" data-id="'.$row['id'].'" id="buttonsongid">Add to playlist</button>
								</div>
                            </div>
      						<audio controls preload="none" loop>
            					<source src="'.$row['songpath'].'" type="audio/mp3">
            					please upgarde your browser!
        					</audio>
  						</div>
					  </div>';
            }
        }
    }
	function playlistimage() {
    	global $link;
      	$query="select * from playlists where userid='".$_SESSION['id']."'";
      	$result=mysqli_query($link,$query);
      	if(mysqli_num_rows($result)==0) {
        	echo '<div class="container">
            	  	<div class="alert alert-dark" role="alert" id="text">There is no playlist created by you.</div>
                  </div>';        
        }
      	else {
        	while($row=mysqli_fetch_array($result)) {
            	echo '<div class="container">
               		 	<div class="album">
      				  		<a href="http://rahulgoyalproject14-com.stackstaging.com/playlistsong.php?page=playlistsong&playlistid='.$row['id'].'">
                        		<img src="http://rahulgoyalproject14-com.stackstaging.com/images/playlistimage.png" class="albumimage">
                        	</a>
                        	<div class="albumname">'.$row['name'].'
                            	<a href="http://rahulgoyalproject14-com.stackstaging.com/playlist.php?page=removeplaylist&playlistid='.$row['id'].'"><button type="button" class="btn btn-dark">-</button></a>
                            </div>
                        </div>
					 </div>';
            }
        }
    }
	function playlistsong() {
    	global $link;
      	$query="select * from songs s,playlistsongs p where p.playlistid='".$_GET['playlistid']."' and p.songid=s.id";
      	$result=mysqli_query($link,$query);
      	if(mysqli_num_rows($result)==0) {
        	echo '<div class="container">
            	  	<div class="alert alert-dark" role="alert" id="text">There is no music in the playlist.</div>
                  </div>'; 
        }
      	else {
        	while($row=mysqli_fetch_array($result)) {
            	echo '<div class="container">
    				  	<div class="music">
                        	<img src="'.$row['imagepath'].'"class="songimage">
                        	<div class="clear"></div>
                            <div class="songname">'.$row['name'].'
                            	<a href="http://rahulgoyalproject14-com.stackstaging.com/playlist.php?page=removeplaylistsong&removeplaylistsongid='.$row['id'].'"><button type="button" class="btn btn-dark">-</button></a>
                            </div>
      						<audio controls preload="none">
            					<source src="'.$row['songpath'].'" type="audio/mp3">
            					please upgarde your browser!
        					</audio>
  						</div>
					  </div>';
            }
        }
    }
	function removeplaylist() {
    	global $link;
      	$query="delete from playlists where id='".$_GET['playlistid']."'";
      	mysqli_query($link,$query);
      	echo '<script>window.location.assign("http://rahulgoyalproject14-com.stackstaging.com/playlist.php?page=playlist");</script>';
    }
	function removeplaylistsong() {
    	global $link;
      	$query="delete from playlistsongs where id='".$_GET['removeplaylistsongid']."'";
      	mysqli_query($link,$query);
    }
	function removeduplicate() {
    	global $link;
      	$query="delete p from playlistsongs p,playlistsongs q where p.id>q.id and p.playlistid=q.playlistid and p.songid=q.songid";
      	mysqli_query($link,$query);
    }
?>