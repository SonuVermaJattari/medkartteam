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

if(isset($_POST['Orderagain'])){
	$order_confirm_id=(int)(str_replace("TD-","",$_POST['Orderagain_Id']));
	if($fetchOrderAgain=$DB->OrderAgain($username,$order_confirm_id)){
		header("location:checkout.php");
	}else{
		die('Error to Re-order..');
	}

	//print_r($fetchOrderAgain);
}

//let us find all orders of this usee

?>

<!doctype html>

<html lang="en">

<head>

		<!-- Basic page needs

		============================================ -->

		<title>The medkart | My Orders</title>

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

<link rel="stylesheet" href="css/pagination.css">

		<!-- JS Libs

		============================================ -->

		<script src="js/modernizr.js"></script>

		<script src="js/jquery-2.1.1.min.js"></script>

		<script src="js/queryloader2.min.js"></script>



		<script>





		</script>

<script>

function getresult(url) {

	$.ajax({

		url: url,

		type: "GET",

		data:  {rowcount:$("#rowcount").val(),"pagination_setting":'all-links'},

		beforeSend: function(){$("#overlay").show();},

		success: function(data){

		$("#pagination-result").html(data);

		//setInterval(function() {$("#overlay").hide(); },500);

		}, complete: function (data) {

		 $("#overlay").hide();



		 }

   });

}

    
    
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



							<?php include'inc/left.php' ;?><!--/ .section_offset -->



							<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->



							<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->







							<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->



						</aside><!--/ [col]-->



						<main class="col-md-9 col-sm-8">


							<h1>My Orders</h1>



							<div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div>

                            <div class="page-content">

                                <div id="pagination-result">

                                    <input type="hidden" name="rowcount" id="rowcount" />

                                </div>

                            </div>

							<?php ?><div class="table_wrap">



								<table class='table_type_1 orders_table'>



									<thead>



										<tr>



											<th class='order_number_col'>Order Number</th>

											<th>Order Date</th>

											<th class='ship_col'>Address</th>

											<th>Order Status</th>

                                            <th>Payment Type</th>

											<th class='order_total_col'>Total</th>

											<th class='product_action_col'>Action</th>



										</tr>



									</thead>





									<tbody>



<?php 
                                       
                                          $myorders=mysql_query("SELECT * FROM `order_confirm` oc INNER JOIN  order_address oa ON(oc.id=oa.order_confirm_id)  where oc.user_id=".$_SESSION['username_id']."  order By oc.id DESC");
	                                    


                                        while($myordersReslt=mysql_fetch_array($myorders)) {
                                        
                                            $phpdate = strtotime( $myordersReslt['order_date'] );

                                       $formatedDate = date("d/m/Y", $phpdate);
                                        
                                        ?>
                                        
                                       

									<tr>

                                      <td data-title='Order Number'><a href='#'><?php echo $myordersReslt['id']?></a></td>

                                      <td data-title='Order Date'><?php echo $formatedDate;?></td>

                                      <td data-title='Ship To'><?php echo $myordersReslt['fname']?> <?php echo $myordersReslt['lname']?>
                                        <br />
                                          <?php echo $myordersReslt['address']?>,<?php echo $myordersReslt['street']?>,<?php echo $myordersReslt['city']?>,
                                          <?php echo $myordersReslt['state']?>,<?php echo $myordersReslt['pincode']?>,<?php echo $myordersReslt['phone']?>
                                        </td>

                                      <td data-title='Order Status'><?php echo  $order_statusOptions[$myordersReslt['order_status']]; ?></td>

                                      <td data-title='Order Status'><?php echo $myordersReslt['PaymentType']?></td>

                                      <td data-title='Total' class='total'>Rs <?php echo $myordersReslt['grand_total']?></td>

                                      <td data-title='Action'><ul class='buttons_col'>

                                          <li> <a href='order_details.php?order_id=<?php echo $myordersReslt['id']?>' class='button_grey'>View Order</a> </li>

                                         <!-- <li> <a href='#' class='button_grey'>Reorder</a> </li>-->

                                        </ul>

                                      </td>

                                    </tr>

<?php } die; ?>







									</tbody>



								</table>



							</div>

							<footer class="bottom_box">



								<a href="index.php" class="button_grey middle_btn">Home</a>



							</footer><?php ?>



                            <!--/ .bottom_box -->



						</main><!--/ [col]-->



					</div><!--/ .row-->



				</div><!--/ .container-->



			</div><!--/ .page_wrapper-->





         <?php /*?>   <tr>



											<td data-title="Order Number"><a href="#">145000007</a></td>



											<td data-title="Order Date">9/5/2014</td>



											<td data-title="Ship To">John Doe</td>



											<td data-title="Order Status">Pending</td>



											<td data-title="Total" class="total">Rs5.99</td>



											<td data-title="Action">



												<ul class="buttons_col">



													<li>



														<a href="order_details.php" class="button_grey">View Order</a>



													</li>



													<li>



														<a href="#" class="button_grey">Reorder</a>



													</li>



												</ul>



											</td>



										</tr>



										<tr>



											<td data-title="Order Number"><a href="#">145000007</a></td>



											<td data-title="Order Date">9/5/2014</td>



											<td data-title="Ship To">John Doe</td>



											<td data-title="Order Status">Pending</td>



											<td data-title="Total" class="total">Rs5.99</td>



											<td data-title="Action">



												<ul class="buttons_col">



													<li>



														<a href="order_details.php" class="button_grey">View Order</a>



													</li>



													<li>



														<a href="#" class="button_grey">Reorder</a>



													</li>



												</ul>



											</td>



										</tr>



										<tr>



											<td data-title="Order Number"><a href="#">145000007</a></td>



											<td data-title="Order Date">9/5/2014</td>



											<td data-title="Ship To">John Doe</td>



											<td data-title="Order Status">Pending</td>



											<td data-title="Total" class="total">Rs5.99</td>



											<td data-title="Action">



												<ul class="buttons_col">



													<li>



														<a href="order_details.php" class="button_grey">View Order</a>



													</li>



													<li>



														<a href="#" class="button_grey">Reorder</a>



													</li>



												</ul>



											</td>



										</tr>



										<tr>



											<td data-title="Order Number"><a href="#">145000007</a></td>



											<td data-title="Order Date">9/5/2014</td>



											<td data-title="Ship To">John Doe</td>



											<td data-title="Order Status">Pending</td>



											<td data-title="Total" class="total">Rs5.99</td>



											<td data-title="Action">



												<ul class="buttons_col">



													<li>



														<a href="order_details.php" class="button_grey">View Order</a>



													</li>



													<li>



														<a href="#" class="button_grey">Reorder</a>



													</li>



												</ul>



											</td>



										</tr><?php */?>





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

		<script src="js/colorpicker/colorpicker.js"></script>

		<script src="js/retina.min.js"></script>



		<!-- Theme files

		============================================ -->

		<script src="js/theme.styleswitcher.js"></script>

		<script src="js/theme.plugins.js"></script>

		<script src="js/theme.core.js"></script>

		<script>

getresult("ajax/orders_list_getresult.php");

</script>

	</body>



</html>
