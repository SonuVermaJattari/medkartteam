<?php

session_start();

ob_start();

error_reporting(0);

$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include_once 'inc/functions.php';



if($_SESSION['email']==''){

	//header("location:login.php?login_attempt=2");

	echo "<script>window.location='login.php?login_attempt=2';</script>";

//	die;

}else{

	if(isset($_SESSION['email'])){

		$username=$_SESSION['email'];

	}

	$abc=$DB->check_prescription("select * from products_added where username='".$username."' order by id desc",$username);

	if($abc!='0'){

		$_SESSION['prescription_error']=$DB->error();

		header('Location: shopping_cart.php');

	}

}





//unset($_SESSION['checkout']);

$_SESSION['checkout_flag']=1;

/*if(!isset($_SESSION['checkout_flag'])){

	$_SESSION['checkout_flag']=1;

}*/







if(isset($_POST['Select'])){

	$Checkout_Address=mysql_query("SELECT a.title,a.fname,a.lname,a.address,a.street,a.phone,a.city,a.state,a.pincode,user.email FROM `address` a LEFT JOIN user ON user.id=a.u_id where user.email='$username' AND a.id='".$_POST['Address_hidden']."'");

	if((mysql_num_rows($Checkout_Address))>0){

		$row=mysql_fetch_assoc($Checkout_Address);
		$_SESSION['pincode']=$row['pincode'];
		$_SESSION['checkout']['Address']=json_encode($row);

		$_SESSION['checkout_flag']=2;

		unset($row);

		unset($_POST);

	}else{

		$error='Invalide Address';

	}

}

if(isset($_POST['NewAddress'])){

	unset($_POST['NewAddress']);

	$a=$DB->AddAddressInChechout($username,$_POST);
	$_SESSION['pincode']=$_POST['pincode'];
	if($a){

		foreach($_POST as $key=>$val){

			$_POST[$key]=$DB->escape($val);

		}

		$_POST['email']=$username;

		$_SESSION['checkout']['Address']=json_encode($_POST);

		$_SESSION['checkout_flag']=2;

		unset($_POST);

		unset($a);

	}else{

		$error='Invalide Address';

	}

}



if(isset($_POST['PaymentMethod'])){
	unset($_POST['PaymentMethod']);
	if(($_POST['PaymentType']=='cod')||($_POST['PaymentType']=='online')){
		$a=json_decode($_SESSION['checkout']['Address'],TRUE);
		$output=array_merge($a,array('PaymentType'=>$_POST['PaymentType']));
		$_SESSION['checkout']['Address']=json_encode($output);
		$_SESSION['checkout_flag']=3;
	}
	else{
		$error='Invalide Payment Method';
	}
}

//print_r($_SESSION);

?>

<!doctype html>

<html lang="en">

