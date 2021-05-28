<?php
 
 session_start();
 require ("config/config.php");
 require('auth/auth.php');
 require('auth/admin-auth.php');
    $id = $_GET['id'];
    $select= "select * from course where id=$id";
    $sql = mysqli_query($con,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
 if(isset($_POST['edit_course']))
 {
    $course_name=$_POST['course_name'];
    $course_detail=$_POST['course_detail'];
    if($res === $id)
    {
   
       $update = "update course set course_name='$course_name',course_detail='$course_detail' where id=$id";
       $sql2=mysqli_query($con,$update);
if($sql2)
       { 
           $_SESSION['success_message'] = "Edit Course successfully";
       }
       else
       {
           $_SESSION['success_message'] = "Failed To update Course";
       }
    }
    else
    {
        $_SESSION['success_message'] = "Course id not match";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <title>Adhyan- Course Edit</title>
</head>
<body>

    <!-- Navbar -->
    <?php include 'header.php'; ?>
    <section class="profile-main">
      <div class="container">
        <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <center><div class="alert" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div></center>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
      </div>

      <div class="container grid">
        <div class="profile-form">
                  <h2>Course Information</h2>
                      <div class="">
                        <label>Course Name</label>
                          <h1><b><?= $row['course_name'] ?></b></h1>
                      </div>
                      <div class="">
                        <label>Course Detail</label>
                          <h3><?= $row['course_detail'] ?></h3>
                      </div>
        </div>

        <div class="profile-form" style="float: right;">
            <h2>Update Course</h2>
             <form method="post" action="">
                <div class="form-control">
                  <label>Course Name</label>
                    <input type="text" name="course_name" value="<?= $row['course_name'] ?>" required>
                </div>
                <div class="form-control">
                  <label>Course Detail</label>
                    <input type="text" name="course_detail" value="<?= $row['course_detail'] ?>" required>
                </div>
                <input type="submit" name="edit_course" value="Update Course" class="btn btn-primary">
            </form>
        </div>
      </div>

    </section>
<?php include 'footer.php'; ?> 
</body>
</html>
