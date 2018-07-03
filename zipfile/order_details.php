<?php

session_start();

ob_start();

error_reporting(0);

include_once 'inc/functions.php';

$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if($_SESSION['email']==''){

	header("location:login.php?login_attempt=2");

}

if(isset($_SESSION['email'])){

	$username=$_SESSION['email'];

}

$username_id=$DB->fectchRecord("SELECT id from user where email='$username'");

$_SESSION['username_id']=$username_id['id'];
$order_confirm_id=(int)(str_replace("TD-","",$_GET['order']));
//echo $_GET['order'];
if(isset($_POST['ConfirmCancelation'])){

	if($_POST['reason']==1){
		$reason='I placed the wrong order';
	}
	else if($_POST['reason']==2){
		$reason='I am not available at home';
	}
	else if($_POST['reason']==3){
		$reason='Got a better deal on alternative website';
	}
	else if($_POST['reason']==4){
		$reason=$DB->escape($_POST['other_reason']);
	}else{
		header("location:logout.php");
	}
	$date=date('d-m-Y');

	//echo "UPDATE `order_confirm` SET `reason`='$reason',`can_date`='$date',order_status='-1' WHERE id='$order_confirm_id'";
	if($DB->executupdate("UPDATE `order_confirm` SET `reason`='$reason',`can_date`='$date',order_status='-1' WHERE id='$order_confirm_id' AND user_id='".$_SESSION['username_id']."'")){

		$order_id=$_GET['order'];
		$table= $DB->OrderDetails($order_confirm_id,$_SESSION['shippingcharges']);
		$body = "<div bgcolor='#f5f5f5' style='margin:0;padding:0'><div class='adM'>

		</div><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='padding:27px 20px 40px 20px;background-color:#f5f5f5;max-width:700px'>

		<table style='margin:0 auto' align='center' border='0' cellpadding='0' cellspacing='0' width='700'>

		<tbody><tr>

		<td width='600'>

		<table style='margin:0 auto;border:1px solid #d2d2d2;border-radius:5px' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

		<tbody><tr>

		<td style='border-top-left-radius:5px;border-top-right-radius:5px' bgcolor='#ffffff' height='21' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 19px 0 21px' align='right' bgcolor='#ffffff'>

		<table border='0' cellpadding='0' cellspacing='0' width='100%'>

			<tbody><tr>

				<td style='display:block' align='right' bgcolor='#ffffff'>

					<img src='The-medkart-logo1.png' alt='' border='0'>

				</td>

			</tr>

		</tbody></table>

		</td>

		</tr>

		<tr>

		<td bgcolor='#ffffff' height='12' width='600'></td>

		</tr>

		<tr>

		<td style='padding:0 50px 62px;border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>



		<table>

			<tbody><tr>

				<td bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td style='padding-bottom:49px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#292929;font-size:26px;line-height:1.2em;font-weight:bold' align='center' valign='top' width='600'>


Order cancelled $order_id

		</td>

					</tr>

					</tbody></table>

				</td>

			</tr>

			<tr>

				<td style='border-bottom-right-radius:5px;border-bottom-left-radius:5px' bgcolor='#ffffff'>

					<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>

						<tbody><tr>

							<td valign='top' width='100%'>



								<table border='0' cellpadding='0' cellspacing='0' width='100%'>

									<tbody><tr>

										<td style='padding:4px 0 15px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>





								</td></tr><tr>

										<td style='padding:7px 0 0px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a style='color:#0088cc;text-decoration:none'></a>

		<strong>$table</strong>



		<hr />

		Thank you.



		</td>

		</tr>

								<tr>

										<td style='padding:17px 0 19px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em'>

		<a href='javascript:void(0)'>The-medkart</a><br>



		</td>

		</tr>

								</tbody></table>

							</td>

						</tr>

					</tbody></table>

				</td>

			</tr>



		</tbody></table>

		</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";
		$DB->CodOrderMail($username,'Order cancelled '.$order_id,$body);
		$order_id='';
	// Send mail...

	}
}
if(isset($_POST['Orderagain'])){
	if($fetchOrderAgain=$DB->OrderAgain($username,$order_confirm_id)){
		header("location:checkout.php");
	}else{
		die('Error to Re-order..');
	}

	//print_r($fetchOrderAgain);
}
?>

