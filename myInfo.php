<?php
include_once 'header.php';
require_once "includes/dbh.inc.php";
if (!isset($_SESSION["email"])) {
    header("location: employeeAccessError.php");
    exit();
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
    th {
        color: #fff;
    }
</style>
<section class="signup-form">
    <h1><?php echo $_SESSION["email"] ?></h1>
</section>
<br>

<div class="emp-container">
    <table>
        <tr>
            <th data-colname="empID" data-order="desc">ID</th>
            <th class="bg-info" data-colname="fName" data-order="desc">First Name</th> <!-- Combine First Name + Middle Name + Last Name/!-->
            <th data-colname="mName" data-order="desc">Middle Name</th>
            <th data-colname="lName" data-order="desc">Last Name</th>
            <th data-colname="DOB" data-order="desc">Date of Birth</th>
            <th data-colname="address" data-order="desc">Address</th>
            <th data-colname="city" data-order="desc">City</th>
            <th data-colname="state" data-order="desc">State</th>
            <th data-colname="zip" data-order="desc">Zip</th>
            <th data-colname="email" data-order="desc">Email</th>
            <th data-colname="phone" data-order="desc">Phone</th>
            <th data-colname="ssn" data-order="desc">SSN</th>
            <th data-colname="bankAccountNumber" data-order="desc">Bank Account #</th>
            <th data-colname="bankRoutingNumber" data-order="desc">Bank Routing #</th>
            <th data-colname="bankDirectDeposit" data-order="desc">Bank Direct Deposit</th>
            <th data-colname="W42019RelStatus" data-order="desc">W4-2019 Relation Status</th>
            <th data-colname="W42019ClaimDependents" data-order="desc">W4-2019 Dependents Claim</th>
            <th data-colname="W42021RelStatus" data-order="desc">W4-2021 Relation Status</th>
            <th data-colname="W42021ClaimDependents" data-order="desc">W4-2021 Dependents Claim</th>
            <th data-colname="W4MichiganDL" data-order="desc">W4-MI Driver's License Number</th>
            <th data-colname="W4MichiganNewEmployee" data-order="desc">W4-MI New Employee?</th>
            <th data-colname="W4MichiganHireDate" data-order="desc">W4-MI Hire Date</th>
            <th data-colname="W4MichiganDependents" data-order="desc">W4-MI Dependents</th>
        </tr>
        <tbody id="myTable">

        </tbody>
    </table>
</div>



<section class="signup-form">
    <div class="signup-form-form">
        <button type="submit" name="updateEmployeeInfo" onclick="saveInfo();">
            <center>Save</center>
        </button>
    </div>
    <h3>
        <center>After you are finished making your changes please press "Save", and when you are ready, "Update".</center>
    </h3>





    <div class="signup-form-form">
        <form action="includes/signup.inc.php" method="post">
            <input type="hidden" id="inpempId" name="empId">
            <input type="hidden" id="inpfName" name="fName">
            <input type="hidden" id="inpmName" name="mName">
            <input type="hidden" id="inplName" name="lName">
            <input type="hidden" id="inpDOB" name="DOB">
            <input type="hidden" id="inpAdd" name="address">
            <input type="hidden" id="inpCit" name="city">
            <input type="hidden" id="inpState" name="state">
            <input type="hidden" id="inpZip" name="zip">
            <input type="hidden" id="inpEmail" name="email">
            <input type="hidden" id="inpPhone" name="employeePhone">
            <input type="hidden" id="inpSSN" name="ssn">
            <input type="hidden" id="inpBankAcc" name="bankAccNum">
            <input type="hidden" id="inpBankRouting" name="routingNum">
            <input type="hidden" id="inpBankDep" name="depositMethod">
            <input type="hidden" id="inpW42019Rel" name="W4p2019Status">
            <input type="hidden" id="inpW42019Dep" name="W4p2019numDep">
            <input type="hidden" id="inpW42021Rel" name="W42021Status">
            <input type="hidden" id="inpW42021Dep" name="W42021numDep">
            <input type="hidden" id="inpW4MIDL" name="MW4DLNum">
            <input type="hidden" id="inpW4MINewEmp" name="MW4HireCheck">
            <input type="hidden" id="inpW4MIHireDate" name="MW4HireDate">
            <input type="hidden" id="inpW4MIDep" name="MW4dependents">

            <button type="submit" id="updateButton" name="updateEmployeeInfo" disabled>
                <center>Update</center>
            </button>
        </form>
    </div>
    <?php
    // Error messages
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo '<p><span style="color:red;text-align:center;">Please fill in all fields.</span></p>';
        } else if ($_GET["error"] == "invaliduid") {
            echo '<p><span style="color:red;text-align:center;">Choose a proper username!</span></p>';
        } else if ($_GET["error"] == "invalidemail") {
            echo '<p><span style="color:red;text-align:center;">Choose a proper email!</span></p>';
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo '<p><span style="color:red;text-align:center;">Passwords do not match!</span></p>';
        } else if ($_GET["error"] == "stmtfailed") {
            echo '<p><span style="color:red;text-align:center;">Something went wrong!</span></p>';
        } else if ($_GET["error"] == "usernametaken") {
            echo '<p><span style="color:red;text-align:center;">Username or email already taken!</span></p>';
        } else if ($_GET["error"] == "SSNtaken") {
            echo '<p><span style="color:red;text-align:center;">Someone else is signed up using that SSN!</span></p>';
        } else if ($_GET["error"] == "none") {
            echo '<p><span style="color:green;text-align:center;">Information updated successfully!</span></p>';
            header("refresh:3;url=login.php");
        }
    }
    ?>
