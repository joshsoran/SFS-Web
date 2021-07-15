<?php
// DO NOT UPLOAD THIS FILE TO LIVE SERVERS!!!!!!!!
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "password";
$dBName = "sfsenoll_SFSdb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
