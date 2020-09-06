<?php
    //Start session
    session_start();
    
    //Unset the variables stored in session
    unset($_SESSION['user_id']);
    unset($_SESSION['user']);
    unset($_SESSION['phone']);
    unset($_SESSION['name']);
    header("location: ../index.php");
?>