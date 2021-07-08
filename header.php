<?php
  session_start();
  include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SFS Signup</title>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css<?php echo rand(111,999)?>">
    <link rel="stylesheet" href="css/style.css?ver=<?php echo rand(111,999)?>">
  </head>
  <body>
    <!--A quick navigation-->
    <nav>
      <div class="wrapper">
        <ul>
          <li><a href="index.php">Home</a></li>
          <?php
            if (isset($_SESSION["useruid"])) {
              echo "<li><a href='viewEmployees.php'>View Employees</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else if(isset($_SESSION["email"])){
              echo "<li><a href='myInfo.php'>" . $_SESSION["email"] . "</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
              //echo "<h2>" . $_SESSION["email"] . "</h2>";
            }
            else {
              echo "<li><a href='employeeSignup.php'>Employee Signup</a></li>";
              echo "<li><a href='adminSignup.php'>Admin Signup</a></li>";
              echo "<li><a href='employeeLogin.php'>Employee Log in</a></li>";
              echo "<li><a href='login.php'>Admin Log in</a></li>";
            }
          ?>
        </ul>
      </div>
      <hr></hr>
    </nav>

<!--A quick wrapper to align the content (ends in footer.php)-->
<div class="wrapper">
