<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h1>Employee Log In</h1>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
    <center>
      <h2>Instructions:</h2>
      <h3>Enter email you signed up with.</h3>
      <h3>Enter SSN with dashes, EX: XXX-XX-XXXX</h3>
  </center><br>
      <center><input type="email" name="empEmail" placeholder="Enter Email..."><br><br>
      <input type="password" name="empSSN" placeholder="SSN: XXX-XX-XXXX"></center>
      <button type="submit" name="employeeLoginSubmit">Log in</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "wronglogin") {
        echo "<p>Wrong login!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
