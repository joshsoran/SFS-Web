<?php
session_start();
require_once "includes/dbh.inc.php";
if (!isset($_SESSION["useruid"])) { // There must be nothing HTML related ABOVE this line
    header("location: error.php");
    exit();
}
include_once 'header.php';
require_once "includes/functions.inc.php";
$key = 'cHcabxgZDblOq1wlTEWEDZjT2JkbOgAaKobpXT1DbaR9zQ5K1HB1zEXJEuPK51oK';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
    th {
        color: #fff;
    }
    /* alternate row color */
    tr:nth-child(even) {background-color: #dde4eb;}
    tr:nth-child(odd) {background-color: #fff;}
</style>

<h1>Employee Information</h1>


<center>
    <label>Search: </label>
    <input class="input-search" id="search-input" type="text" placeholder="Employee name...">
</center>

<br>

<div class="emp-container">
    <table>
        <tr>
            <div class="emp-table-header">
                <th data-colname="name" data-order="desc">Name</th> <!-- Combine First Name + Middle Name + Last Name/!-->
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
                <th data-colname="W42019RelStatus" data-order="desc">W4 Relation Status</th>
                <th data-colname="W42019ClaimDependents" data-order="desc">W4-2019 Dependents Claim</th>
                <th data-colname="W42021ClaimDependents" data-order="desc">W4-2021 Dependents Claim</th>
                <th data-colname="W4MichiganDL" data-order="desc">W4-MI Driver's License Number</th>
                <th data-colname="W4MichiganNewEmployee" data-order="desc">W4-MI New Employee?</th>
                <th data-colname="W4MichiganHireDate" data-order="desc">W4-MI Hire Date</th>
                <th data-colname="W4MichiganDependents" data-order="desc">W4-MI Dependents</th>
            </div>
        </tr>
        <tbody id="myTable">

        </tbody>
    </table>
</div>


<?php

$ind = 0;
$empName = $_GET["empName"];
$sql = "SELECT * FROM empInfo;";
$result = mysqli_query($conn, $sql);
$resultCheck = $result->num_rows;
$empArray = array(
    "name" => array(), "DOB" => array(), "address" => array(), "city" => array(), "state" => array(), "zip" => array(), "email" => array(),
    "phone" => array(), "ssn" => array(), "bankAccountNumber" => array(), "bankRoutingNumber" => array(), "bankDirectDeposit" => array(), "W42019RelStatus" => array(), "W42019ClaimDependents" => array(),
    "W42021RelStatus" => array(), "W42021ClaimDependents" => array(), "W4MichiganDL" => array(), "W4MichiganNewEmployee" => array(), "W4MichiganHireDate" => array(), "W4MichiganDependents" => array()
);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $empArray["name"][$ind] = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName']; // use '.' to concatenate multiple strings
        $empArray["DOB"][$ind] = $row['DOB'];
        $empArray["address"][$ind] = $row['address'];
        $empArray["city"][$ind] = $row['city'];
        $empArray["state"][$ind] = $row['state'];
        $empArray["zip"][$ind] = $row['zip'];
        $empArray["email"][$ind] = $row['email'];
        $empArray["phone"][$ind] = $row['phone'];
        $empArray["ssn"][$ind] = decryptthis($row['ssn'],$key); // Decrypt the information
        $empArray["bankAccountNumber"][$ind] = decryptthis($row['bankAccountNumber'],$key); // Decrypt the information
        $empArray["bankRoutingNumber"][$ind] = $row['bankRoutingNumber'];
        $empArray["bankDirectDeposit"][$ind] = $row['bankDirectDeposit'];
        $empArray["W42019RelStatus"][$ind] = $row['W42019RelStatus'];
        $empArray["W42019ClaimDependents"][$ind] = $row['W42019ClaimDependents'];
        $empArray["W42021RelStatus"][$ind] = $row['W42021RelStatus'];
        $empArray["W42021ClaimDependents"][$ind] = $row['W42021ClaimDependents'];
        $empArray["W4MichiganDL"][$ind] = decryptthis($row['W4MichiganDL'], $key); // Decrypt the information
        $empArray["W4MichiganNewEmployee"][$ind] = $row['W4MichiganNewEmployee'];
        $empArray["W4MichiganHireDate"][$ind] = $row['W4MichiganHireDate'];
        $empArray["W4MichiganDependents"][$ind] = $row['W4MichiganDependents'];
        $ind++; // use this to increment inside the While loop
    }
}


?>

