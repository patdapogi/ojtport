<?php
	// include('../conn.php');	
	include('../class/adviser.php');
    // Start session.
    session_start();
    
	$fname 		=$_POST['fname'];
	$lname 		=$_POST['lname'];
	$dept 		=$_POST['dept'];
	$subj 		=$_POST['subj'];
	// $username 	=$_POST['username'];
	// $pass 	 	=$_POST['password'];

	// checking empty fields
	if(empty($fname) || empty($lname) || empty($dept) || empty($subj)) {
		echo "Error. check fields";
	}else{
		$password=$pass;
		//insert data to database	
		$adviser->AddAdviser($fname,$lname,$dept,$subj);
		header('location:./');
	}

	// mysqli_query($conn,"insert into account_adviser (title, details, event_date, user) values ('$title', '$details', '$event_date', '$user')");

?>