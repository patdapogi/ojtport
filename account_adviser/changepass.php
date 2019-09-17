<?php
	
	include('../class/adviser.php');
    // Start session.
    session_start();
	$id=$_GET['id'];
    
	$username 		=$_POST['username'];
	$oldpassword 	=$_POST['oldpassword'];
	$newpassword 	=$_POST['newpassword'];

	
	// checking empty fields
	if(empty($oldpassword) || empty($newpassword)) {
		echo "Error. check fields";
	}else{

		if($adviser->PasswordMatch($id,$oldpassword)){

			if($adviser->PasswordChange($id,$newpassword)){

				header('location:./adviser_info.php');

			}else{

				echo "Error";

			}

		}else{
			echo "Password does not match";
		}
	}
	
	// mysqli_query($conn,"update list_announcement set title='$title', details='$details', event_date='$event_date', user='$user' where id='$id'");
	// header('location:./announcement.php');

?>