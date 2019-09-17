<?php
	include('../conn.php');
	
    // Start session.
    session_start();
    
	$id=$_GET['id'];
	
	$title=$_POST['title'];
	$details=$_POST['details'];
	$event_date=$_POST['event_date'];
	$user  	    = $_SESSION['auth_user'];
	
	mysqli_query($conn,"update list_announcement set title='$title', details='$details', event_date='$event_date', user='$user' where id='$id'");
	header('location:./announcement.php');

?>