<!doctype html>

<html lang="en">
		<head>

		<!-- Basic page needs

		============================================ -->

		<title>The medkart | Order #<?php echo $_GET['order']; ?></title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas

		============================================ -->

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Google web fonts

		============================================ -->

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

		<!-- Libs CSS

		============================================ -->

		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<!-- Theme CSS

		============================================ -->

		<link rel="stylesheet" href="js/arcticmodal/jquery.arcticmodal.css">
		<link rel="stylesheet" href="js/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" href="js/colorpicker/colorpicker.css">
		<link rel="stylesheet" href="css/style.css">

		<!-- jQuery Image Pop-over on Click -->

		<link rel="stylesheet" href="css/Image-Pop-over.css">
<style>
#cancel_div{
	display:none;
}
</style>
		<!-- JS Libs

		============================================ -->

		<script src="js/modernizr.js"></script>
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/queryloader2.min.js"></script>
		<script>



			$(document).ready(function(){



				$("body").queryLoader2({

	    			barHeight : 4,

	    			backgroundColor : '#fff',

	    			barColor : '#018bc8',

	    			minimumTime : 2000,

	    			onComplete : function(){



						// show promo popup

	    				if($.arcticmodal && $('body').hasClass('promo_popup')){

							$.arcticmodal({

								url : "modals/promo.html"

							});

						}



	    			}

	    		});



			});



		</script>

		<!-- Old IE stylesheet

		============================================ -->

		<!--[if lte IE 9]>

			<link rel="stylesheet" type="text/css" href="css/oldie.css">

		<![endif]-->

		</head>

		<body>

<!-- - - - - - - - - - - - - - Styleswitcher - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - end Styleswitcher - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

