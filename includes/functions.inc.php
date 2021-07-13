<?php


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
function emptyInputEmpSignup($fName, $lName, $dob, $addr, $city, $state, $zip, $phone, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4HireDate, $MW4DepNum, $checkAgreement)
{
	$inputArray = array(
		1 => $fName,
		2 => $lName,
		3 => $dob,
		4 => $addr,
		5 => $city,
		6 => $state,
		7 => $zip,
		8 => $phone,
		9 => $email,
		10 => $SSN,
		11 => $bankAccNum,
		12 => $bankRoutingNum,
		13 => $bankDepMethod,
		14 => $W4p2019Status,
		15 => $W4p2019DepNum,
		16 => $W42021Status,
		17 => $W42021DepNum,
		18 => $MW4DriverLicNum,
		19 => $MW4HireCheck,
		20 => $MW4HireDate,
		21 => $MW4HireDate,
		22 => $MW4DepNum,
		23 => $checkAgreement,
	);

	foreach($inputArray as &$value){
		if(empty($value)){
			return $value;
			break;
		}
	}
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


// Insert new employee into database
function createEmployee($conn, $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate, $key)
{
	$sql = "INSERT INTO empInfo (firstName, middleName, lastName, DOB, address, city, state, zip, email, ssn, bankAccountNumber, bankRoutingNumber, bankDirectDeposit, W42019RelStatus, W42019ClaimDependents, W42021RelStatus, W42021ClaimDependents, W4MichiganDL, W4MichiganNewEmployee, W4MichiganDependents, phone, W4MichiganHireDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../employeeSignup.php?error=stmtfailed");
		exit();
	}
	// encrypt sensitive info
	$encryptSSN = encryptthis($SSN, $key);
	$encryptbankAccNum = encryptthis($bankAccNum, $key);
	$encryptMW4DriverLicNum = encryptthis($MW4DriverLicNum, $key);

	mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $encryptSSN, $encryptbankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $encryptMW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../employeeSignup.php?error=none");
	exit();
}

// Modify Existing employees info
//function modifyEmployee($conn, $empId, $fName, $mName)
function modifyEmployee($conn, $empId, $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $SSN, $bankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $MW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate, $key)
{
	$sql = "UPDATE empInfo SET firstName = ?, middleName = ?, lastName = ? , DOB = ?, address = ?, city = ?, state = ?, zip = ?, email = ?, ssn = ?, bankAccountNumber = ?, bankRoutingNumber = ?, bankDirectDeposit = ?, W42019RelStatus = ?, W42019ClaimDependents = ?, W42021RelStatus = ?, W42021ClaimDependents =?, W4MichiganDL = ?, W4MichiganNewEmployee=?, W4MichiganDependents = ?, phone = ?, W4MichiganHireDate = ? WHERE empId = ?";
	//$sql = "UPDATE empInfo SET firstName = ?, middleName = ? WHERE empId = ?";
	
	
	//, DOB, address, city, state, zip, email, ssn, bankAccountNumber, bankRoutingNumber, bankDirectDeposit, W42019RelStatus, W42019ClaimDependents, W42021RelStatus, W42021ClaimDependents, W4MichiganDL, W4MichiganNewEmployee, W4MichiganDependents, phone, W4MichiganHireDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

	// encrypt sensitive info
	$encryptSSN = encryptthis($SSN, $key);
	$encryptbankAccNum = encryptthis($bankAccNum, $key);
	$encryptMW4DriverLicNum = encryptthis($MW4DriverLicNum, $key);

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../myInfo.php?error=stmtfailed");
		exit();
	}

	//mysqli_stmt_bind_param($stmt, "ssi", $fName, $mName, $empId);
	mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssi", $fName, $mName, $lName, $dob, $addr, $city, $state, $zip, $email, $encryptSSN, $encryptbankAccNum, $bankRoutingNum, $bankDepMethod, $W4p2019Status, $W4p2019DepNum, $W42021Status, $W42021DepNum, $encryptMW4DriverLicNum, $MW4HireCheck, $MW4DepNum, $phone, $MW4HireDate, $empId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../myInfo.php?error=none");

	// Decrypt the information after pushing it to the database so as to display properly
	$SSNdecrypt = decryptthis($encryptSSN, $key);
	$bankAccDecrypt = decryptthis($encryptbankAccNum, $key);
	$DLdecrypt = decryptthis($encryptMW4DriverLicNum, $key);
	
	
	session_start();
	$_SESSION["empId"] = $email;
	$_SESSION["email"] = $email;
	$_SESSION["ssn"] = $SSNdecrypt;
	$_SESSION["bankAccountNumber"] = $bankAccDecrypt;
	$_SESSION["W4MichiganDL"] = $DLdecrypt;
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





// Check for empty input login for Admin Login
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

// Check for empty input email for Employee Login
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


// Login Admin user into website
function loginUser($conn, $username, $pwd)
{
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	// creating a hashed-password variable, and setting it to the "pwd" that is associated
	// with the user ID that was found in the function uidExists(a,b);
	$pwdHashed = $uidExists["pwd"]; // will output the hashed version of the password
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

// Login employee into website
function loginEmployee($conn, $empEmail, $ssn, $key)
{
	// Email check
	$empEmailExists = empEmailExists($conn, $empEmail);

	if ($empEmailExists === false) {
		header("location: ../employeeLogin.php?error=wronglogin");
		exit();
	}

	$SSNencrypted = $empEmailExists["ssn"];
	// find the SSN that is paired with that email
	$SSNdecrypt = decryptthis($SSNencrypted, $key);

	// Final check to ensure that everything matches correctly
	if ($SSNdecrypt !== $ssn) {
		header("location: ../employeeLogin.php?error=wronglogin");
		exit();
	} else if ($SSNdecrypt === $ssn) {
		$bankAccDecrypt = decryptthis($empEmailExists["bankAccountNumber"], $key);
		$DLdecrypt = decryptthis($empEmailExists["W4MichiganDL"], $key);
		session_start();
		$_SESSION["empId"] = $empEmailExists["email"];
		$_SESSION["email"] = $empEmailExists["email"];
		$_SESSION["ssn"] = $SSNdecrypt;
		$_SESSION["bankAccountNumber"] = $bankAccDecrypt;
		$_SESSION["W4MichiganDL"] = $DLdecrypt;
		header("location: ../index.php?error=none");
		exit();
	}
}

// Encrypt sensitive info
function encryptthis($data, $key)
{
	$encryption_key = base64_decode($key);
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
	return base64_encode($encrypted . '::' . $iv);
}

// Decrypt sensitive info
function decryptthis($data, $key)
{
	$encryption_key = base64_decode($key);
	list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
	return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
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



