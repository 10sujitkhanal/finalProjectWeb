<?php

    session_start();
    require('config/config.php');
    require('auth/auth.php');
    require('auth/admin-auth.php');

    $result = mysqli_query($con,"SELECT * FROM course");
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Adhyan- Admin Course</title>
</head>
<body>

    <?php include 'header.php'; ?>
    

    <section class="courses">
      <div class="container">
        <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <center><div class="alert" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div></center>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
      </div>


        <h2 class="text-center my-2">
            Courses
        </h2>
        <table>
  <thead>
    <tr>
      <th>Course Name</th>
      <th>Course Detail</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php 
                    if (mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_array($result)) {
                ?>
    <tr>
      <td><?= $row['course_name'] ?></td>
      <td><?= $row['course_detail'] ?></td>
      <td><a href="course_edit.php?id=<?= $row['id'] ?>">Edit</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="delete_course.php?id=<?= $row['id'] ?>">Delete</a></td>
    </tr>
    <?php } }?>
    
  </tbody>
</table>

                

                

 

    </section>
<?php include 'footer.php'; ?> 
</body>
</html>


