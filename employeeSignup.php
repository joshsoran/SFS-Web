<?php
include_once 'header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<section class="signup-form">
  <h1>Employee Signup</h1>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <h2>1. Personal</h2>
      <labelSpace>a. First Name</labelSpace>
      <input type="text" name="FName" placeholder="Enter first name here..." value='<?php echo $_GET["FName"] ?>'>
      <labelSpace>b. Middle Name</labelSpace>
      <input type="text" name="MName" placeholder="Enter middle name here..." value='<?php echo $_GET["MName"] ?>'>
      <labelSpace>c. Last Name</labelSpace>
      <input type="text" name="LName" placeholder="Enter last name here..." value='<?php echo $_GET["LName"] ?>'>
      <labelSpace>d. Date of Birth</labelSpace>
      <input type="date" name="DOB" value='<?php echo $_GET["DOB"] ?>'>
      <labelSpace>e. Address</labelSpace>
      <input type="text" name="address" placeholder="Enter address here..." value='<?php echo $_GET["address"] ?>'>
      <labelSpace>f. City</labelSpace>
      <input type="text" name="city" placeholder="Enter city here..." value='<?php echo $_GET["city"] ?>'>
      <labelSpace>g. State</labelSpace>
      <select id="state" name="state">
        <option value='<?php echo $_GET["state"] ?>'><?php echo $_GET["state"] ?></option>
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
      <input type="text" name="zip" placeholder="XXXXX" minlength="5" maxlength="5" onkeypress="return onlyNumberKey(event); return numberWithSpaces(event)" value='<?php echo $_GET["zip"] ?>'>
      <labelSpace>i. Phone number</labelSpace>
      <input type="text" name="employeePhone" id="empPhone" placeholder="(XXX)-XXX-XXXX" minlength="14" maxlength="14" onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["employeePhone"] ?>'>
      <labelSpace>j. Email Address</labelSpace>
      <input type="email" name="email" placeholder="example@company.com" value='<?php echo $_GET["email"] ?>'>
      <labelSpace>k. SSN</labelSpace>
      <input type="text" name="ssn" id="empSSN" placeholder="XXX-XX-XXXX" minlength="11" maxlength="11" onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["ssn"] ?>'>


      <h2>2. Banking</h2>
      <labelSpace>a. Bank Account #</labelSpace>
      <input type="text" name="bankAccNum" placeholder="Enter bank account number..." minlength="9" maxlength="17" onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["bankAccNum"] ?>'>
      <labelSpace>b. Routing #</labelSpace>
      <input type="text" name="routingNum" placeholder="XXXX-XXXXX" minlength="9" maxlength="9" onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["routingNum"] ?>'><br>
      <h3>It is mandatory for ALL employees to choose DIRECT DEPOSIT. Exceptions may apply.</h3>
      <input type="radio" name="depositMethod" value="Direct Deposit">
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
      <input type="text" name="W4p2019numDep" placeholder="Enter number of dependents..." onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["W4p2019numDep"] ?>'>


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
      <h3><i>Enter '0' if none</i></h3>
      <div class="dollar"><input type="number" name="W42021numDep" placeholder="Enter total $ here..." onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["W42021numDep"] ?>'></div>

      <h2>5. Michigan W-4</h2>
      <labelSpace>a. Driver's License Number</labelSpace>
      <input type="text" name="MW4DLNum" placeholder="Enter Driver's License # here..." spellcheck="false" value='<?php echo $_GET["MW4DLNum"] ?>'>
      <labelSpace>b. Are you a new employee?</labelSpace>
      <label for="chkYes">
        <input type="radio" id="chkYes" name="MW4HireCheck" onclick="ShowHideDiv()" value="Yes." />Yes.</label><br>
      <div id="dvtext" style="display: none"><label>Enter date of hire: </label>
        <input type="date" id="dateOfHire" name="MW4HireDate"/>
      </div>
      <label for="chkNo">
        <input type="radio" id="chkNo" name="MW4HireCheck" onclick="ShowHideDiv()" value="No." />No.</label><br><br>
      <labelSpace>c. Enter the number of personal and dependent exemptions </labelSpace>
      <input type="text" name="MW4dependents" placeholder="Enter number of dependents..." onkeypress="return onlyNumberKey(event)" value='<?php echo $_GET["MW4dependents"] ?>'>

      <h2>6. Agreement</h2>
      <labelSpace>By checking this box you are hereby agreeing that all this information is valid and yours.</labelSpace>
      <labelSpace><input type="checkbox" name="AgreementCheck" />I Agree.</labelSpace><br>

      <button type="submit" name="sendInfo" onsubmit="return false">Submit</button>
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
      echo '<p><span style="color:red;text-align:center;">Someone is already using that email!</span></p>';
    } else if ($_GET["error"] == "passwordsdontmatch") {
      echo '<p><span style="color:red;text-align:center;">Passwords do not match!</span></p>';
    } else if ($_GET["error"] == "stmtfailed") {
      echo '<p><span style="color:red;text-align:center;">Something went wrong!</span></p>';
    } else if ($_GET["error"] == "usernametaken") {
      echo '<p><span style="color:red;text-align:center;">Username or email already taken!</span></p>';
    } else if ($_GET["error"] == "SSNtaken") {
      echo '<p><span style="color:red;text-align:center;">Someone else is signed up using that SSN!</span></p>';
    } else if ($_GET["error"] == "invalidSSN") {
      echo "<p><span style='color:red;text-align:center;'>SSN cannot begin with the number 9!</span></p>";
    } else if ($_GET["error"] == "none") {
      echo '<p><span style="color:green;text-align:center;">You have signed up!</span></p>';
    }
  }
  ?>

</section>

<?php
include_once 'footer.php';
?>

<script>
  // var firstName = document.getElementsByName("FName")[0].value;
  // console.log(firstName);

  function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }

  function formatSocialSecurity(val){
	  val = val.replace(/\D/g, '');
	  val = val.replace(/^(\d{3})/, '$1-');
	  val = val.replace(/-(\d{2})/, '-$1-');
	  val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
	  return val;
  }  
  
  function formatPhone(val){
	  val = val.replace(/\D/g, '');
	  val = val.replace(/^(\d{3})/, '($1)-');
	  val = val.replace(/-(\d{3})/, '-$1-');
	  val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
	  return val;
  } 

  // Create spaces inside of characters
  $('#empSSN').on('keyup', function() {
        var value = $(this).val()
        console.log('Value: ', formatSocialSecurity(value))
        document.getElementById("empSSN").value = formatSocialSecurity(value);
    })
  $('#empPhone').on('keyup', function(){
    var value = $(this).val()
    document.getElementById("empPhone").value = formatPhone(value);
  })

  // Show hide function for Hire check
  function ShowHideDiv() {
    var chkYes = document.getElementById("chkYes");
    var dvtext = document.getElementById("dvtext");
    dvtext.style.display = chkYes.checked ? "block" : "none";
  }

  // Only allow numbers to be typed
  function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
      return false;
    return true;
  }
</script>