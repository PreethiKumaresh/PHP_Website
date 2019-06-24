<?php
session_start();
//$_SESSION['alogin']=="";
//session_unset();
//session_destroy();
$extra="php/bookhub/login.php";
$host  = $_SERVER['HTTP_HOST'];
header("location:http://$host/$extra");
$_SESSION['errmsg']="You have successfully logout !!";
exit();
?>
