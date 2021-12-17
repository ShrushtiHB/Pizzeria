<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PIZZERIA</title>
<link rel="stylesheet" href="Homecss.css">
</head>
<body style="background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url(bg.jpg); color:white; font-size:20px">
    <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
    <div class="fixed-header">
        <div class="container">
            <nav>
                <a href="logout.php">LogOut</a>
                <a href="feedbck.php">Feedback</a>
                <a href="index.php">Order</a>
                <a href="about.html">About</a>
                <a href="Homepage.html">Home</a>
            </nav>
        </div>
    </div>
    <div>
        <br><br><br>
        <div class="">
            <img class="logo" src="img/logo.jpg">
            <h1 class="h1">PIZZERIA</h1>
        </div>
        <marquee class="h3" width="45%" direction="left" height="100px">
            Pizza for Foodies!!!
        </marquee>
        <br>
    </div>
    <div class="fixed-footer">
        <div class="container">Copyright &copy; 2021 PIZZERIA</div>        
    </div>
</body>
</html>