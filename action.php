<?php
	include("function.php");
	if($_GET['action']=="loginsignup") {
      	$error="";
      	if(!$_POST['email']) {
        	$error="An email adddress is required.";
        }
      	else if(!$_POST['password']) {
        	$error.="A password is required.";
        }
      	else if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)==false) {
       		$error.="Please enter a valid email address.";
        }
      	if($error!=="") {
        	echo $error;
          	exit();
        }
    	if($_POST['loginactive']=="0") {
        	$query="select * from users where email='".mysqli_real_escape_string($link,$_POST['email'])."' limit 1";
          	$result=mysqli_query($link,$query);
          	if(mysqli_num_rows($result)>0) {
            	$error="That email is alredy taken.";
            }
          	else {
            	$query="insert into users(`email`,`password`) values('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
              	if(mysqli_query($link,$query)) {
                  	$_SESSION['id']=mysqli_insert_id($link);
                	$query="update users set password='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' where id=".mysqli_insert_id($link)." limit 1";
                	mysqli_query($link,$query);
                  	echo 1;
                }
              	else {
                	$error="Couldn't signup please try again later.";
                }
            }
          	if($error!=="") {
            		echo $error;
            }
        }
      	else {
        	$query="select * from users where email='".mysqli_real_escape_string($link,$_POST['email'])."' limit 1";
          	$result=mysqli_query($link,$query);
          	$row=mysqli_fetch_array($result);
          	if($row['password']==md5(md5($row['id']).$_POST['password'])){
            	echo 1;
              	$_SESSION['id']=$row['id'];
            }
          	else {
            	$error="Couldn't find that username and password combination please try again later.";
            }
          	if($error!=="") {
            	echo $error;
            }
        }
    }
?>