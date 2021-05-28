<?php
if($_SESSION["username"]){
        $username=$_SESSION['username'];
        $select= "select * from users where username='$username'";
        $sql = mysqli_query($con,$select);
        $row = mysqli_fetch_assoc($sql);
        if($row['status'] == 0){
            if(session_destroy()) {
                header("Location: login.php");
            }
        }
    }
    if(!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
?>