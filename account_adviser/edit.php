<?php
	
	include('../class/adviser.php');
    // Start session.
    session_start();
	$id=$_GET['id'];
    
	$fname 		=$_POST['fname'];
	$lname 		=$_POST['lname'];
	$dept 		=$_POST['dept'];
	$subj 		=$_POST['subj'];

	
	// checking empty fields
	if(empty($fname) || empty($lname) || empty($dept) || empty($subj)) {
		echo "Error. check fields";
	}else{
		$adviser->UpdateAdviser($id,$fname,$lname,$dept,$subj);
		header('location:./adviser_info.php');
	}
	
	// mysqli_query($conn,"update list_announcement set title='$title', details='$details', event_date='$event_date', user='$user' where id='$id'");
	// header('location:./announcement.php');

?>