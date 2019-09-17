<?php
	include('../conn.php');
    // Start session.
    session_start();
    
	$id=$_GET['id'];
	mysqli_query($conn,"delete from list_announcement where id='$id'");
	header('location:./announcement.php');

?>