<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h1>Employee Log In</h1>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      <center><input type="text" name="empEmail" placeholder="Enter Email..."><br>
      <input type="password" name="empSSN" placeholder="Enter SSN as password..."></center>
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
