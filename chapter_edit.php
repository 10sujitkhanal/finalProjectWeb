<?php
 
 session_start();
 require ("config/config.php");
 require('auth/auth.php');
 require('auth/admin-auth.php');
    $id = $_GET['id'];
    $select= "select * from chapter where id=$id";
    $sql = mysqli_query($con,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
 if(isset($_POST['edit_chapter']))
 {
    $chapter_name=$_POST['chapter_name'];
    $chapter_content=$_POST['chapter_content'];
    if($res === $id)
    {
   
       $update = "update chapter set chapter_name='$chapter_name',chapter_content='$chapter_content' where id=$id";
       $sql2=mysqli_query($con,$update);
if($sql2)
       { 
           $_SESSION['success_message'] = "Edit Chapter Successfully";
           header("Location:chapter_edit.php?id=$id");
       }
       else
       {
           $_SESSION['success_message'] = "Failed To Update Chapter";
           header('Location:admin_chapter.php');
       }
    }
    else
    {
        $_SESSION['success_message'] = "Sorry id not match";
        header('location:admin_chapter.php');
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
    <title>Adhyan- Chapter Edit</title>
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
                        <label>Chapter Name</label>
                          <h1><b><?= $row['chapter_name'] ?></b></h1>
                      </div>
                      <div class="">
                        <label>Chapter Content</label>
                          <h3><?= $row['chapter_content'] ?></h3>
                      </div>
        </div>

        <div class="chapter-form" style="float: right;">
            <h2>Update Course</h2>
             <form method="post" action="">
                <div class="form-control">
                  <label>Chapter Name</label>
                    <input type="text" name="chapter_name" value="<?= $row['chapter_name'] ?>" required>
                </div>
                <div class="form-control">
                  <label>Chapter Content</label>
                    <textarea class="ckeditor" name="chapter_content"><?= $row['chapter_content'] ?></textarea>
                </div>
                <input type="submit" name="edit_chapter" value="Update Chapter" class="btn btn-primary">
            </form>
        </div>
      </div>

    </section>
    <?php include 'footer.php'; ?> 
</body>
</html>