</section>


<?php
$ind = 0;
$empName = $_GET["empName"];
$sql = "SELECT * FROM empInfo;";
$result = mysqli_query($conn, $sql);
$resultCheck = $result->num_rows;
$empID = 0;
$empArray = array(
    "fName" => array(), "mName" => array(), "lName" => array(), "DOB" => array(), "address" => array(), "city" => array(), "state" => array(), "zip" => array(), "email" => array(),
    "phone" => array(), "ssn" => array(), "bankAccountNumber" => array(), "bankRoutingNumber" => array(), "bankDirectDeposit" => array(), "W42019RelStatus" => array(), "W42019ClaimDependents" => array(),
    "W42021RelStatus" => array(), "W42021ClaimDependents" => array(), "W4MichiganDL" => array(), "W4MichiganNewEmployee" => array(), "W4MichiganHireDate" => array(), "W4MichiganDependents" => array()
);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] === $_SESSION["email"]) {
            // Grab the ID first
            $empID = $row["empId"];
            $empArray["fName"][0] = $row['firstName'];
            $empArray["mName"][0] = $row['middleName'];
            $empArray["lName"][0] = $row['lastName'];
            $empArray["DOB"][0] = $row['DOB'];
            $empArray["address"][0] = $row['address'];
            $empArray["city"][0] = $row['city'];
            $empArray["state"][0] = $row['state'];
            $empArray["zip"][0] = $row['zip'];
            $empArray["email"][0] = $row['email'];
            $empArray["phone"][0] = $row['phone'];
            $empArray["ssn"][0] = $row['ssn'];
            $empArray["bankAccountNumber"][0] = $row['bankAccountNumber'];
            $empArray["bankRoutingNumber"][0] = $row['bankRoutingNumber'];
            $empArray["bankDirectDeposit"][0] = $row['bankDirectDeposit'];
            $empArray["W42019RelStatus"][0] = $row['W42019RelStatus'];
            $empArray["W42019ClaimDependents"][0] = $row['W42019ClaimDependents'];
            $empArray["W42021RelStatus"][0] = $row['W42021RelStatus'];
            $empArray["W42021ClaimDependents"][0] = $row['W42021ClaimDependents'];
            $empArray["W4MichiganDL"][0] = $row['W4MichiganDL'];
            $empArray["W4MichiganNewEmployee"][0] = $row['W4MichiganNewEmployee'];
            $empArray["W4MichiganHireDate"][0] = $row['W4MichiganHireDate'];
            $empArray["W4MichiganDependents"][0] = $row['W4MichiganDependents'];
        } else {
            $ind++;
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


?>

<script>
    // transfer object from PHP into JS
    var employeeArray = <?php echo json_encode($empArray); ?>;
    var empId = <?php echo json_encode($empID); ?>;
    buildTable(employeeArray); // passing in the object-array as well as a value of 0 to indicate which for loop function to use


    function buildTable(data) {
        var table = document.getElementById('myTable')

        table.innerHTML = ''

        var row = `<tr>
                                        <td id="empId">${empId}</td>
                                        <td contenteditable ='true' spellcheck="false" id="fName">${data["fName"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="mName">${data["mName"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="lName">${data["lName"][0]}</td>
                                        <td><input type="date" id="DOB" value= ${data["DOB"][0]}></td>
                                        <td contenteditable ='true' spellcheck="false" id="address">${data["address"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="city">${data["city"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="state">${data["state"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="zip" onkeypress="return onlyNumberKey(event)">${data["zip"][0]}</td></div>
                                        <td contenteditable ='true' spellcheck="false" id="email">${data["email"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="employeePhone" onkeypress="return onlyNumberKey(event)">${data["phone"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="ssn" onkeypress="return onlyNumberKey(event)">${data["ssn"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="bankAccNum" onkeypress="return onlyNumberKey(event)">${data["bankAccountNumber"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="routingNum" onkeypress="return onlyNumberKey(event)">${data["bankRoutingNumber"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="depositMethod">${data["bankDirectDeposit"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="W4p2019Status">${data["W42019RelStatus"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="W4p2019numDep" onkeypress="return onlyNumberKey(event)">${data["W42019ClaimDependents"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="W42021Status">${data["W42021RelStatus"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="W42021numDep" onkeypress="return onlyNumberKey(event)">${data["W42021ClaimDependents"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="MW4DLNum">${data["W4MichiganDL"][0]}</td>
                                        <td contenteditable ='true' spellcheck="false" id="MW4HireCheck">${data["W4MichiganNewEmployee"][0]}</td>
                                        <td><input type="date" id="MW4HireDate" value=${data["W4MichiganHireDate"][0]}></td>
                                        <td contenteditable ='true' spellcheck="false" id="MW4dependents" onkeypress="return onlyNumberKey(event)">${data["W4MichiganDependents"][0]}</td>
                                    </tr>`
        table.innerHTML += row
    }


    function saveInfo() {

        var empID = document.getElementById("empId").textContent;
        var firstName = document.getElementById("fName").textContent;
        var middleName = document.getElementById("mName").textContent;
        var lastName = document.getElementById("lName").textContent;
        var dateOfBirth = document.getElementById("DOB").value;
        var addr = document.getElementById("address").textContent;
        var cit = document.getElementById("city").textContent;
        var sta = document.getElementById("state").textContent;
        var zp = document.getElementById("zip").textContent;
        var empEmail = document.getElementById("email").textContent;
        var phone = document.getElementById("employeePhone").textContent;
        var empSsn = document.getElementById("ssn").textContent;
        var bAccNum = document.getElementById("bankAccNum").textContent;
        var rNum = document.getElementById("routingNum").textContent;
        var depMet = document.getElementById("depositMethod").textContent;
        var w42019stat = document.getElementById("W4p2019Status").textContent;
        var w42019numDep = document.getElementById("W4p2019numDep").textContent;
        var W42021stat = document.getElementById("W42021Status").textContent;
        var W42021numDep = document.getElementById("W42021numDep").textContent;
        var MW4DL = document.getElementById("MW4DLNum").textContent;
        var MW4HireCheck = document.getElementById("MW4HireCheck").textContent;
        var MW4HiDate = document.getElementById("MW4HireDate").value;
        var MW4dep = document.getElementById("MW4dependents").textContent;


        document.getElementById("inpempId").value = empID;
        document.getElementById("inpfName").value = firstName;
        document.getElementById("inpmName").value = middleName;
        document.getElementById("inplName").value = lastName;
        document.getElementById("inpDOB").value = dateOfBirth;
        document.getElementById("inpAdd").value = addr;
        document.getElementById("inpCit").value = cit;
        document.getElementById("inpState").value = sta;
        document.getElementById("inpZip").value = zp;
        document.getElementById("inpEmail").value = empEmail;
        document.getElementById("inpPhone").value = phone;
        document.getElementById("inpSSN").value = empSsn;
        document.getElementById("inpBankAcc").value = bAccNum;
        document.getElementById("inpBankRouting").value = rNum;
        document.getElementById("inpBankDep").value = depMet;
        document.getElementById("inpW42019Rel").value = w42019stat;
        document.getElementById("inpW42019Dep").value = w42019numDep;
        document.getElementById("inpW42021Rel").value = W42021stat;
        document.getElementById("inpW42021Dep").value = W42021numDep;
        document.getElementById("inpW4MIDL").value = MW4DL;
        document.getElementById("inpW4MINewEmp").value = MW4HireCheck;
        document.getElementById("inpW4MIHireDate").value = MW4HiDate;
        document.getElementById("inpW4MIDep").value = MW4dep;

        document.getElementById("updateButton").disabled = false;
        //console.log(document.getElementById("inpfName").value);

    }

    // Only allow numbers to be typed
    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    zipInput = document.querySelector('#zip');
    empPhoneInput = document.querySelector('#employeePhone');
    ssnInput = document.querySelector('#ssn');
    bankAccInput = document.querySelector('#bankAccNum');
    routingInput = document.querySelector('#routingNum');
    DLInput = document.querySelector('#MW4DLNum');

    settings = {
        maxLen: 5,
    }

    keys = {
        'backspace': 8,
        'shift': 16,
        'ctrl': 17,
        'alt': 18,
        'delete': 46,
        // 'cmd':
        'leftArrow': 37,
        'upArrow': 38,
        'rightArrow': 39,
        'downArrow': 40,
    }

    utils = {
        special: {},
        navigational: {},
        isSpecial(e) {
            return typeof this.special[e.keyCode] !== 'undefined';
        },
        isNavigational(e) {
            return typeof this.navigational[e.keyCode] !== 'undefined';
        }
    }

    utils.special[keys['backspace']] = true;
    utils.special[keys['shift']] = true;
    utils.special[keys['ctrl']] = true;
    utils.special[keys['alt']] = true;
    utils.special[keys['delete']] = true;

    utils.navigational[keys['upArrow']] = true;
    utils.navigational[keys['downArrow']] = true;
    utils.navigational[keys['leftArrow']] = true;
    utils.navigational[keys['rightArrow']] = true;

    zipInput.addEventListener('keydown', function(event) {
        let len = event.target.innerText.trim().length;
        hasSelection = false;
        selection = window.getSelection();
        isSpecial = utils.isSpecial(event);
        isNavigational = utils.isNavigational(event);

        if (selection) {
            hasSelection = !!selection.toString();
        }

        if (isSpecial || isNavigational) {
            return true;
        }

        if (len >= 5 && !hasSelection) {
            event.preventDefault();
            return false;
        }

    });

    empPhoneInput.addEventListener('keydown', function(event) {
        let len = event.target.innerText.trim().length;
        hasSelection = false;
        selection = window.getSelection();
        isSpecial = utils.isSpecial(event);
        isNavigational = utils.isNavigational(event);

        if (selection) {
            hasSelection = !!selection.toString();
        }

        if (isSpecial || isNavigational) {
            return true;
        }

        if (len >= 10 && !hasSelection) {
            event.preventDefault();
            return false;
        }

    });

    ssnInput.addEventListener('keydown', function(event) {
        let len = event.target.innerText.trim().length;
        hasSelection = false;
        selection = window.getSelection();
        isSpecial = utils.isSpecial(event);
        isNavigational = utils.isNavigational(event);

        if (selection) {
            hasSelection = !!selection.toString();
        }

        if (isSpecial || isNavigational) {
            return true;
        }

        if (len >= 9 && !hasSelection) {
            event.preventDefault();
            return false;
        }

    });

    bankAccInput.addEventListener('keydown', function(event) {
        let len = event.target.innerText.trim().length;
        hasSelection = false;
        selection = window.getSelection();
        isSpecial = utils.isSpecial(event);
        isNavigational = utils.isNavigational(event);

        if (selection) {
            hasSelection = !!selection.toString();
        }

        if (isSpecial || isNavigational) {
            return true;
        }

        if (len >= 9 && !hasSelection) {
            event.preventDefault();
            return false;
        }

    });

    routingInput.addEventListener('keydown', function(event) {
        let len = event.target.innerText.trim().length;
        hasSelection = false;
        selection = window.getSelection();
        isSpecial = utils.isSpecial(event);
        isNavigational = utils.isNavigational(event);

        if (selection) {
            hasSelection = !!selection.toString();
        }

        if (isSpecial || isNavigational) {
            return true;
        }

        if (len >= 8 && !hasSelection) {
            event.preventDefault();
            return false;
        }

    });

    DLInput.addEventListener('keydown', function(event) {
        let len = event.target.innerText.trim().length;
        hasSelection = false;
        selection = window.getSelection();
        isSpecial = utils.isSpecial(event);
        isNavigational = utils.isNavigational(event);

        if (selection) {
            hasSelection = !!selection.toString();
        }

        if (isSpecial || isNavigational) {
            return true;
        }

        if (len >= 13 && !hasSelection) {
            event.preventDefault();
            return false;
        }

    });
    //console.log(firstName);
</script>

<?php
include_once 'footer.php';
?>