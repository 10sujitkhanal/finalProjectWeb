
<?php
session_start();
require ('config/config.php');
require('auth/auth.php');
require('auth/admin-auth.php');
if(isset($_POST['save']))
{	 
	 $course_id = $_POST['course_id'];
	 $chapter_name = $_POST['chapter_name'];
	 $chapter_content = $_POST['chapter_content'];
	 $sql = "INSERT INTO chapter (course_id,chapter_name,chapter_content)
	 VALUES ('$course_id','$chapter_name','$chapter_content')";
	 if (mysqli_query($con, $sql)) {
				$_SESSION['success_message'] = "Topic Added successfully.";
				$last_id = mysqli_insert_id($con);
		header("Location: course-detail.php?course_id=$course_id&chapter_id=$last_id");
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($con);
	 }
	 mysqli_close($con);
}
?>