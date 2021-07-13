<?php
// This is for the Admin Sign up page
if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];
  $authent = $_POST["authent"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputSignup($username, $pwd, $pwdRepeat, $authent) !== false) {
    header("location: ../adminSignup.php?error=emptyinput");
    exit();
  }
  // Proper username chosen
  if (invalidUid($uid) !== false) {
    header("location: ../adminSignup.php?error=invaliduid");
    exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../adminSignup.php?error=passwordsdontmatch");
    exit();
  }
  // Is the username taken already
  if (uidExists($conn, $username) !== false) {
    header("location: ../adminSignup.php?error=usernametaken");
    exit();
  }

  // check if authentication matches given key
  if (checkAuthent($authent) === false) {
    header("location: ../adminSignup.php?error=invalidAuth");
    exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $username, $pwd);
}

// This is for the Employee sending information page
else if (isset($_POST["sendInfo"])) {

  // Personal Information
  $fName = $_POST["FName"];
  $mName = $_POST["MName"];
  $lName = $_POST["LName"];
  $dob = $_POST["DOB"];
  $addr = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];
  $phone = $_POST["employeePhone"];
  $email = $_POST["email"];
  $SSN = $_POST["ssn"];

  //Banking
  $bankAccNum = $_POST["bankAccNum"];
  $bankRoutingNum = $_POST["routingNum"];
  $bankDepMethod = $_POST["depositMethod"];

  //W4 prior to 2019
  $W4p2019Status = $_POST["W4p2019Status"];
  $W4p2019DepNum = $_POST["W4p2019numDep"];

  //W4 2021
  $W42021Status = $_POST["W42021Status"];
  $W42021DepNum = $_POST["W42021numDep"];

  //Michigan W4
  $MW4DriverLicNum = $_POST["MW4DLNum"];
  $MW4HireCheck = $_POST["MW4HireCheck"];
  $MW4HireDate = $_POST["MW4HireDate"];
  $MW4DepNum = $_POST["MW4dependents"];

  //Agreement
  $checkAgreement = $_POST["AgreementCheck"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';


  if ($MW4HireCheck === "Yes.") {
    if ($MW4HireDate === "") {
      header("location: ../employeeSignup.php?error=invalidDLstartChar");
      exit();
    }
  }

  // Make sure the user agreed to this information
  if($checkAgreement == ""){
    // Using $_GET (on employeeSignup.php) to grab info from the URL, so the user doesn't have to retype in everything.
    header("location: ../employeeSignup.php?error=emptyinput&FName=".$fName."&MName=".$mName."&LName=".$lName."&DOB=".$dob.
    "&address=".$addr."&city=".$city."&state=".$state."&zip=".$zip."&employeePhone=".$phone."&email=".$email."&ssn=".$SSN.
    "&bankAccNum=".$bankAccNum."&routingNum=".$bankRoutingNum."&depositMethod=".$bankDepMethod."&W4p2019Status=".$W4p2019Status.
    "&W4p2019numDep=".$W4p2019DepNum."&W42021Status=".$W42021Status."&W42021numDep=".$W42021DepNum."&MW4DLNum=".$MW4DriverLicNum."&MW4HireCheck=".$MW4HireCheck."&MW4HireDate=".$MW4HireDate."&MW4dependents=".$MW4DepNum);
    exit();
  }

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  $empInpRes = emptyInputEmpSignup($fName, $lName, $dob, $addr, $city, $state, $zip, $phone, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4HireDate, $MW4DepNum, $checkAgreement);
  if ($empInpRes === "") {
    //header("location: ../employeeSignup.php?error=emptyinput");
    header("location: ../employeeSignup.php?error=emptyinput&FName=".$fName."&MName=".$mName."&LName=".$lName."&DOB=".$dob.
    "&address=".$addr."&city=".$city."&state=".$state."&zip=".$zip."&employeePhone=".$phone."&email=".$email."&ssn=".$SSN.
    "&bankAccNum=".$bankAccNum."&routingNum=".$bankRoutingNum."&depositMethod=".$bankDepMethod."&W4p2019Status=".$W4p2019Status.
    "&W4p2019numDep=".$W4p2019DepNum."&W42021Status=".$W42021Status."&W42021numDep=".$W42021DepNum."&MW4DLNum=".$MW4DriverLicNum."&MW4HireCheck=".$MW4HireCheck."&MW4HireDate=".$MW4HireDate."&MW4dependents=".$MW4DepNum);
    exit();
  }

  // Is the SSN taken already
  if (ssnExists($conn, $SSN) !== false) {
    //header("location: ../employeeSignup.php?error=SSNtaken");
    header("location: ../employeeSignup.php?error=SSNtaken&FName=".$fName."&MName=".$mName."&LName=".$lName."&DOB=".$dob.
    "&address=".$addr."&city=".$city."&state=".$state."&zip=".$zip."&employeePhone=".$phone."&email=".$email.
    "&bankAccNum=".$bankAccNum."&routingNum=".$bankRoutingNum."&depositMethod=".$bankDepMethod."&W4p2019Status=".$W4p2019Status.
    "&W4p2019numDep=".$W4p2019DepNum."&W42021Status=".$W42021Status."&W42021numDep=".$W42021DepNum."&MW4DLNum=".$MW4DriverLicNum."&MW4HireCheck=".$MW4HireCheck."&MW4HireDate=".$MW4HireDate."&MW4dependents=".$MW4DepNum);
    exit();
  }

  // check to make sure driver's license starts with an "s"
  if (strtoupper($MW4DriverLicNum[0]) !== 'S') {
    //header("location: ../employeeSignup.php?error=invalidDLstartChar");
    header("location: ../employeeSignup.php?error=invalidDLstartChar&FName=".$fName."&MName=".$mName."&LName=".$lName."&DOB=".$dob.
    "&address=".$addr."&city=".$city."&state=".$state."&zip=".$zip."&employeePhone=".$phone."&email=".$email."&ssn=".$SSN.
    "&bankAccNum=".$bankAccNum."&routingNum=".$bankRoutingNum."&depositMethod=".$bankDepMethod."&W4p2019Status=".$W4p2019Status.
    "&W4p2019numDep=".$W4p2019DepNum."&W42021Status=".$W42021Status."&W42021numDep=".$W42021DepNum."&MW4DLNum=".$MW4DriverLicNum."&MW4HireCheck=".$MW4HireCheck."&MW4HireDate=".$MW4HireDate."&MW4dependents=".$MW4DepNum);
    exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createEmployee($conn, $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate);

} else if (isset($_POST["updateEmployeeInfo"])) {
  // Employee ID
  $empId = $_POST["empId"];

  // Personal Information
  $fName = $_POST["fName"];
  $mName = $_POST["mName"];
  $lName = $_POST["lName"];
  $dob = $_POST["DOB"];
  $addr = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];
  $phone = $_POST["employeePhone"];
  $email = $_POST["email"];
  $SSN = $_POST["ssn"];

  //Banking
  $bankAccNum = $_POST["bankAccNum"];
  $bankRoutingNum = $_POST["routingNum"];
  $bankDepMethod = $_POST["depositMethod"];

  //W4 prior to 2019
  $W4p2019Status = $_POST["W4p2019Status"];
  $W4p2019DepNum = $_POST["W4p2019numDep"];

  //W4 2021
  $W42021Status = $_POST["W42021Status"];
  $W42021DepNum = $_POST["W42021numDep"];

  //Michigan W4
  $MW4DriverLicNum = $_POST["MW4DLNum"];
  $MW4HireCheck = $_POST["MW4HireCheck"];
  $MW4HireDate = $_POST["MW4HireDate"];
  $MW4DepNum = $_POST["MW4dependents"];




  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  //require_once '../myInfo.php';
  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  //$firstName = "<script>document.writeln(firstName);</script>";
  //echo "<h2>Name: " . $fName . "</h2>";

  //modifyEmployee($conn, $empID, "Joshs", $middleName, $lastName, $dateOfBirth, $addr, $cit, $sta, $zp, $empEmail, $empSsn, $bAccNum, $rNum, $depMet, $w42019stat, $w42019numDep, $W42021stat, $W42021numDep, $MW4DL, $MW4HiCheck, $MW4dep, $empPhone, $MW4HiDate);
  //modifyEmployee($conn, "6", $fName, "C");

  modifyEmployee($conn, $empId, $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate);
} else {
  header("location: ../employeeSignup.php");
  exit();
}
