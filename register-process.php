
<?php
    require('config/config.php');
    if (isset($_REQUEST['username'])) {
        $fname = stripslashes($_REQUEST['fname']);
        $fname = mysqli_real_escape_string($con, $fname);

        $lname = stripslashes($_REQUEST['lname']);
        $lname = mysqli_real_escape_string($con, $lname);

        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (fname, lname, username, password, email, create_datetime)
                     VALUES ('$fname','$lname','$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);

        if ($result) {
            header("Location:login.php")
        } else {
            header("Location:registration.php")
        }
    }
?>
