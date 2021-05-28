<?php
	session_start();
	require ("config/config.php");
    require('auth/auth.php');
    require('auth/admin-auth.php');
	$id=$_GET['id'];
	echo $id;
	$delete= "DELETE FROM users WHERE id='$id'";
	$sql = mysqli_query($con,$delete);

	if($sql){
        $_SESSION['success_message'] = "Delete User Successfully";
        header('Location:alluser.php');
    }

 ?>
