<?php

    session_start();
    require('config/config.php');
    require('auth/auth.php');
    require('auth/admin-auth.php');

    $result = mysqli_query($con,"SELECT * FROM chapter");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Addhyan- Admin Chapter</title>
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
      <th>Chapter Name</th>
      <th>Chapter Detail</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php 
                    if (mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_array($result)) {
                          $course_id = $row['course_id'];
                          $course_result = mysqli_query($con,"SELECT * FROM course where id=$course_id");
                          $course = mysqli_fetch_assoc($course_result);
                ?>
    <tr>
      <td><?= $course['course_name'] ?></td>
      <td><?= $row['chapter_name'] ?></td>
      <td><?= $row['chapter_content'] ?></td>
      <td><a href="chapter_edit.php?id=<?= $row['id'] ?>">Edit</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="delete_chapter.php?id=<?= $row['id'] ?>">Delete</a></td>
    </tr>
    <?php } }?>
    
  </tbody>
</table>

                

                

 

    </section>


    <footer class="footer bg-dark py-5">
        <div class="container grid grid-3">
            <div>
                <h1>Loruki
                </h1>
                <p>Copyright &copy; 2020</p>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="features.html">Features</a></li>
                    <li><a href="docs.html">Docs</a></li>
                </ul>
            </nav>
            <div class="social">
                <a href="#"><i class="fab fa-github fa-2x"></i></a>
                <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>


