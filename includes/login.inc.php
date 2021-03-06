<?php
$key = 'cHcabxgZDblOq1wlTEWEDZjT2JkbOgAaKobpXT1DbaR9zQ5K1HB1zEXJEuPK51oK';

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  // Then we run a bunch of error handlers to catch any user mistakes we can 
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  if (emptyInputLogin($username, $pwd) === true) {
    header("location: ../login.php?error=emptyinput");
		exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  loginUser($conn, $username, $pwd);

}
else if(isset($_POST["employeeLoginSubmit"])){
  // First we get the form data from the URL
  $empEmail = $_POST["empEmail"];
  $ssn = $_POST["empSSN"];

  // Then we run a bunch of error handlers to catch any user mistakes we can
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  if (emptyInputLoginEmail($empEmail, $ssn) === true) {
    header("location: ../employeeLogin.php?error=emptyinput");
		exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  loginEmployee($conn, $empEmail, $ssn, $key);
}


else {
	header("location: ../login.php");
    exit();
}
