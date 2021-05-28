<?php
 
 session_start();
 require ("config/config.php");
   require('auth/auth.php');
   require('auth/admin-auth.php');
    $id = $_GET['id'];
    $select= "select * from topic where id=$id";
    $sql = mysqli_query($con,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
 if(isset($_POST['edit_topic']))
 {
    $detail=$_POST['detail'];
    if($res === $id)
    {
   
       $update = "update topic set detail='$detail' where id=$id";
       $sql2=mysqli_query($con,$update);
if($sql2)
       { 
           $_SESSION['success_message'] = "Topic Edit Successfully";
           header("Location:chapter_edit.php?id=$id");
       }
       else
       {
           $_SESSION['success_message'] = "Failed to Edit Topic.";
           header('Location:admin_chapter.php');
       }
    }
    else
    {
        $_SESSION['success_message'] = "Topic id not match";
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
    <title>Adhyan- Topic Edit</title>
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
                  <h2>Topic Information</h2>
                      <div class="">
                        <label>Detail</label>
                          <h3><?= $row['detail'] ?></h3>
                      </div>
        </div>

        <div class="chapter-form" style="float: right;">
            <h2>Update Topic</h2>
             <form method="post" action="">
                <div class="form-control">
                  <label>Detail</label>
                    <textarea class="ckeditor" name="detail"><?= $row['detail'] ?></textarea>
                </div>
                <input type="submit" name="edit_chapter" value="Update Chapter" class="btn btn-primary">
            </form>
        </div>
      </div>

    </section>
<?php include 'footer.php'; ?> 
</body>
</html>
