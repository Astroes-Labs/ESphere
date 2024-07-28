<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'config.php';
include "controller.php";

   /* function isLoggedIn() {
        if (isset($_SESSION['lid']) && $_SESSION['lid'] > 0) {
            return true; // User is logged in
        } else {
            return false; // User is not logged in
        }
    }
    
    // Method to enforce login for 'user' directory
    $currentDirectory = basename(dirname($_SERVER['PHP_SELF']));
    
    if ($currentDirectory === 'user' && !isLoggedIn()) {
        redirect($loginPage);
    }

    
    // Method to enforce logout for 'home' directory
    if ($currentDirectory === 'home' && isLoggedIn()) {
        redirect($dashboardPage); // Example redirect to user dashboard
    }

    
    // Helper method to perform redirection
    function redirect($url) {
        header("Location: $url");
        exit;
    }
*/