<head>

		<!-- Basic page needs

		============================================ -->

		<title>The medkart | Checkout</title>

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

		<style>

        /*.section_offset{

			display:none;

			}*/

        </style>

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



     <?php include'inc/header.php' ;?>



			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->



			<div class="secondary_page_wrapper">



				<div class="container">



					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->



					<ul class="breadcrumbs">



						<li><a href="index.html">Home</a></li>

						<li>Checkout</li>



					</ul>



					<h1 class="page_title">Checkout</h1>



					<!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->



					<?php /*?><section class="section_offset">



						<h3 class="offset_title">1. Checkout Method</h3>



						<div class="relative">



							<a class="icon_btn button_dark_grey edit_button" href="#"><i class="icon-pencil"></i></a>





							<div class="table_layout">



								<div class="table_row">



									<div class="table_cell">



										<section>



											<h4>Checkout as a Guest or Register</h4>



											<p class="subcaption">Register with us for future convenience:</p>



											<form>



												<ul>



													<li>



														<input type="radio" checked name="radio_2" id="radio_button_1">

														<label for="radio_button_1">Checkout as Guest</label>



													</li>



													<li>



														<input type="radio" name="radio_2" id="radio_button_2">

														<label for="radio_button_2">Register</label>



													</li>



												</ul>



											</form>



											<h5 class="sub bold">Register and save time!</h5>



											<p class="subcaption">Register with us for future convenience:</p>



											<ul class="list_type_7">



												<li>Fast and easy check out</li>

												<li>Easy access to your order history and status</li>



											</ul>



										</section>



									</div><!--/ .table_cell -->



									<div class="table_cell">



										<section>



											<h4>Login</h4>



											<p class="subcaption">Already registered? Please log in below:</p>



											<form id="login_form" class="type_2">



												<ul>



													<li class="row">



														<div class="col-xs-12">



															<label for="login_email" class="required">Email address</label>

															<input type="email" name="" id="login_email">



														</div>



													</li>



													<li class="row">



														<div class="col-xs-12">



															<label for="login_password" class="required">Password</label>

															<input type="password" name="" id="login_password">



														</div>



													</li>



													<li class="row">



														<div class="col-xs-12">



															<div class="on_the_sides">



																<div class="left_side">



																	<a href="#" class="small_link">Forgot your password?</a>



																</div>



																<div class="right_side">



																	<span class="prompt">Required Fields</span>



																</div>



															</div>



														</div>



													</li>



												</ul>



											</form>



										</section>



									</div><!--/ .table_cell -->



								</div><!--/ .table_row -->



								<div class="table_row">



									<div class="table_cell">



										<a href="#" class="button_blue middle_btn">Continue</a>



									</div><!--/ .table_cell -->



									<div class="table_cell">



										<div class="on_the_sides login_with">



											<div class="left_side">



												<button type="submit" form="login_form" class="button_blue middle_btn">Login</button>



											</div>







										</div>



									</div><!--/ .table_cell -->



								</div><!--/ .table_row -->



							</div><!--/ .table_layout -->



						</div><!--/ .relative -->



					</section><?php */?><!--/ .section_offset -->



					<!-- - - - - - - - - - - - - - End of checkout method - - - - - - - - - - - - - - - - -->



					<!-- - - - - - - - - - - - - - Billing information - - - - - - - - - - - - - - - - -->

					<!---->

                    <?php if($_SESSION['checkout_flag']==1){ ?>

					<section class="section_offset"  id='checkoutShipping'>





						<h3>1. Shipping Address</h3>



						<div class="theme_box" >







							 <?php

											$fetch="SELECT a.id,a.title,a.fname,a.lname,a.address,a.street,a.phone,a.city,a.state,a.pincode,user.email FROM `address` a LEFT JOIN user ON user.id=a.u_id where email='$username'";

											$res_address11=mysql_query($fetch);

											while($rs_address11=mysql_fetch_assoc($res_address11)){

												$d=$rs_address11['id'];

												?>

                                                <form action="" method="post" >

                                                <?php

												echo $rs_address11['title'].' '.$rs_address11['fname'].' '.$rs_address11['lname'].'<br>';

												echo $rs_address11['address'].'<br>';

												echo $rs_address11['street'].'<br>';

												echo $rs_address11['city'].', ';

												echo $rs_address11['state'].'<br>';

												echo 'pincode: '.$rs_address11['pincode'].'<br>';

												echo 'Phone number: '.$rs_address11['phone'].'<br>';

												?>

                                                <input type="hidden" name="Address_hidden"  value="<?php echo $d; ?>"/>

                                                 <input type="submit" name="Select" class='button_grey middle_btn' value="Select"/>

                                                 </form>

                                               <!-- <a href='javascript:void(0);' onClick="select_address('<?php echo $d; ?>','Old');" class='button_grey middle_btn'>Select</a>-->

                                                <?php

												//echo "<a href='javascript:void(0);' onClick='select_address($d,Old);' class='button_grey middle_btn'>Select</a>";

												echo '<hr>';

											}

											?>



						</div>



						<footer class="bottom_box on_the_sides">



							<div class="left_side">



								<a href='javascript:void(0);' onClick="select_address('0','New');" class="button_blue middle_btn">Add New Address</a>



							</div>







						</footer>



					</section><!--/ .section_offset -->



					<!-- - - - - - - - - - - - - - End of billing information - - - - - - - - - - - - - - - - -->



					<!-- - - - - - - - - - - - - - Shipping information - - - - - - - - - - - - - - - - -->



					<section class="section_offset" style="display:none" id='checkoutNewShipping'>



						<h3>1. New Shipping Address</h3>



						<div  class="theme_box">

			<form action="" name="myForm"  method="post" class="type_2" onSubmit="return validateForm()">

          <div class="theme_box">

            <ul>


             	<li class="row">

            		<div class="col-sm-6">

                  <label class="required">Title</label>

                  <div class="custom_select">

                    <select name="title" class="searchskill">

                      <option value="Mr." <?php echo $_SESSION['title']=='Mr.'?'selected':''; ?> >Mr.</option>

                      <option value="Mrs." <?php echo $_SESSION['title']=='Mrs.'?'selected':''; ?> >Mrs.</option>

                    </select>

                  </div>

                </div>

                </li>

              <li class="row">

                <div class="col-sm-6">

                <p id="fname"></p>

                  <label for="first_name" class="required">First Name</label>

                  <input class="searchskill" type="text" name="fname" value="<?php echo $_SESSION['firstname']; ?>" id="first_name">

                </div>



                <div class="col-sm-6">

                  <label for="last_name" class="required">Last Name</label>

                  <input type="text" class="searchskill" name="lname"  value="<?php echo $_SESSION['lastname']; ?>" id="last_name">

                </div>



              </li>

              <!--/ .row -->

             <!-- <li class="row">

                <div class="col-sm-12">

                  <label for="email_address" class="required">Email Address</label>

                  <input type="text" class="searchskill" name="email"  value="<?php echo $_POST['email']; ?>" id="email_address">

                </div>

              </li>-->

              <li class="row">

                <div class="col-sm-6">

                  <label for="telephone" class="required">Telephone</label>

                  <input type="text" class="searchskill" name="phone"  value="<?php echo $_SESSION['phone']; ?>" onKeyPress="return isNumber(event)" id="phone">

                </div>

              </li>





              <li class="row">

                <div class="col-xs-12">

                  <label for="address" class="required">Address</label>

                  <input type="text" class="searchskill" name="address"   value="<?php echo $_POST['address']; ?>" >

                </div>

                <div class="col-xs-12">

                 <label for="address" class="required">Street Address</label>

                  <input type="text"  name="street" class="searchskill"  value="<?php echo $_POST['street']; ?>" >

                </div>

                <!--/ [col] -->



              </li>

              <li class="row">

                <div class="col-sm-4">

                  <label for="city" class="required">City</label>

                  <input type="text" class="searchskill"  value="<?php echo $_POST['city']; ?>" name="city" id="city">

                </div>

                <!--/ [col] -->



                <div class="col-sm-4">

                  <label class="required">Country</label>

                  <div class="custom_select">

                    <select name="state" class="searchskill">

                      <option value="Alabama" <?php echo $_POST['state']=='Alabama'?'selected':''; ?> >Alabama</option>

                      <option value="Illinois" <?php echo $_POST['state']=='Illinois'?'selected':''; ?> >Illinois</option>

                      <option value="India" <?php echo $_POST['state']=='India'?'selected':''; ?>>India</option>

                    </select>

                  </div>

                </div>

                <div class="col-sm-4">

                  <label for="postal_code" class="required">Pin Code</label>

                  <input type="text" class="searchskill"  value="<?php echo $_POST['pincode']; ?>" name="pincode" onKeyPress="return isNumberPincode(event)" id="postal_code">

                </div>

                <!--/ [col] -->



              </li>

              <!--/ .row -->





              <!--/ .row -->





              <!--/ .row -->



            </ul>

          </div>

          <footer class="bottom_box on_the_sides">

            <div class="left_side">

              <button type="submit" name="NewAddress" class="button_blue middle_btn" value="Edit">Continue</button>

            </div>

            <div class="right_side"> <span class="prompt">Required Fields</span> </div>

          </footer>

			</form>

						</div>

					</section><!--/ .section_offset -->

					<?php } ?>

					<!-- - - - - - - - - - - - - - End of billing information - - - - - - - - - - - - - - - - -->



					<!-- - - - - - - - - - - - - - Shipping method - - - - - - - - - - - - - - - - -->



					<?php /*?><section class="section_offset">



						<h3>4. Shipping Method</h3>



						<div class="theme_box">



							<a class="icon_btn button_dark_grey edit_button" href="#"><i class="icon-pencil"></i></a>



							<ul class="shipping_method">



								<li>



									<p class="subcaption bold">Free Shipping</p>



									<input type="radio" checked name="radio_3" id="radio_button_3">

									<label for="radio_button_3">Free Rs.0</label>



								</li>



								<li>



									<p class="subcaption bold">Flat Rate</p>



									<input type="radio" name="radio_3" id="radio_button_4">

									<label for="radio_button_4">Standard Shipping Rs.5.00</label>



								</li>



							</ul>



						</div>



						<footer class="bottom_box">



							<a href="#" class="button_blue middle_btn">Continue</a>



						</footer>



					</section><?php */?>





					<!-- - - - - - - - - - - - - - End of shipping method - - - - - - - - - - - - - - - - -->

					<!-- - - - - - - - - - - - - - Payment information - - - - - - - - - - - - - - - - -->

					<?php if($_SESSION['checkout_flag']==2){ ?>

					<section class="section_offset" id='checkoutPayment'>



						<h3>2. Payment Method</h3>

						<form action="" method="post">

						<div class="theme_box">





							<p class="subcaption bold">Free Shipping</p>


							<ul class="simple_vertical_list">
                              <?php
							  if($fetcharray=$DB->WhichPaymentMethodVisible($username)){ ?>
								<li>
									<input type="radio" checked name="PaymentType" value="cod" id="radio_button_5">
									<label for="radio_button_5">COD</label>
								</li>
                              <?php } ?>
								<li>
                                <!--online-->
									<input type="radio" name="PaymentType" value="cod" id="radio_button_6">
									<label for="radio_button_6">Credit card (saved)</label>
								</li>



							</ul>



						</div>



						<footer class="bottom_box">



							<button type="submit" name="PaymentMethod" class="button_blue middle_btn" value="Edit">Continue</button>



						</footer>

                        </form>

					</section>

					<?php } ?>



					<!-- - - - - - - - - - - - - - End of payment information - - - - - - - - - - - - - - - - -->



					<!-- - - - - - - - - - - - - - Order review - - - - - - - - - - - - - - - - -->

					<?php if($_SESSION['checkout_flag']==3){ ?>

					<section class="section_offset" id='checkoutOrder'>



						<h3>3. Order Review</h3>



						<div class="table_wrap">



							<table class="table_type_1 order_review">



								<thead>



									<tr>



										<th class="product_title_col">Product Name</th>

										<!--<th class="product_sku_col">Manufacturer</th>-->

										<th class="product_price_col">Price</th>

										<th class="product_qty_col">Quantity</th>

										<th class="product_total_col">Total</th>



									</tr>



								</thead>



								<tbody>

									 <?php

										$ctr=0;

										$sql="select * from products_added where username='".$username."' order by id desc";

										$res=mysql_query($sql);

										$count=mysql_num_rows($res);

										if($count>0){

											$sumRs=0;

										while($rs=mysql_fetch_assoc($res)){

											$product_id=$rs['product_id'];

											$product_qty=$rs['product_qty'];

											$price_id=$rs['price_id'];

											$sqlproducts="SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name,so.name as solt,p.prescription FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id left JOIN solt so on p.solt=so.id where p.id='".$product_id."'";

											$resProducts=$DB->runQuery($sqlproducts);

											$resProducts=$resProducts[0];

											$sqlprice="SELECT * FROM `price`  where id='".$price_id."'";

											$resprice=$DB->runQuery($sqlprice);

											$resprice=$resprice[0];



									?>

									<tr>



										<td data-title="Product Name">



											<a href="<?php echo $resProducts['menu']=='1'?'product_details-medicine.php?q='.$resProducts['id']:'product_details.php?q='.$resProducts['id']; ?>" class="product_title"><?php echo $resProducts['name']; ?></a>

											<ul class="sc_product_info">



												<li><?php echo $resProducts['c_name']; ?></li>

                                                <?php echo $resProducts['solt']!=''?'<li>'.$resProducts['solt'].'</li>':''; ?>

												<li><?php echo $resprice['p_b1'].' '.$resProducts['p_b1name']; ?> in 1  <?php echo $resProducts['p_bname']; ?></li>



											</ul>

                                            <?php

										if($resProducts['prescription']=='1'){

											 echo '<img src="images/prescr-icon.png" style="width: 15px;">Prescription Required<br>';
											 if($rs['prescription_id']!='whatsapp'){
											$upload_prescriptionmqry="SELECT id,name,Img,DATE_FORMAT(upload_date, '%M %d %Y') as upload_date FROM `upload_prescription` where status='1' AND email='$username' AND id='".$rs['prescription_id']."' order by upload_date ";

                                                $upload_prescriptionfetch=mysql_query($upload_prescriptionmqry);

                                               $upload_prescriptionweb=mysql_fetch_assoc($upload_prescriptionfetch); ?>

                                               	 <img style="width: 10%;" src="<?php echo $upload_prescriptionweb['Img']; ?>">

                                                        <?php echo $upload_prescriptionweb['name']; ?> <?php echo $upload_prescriptionweb['upload_date']; ?>

                                                       <?php /*?> <a href="<?php echo $upload_prescriptionweb['Img']; ?>" target="_blank" title="<?php echo $upload_prescriptionweb['name']; ?>" /> View</a><?php */?>



                                                <?php



                                                }else{
													echo "prescription is uploaded on whatsapp";
												}
												}

                                                ?>

										</td>



										<!--<td data-title="SKU">PS01</td>-->



										<td data-title="Price" class="subtotal"><i class="icon-rupee"></i><?php echo $resprice['price']; ?></td>



										<td data-title="Quantity"><?php echo $product_qty; ?></td>

										<?php $sumRs=$sumRs+($product_qty*$resprice['price']); ?>

										<td data-title="Total" class="total"><i class="icon-rupee"></i><?php echo $product_qty*$resprice['price']; ?></td>



									</tr>

									  <?php  } } ?>

									<?php /*?><tr>



										<td data-title="Product Name">



											<a href="#" class="product_title">Sed in lacus ut enim adipiscing dictum elementum velit<br>Relief 4.25 fl oz (126ml)</a>



											<ul class="sc_product_info">



												<li>Size: Big</li>

												<li>Color: Red</li>



											</ul>



										</td>



										<td data-title="SKU">PS02</td>



										<td data-title="Price" class="subtotal">Rs.8.99</td>



										<td data-title="Quantity">1</td>



										<td data-title="Total" class="total">Rs.8.99</td>



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



										<td data-title="Price" class="subtotal">Rs.76.99</td>



										<td data-title="Quantity">1</td>



										<td data-title="Total" class="total">Rs.76.99</td>



									</tr><?php */?>



								</tbody>



								<tfoot>



									<tr>



										<td colspan="3" class="bold" align="right">Subtotal</td>

										<td class="total"><i class="icon-rupee"></i><?php echo $sumRs; ?></td>



									</tr>



									<tr>


										<td colspan="3" class="bold">Shipping Charges </td>

										<td class="total"><?php
										$shipping=$DB->WhichPaymentMethodShipping($_SESSION['pincode']);
											if($shipping){
												echo $shipping['shippingcharges']==0?'Free Shipping':'Rs. '.$shipping['shippingcharges'];
												$sumRs+=(int)$shipping['shippingcharges'];
											}else{
												echo 'Rs. 50';
												$sumRs+=50;
											} ?>
                                        </td>
									</tr>
									<tr>
										<td colspan="3" class="grandtotal" align="right">Grand Total</td>
										<td class="grandtotal"><i class="icon-rupee"></i><?php echo $sumRs; ?></td>
									</tr>
								</tfoot>
							</table>
						</div><!--/ .table_wrap -->
						<footer class="bottom_box on_the_sides">
							<div class="left_side v_centered">
								<a href="shopping_cart.php" class="button_grey middle_btn">Edit Your Cart</a>
							</div>
							<div class="right_side">
                            <form action="order_confirm.php" method="post">
                            	 <div class="col-sm-12">

                                  <label for="referralcode" class="required">Referral Code</label>

                                  <input type="text"  value="" name="referralCode" >

                                </div>
                            	<button type="submit" name="PlaceOrder" class="button_blue middle_btn" value="Place Order">Place Order</button>
                            </form>
							</div>
						</footer>
					</section>
					<?php } ?>

					<!-- - - - - - - - - - - - - - End of order review - - - - - - - - - - - - - - - - -->

			<!--	</form>-->

				</div><!--/ .container-->



			</div><!--/ .page_wrapper-->



			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->



			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->



			 <?php include'inc/footer.php' ;?>



			<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->



		</div><!--/ [layout]-->



		<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->



		<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->







		<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->



		<!-- Include Libs & Plugins

		============================================ -->

		<script src="js/jquery.appear.js"></script>

		<script src="js/owlcarousel/owl.carousel.min.js"></script>

		<script src="twitter/jquery.tweet.min.js"></script>

		<script src="js/arcticmodal/jquery.arcticmodal.js"></script>

		<script src="js/jquery.countdown.plugin.min.js"></script>

		<script src="js/jquery.countdown.min.js"></script>

		<script src="js/colorpicker/colorpicker.js"></script>

		<script src="js/retina.min.js"></script>

		<!-- Theme files

		============================================ -->

	<script src="js/theme.styleswitcher.js"></script>

		<script src="js/theme.plugins.js"></script>

		<script src="js/theme.core.js"></script>

		<script>

		function select_address(id,type){

			//alert(id);

			if(type=='New'){

				$('#checkoutShipping').hide(1000);

				$('#checkoutNewShipping').show(1000);

			}

			else if(type=='Old'){

				$('#checkoutShipping').hide(1000);

				$('#checkoutPayment').show(1000);



			}else{



			}

			//select_addressAjax(id,type);

		}

		function select_addressAjax(id,type){

			//alert(id+type);

			if (window.XMLHttpRequest) {

				// code for IE7+, Firefox, Chrome, Opera, Safari

				xmlhttp=new XMLHttpRequest();

			} else {  // code for IE6, IE5

				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

			}

			xmlhttp.onreadystatechange=function() {

				if (this.readyState==4 && this.status==200) {

					alert(this.responseText);

					//document.getElementById("LOAD_MORE").innerHTML='';

					//$('.LOAD_MORE').hide();

					//node.innerHTML = this.responseText;

					//document.getElementById("section_offset").appendChild(node);

				  //document.getElementById("section_offset").value=this.responseText;

				}

			}

			xmlhttp.open("GET","ajax/chechout_ajax.php?id="+id+"&&type="+type,true);

			xmlhttp.send();

		}

		//select_addressAjax();

		</script>

        <script>

function val(v){

	return document.forms["myForm"][v].value;

}



function validateForm() {

	var flag=0;

	var phone = val('phone');

//	var address = val('address');

	var city = val('city');

	var state = val('state');

	var pincode = val('pincode');

	var filteredList = $('.searchskill').filter(function() {

		if($(this).val()==''){

			$(this).css("border", "1px solid red");

		}else{

			$(this).css("border", "");

		}

    	return $(this).val() == "";

	});

	if (filteredList.length > 0) {

		flag=0;

	}else{

		flag=1;

	}



	if(phone!=''){

		if(!phonenumber(phone)){

			$('#phone').css("border", "1px solid red");

			flag=0;

		}else{

			$('#phone').css("border", "");

		}

	}



	if(flag==0){

		$('#cpass').css("border", "1px solid red");

		$('#pass').css("border", "1px solid red");

		//alert(0);

		return false;



	}

	else{

    	$('#cpass').css("border", "");

		$('#pass').css("border", "");

		//alert(1);

		return true;

	}

}

</script>

<!-- jQuery Image Pop-over on Click -->

<script src="js/Image-Pop-over.js"></script>



<script src="js/formValidation.js"></script>

	</body>

    </html>
