<?php

    session_start();
    if(isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }

    require('config/config.php');
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query    = "SELECT * FROM users WHERE username='$username' AND status=1
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $data['user_type'];

            header("Location: index.php");
        } else {

        }
    } 
?>

<style>
body {
    background-image: url('images/login-bg.jpg');
    font-family: 'Open Sans', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    width: 500px;
    max-width: 100%;
}

.header {
    border-bottom: 1px solid #f0f0f0;
    background-color: #f7f7f7;
    padding: 20px 40px;
}

.header h2 {
    margin: 0;
}

.form {
    padding: 30px 40px; 
}

.form-control {
    padding-bottom: 15px;
    position: relative;
}

.form-control label {
    display: inline-block;
    margin-bottom: 5px;
}

.form-control input {
    border: 2px solid #f0f0f0;
    border-radius: 4px;
    display: block;
    font-family: inherit;
    font-size: 14px;
    padding: 10px;
    width: 100%;
}

.form-control input:focus {
    outline: 0;
    border-color: #777;
}

.form-control.success input {
    border-color: #2ecc71;
}

.form-control.error input {
    border-color: #e74c3c;
}

.form-control i {
    visibility: hidden;
    position: absolute;
    top: 40px;
    right: 10px;
}

.form-control.success i.fa-check-circle {
    color: #2ecc71;
    visibility: visible;
}

.form-control.error i.fa-exclamation-circle {
    color: #e74c3c;
    visibility: visible;
}

.form-control small {
    color: #e74c3c;
    position: absolute;
    bottom: 0;
    left: 0;
    visibility: hidden;
}

.form-control.error small {
    visibility: visible;
}

.form button {
    background-color: #8e44ad;
    border: 2px solid #8e44ad;
    border-radius: 4px;
    color: #fff;
    display: block;
    font-family: inherit;
    font-size: 16px;
    padding: 10px;
    margin-top: 20px;
    width: 100%;
}

</style>
<div class="container">
    <div class="header">
        <h2>Login</h2>
    </div>
    <form id="form" method="post" action="" class="form">

        <div class="form-control">
            <label for="username">Username</label>
            <input type="text" placeholder="Username" name="username" id="username" />
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="username">Password</label>
            <input type="password" placeholder="Password" name="password" id="password"/>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <button>Login</button>
        <br>
        <center><span><a href="registration.php">Register Now</a></span></center>
    </form>
</div>
<script type="text/javascript">
const form = document.getElementById('form');
const username = document.getElementById('username');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
    e.preventDefault();
    
    checkInputs();
});

function checkInputs() {
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    
    if(usernameValue === '') {
        setErrorFor(username, 'Username required');
        return false;
    } else {
        setSuccessFor(username);
    }
    
    
    if(passwordValue === '') {
        setErrorFor(password, 'Password required');
        return false;
    } else {
        setSuccessFor(password);
    }
    
    form.submit();
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-control error';
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}
    
function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}


</script>
