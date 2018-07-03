<?php 
session_start();
unset($_SESSION['uname']);
unset($_SESSION['upass']);
unset($_SESSION['oname']);
unset($_SESSION['uemail']);
session_destroy() ;
header('location:login.php');


?>