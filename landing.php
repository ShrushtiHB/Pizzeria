<?php

include 'config.php';
session_start();
error_reporting(0);
if (isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if(!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                echo "<script>alert('Wow! User registeration successful.')</script>";
            } else {
                echo "<script>alert('Woops! Something went wrong.')</script>";
            }
        } else {
            echo "<script>alert('Woops. Email already exists')</script>";
        }
    } else {
        echo "<script>alert('Password not matched.')</script>";
    }
}

if (isset($_POST['login'])){
    $username = $_POST['loginusername'];
    $password = md5($_POST['loginpassword']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        header("Location: welcome.php");
    } else {
        echo "<script>alert('Woops. Username or Password is wrong.')</script>";
    }
}

?>

<html>
<head>
    <title>Login & Registration</title>
    <link rel="stylesheet" type="text/css" href="landing.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <img src="img/fb.png">
                <img src="img/tw.png">
                <img src="img/gp.png">
            </div>
            <form action="" method="POST" id="login" class="input-group">
                <input name="loginusername" type="text" class="input-field" placeholder="User Id" value="<?php echo $username; ?>" required>
                <input name="loginpassword" type="password" class="input-field" placeholder="Enter password" value="<?php echo $password; ?>" required>
                <br><br><br>
                <button style="color: white; font-weight: bold; font-size: 15px;" class="submit-btn" name="login">Log In</button>
            </form>
            <form action="" method="POST" id="register" class="input-group">
                <input name="username" type="text" class="input-field" placeholder="User Id" value="<?php echo $username; ?>" required>
                <input name="email" type="email" class="input-field" placeholder="Email Id" value="<?php echo $email; ?>" required>
                <input name="password" type="password" class="input-field" placeholder="Enter password" value="<?php echo $password; ?>" required>
                <input name="cpassword" type="password" class="input-field" placeholder="Confirm password" value="<?php echo $cpassword; ?>" required>
                <br><br><br>
                <button style="color: white; font-weight: bold; font-size: 15px;" class="submit-btn" name="register">Register</button>
            </form>
        </div>
    </div>
<script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");
    function register(){
        x.style.left = "-400px"
        y.style.left = "50px"
        z.style.left = "110px"
    }
    function login(){
        x.style.left = "50px"
        y.style.left = "450px"
        z.style.left = "0px"
    }
</script>
</body>
</html>