<?php
$host = "localhost";
$username = "root";
$pass = "";
$db_name = "dbbook";
$con = mysqli_connect ($host, $username, $pass,$db_name);

if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
?>