<?php
error_reporting(0);
include_once 'inc/functions.php'; 
session_start();
$email = $_SESSION['email'];
if($_SESSION['email']=='')
	{
		echo "<script>window.location='index.php';</script>";
	}
	
?>
<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
		<title>The medkart | Wishlist</title>
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
						<li>Wishlist</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<?php include'inc/left.php' ;?>							

							<!-- - - - - - - - - - - - - - End of compare - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1>Wishlist</h1>

							<header class="top_box on_the_sides">

								<div class="left_side v_centered">

									<p class="visible_pages">Showing 1 to 10 of 30 (3 pages)</p>

									<span>Show:</span> 

									<div class="custom_select">

										<select name="">

											<option value="10">10</option>
											<option value="9">9</option>
											<option value="8">8</option>
											<option value="7">7</option>
											<option value="6">6</option>
											<option value="5">5</option>
											<option value="4">4</option>
											<option value="3">3</option>
											<option value="2">2</option>
											<option value="1">1</option>

										</select>

									</div>

								</div>

								<div class="right_side">
								
									<ul class="pags">

										<li><a href="#"></a></li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#"></a></li>

									</ul>

								</div>

							</header><!--/ .top_box -->

							<div class="table_wrap">

								<table class="table_type_1 wishlist_table">
									 	
									<thead>
										
										<tr>
											
											<th class="product_image_col">Product Image</th>
											<th class="product_title_col">Product Name and Category</th>
											<th class="product_price_col">Price</th>
											<th class="product_qty_col">Quantity</th>
											<th>Action</th>

										</tr>

									</thead>

									<tbody>
                                    
                                    	<?php
					
$w_product=mysql_query("select * from wishlist where email='$email'");
while($ft_w_product=mysql_fetch_array($w_product))
{
	$w_pid=$ft_w_product['p_id'];
	$show_product=mysql_query("select * from products where id='$w_pid'");
	$ft_show_product=mysql_fetch_assoc($show_product);
 
?>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="add_cart.php?bid=<?php echo $ft_show_product['id'] ?>"><img src="<?php echo $ft_show_product['img'] ?>" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="add_cart.php?bid=<?php echo $ft_show_product['id'] ?>" class="product_title">Adipiscing aliquet sed in lacus, Liqui-gels 24</a>

												<a href="add_cart.php?bid=<?php echo $ft_show_product['id'] ?>">Beauty Clearance</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs5.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="add_cart.php?bid=<?php echo $ft_show_product['id'] ?>" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>
<?php } ?>
										<?php /*?><tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_5.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Sed in lacus ut enim adipiscing dictum elementum velit</a>

												<a href="#">Gift Sets</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs8.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_6.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Interdum vitae dapibus ac quisque diam lorem 160 ea</a>

												<a href="#">Makeup &amp; Accessories</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs76.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_10.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Adipiscing dictum elementum velit sed in lacus ut enim </a>

												<a href="#">Beauty Clearance</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total"><s>Rs29.99</s>Rs21.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_11.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Ut pharetra augue nec augue, Chocolate</a>

												<a href="#">Gift Sets</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total"><s>Rs19.99</s>Rs13.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_12.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Etiam cursus leo vel metus nulla facilisi Sponge, Deep Cleansing 1</a>

												<a href="#">Beauty Clearance</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total"><s>Rs5.99</s>Rs2.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_13.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Elementum velit sed in lacus, 100mg, Softgels 120 ea</a>

												<a href="#">Gift Sets</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs75.39</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_14.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Lorem ipsum dolor sit amet consectetuer adipis mauris 12 ea</a>

												<a href="#">Hair Care</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs24.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_15.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Sed in lacus ut enim adipiscing 30 ea</a>

												<a href="#">Beauty Clearance</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs5.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr>

										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												<a href="#"><img src="images/product_thumb_16.jpg" alt=""></a>

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												
												<a href="#" class="product_title">Sed ut perspiciatis unde omnis iste natus error sit, Medium 2.5 fl oz</a>

												<a href="#">Hair Care</a>

											</td>

											<!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

											<td data-title="Price" class="total">Rs5.99</td>

											<!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

											<td data-title="Quantity">
												
												<div class="qty min clearfix">

													<button class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="" value="1">
													<button class="theme_button" data-direction="plus">&#43;</button>

												</div><!--/ .qty.min.clearfix-->

											</td>

											<!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<td data-title="Action">

												<ul class="buttons_col">

													<li>
														<a href="#" class="button_blue">Add to Cart</a>
													</li>

													<li>
														<a href="#" class="button_dark_grey">Remove</a>
													</li>

												</ul>

											</td>

											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</tr><?php */?>

									</tbody>

								</table>

							</div><!--/ .table_wrap -->

							<footer class="bottom_box on_the_sides">

								<div class="left_side v_centered">

									<p class="visible_pages">Showing 1 to 10 of 30 (3 pages)</p>

									<span>Show:</span> 

									<div class="custom_select">

										<select name="">

											<option value="10">10</option>
											<option value="9">9</option>
											<option value="8">8</option>
											<option value="7">7</option>
											<option value="6">6</option>
											<option value="5">5</option>
											<option value="4">4</option>
											<option value="3">3</option>
											<option value="2">2</option>
											<option value="1">1</option>

										</select>

									</div>

								</div>
								
								<div class="right_side">

									<ul class="pags">

										<li><a href="#"></a></li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#"></a></li>

									</ul>

								</div>

							</footer><!--/ .bottom_box -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

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
		<script src="js/colorpicker/colorpicker.js"></script>
		<script src="js/retina.min.js"></script>

		<!-- Theme files
		============================================ -->
		<script src="js/theme.styleswitcher.js"></script>
		<script src="js/theme.plugins.js"></script>
		<script src="js/theme.core.js"></script>
		
	</body>
</html>
