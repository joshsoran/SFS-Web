<?php
include_once 'header.php';
?>
<!-- Stylesheet for copyright-free button effects -->
<link rel="stylesheet" href="css/base.css?ver=<?php echo rand(111, 999) ?>">
<!-- Draw verticle line down the middle -->
<div class="vl"></div>
<br><br>
<!-- Left side -->
<div id="divLeft">
    <h1>Employee Login</h1>
    <center>
    <form action="employeeLogin.php">
        <button class="button button--hyperion"><span><span>Go here!</span></span></button>
    </form>
    </center>
</div>

<!-- Right side -->
<div id="divRight">
    <h1>Admin Login</h1>
    <center>
    <form action="login.php">
        <button class="button button--hyperion"><span><span>Go here!</span></span></button>
    </form>
    </center>
</div>

<?php
include_once 'footer.php';
?>