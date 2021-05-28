
<?php
session_start();
require ('config/config.php');
require('auth/auth.php');
require('auth/admin-auth.php');
if(isset($_POST['save']))
{	$filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];   
    $folder = "images/".$filename;
	 $course_name = $_POST['course_name'];
	 $course_detail = $_POST['course_detail'];
	 if (move_uploaded_file($tempname, $folder))  {
            $sql = "INSERT INTO course (course_name,course_detail,image)
	 		VALUES ('$course_name','$course_detail','$folder')";
	 		if (mysqli_query($con, $sql)) {
	 			$_SESSION['success_message'] = "Course Added successfully.";
	 			header("Location: index.php");
	 		} else {
		$_SESSION['success_message'] = "Failed To add Course.";
	 }
        }else{
            $msg = "Failed to upload image";
      }
	 mysqli_close($con);
}
?>