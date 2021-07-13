<?php
  include_once 'header.php';
?>


<section class="signup-form">
  <h1>Admin Sign Up</h1>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <center><input type="text" name="uid" placeholder="Username..."><br><br>
      <input type="password" name="pwd" placeholder="Password..."><br><br>
      <input type="password" name="pwdrepeat" placeholder="Repeat password..."><br><br>
      <input type="text" name="authent" placeholder="Authentication code..."><br></center>
      <button type="submit" name="submit">Sign up</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a proper username!</p>";
      }
      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passwords doesn't match!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
      }
      else if ($_GET["error"] == "usernametaken") {
        echo "<p>Username already taken!</p>";
      }
      else if($_GET["error"] == "invalidAuth"){
        echo "<p>Invalid authentication key!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>You have signed up!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
