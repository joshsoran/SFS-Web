<?php
// Check for empty input for employee signup

// Check for SSN inside of database, no duplicate SSN's should exist.


// Check for empty input for admin signup
function emptyInputSignup($username, $pwd, $pwdRepeat, $authent)
{
	$result;
	if (empty($username) || empty($pwd) || empty($pwdRepeat) || empty($authent)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check for empty input for employee signup
function emptyInputEmpSignup($fName, $lName, $dob, $addr, $city, $state, $zip, $phone, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $MW4DriverLicNum, $MW4HireCheck, $MW4HireDate, $MW4DepNum, $checkAgreement)
{
	$result;
	if (empty($fName) || empty($lName) || empty($dob) || empty($addr) || empty($city) || empty($state) || empty($zip) || empty($phone) || empty($email) || empty($SSN) || empty($bankAccNum) || empty($bankRoutingNum) || empty($bankDepMethod) || empty($W4p2019Status) || empty($W4p2019DepNum) || empty($W42021Status) || empty($MW4DriverLicNum) || empty($MW4HireCheck) || empty($MW4HireDate) || empty($MW4DepNum) || empty($checkAgreement)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check invalid username
function invalidUid($username)
{
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat)
{
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if authentication is valid
function checkAuthent($authent)
{
	$result;
	if ($authent === "L8dLTYCCyN") {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username)
{
	$sql = "SELECT * FROM adminUsers WHERE usersUid = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../adminSignup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $username, $pwd)
{
	$sql = "INSERT INTO adminUsers (usersUid, pwd) VALUES (?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../adminSignup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../adminSignup.php?error=none");
	exit();
}

// Insert new employee into database
function createEmployee($conn, $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate)
{
	$sql = "INSERT INTO empInfo (firstName, middleName, lastName, DOB, address, city, state, zip, email, ssn, bankAccountNumber, bankRoutingNumber, bankDirectDeposit, W42019RelStatus, W42019ClaimDependents, W42021RelStatus, W42021ClaimDependents, W4MichiganDL, W4MichiganNewEmployee, W4MichiganDependents, phone, W4MichiganHireDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../employeeSignup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../employeeSignup.php?error=none");
	exit();
}

// Modify Existing employees info
//function modifyEmployee($conn, $empId, $fName, $mName)
function modifyEmployee($conn, $empId, $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate)
{
	$sql = "UPDATE empInfo SET firstName = ?, middleName = ?, lastName = ? , DOB = ?, address = ?, city = ?, state = ?, zip = ?, email = ?, ssn = ?, bankAccountNumber = ?, bankRoutingNumber = ?, bankDirectDeposit = ?, W42019RelStatus = ?, W42019ClaimDependents = ?, W42021RelStatus = ?, W42021ClaimDependents =?, W4MichiganDL = ?, W4MichiganNewEmployee=?, W4MichiganDependents = ?, phone = ?, W4MichiganHireDate = ? WHERE empId = ?";
	//$sql = "UPDATE empInfo SET firstName = ?, middleName = ? WHERE empId = ?";
	
	
	//, DOB, address, city, state, zip, email, ssn, bankAccountNumber, bankRoutingNumber, bankDirectDeposit, W42019RelStatus, W42019ClaimDependents, W42021RelStatus, W42021ClaimDependents, W4MichiganDL, W4MichiganNewEmployee, W4MichiganDependents, phone, W4MichiganHireDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../myInfo.php?error=stmtfailed");
		exit();
	}

	//mysqli_stmt_bind_param($stmt, "ssi", $fName, $mName, $empId);
	mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssi", $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate, $empId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../myInfo.php?error=none");

	session_start();
	$_SESSION["empId"] = $email;
	$_SESSION["email"] = $email;
	exit();
}

// Check if SSN is in database, if so then return data
function ssnExists($conn, $SSN)
{
	$sql = "SELECT * FROM empInfo WHERE ssn = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../employeeSignup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $SSN);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}





// Check for empty input login
function emptyInputLogin($username, $pwd)
{
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Check for empty input email
function emptyInputLoginEmail($email, $ssn)
{
	$result;
	if (empty($email) || empty($ssn)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd)
{
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["pwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	} elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		header("location: ../index.php?error=none");
		exit();
	}
}

function empEmailExists($conn, $empEmail)
{
	$sql = "SELECT * FROM empInfo WHERE email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../employeeLogin.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $empEmail);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function loginEmployee($conn, $empEmail, $ssn)
{
	// Email check
	$empEmailExists = empEmailExists($conn, $empEmail);

	if ($empEmailExists === false) {
		header("location: ../employeeLogin.php?error=wronglogin");
		exit();
	}

	// find the SSN that is paired with that email
	$ssnCheck = $empEmailExists["ssn"];

	// Final check to ensure that everything matches correctly
	if ($ssn !== $ssnCheck) {
		header("location: ../employeeLogin.php?error=wronglogin");
		exit();
	} elseif ($ssn === $ssnCheck) {
		session_start();
		$_SESSION["empId"] = $empEmailExists["email"];
		$_SESSION["email"] = $empEmailExists["email"];
		header("location: ../index.php?error=none");
		exit();
	}
}