<div class="wide_layout">

          <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

          <?php include'inc/header.php' ;?>

          <!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

          <div class="secondary_page_wrapper">
    <div class="container">

              <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

              <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>My Orders</li>
      </ul>

              <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

              <div class="row">
        <aside class="col-md-3 col-sm-4">

                  <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

                  <?php include'inc/left.php' ;?>
                  <!--/ .section_offset -->

                </aside>
        <!--/ [col]-->

        <main class="col-md-9 col-sm-8" id='PrintElem'>
                  <h1>Order #<?php echo $_GET['order']; ?> </h1>

                  <!-- - - - - - - - - - - - - - Order table - - - - - - - - - - - - - - - - -->

                  <div class="section_offset">
            <header class="top_box">
                      <div class="buttons_row"> <a href="#" class="button_grey middle_btn">Reorder</a> <a href="#" onClick="PrintElem('PrintElem');"  class="button_grey middle_btn">Print Order</a>
                      <form method="post">
                      	<button type="submit" name="Orderagain" style="float: right;" class="button_grey middle_btn">Re-Order</button>
                      </form>
                      </div>
                    </header>

            <?php $sql = "SELECT ocf.id,ocf.user_id,ocf.pay,ocf.order_status,DATE_FORMAT(ocf.order_date, '%M %d %Y') as order_date,CONCAT(oad.title,' ',oad.fname,' ',oad.lname) as name,CONCAT(oad.address,', ',oad.street,' ',oad.lname) as address,CONCAT(oad.state,', ',oad.city,' , ',oad.pincode) as state, oad.phone,oad.email,(SELECT SUM(price*product_qty+ocf.shippingcharges) as price FROM `order_details` WHERE order_confirm_id=ocf.id  GROUP BY order_confirm_id ) as price,ocf.reason,DATE_FORMAT(ocf.can_date, '%M %d %Y') as can_date,ocf.shippingcharges FROM `order_confirm` ocf LEFT JOIN order_address oad ON oad.order_confirm_id=ocf.id ";

								$sql.= " where ocf.user_id='".$_SESSION['username_id']."' AND ocf.id='$order_confirm_id' order BY ocf.order_date DESC ";

								if($DB->numRows($sql)){

									$FetchOrderDetails=$DB->fectchRecord($sql);
									$cancel=0;
									$FetchOrderDetails["pay"]=($FetchOrderDetails["pay"]==0?'Cash On Delivery':'Online paied');
									if($FetchOrderDetails["order_status"]==1){
										$FetchOrderDetails["order_status"]='Pending';
									}
									else if($FetchOrderDetails["order_status"]==-1){
										$FetchOrderDetails["order_status"]='order is cancelled. ('.$FetchOrderDetails["reason"].' )';
										//$FetchOrderDetails["can_date"]
										$cancel=1;
									}

$_SESSION['shippingcharges']=$FetchOrderDetails['shippingcharges'];
									$table=$DB->OrderDetails($order_confirm_id,$_SESSION['shippingcharges']);

								?>
            <div class='table_wrap'>
                      <table class='table_type_1 order_table'>
                <tbody>
                          <tr>
                    <th>Order Number</th>
                    <td><?php echo $_GET['order']; ?></td>
                  </tr>
                          <tr>
                    <th>Order Date</th>
                    <td><?php echo $FetchOrderDetails['order_date']; ?></td>
                  </tr>
                          <tr>
                    <th>Product Status</th>
                    <td><?php echo $FetchOrderDetails['order_status']; ?></td>
                  </tr>
                          <tr>
                    <th>Shipping Details</th>
                    <td><?php echo $FetchOrderDetails["name"].'<br />'.$FetchOrderDetails["phone"].'<br />'.$FetchOrderDetails["address"].' <br>'.$FetchOrderDetails["state"]; ?></td>
                  </tr>
                  <tr>
                    <th>Payment</th>
                    <td><?php echo $FetchOrderDetails['pay']; ?></td>
                  </tr>
                 <tr>
                    <th>Total</th>
                    <td class='total'><i class="icon-rupee"></i><?php echo round($FetchOrderDetails['price'], 2); ?></td>
                 </tr>
                        </tbody>
              </table>
              <?php if($cancel){
				  echo " <img src='./images/cancel.gif' />";

			} ?>

                    </div>
            <?php } ?>
          </div>
                  <br>
                  <?php /*?><div class="section_offset">



								<div class="row">



									<div class="col-md-6">



										<!-- - - - - - - - - - - - - - Bill to - - - - - - - - - - - - - - - - -->



										<section>



											<h3>Bill To</h3>



											<div class="table_wrap">



												<table class="table_type_1 order_table">



													<tbody>



														<tr>



															<th>Email</th>



															<td><a href="mailto:#">john.doe@gmail.com</a></td>



														</tr>



														<tr>



															<th>Company Name</th>



															<td>-</td>



														</tr>



														<tr>



															<th>Name</th>



															<td>John Doe</td>



														</tr>



														<tr>



															<th>Address</th>



															<td>Street Name 123</td>



														</tr>



														<tr>



															<th>Zip/Postal Code</th>



															<td>2000</td>



														</tr>



														<tr>



															<th>City</th>



															<td>New York</td>



														</tr>



														<tr>



															<th>Country</th>



															<td>USA</td>



														</tr>



														<tr>



															<th>State</th>



															<td>NY</td>



														</tr>



														<tr>



															<th>Phone</th>



															<td>876-54-32</td>



														</tr>



													</tbody>



												</table>



											</div>



										</section>



										<!-- - - - - - - - - - - - - - End of bill to - - - - - - - - - - - - - - - - -->



									</div><!--/ [col] -->



									<div class="col-md-6">



										<!-- - - - - - - - - - - - - - Ship to - - - - - - - - - - - - - - - - -->



										<section>



											<h3>Ship To</h3>



											<div class="table_wrap">



												<table class="table_type_1 order_table">



													<tbody>



														<tr>



															<th>Company Name</th>



															<td>-</td>



														</tr>



														<tr>



															<th>Name</th>



															<td>John Doe</td>



														</tr>



														<tr>



															<th>Address</th>



															<td>Street Name 123</td>



														</tr>



														<tr>



															<th>Zip/Postal Code</th>



															<td>2000</td>



														</tr>



														<tr>



															<th>City</th>



															<td>New York</td>



														</tr>



														<tr>



															<th>Country</th>



															<td>USA</td>



														</tr>



														<tr>



															<th>State</th>



															<td>NY</td>



														</tr>



														<tr>



															<th>Phone</th>



															<td>876-54-32</td>



														</tr>



													</tbody>



												</table>



											</div>



										</section>



										<!-- - - - - - - - - - - - - - End of ship to - - - - - - - - - - - - - - - - -->



									</div><!--/ [col] -->



								</div><!--/ .row -->



							</div><?php */?>
                  <!--/ .section_offset -->
                  <section class="section_offset"> <?php echo $table; ?>
            <footer class="bottom_box"> <a href="orders_list.php" class="button_grey middle_btn">Back to My Orders</a>
                      <?php
			if($FetchOrderDetails["order_status"]=='Pending' || $FetchOrderDetails["order_status"]=='Under Review' || $FetchOrderDetails["order_status"]=='Order Confirmed'){
			?>
                      <a href="javascript:void(0)" name='Cancel Order' onClick="CancelOrder();" style="float: right;" class="button_grey middle_btn">Cancel Order</a>
                      <?php } ?>
                    </footer>
            <?php /*?><table class="table_type_1 order_review">



										<thead>



											<tr>



												<th class="product_title_col">Product Name</th>

												<th class="product_sku_col">SKU</th>

												<th class="product_price_col">Price</th>

												<th class="product_qty_col">Quantity</th>

												<th class="product_total_col">Total</th>



											</tr>



										</thead>



										<tbody>



											<tr>



												<td data-title="Product Name">



													<a href="#" class="product_title">Adipiscing aliquet sed in lacus, Liqui-gels 24</a>



													<ul class="sc_product_info">



														<li>Size: Big</li>

														<li>Color: Red</li>



													</ul>



												</td>



												<td data-title="SKU">PS01</td>



												<td data-title="Price" class="subtotal">Rs5.99</td>



												<td data-title="Quantity">1</td>



												<td data-title="Total" class="total">Rs5.99</td>



											</tr>



											<tr>



												<td data-title="Product Name">



													<a href="#" class="product_title">Sed in lacus ut enim adipiscing dictum elementum velit<br>Relief 4.25 fl oz (126ml)</a>



													<ul class="sc_product_info">



														<li>Size: Big</li>

														<li>Color: Red</li>



													</ul>



												</td>



												<td data-title="SKU">PS02</td>



												<td data-title="Price" class="subtotal">Rs8.99</td>



												<td data-title="Quantity">1</td>



												<td data-title="Total" class="total">Rs8.99</td>



											</tr>



											<tr>



												<td data-title="Product Name">



													<a href="#" class="product_title">Donec porta diam eu massa quisque Mint 160 ea</a>



													<ul class="sc_product_info">



														<li>Size: Big</li>

														<li>Color: Red</li>



													</ul>



												</td>



												<td data-title="SKU">PS03</td>



												<td data-title="Price" class="subtotal">Rs76.99</td>



												<td data-title="Quantity">1</td>



												<td data-title="Total" class="total">Rs76.99</td>



											</tr>



										</tbody>



										<tfoot>



											<tr>



												<td colspan="4" class="bold">Subtotal</td>

												<td class="total">Rs146.87</td>



											</tr>



											<tr>



												<td colspan="4" class="bold">Shipping &amp; Heading (Flat Rate - Fixed)</td>

												<td class="total">Rs5.00</td>



											</tr>



											<tr>



												<td colspan="4" class="grandtotal">Grand Total</td>

												<td class="grandtotal">Rs151.87</td>



											</tr>



										</tfoot>



									</table><?php */?>
          </section>

                  <!-- - - - - - - - - - - - - - End of items ordered - - - - - - - - - - - - - - - - -->

                </main>
         <?php
		if($FetchOrderDetails["order_status"]=='Pending' || $FetchOrderDetails["order_status"]=='Under Review' || $FetchOrderDetails["order_status"]=='Order Confirmed'){
		?>
        <main class="col-md-9 col-sm-8" id='cancel_div'>
       		<h1>Cancel Order #<?php echo $_GET['order']; ?> </h1>
			<form method="post" onSubmit="return ConfirmCancelation1()">
            <div class="section_offset">
            	<section class="section_offset">
                    <div class="table_wrap">
                    <select name="reason" id="reason" onChange="ConfirmCancelation1()">
                    	<option value="0">Select Reason</option>
                    	<option value="1"> I placed the wrong order</option>
                        <option value="2">I am not available at home</option>
                        <option value="3">Got a better deal on alternative website</option>
                        <option value="4">Other</option>
                    </select>
                    <textarea style="display:none;" name="other_reason" id="other_reason"></textarea>
                    </div>
                </section>
            </div>
            <section class="section_offset"> <?php echo $table; ?>
            	<footer class="bottom_box">
                	<a href="javascript:void(0)" onClick="CancelOrderBack();" class="button_grey middle_btn">Back</a>
                    <button type="submit" style="float: right;" name="ConfirmCancelation" class="button_grey middle_btn" >Confirm Cancelation</button>
            	</footer>
            </section>
            </form>
        </main>
        <?php } ?>
      </div>
              <!--/ .row-->

            </div>
    <!--/ .container-->

  </div>
          <!--/ .page_wrapper-->

          <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

          <?php include'inc/footer.php' ;?>

          <!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

        </div>
