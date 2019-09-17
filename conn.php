<?php
     include("db_config.php");
//MySQLi Procedural
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>