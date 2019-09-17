<?php
    // Start and destroy session.
    session_start();
    session_destroy();
    
    // Redirect to login page and exit script.
    header('Location:./index.php');
    exit();
?>