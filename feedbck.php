<?php

session_start();
include 'config.php';
if(isset($_POST['submit'])){
  $fname = $_SESSION['username'];
  $feedback = $_POST['feedback'];

  $sql = "INSERT INTO feedback (firstname, feedback)
          VALUES ('$fname','$feedback')";
  $result = mysqli_query($conn,$sql);
  if(!$result){
    echo "<script>alert('Woops! Something went wrong.')</script>";
  } else {
    echo "<script>alert('Feedback submitted.')</script>";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  * {
    box-sizing: border-box;
  }

  /* Style inputs */
  input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
  }

  input[type=submit] {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    cursor: pointer;
  }

  input[type=submit]:hover {
    background-color: #45a049;
  }


  /* Create two columns that float next to eachother */
  .column {
    float: left;
    width: 50%;
    margin-top: 6px;
    padding: 20px;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  .sidebar {
    height: 100%;
    width: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color: rgb(191, 236, 122);
    overflow-x: hidden;
    padding-top: 20px;
  }

  /* Style sidebar links */
  .sidebar a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 30px;
    display: block;
  }

  /* Style links on mouse-over */
  .sidebar a:hover {
    color: red;
    mask-border-repeat: round;
  }

  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .column, input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
    .sidebar {padding-top: 15px; width:20%;}
    .sidebar a {font-size: 18px;}
  }
</style>
</head>
<body style="background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), url(./img/bg.jpg);">
<div class="row" >
    <div class="column" style="align-items: center;">
      <h2 style="font-size: 50px; font-weight: 300; color: aliceblue;">Your Feedback is very Important!!</h2>
      <form action="" method="POST">
        <label for="fname" style="color: whitesmoke;">First Name</label>
        <input name="fname" type="text" id="fname" placeholder="Your name.." value="<?php echo $_SESSION['username']; ?>">
        <label for="subject" style="color: whitesmoke;">Feedback</label>
        <textarea name="feedback" id="subject" placeholder="Write something.." style="height:100px"></textarea>
        <input type="submit" value="Submit" name="submit">
      </form>
    </div>
</div>
</body>
</html>
