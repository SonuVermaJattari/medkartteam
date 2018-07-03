<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FlyingCakes</title>
</head>

<body>
</body>
</html><?php
ini_set('display_errors', '0');
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");

ob_start();

@extract($_REQUEST);
include 'includes/functions.php';
include '../towords.php';
session_start();

$order_id=$_GET['order_id'];
$job=mysql_query("select * from ordered_history where Order_Id='$order_id'");

$fox=mysql_fetch_assoc($job);
		$bill_name=$fox['Name'];
		$bill_address=$fox['Address'];
		$bill_email=$fox['Email'];
		$bill_contact=$fox['Contact'];
		$bill_city=$fox['City'];
		$bill_state=$fox['State'];
		$bill_zip=$fox['Zip'];
		$bill_country=$fox['Country'];
	    $ship_name=$fox['SName'];
		$ship_address=$fox['SAddress'];
		$ship_email=$fox['SEmail'];
		$ship_contact=$fox['SContact'];
		$ship_city=$fox['SCity'];
		$ship_state=$fox['SState'];
		$ship_zip=$fox['SZip'];
		$ship_country=$fox['SCountry'];
$lux=mysql_query("select * from promocode_data where OrderId='$order_id'");
$joss=mysql_fetch_assoc($lux);
$such=mysql_query("select * from delivery_info where order_id='$order_id'");
$much=mysql_fetch_assoc($such);;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FlyingCakes</title>
<style>
body { font-family: calibri !important; font-size:15px;}
.brder6{ border-bottom:1px solid #666;}
.brder7{ border-right:1px solid #666;}
.brder8{ border-right:1px solid #666; border-left:1px solid #666;}
.brder5 {border-left:1px solid #666;  border-bottom:1px solid #666; }
.brder1 { border-top:1px solid #666; border-left:1px solid #666;}
.brder4 { border-top:1px solid #666; border-right:1px solid #666;}
.brder { border-top:1px solid #666; border-left:1px solid #666; border-right:1px solid #666;}
.brder-2 { border-top:1px solid #666; border-right:1px solid #666;}
.brder-3 { border-top:1px solid #666;}
td{ padding:5px; vertical-align:top;}
p{ margin:5px 0; padding:0px; }
.taxes { margin-top:7px; margin-bottom:11px;}
.main-div { width:800px; margin:0 auto;}
</style>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,500,600,700,800&amp;subset=all' rel='stylesheet' type='text/css'/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,500,600,700,800&amp;subset=all' rel='stylesheet' type='text/css'/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,500,600,700,800&amp;subset=all' rel='stylesheet' type='text/css'/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,500,600,700,800&amp;subset=all' rel='stylesheet' type='text/css'/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,500,600,700,800&amp;subset=all' rel='stylesheet' type='text/css'/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,500,600,700,800&amp;subset=all' rel='stylesheet' type='text/css'/>

</head>

<body>
<div class='main-div' align=center>
<table border='0' width='800'>
	<tr>
		<td width='131'><div class='uppr-div'>
        
<img src='http://www.flyingcakes.in/img/logo1.png' align='left'/>

</div></td>
		<td>

<h3 align='right'>Invoice  <?php if($much['delivery_status']=="Delivered" || $much['delivery_status']=="Cancelled" || $much['delivery_status']=="Returned") { echo $much['delivery_status']; } ?></h3></td>
			</tr>
</table>
<table cellpadding='5' cellspacing='0' width='800' border='1'>

<tr>
<td valign='top' width='30%' class='brder' rowspan='2'>
<span>Sender Detail</span>
<p><b>Flying Cakes</b></p>
<p style='font-size:12px;'>U-6/50, DLF Phase-III
Gurgaon Haryana-122002,
</p>
<p>Delhi - 110052<br/>
Ph No:(+91)8130596636</p>
<p>Email : flyingcakes2006@gmail.com</p>
</td>
<td valign='top' width='30%' class='brder-2'>
<span>Invoice No.</span>
<p><b><?php echo $joss['Invoice_No'];?></b></p>
</td>
<td valign='top' width='30%' class='brder-2' rowspan='2'>
<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td  valign='top'><span>Date Of Order</span>
<p><b><?php $outdate=$joss['OderDate']; echo date("d-m-Y", strtotime($outdate));?></b></p></td>
</tr>
<tr>
<td  valign='top' class='brder-3'>
<span>Invoice Date </span>
<p><b><?php echo date("d-m-Y", strtotime($outdate));?></b></p>
</td></tr>
</table>
</td>
</tr>
<tr>
<td valign='top' width='30%' class='brder-2'>
<span>Order No.</span>
<p align='center' style='font-size:12px;'><?php echo $order_id;?></p>

</td>
</tr>
<tr>
<td valign='top' width='30%' class='brder' rowspan='4'>
<span>Billing Address</span>

<p><b><?php echo $bill_name;?></b></p>
<p style='font-size:12px;'><?php echo $bill_address.", ".$bill_state.",".$bill_country;?></p>
<p><?php echo $bill_city ."-".$bill_zip;?><br/>
Ph No: <?php echo $bill_contact;?></p>
<p>Email :<?php echo $bill_email;?></p>
</td>
<td valign='top' width='30%' class='brder' rowspan='4'>
<span>Delivery Address</span>

<p><b><?php echo $ship_name;?></b></p>
<p style='font-size:12px;'><?php echo $ship_address.", ".$ship_state.",".$ship_country;?></p>
<p><?php echo $ship_city ."-".$ship_zip;?><br/>
Ph No: <?php echo $bill_contact;?></p>
<p>Email :<?php echo $ship_email;?></p>
</td>
<td valign='top' width='30%' class='brder-2'>
<span>Payment Mode</span>
<?php echo $joss['payment_mode']; ?>
</td>
</tr>
<tr>
<td valign='top' width='30%' class='brder-2'>
<span>Dispatch Through: </span>
<p><?php echo $much['courier_co'];?></p>
</td>
</tr>
<tr>
<td valign='top' width='30%' class='brder-2'>
<span>AWB No. </span>: <p><?php echo $much['awp_no'];?></p>
&nbsp;</td>
</tr>
<tr>
<td valign='top' width='30%' class='brder-2'>
<span>Portal</span>
<p>Flyingcakes.in</p>
</td>
</tr>
<tr>
<td colspan='3' style='padding:0px;'>
<table cellpadding='5' cellspacing='0' width='100%' border=1 RULES=COLS FRAME=VSIDES>
<tr>
<td width='6%' height='45' class='brder brder6' bgcolor='#EDEDEB'>S No.</td>
<td class='brder-2 brder6' align='center' width='30%' bgcolor='#EDEDEB'>
Item</td>
<td class='brder-2 brder6' width='9%' bgcolor='#EDEDEB'>Part No.</td>
<td class='brder-2 brder6' align='center' width='8%' bgcolor='#EDEDEB'>Quantity</td>
<td class='brder-2 brder6' align='center' width='14%' bgcolor='#EDEDEB'>Unit Price(Rs.)
</td>
<td class='brder-2 brder6' align='center' width='9%' bgcolor='#EDEDEB'>Price(Rs.)</td>
<!--<td class='brder-2 brder6' align='center' width='7%' bgcolor='#EDEDEB'>Tax(Rs.)</td>-->
<td class='brder-2 brder6' width='9%' align='center' bgcolor='#EDEDEB'>Total(Rs.)</td>
</tr>
<?php
$count=1;
$kob=mysql_query("select * from ordered_history where Order_Id='$order_id'");
while($rss=mysql_fetch_assoc($kob))
{

$taxamt=($grandtotal*$tax)/100;
$totqty=$totqty+$rss['qty'];

?>
<tr>
<td class=brder8><p><?php echo $count++; ?></p></td>
<td align=left  class=brder7><p><?php echo $rss['item_name']; ?></p></td>
<td  class=brder7><p><?php echo $rss['scc'];?></p></td>
<td align=center  class=brder7><p><b><?php echo $qty=$rss['qty'];?></b></p></td>
<td align=center  class=brder7><?php echo $mygt=$rss['grandtotal']-$taxamt;?></td>
<td align=center  class=brder7><?php echo $mygt*$rss['qty'];?></td>
<!--<td align=center  class=brder7><p><?php // echo $taxamt*$qty;?></p></td>-->
<td align=right  class=brder7><p><?php  echo $rss['final_amount'];?></p></td>
</tr>
<?php } ?>

<tr>
<td class='brder8'>
<p>&nbsp;</p>
</td>
<td align='left'  class='brder7'>
<div class='taxes'>
<p>&nbsp;</p>
<p align='right'><i>Shipping charge  </i></p>
<p align='right'><i>Discount Amount<br></i></p>
</div>
</td>
<td  class='brder7'>
<p>&nbsp;</p>
</td>
<td align='center'  class='brder7'>
<p>&nbsp;</p>
</td>
<td align='center'  class='brder7'>
<div class='taxes'>

</div>

</td>
<td align='center'  class='brder7'>
<div class='taxes'>

</div>

</td>
<!--<td align='center'  class='brder7'>
<div class='taxes'>
<p>&nbsp;</p>
<p align='right'></p>
</div>

</td>-->
<td align='right'  class='brder7'>
<div class='taxes'>

<p align='right' class='brder-3'><?php echo $joss['Amount'];?></p>


<p align='right'><b><?php  echo $joss['shipping_charge'];?></b></p>
<p align='right'><b> - <?php echo $joss['Amount']+$joss['shipping_charge']-$joss['DiscountedAmt'];?></b></p>
</div>
</td>
</tr>

<tr>
<td class='brder' width='6%'>&nbsp;</td>
<td class='brder-2' align='right' width='30%'>
<p><b>Total Amount</b>(Inclusive of all taxes)</p>
</td>
<td class='brder-2'>&nbsp;</td>
<td class='brder-2' align="center"><?php echo $totqty;?></td>
<td class='brder-2'>&nbsp;</td>
<td class='brder-2'>&nbsp;</td>
<!--<td class='brder-2'>&nbsp;</td>-->
<td class='brder-2'><p align='right'><?php echo $allvalue=$joss['DiscountedAmt'];?></p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan='2' class='brder1'><p><?php
$obj    = new toWords($allvalue);
$upper = strtoupper($obj->words);
echo $upper;

?></p>
<br />




</td>
<td class='brder4'><p align='right'>E. &amp; O.E</p>


</td>
</tr>
<tr>
<td colspan='2' class='brder5'>
<p style='text-decoration:underline;'>Declaration</p>
<p>We declare that this invoice shows the actual price of the goods described
and that all particulars are true and correct.</p>
</td>
<td class='brder brder6'>
<p align='right'><b>For www.flyingcakes.in</b></p>
<p align='right'>&nbsp;</p>
<p align='right'>Authorized Signatory</p>
</td></tr>
</table>
<p><b>Prepared By &nbsp;: www.flyingcakes.in
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
This is a Computer Generated Invoice</p>
</div>
</body>
</html>
