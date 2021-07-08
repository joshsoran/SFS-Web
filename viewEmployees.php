<?php
include_once 'header.php';
require_once "includes/dbh.inc.php";

if (!isset($_SESSION["useruid"])){
    header("location: error.php");
    exit();
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    th {
        color: #fff;
    }
</style>
<section class="signup-form">
  <h1>Employee Information</h1>
</section>
<br>
<div class="row">
    <div class="col">
        <div class="card card-body">
            <input id="search-input" class="form-control" type="text" placeholder="Enter name here">
        </div>
    </div>
</div>

<table class="table table-striped">
    <tr class="bg-info">
        <th class="bg-info" data-colname="name" data-order="desc">Name</th> <!-- Combine First Name + Middle Name + Last Name/!-->
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
        $empArray["ssn"][$ind] = $row['ssn'];
        $empArray["bankAccountNumber"][$ind] = $row['bankAccountNumber'];
        $empArray["bankRoutingNumber"][$ind] = $row['bankRoutingNumber'];
        $empArray["bankDirectDeposit"][$ind] = $row['bankDirectDeposit'];
        $empArray["W42019RelStatus"][$ind] = $row['W42019RelStatus'];
        $empArray["W42019ClaimDependents"][$ind] = $row['W42019ClaimDependents'];
        $empArray["W42021RelStatus"][$ind] = $row['W42021RelStatus'];
        $empArray["W42021ClaimDependents"][$ind] = $row['W42021ClaimDependents'];
        $empArray["W4MichiganDL"][$ind] = $row['W4MichiganDL'];
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
                                        <td>${data["W42021RelStatus"][i]}</td>
                                        <td>${data["W42021ClaimDependents"][i]}</td>
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
            for (var i = 0; i < secondData.length; i++) {
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
                                        <td>${data["W42021RelStatus"][indexArray[i]]}</td>
                                        <td>${data["W42021ClaimDependents"][indexArray[i]]}</td>
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