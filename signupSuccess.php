<?php
header("refresh:5;url=index.php?");
include_once 'header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/loadComplete.css?ver=<?php echo rand(111, 999) ?>">

<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
  <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
  <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
</svg>
 <h2 style="color: #2dda7a; line-height: 0px; padding: 0px 0;">Success!</h2>
 <h2 style="color: #2dda7a; padding: 0px 0; font-size: 16px">Redirecting you to front page...</h2>

<?php
include_once 'footer.php';
?>