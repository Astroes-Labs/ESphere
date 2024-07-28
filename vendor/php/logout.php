<?php 
    $endpoint = 'view.php'; 
    include_once $endpoint; 

    // Destroy the session
    session_destroy();
    header("location: ../../user/dashboard.html");
    exit;
?>