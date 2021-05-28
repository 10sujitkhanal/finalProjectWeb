<?php
 
 session_start();
 require ("config/config.php");
  require('auth/auth.php');
 $username=$_SESSION['username'];
    $select= "select * from users where username='$username'";
    $sql = mysqli_query($con,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['username'];
 if(isset($_POST['edit_profile']))
 {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    if($res === $username)
    {
   
       $update = "update users set fname='$fname',lname='$lname',email='$email' where username='$username'";
       $sql2=mysqli_query($con,$update);
if($sql2)
       { 
           $_SESSION['success_message']="Update Profile Successfully";
       }
       else
       {
           $_SESSION['success_message']="Failed To Update Profile";
       }
    }
    else
    {
        $_SESSION['success_message']="Username not match";
    }
 }
?>
<?php
if(isset($_POST['change_password']))
{
 $oldpass=md5($_POST['old_password']);
 $username=$_SESSION['username'];
 $newpassword=md5($_POST['new_password']);
$sql=mysqli_query($con,"SELECT * FROM users where password='$oldpass' && username='$username'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update users set password='$newpassword' where username='$username'");
$_SESSION['success_message']="Password Changed Successfully";
}
else
{
$_SESSION['success_message']="Old Password not match";
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
    <title>Adhyan- Profile</title>
</head>
<body>

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
                  <h2>Profile Update</h2>
                   <form method="post" action="">
                      <div class="form-control">
                        <label>Firstname</label>
                          <input type="text" name="fname" value="<?= $row['fname'] ?>" required>
                      </div>
                      <div class="form-control">
                        <label>Lastname</label>
                          <input type="text" name="lname" value="<?= $row['lname'] ?>" required>
                      </div>
                      <div class="form-control">
                        <label>Email</label>
                          <input type="email" name="email" value="<?= $row['email'] ?>" required>
                      </div>
                      <input type="submit" name="edit_profile" value="Update Profile" class="btn btn-primary">
                  </form>
        </div>

        <div class="profile-form" style="float: right;">
            <h2>Change Password</h2>
             <form method="post" action="">
                <div class="form-control">
                  <label>Old Password</label>
                    <input type="password" name="old_password" required>
                </div>
                <div class="form-control">
                  <label>New Password</label>
                    <input type="password" name="new_password" required>
                </div>
                <div class="form-control">
                  <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <input type="submit" name="change_password" value="Change Password" class="btn btn-primary">
            </form>
        </div>
      </div>

    </section>
<?php include 'footer.php'; ?> 
</body>
</html>
