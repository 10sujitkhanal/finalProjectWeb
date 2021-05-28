
<?php
session_start();
require("config/config.php");
require('auth/auth.php');
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
<?php
	$query =$_POST['query'];
	$min_length = 3;
	if(strlen($query) >= $min_length){
		$query = htmlspecialchars($query);
		$query = mysqli_real_escape_string($con, $query);
		$result = mysqli_query($con,"SELECT * FROM course
			WHERE (`course_name` LIKE '%".$query."%')");
			?>

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
                <?php } }?>

 
            </div>
            
        </div>

    </section>

<?php include 'footer.php'; ?> 
<?php } else{
	header('Location: index.php');
} ?>
</body>
</html>