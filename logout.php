<?php
header("location:logout");
exit;
session_start();
if(isset($_GET['p'])){
	$p=1;
}else{
	$p=0;
}
if(isset($_GET['q'])){
	if($_GET['q']=='1' && ($p==0)){
		$email=$_SESSION['email'];
		session_destroy();
		header("location:login.php?email=$email");
	}
	if($_GET['q']=='1' && ($p==1)){
		$email=$_SESSION['pemail'];
		session_destroy();
		header("location:plogin.php?email=$email");
	}
}else{
	session_destroy();
	header("location:index.php");

}

?>