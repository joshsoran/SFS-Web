<?php
include_once 'header.php';
?>

<section class="signup-form">
  <h1>Employee Information</h1>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <h2>1. Personal</h2>
      <labelSpace>a. First Name</labelSpace>
      <input type="text" name="FName" placeholder="Enter first name here...">
      <labelSpace>b. Middle Name</labelSpace>
      <input type="text" name="MName" placeholder="Enter middle name here...">
      <labelSpace>c. Last Name</labelSpace>
      <input type="text" name="LName" placeholder="Enter last name here...">
      <labelSpace>d. Date of Birth</labelSpace>
      <input type="date" name="DOB">
      <labelSpace>e. Address</labelSpace>
      <input type="text" name="address" placeholder="Enter address here...">
      <labelSpace>f. City</labelSpace>
      <input type="text" name="city" placeholder="Enter city here...">
      <labelSpace>g. State</labelSpace>
      <select id="state" name="state">
        <option value="---">---</option>
        <option value="Alabama">Alabama</option>
        <option value="Alaska">Alaska</option>
        <option value="Arizona">Arizona</option>
        <option value="Arkansas">Arkansas</option>
        <option value="California">California</option>
        <option value="Colorado">Colorado</option>
        <option value="Connecticut">Connecticut</option>
        <option value="Delaware">Delaware</option>
        <option value="District of Columbia">District of Columbia</option>
        <option value="Florida">Florida</option>
        <option value="Georgia">Georgia</option>
        <option value="Guam">Guam</option>
        <option value="Hawaii">Hawaii</option>
        <option value="Idaho">Idaho</option>
        <option value="Illinois">Illinois</option>
        <option value="Indiana">Indiana</option>
        <option value="Iowa">Iowa</option>
        <option value="Kansas">Kansas</option>
        <option value="Kentucky">Kentucky</option>
        <option value="Louisiana">Louisiana</option>
        <option value="Maine">Maine</option>
        <option value="Maryland">Maryland</option>
        <option value="Massachusetts">Massachusetts</option>
        <option value="Michigan">Michigan</option>
        <option value="Minnesota">Minnesota</option>
        <option value="Mississippi">Mississippi</option>
        <option value="Missouri">Missouri</option>
        <option value="Montana">Montana</option>
        <option value="Nebraska">Nebraska</option>
        <option value="Nevada">Nevada</option>
        <option value="New Hampshire">New Hampshire</option>
        <option value="New Jersey">New Jersey</option>
        <option value="New Mexico">New Mexico</option>
        <option value="New York">New York</option>
        <option value="North Carolina">North Carolina</option>
        <option value="North Dakota">North Dakota</option>
        <option value="Northern Marianas Islands">Northern Marianas Islands</option>
        <option value="Ohio">Ohio</option>
        <option value="Oklahoma">Oklahoma</option>
        <option value="Oregon">Oregon</option>
        <option value="Pennsylvania">Pennsylvania</option>
        <option value="Puerto Rico">Puerto Rico</option>
        <option value="Rhode Island">Rhode Island</option>
        <option value="South Carolina">South Carolina</option>
        <option value="South Dakota">South Dakota</option>
        <option value="Tennessee">Tennessee</option>
        <option value="Texas">Texas</option>
        <option value="Utah">Utah</option>
        <option value="Vermont">Vermont</option>
        <option value="Virginia">Virginia</option>
        <option value="Virgin Islands">Virgin Islands</option>
        <option value="Washington">Washington</option>
        <option value="West Virginia">West Virginia</option>
        <option value="Wisconsin">Wisconsin</option>
        <option value="Wyoming">Wyoming</option>
      </select>
      <labelSpace>h. Zip</labelSpace>
      <input type="text" name="zip" placeholder="XXXXX" maxlength="5">
      <labelSpace>i. Phone number</labelSpace>
      <input type="text" name="employeePhone" placeholder="(XXX)-XXX-XXXX" maxlength="10">
      <labelSpace>j. Email Address</labelSpace>
      <input type="text" name="email" placeholder="example@company.com">
      <labelSpace>k. SSN</labelSpace>
      <input type="text" name="ssn" placeholder="XXX-XX-XXXX" maxlength="9">


      <h2>2. Banking</h2>
      <labelSpace>a. Bank Account #</labelSpace>
      <input type="text" name="bankAccNum" placeholder="XXXX-XXXX" maxlength="8">
      <labelSpace>b. Routing #</labelSpace>
      <input type="text" name="routingNum" placeholder="Enter routing number here"><br>
      <input type="radio" name="depositMethod" value="directDeposit">
      <label for="directDep">Direct Deposit</label>
      <input type="radio" name="depositMethod" value="Check">
      <label for="directDep">Check</label>


      <h2>3. W-4 Prior to 2019</h2>
      <labelSpace>a. Relationship Status</labelSpace>
      <div>
        <input type="radio" name="W4p2019Status" value="SMFS">
        <label for="html">Single or Married filing separately</label><br><br>
        <input type="radio" name="W4p2019Status" value="MFJQW">
        <label for="css">Married filing jointly or Qualifying widow(er)</label><br><br>
        <input type="radio" name="W4p2019Status" value="HOH">
        <label for="javascript">Head of household (Check only if you’re unmarried and pay more than half the costs of keeping up a home for yourself and a qualifying individual.)</label><br><br>
      </div>
      <labelSpace>b. Claim Dependents</labelSpace>
      <h3><i>Enter '0' if none.</i></h3>
      <input type="text" name="W4p2019numDep" placeholder="Enter number of dependents...">
      

      <h2>4. W-4 2021</h2>
      <labelSpace>a. Relationship Status</labelSpace>
      <input type="radio" name="W42021Status" value="SMFS">
      <label for="html">Single or Married filing separately</label><br><br>
      <input type="radio" name="W42021Status" value="MFJQW">
      <label for="css">Married filing jointly or Qualifying widow(er)</label><br><br>
      <input type="radio" name="W42021Status" value="HOH">
      <label for="javascript">Head of household (Check only if you’re unmarried and pay more than half the costs of keeping up a home for yourself and a qualifying individual.)</label><br><br>
      <labelSpace>b. Claim Dependents</labelSpace>
      <h3><i>(Multiply the number of qualifying children under age 18 by $3,000.</i></h3>
      <h3><i>Multiply the number of other dependents by $500.)</i></h3>
      <h3><i>Add the amounts above and enter the total here:</i></h3>
      <input type="text" name="W42021numDep" placeholder="Enter total $ here...">

      <h2>5. Michigan W4</h2>
      <labelSpace>a. Driver's License Number</labelSpace>
      <input type="text" name="MW4DLNum" placeholder="S-XXX-XXX-XXX-XXX" maxlength="13">
      <labelSpace>b. Are you a new employee?</labelSpace>
      <label for="chkYes">
        <input type="radio" id="chkYes" name="MW4HireCheck" onclick="ShowHideDiv()" value="Yes."/>Yes.</label><br>
      <div id="dvtext" style="display: none"><label>Enter date of hire: </label>
        <input type="date" id="dateOfHire" name="MW4HireDate" />
      </div>
      <label for="chkNo">
        <input type="radio" id="chkNo" name="MW4HireCheck" onclick="ShowHideDiv()" value="No."/>No.</label><br><br>
      <labelSpace>c. Enter the number of personal and dependent exemptions </labelSpace>
      <input type="text" name="MW4dependents" placeholder="Enter number of dependents...">

      <h2>6. Agreement</h2>
      <labelSpace>By checking this box you are hereby agreeing that all this information is valid and yours.</labelSpace>
        <labelSpace><input type="checkbox" name="AgreementCheck"  />I Agree.</labelSpace><br>

      <button type="submit" name="sendInfo">Submit</button>
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
      echo '<p><span style="color:green;text-align:center;">You have signed up!</span></p>';
      header("refresh:3;url=login.php");
    }
  }
  ?>
</section>

<?php
include_once 'footer.php';
?>

<script>
  function ShowHideDiv() {
    var chkYes = document.getElementById("chkYes");
    var dvtext = document.getElementById("dvtext");
    dvtext.style.display = chkYes.checked ? "block" : "none";
  }
</script>