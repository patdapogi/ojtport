<?php
	include('../class/adviser.php');
    // Start session.
    session_start();
    
	if(isset($_GET['id'])){
		$id=$_GET['id'];

		$adviser->DeleteAdviser($id);
		header('location:./adviser_info.php');
	}

	// mysqli_query($conn,"delete from account_adviser where id='$id'");
	// header('location:./adviser_info.php');

?>