<?php
    // Include database configuration script.
    include("db_config.php");
    
    // Turn off error reporting.
    error_reporting(0);

    // Start and destroy session.
    session_start();
    session_destroy();
    
    // Stop script and show error if cannot connect to server.
    $conn = mysqli_connect($db_server, $db_username, $db_password);
    if (!$conn) die("Cannot connect to server.");
    
    // Stop script and show error if database does not exists.
    if (!mysqli_select_db($conn, $db_name)) die("Database does not exists.");
    
    // Stop script and show error if script if cannot remove database.
    $query = "DROP DATABASE IF EXISTS `{$db_name}`";
    if (!mysqli_query($conn, $query)) die(mysqli_error($conn));
    
    // Stop script on success.
    mysqli_close($conn);
    die("Database successfully dropped!");
?>