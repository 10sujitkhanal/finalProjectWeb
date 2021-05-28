<style>
* {
    box-sizing: border-box;
}

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
        <h2>Create Account</h2><span style="float: right"><a href="login.php">Login Now</a></span>
    </div>
    <form id="form" action="register-process.php" class="form">
        <div class="form-control">
            <label for="fname">First Name</label>
            <input type="text" placeholder="Firstname" name="fname" id="fname" />
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="lname">Last Name</label>
            <input type="text" placeholder="Lastname" name="lname" id="lname" />
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="username">Username</label>
            <input type="text" placeholder="Username" name="username" id="username" />
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="username">Email</label>
            <input type="email" placeholder="your@email.com" name="email" id="email" />
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
        <div class="form-control">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" id="confirm-password"/>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <button>Submit</button>
    </form>
</div>
<script type="text/javascript">
const form = document.getElementById('form');
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('confirm-password');

form.addEventListener('submit', e => {
    e.preventDefault();
    
    checkInputs();
});

function checkInputs() {
    const fnameValue = fname.value.trim();
    const lnameValue = lname.value.trim();
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    var status;

    if(fnameValue === '') {
        setErrorFor(fname, 'First Name required');
        return false;
    } else {
        setSuccessFor(fname);
    }

    if(lnameValue === '') {
        setErrorFor(lname, 'Last Name required');
        return false;
    } else {
        setSuccessFor(lname);
    }
    
    if(usernameValue === '') {
        setErrorFor(username, 'Username required');
        return false;
    } else {
        setSuccessFor(username);
    }
    
    if(emailValue === '') {
        setErrorFor(email, 'Email required');
        return false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Not a valid email');
        return false;
    } else {
        setSuccessFor(email);
    }
    
    if(passwordValue === '') {
        setErrorFor(password, 'Password required');
        return false;
    } else {
        setSuccessFor(password);
    }
    
    if(password2Value === '') {
        setErrorFor(password2, 'Confirm Password required');
        return false;
    } else if(passwordValue !== password2Value) {
        setErrorFor(password2, 'Confirm Password not match');
        return false;
    } else{
        setSuccessFor(password2);
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