<?php
	session_start();
	require ("config/config.php");
    require('auth/auth.php');
    require('auth/admin-auth.php');
	$id=$_GET['id'];
	$status_id=$_GET['status'];
	$status= "SELECT * FROM users WHERE id='$id'";
	$sql = mysqli_query($con,$status);
	$row = mysqli_fetch_assoc($sql);
	$row_id = $row['id'];
	if($id === $row_id)
    {
   	if($status_id == 1){
   		$update = "update users set status= 0 where id=$id";
        $update_sql=mysqli_query($con,$update);
   	}
   	else{
   		$update = "update users set status= 1 where id=$id";
        $update_sql=mysqli_query($con,$update);
   	}
	if($update_sql)
       { 
           $_SESSION['success_message'] = "User status update Successfully";
           header('Location:alluser.php');
       }
       else
       {
           $_SESSION['success_message'] = "Failed to update User Status";
           header('Location:alluser.php');
       }
    }
    else
    {
        $_SESSION['success_message'] = "Id not match";
        header('location:alluser.php');
    }

 ?>
