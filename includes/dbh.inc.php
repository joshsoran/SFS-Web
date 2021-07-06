<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "Scooby12!";
$dBName = "SFSdb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
