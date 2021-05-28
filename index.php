<?php

    session_start();
    require("config/config.php");
    require('auth/auth.php');

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
    <title>Adhyan- Home</title>
</head>
<body>


    <?php include 'header.php'; ?>
    

    <section class="showcase" style="background-image: url(images/e-learning.png);">
        <div class="container grid">
            <div class="showcase-text">
                <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <div class="alert" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
            </div>
            
            <div class="showcase-form card">
                <?php if($_SESSION['user_type'] == 1){?>
                <h2>Add Course</h2>
                 <form method="post" action="course_insert.php" enctype="multipart/form-data">
                    <div class="form-control">
                        <input type="text" name="course_name" placeholder="Course Name" required>
                    </div>
                    <div class="form-control">
                        <input type="text" name="course_detail" placeholder="Course Detail" required>
                    </div>
                    <div class="form-control">
                        <input type="file" name="image" placeholder="Course Detail" required>
                    </div>
                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            <?php } else{?>
                <ul>
                    <li><h4><b>Propel your career, get a degree, or expand your knowledge at any level</b></h4></li>
                    <br>
                    <li><h4><b>Build a culture of learning through technology</b></h4></li>
                    <br>
                    <li><h4><b>For every student, every classroom</b></h4></li>
                </ul>
            <?php } ?>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="grid grid-3 text-center my-4">
                <div>
                    <i class="fas fa-server fa-3x"></i>
                    <h3>100+</h3>
                    <p class="text-secondary">No of User</p>
                </div>
                <div>
                    <i class="fas fa-upload fa-3x"></i>
                    <h3>987+</h3>
                    <p class="text-secondary">No of Course</p>
                </div>
                <div>
                    <i class="fas fa-project-diagram fa-3x"></i>
                    <h3>100+</h3>
                    <p class="text-secondary">No of topic</p>
                </div>
            </div>
        </div>
    </section>


    <section class="courses">

        <h2 class="text-center my-2">
            Courses
        </h2>
        <div class="container">
            <div class="cards-list">
                <?php 
                    if (mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_array($result)) {
                          $row_id = $row['id'];
                          $first_id_result = mysqli_query($con,"SELECT * FROM chapter where course_id = $row_id");
                          $first_id = mysqli_fetch_assoc($first_id_result);
                ?>
                <a href="course-detail.php?course_id=<?= $row['id'] ?>&chapter_id=<?= $first_id['id']?>">
                    <div class="card1 1">
                      <div class="card_image"> <img src="<?= $row['image'] ?>" /> </div>
                      <div class="card_title title-white">
                        <p><?= $row['course_name'] ?></p>
                      </div>
                    </div>
                </a>
                <?php } }else{ echo "<h1>No course Yet</h1>"; }?>

 
            </div>
            
        </div>

    </section>

<?php include 'footer.php'; ?> 
</body>
</html>


