<?php
    session_start();
    if(session_destroy()) {
    	$_SESSION['success_message'] = "Logout successfully.";
        header("Location: login.php");
    }
?>