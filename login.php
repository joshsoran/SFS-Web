<?php
include_once 'header.php';
?>
<link rel="stylesheet" href="css/inputField.css?ver=<?php echo rand(111, 999) ?>">
<link rel="stylesheet" href="css/base.css?ver=<?php echo rand(111, 999) ?>">
<form action="includes/login.inc.php" method="post">
  <h1>Admin Log In</h1>
  <div class="wrapthis">
    <div class="logInputfield">
      <center>
        <input type="text" name="uid" placeholder="Username...">
        <div class="underline"></div>
        <br><br>
        <input type="password" name="pwd" placeholder="Password..."><br><br>
        <button class="button button--greip"type="submit" name="submit"><span><span>Login</span></span></button>
      </center>
    </div>
  </div>
</form>

<?php
// Error messages
if (isset($_GET["error"])) {
  if ($_GET["error"] == "emptyinput") {
    echo "<p>Fill in all fields!</p>";
  } else if ($_GET["error"] == "wronglogin") {
    echo "<p>Wrong login!</p>";
  }
}
?>

<?php
include_once 'footer.php';
?>