<script>
    // transfer object from PHP into JS
    var employeeArray = <?php echo json_encode($empArray); ?>;

    // Search
    // Keyup event using jquery
    $('#search-input').on('keyup', function() {
        var value = $(this).val()
        console.log('Value: ', value)
        var data = searchTable(value, employeeArray)
        console.log(data)
        //console.log(data["name"])
        buildTable(employeeArray, data)

    })

    buildTable(employeeArray, 0); // passing in the object-array as well as a value of 0 to indicate which for loop function to use

    function searchTable(value, data) {
        var filteredData = []

        for (var i = 0; i < data["name"].length; i++) {
            value = value.toLowerCase()
            var name = data["name"][i].toLowerCase()

            if (name.includes(value)) {
                filteredData.push(data["name"][i])
            }
        }

        return filteredData
    }

    function buildTable(data, secondData) {
        var table = document.getElementById('myTable')
        var searchBox = document.getElementById('search-input')
        table.innerHTML = ''
        if (secondData == 0 && searchBox.value.length == 0) { // Check to make sure there is no filtering data as well as search bar is empty
            for (var i = 0; i < data["name"].length; i++) { // measured array length by "name" because all employees are required to have a name
                var row = `<tr>
                                        <td>${data["name"][i]}</td>
                                        <td>${data["DOB"][i]}</td>
                                        <td>${data["address"][i]}</td>
                                        <td>${data["city"][i]}</td>
                                        <td>${data["state"][i]}</td>
                                        <td>${data["zip"][i]}</td>
                                        <td>${data["email"][i]}</td>
                                        <td>${data["phone"][i]}</td>
                                        <td>${data["ssn"][i]}</td>
                                        <td>${data["bankAccountNumber"][i]}</td>
                                        <td>${data["bankRoutingNumber"][i]}</td>
                                        <td>${data["bankDirectDeposit"][i]}</td>
                                        <td>${data["W42019RelStatus"][i]}</td>
                                        <td>${data["W42019ClaimDependents"][i]}</td>
                                        <td>$${data["W42021ClaimDependents"][i]}</td>
                                        <td>${data["W4MichiganDL"][i]}</td>
                                        <td>${data["W4MichiganNewEmployee"][i]}</td>
                                        <td>${data["W4MichiganHireDate"][i]}</td>
                                        <td>${data["W4MichiganDependents"][i]}</td>
                                    </tr>`
                table.innerHTML += row
            }
        } else {
            // This section matches the elements from secondData to the elements of data so as to find the proper indicies.
            var indexArray = []; // indexArray.push(); --> to add to an array
            for (var i = 0; i < secondData.length; i++) {
                for (var j = 0; j < data["name"].length; j++) {
                    if (secondData[i] == data["name"][j]) {
                        indexArray.push(j)
                    }
                }
            }
            for (var i = 0; i < secondData.length; i++) { // 2021 Dependent claim has an extra $ in front because it shows dollar not because of code
                var row = `<tr>
                                        <td>${data["name"][indexArray[i]]}</td>
                                        <td>${data["DOB"][indexArray[i]]}</td>
                                        <td>${data["address"][indexArray[i]]}</td>
                                        <td>${data["city"][indexArray[i]]}</td>
                                        <td>${data["state"][indexArray[i]]}</td>
                                        <td>${data["zip"][indexArray[i]]}</td>
                                        <td>${data["email"][indexArray[i]]}</td>
                                        <td>${data["phone"][indexArray[i]]}</td>
                                        <td>${data["ssn"][indexArray[i]]}</td>
                                        <td>${data["bankAccountNumber"][indexArray[i]]}</td>
                                        <td>${data["bankRoutingNumber"][indexArray[i]]}</td>
                                        <td>${data["bankDirectDeposit"][indexArray[i]]}</td>
                                        <td>${data["W42019RelStatus"][indexArray[i]]}</td>
                                        <td>${data["W42019ClaimDependents"][indexArray[i]]}</td>
                                        <td>$${data["W42021ClaimDependents"][indexArray[i]]}</td>
                                        <td>${data["W4MichiganDL"][indexArray[i]]}</td>
                                        <td>${data["W4MichiganNewEmployee"][indexArray[i]]}</td>
                                        <td>${data["W4MichiganHireDate"][indexArray[i]]}</td>
                                        <td>${data["W4MichiganDependents"][indexArray[i]]}</td>
                                    </tr>`
                table.innerHTML += row
            }
        }
    }
</script>

<?php
include_once 'footer.php';
?>