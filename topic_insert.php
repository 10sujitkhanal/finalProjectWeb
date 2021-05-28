
<?php
session_start();
    require ("config/config.php");
    require('auth/auth.php');
    require('auth/admin-auth.php');
if(isset($_POST['save']))
{	 
	 $course_id = $_POST['course_id'];
	 $chapter_id = $_POST['chapter_id'];
	 $detail = $_POST['detail'];
	 $sql = "INSERT INTO topic (chapter_id,detail)
	 VALUES ('$chapter_id','$detail')";
	 if (mysqli_query($con, $sql)) {
		$_SESSION['success_message'] = "Topic Added successfully.";
		header("Location: course-detail.php?course_id=$course_id&chapter_id=$chapter_id");
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($con);
	 }
	 mysqli_close($con);
}
?>