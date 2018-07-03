<?php
//include 'config.php';
include_once 'inc/functions.php';
session_start();
//ob_start();
$delId = $_GET['delId'];
if($delId!='')
{

$sql = "delete from products_added where username = '$delId'";
$result = mysql_query($sql);
$total = mysql_affected_rows();



	header("location:shopping_cart.php");
	//echo "<script>window.location='checkout.php'</script>";

}
?>