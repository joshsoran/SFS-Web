<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h1>Admin Log In</h1>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      <center><input type="text" name="uid" placeholder="Username..."><br><br>
      <input type="password" name="pwd" placeholder="Password..."></center>
      <button type="submit" name="submit">Log in</button>
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
