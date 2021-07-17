<?php
include_once 'header.php';
?>
<link rel="stylesheet" href="css/inputField.css?ver=<?php echo rand(111, 999) ?>">
<link rel="stylesheet" href="css/base.css?ver=<?php echo rand(111, 999) ?>">
<section>
  <form action="includes/login.inc.php" method="post">
    <h1>Admin Log In</h1>
    <div class="wrapthis">
      <div class="logInputfield">
        <center>
          <input type="text" name="uid" placeholder="Username...">
          <div class="underline"></div>
          <br><br>
          <input type="password" name="pwd" placeholder="Password..."><br><br>
          <button class="button button--greip" type="submit" name="submit"><span><span>Login</span></span></button>
        </center>
      </div>
    </div>
  </form>
  <br><br><br><br><br><br><br><br><br>
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