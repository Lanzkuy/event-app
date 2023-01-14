<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "reglog";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
	echo "connect to database failed" . "<br><br>";
}
