<?php
session_start();
include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="utf-8">
  <title>SFS Signup</title>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Yomogi&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css?ver=<?php echo rand(111, 999) ?>">
</head>

<body>
  <!--A quick navigation-->
  <div class="wrapper">
    <header>
      <ul class="navigation">
        <li><a class="txtHover" href="index.php">Home</a></li>
        <?php
        if (isset($_SESSION["useruid"])) {
          echo "<li><a class='txtHover' href='viewEmployees.php'>View Employees</a></li>";
          echo "<li><a class='txtHover' href='logout.php'>Logout</a></li>";
        } else if (isset($_SESSION["email"])) {
          echo "<li><a class='txtHover' href='myInfo.php'>" . $_SESSION["email"] . "</a></li>";
          echo "<li><a class='txtHover' href='logout.php'>Logout</a></li>";
          //echo "<h2>" . $_SESSION["email"] . "</h2>";
        } else {
          echo "<li><a class='txtHover' href='loginMaster.php'>Log in</a></li>";
          echo "<li><a class='txtHover' href='employeeSignup.php'>Signup</a></li>";
        }
        ?>
      </ul>
      <!-- <hr> HORIZONTAL LINE-->
      <br>

    </header>
  </div>
  <br><br><br><br>

  <!--A quick wrapper to align the content (ends in footer.php)-->
  <div class="wrapper">