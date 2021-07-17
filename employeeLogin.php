<?php
include_once 'header.php';
?>
<link rel="stylesheet" href="css/inputField.css?ver=<?php echo rand(111, 999) ?>">
<link rel="stylesheet" href="css/base.css?ver=<?php echo rand(111, 999) ?>">
<form action="includes/login.inc.php" method="post">
  <h1 style="line-height: 0px; padding: 0px 0;">Employee Log In</h1><br>
  <div class="wrapthis">
    <div class="logInputfield">
      <center>
        <h2 style="line-height: 0px; padding: 0px 0;">Instructions:</h2><br>
        <h3>Enter the email you signed up with.</h3>
        <h3>Enter SSN with dashes, EX: XXX-XX-XXXX.</h3><br>
        <input type="email" name="empEmail" placeholder="Enter Email..."><br><br>
        <input type="password" name="empSSN" placeholder="SSN: XXX-XX-XXXX"><br><br>
        <button class="button button--greip" type="submit" name="employeeLoginSubmit"><span><span>Login</span></span></button>
      </center>
    </div>
  </div>
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
// Error messages
if (isset($_GET["error"])) {
  if ($_GET["error"] == "emptyinput") {
    echo '<center><p style="color:red;">Fill in all fields!</p></center>';
  } else if ($_GET["error"] == "wronglogin") {
    echo '<center><p style="color:red;">Wrong Login!</p></center>';
  }
}
?>
</section>

<?php
include_once 'footer.php';
?>