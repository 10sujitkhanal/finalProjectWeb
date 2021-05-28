<?php
	session_start();
	require ("config/config.php");
    require('auth/auth.php');
    require('auth/admin-auth.php');
	$id=$_GET['id'];
	echo $id;
	$result_chapter = mysqli_query($con,"SELECT * FROM chapter where course_id=$id");

    if (mysqli_num_rows($result_chapter) > 0) { 
        while($row = mysqli_fetch_array($result_chapter)) {
        	$chapter_id = $row['id'];
        	$result_topic = mysqli_query($con,"SELECT * FROM topic where chapter_id=$chapter_id");
        	if (mysqli_num_rows($result_topic) > 0) { 
        		while($row1 = mysqli_fetch_array($result_topic)) {
        			mysqli_query($con,"DELETE FROM topic where chapter_id=$chapter_id");
        		}
        	}
        	mysqli_query($con,"DELETE FROM chapter where course_id=$id");
	    }
	}

	$delete= "DELETE FROM course WHERE id='$id'";
	$sql = mysqli_query($con,$delete);
	$_SESSION['success_message'] = "Delete Course successfully.";
	header("Location: admin_course.php");


 ?>