<!--/ [layout]-->

<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->

<!-- Include Libs & Plugins

		============================================ -->

<script src="js/jquery.appear.js"></script>
<script src="js/owlcarousel/owl.carousel.min.js"></script>
<script src="twitter/jquery.tweet.min.js"></script>
<script src="js/arcticmodal/jquery.arcticmodal.js"></script>
<script src="js/colorpicker/colorpicker.js"></script>
<script src="js/retina.min.js"></script>

<!-- jQuery Image Pop-over on Click -->

<script src="js/Image-Pop-over.js"></script>

<!-- Theme files

		============================================ -->

<script src="js/theme.styleswitcher.js"></script>
<script src="js/theme.plugins.js"></script>
<script src="js/theme.core.js"></script>
<script>

        function PrintElem(elem)

		{

			var mywindow = window.open('', 'PRINT', 'height=400,width=600');



			mywindow.document.write('<html><head><title>' + document.title  + '</title>');

			mywindow.document.write('</head><body >');

			mywindow.document.write('<h1>' + document.title  + '</h1>');

			mywindow.document.write(document.getElementById(elem).innerHTML);

			mywindow.document.write('</body></html>');



			mywindow.document.close(); // necessary for IE >= 10

			mywindow.focus(); // necessary for IE >= 10*/



			mywindow.print();

			mywindow.close();



			return true;

		}
function CancelOrder(){
	$('#cancel_div').show(3000);
	$('#PrintElem').hide(3000);
}
function CancelOrderBack(){
	$('#PrintElem').show(3000);
	$('#cancel_div').hide(3000);
}
function ConfirmCancelation1(){
	var res=$('#reason').val();
	//alert(res);
	if(res==1||res==2||res==3){
		$('#other_reason').hide();
		$('#other_reason').val('');
		$("#other_reason").prop('required',false);
		return true;
	}else if(res==4){
		$("#other_reason").prop('required',true);
		$('#other_reason').show();
		var res_other=$('#other_reason').val();
		if(res_other!=''){
			return true;
		}else{
			$("#reason").css("border-color", "");
			$("#other_reason").focus();
			$("#other_reason").css("border-color", "red");
			//alert('reason');
			return false;
		}
	}else{
		$("#reason").focus();
		$("#reason").css("border-color", "red");
		return false;
	}
}
        </script>
</body>
</html>
