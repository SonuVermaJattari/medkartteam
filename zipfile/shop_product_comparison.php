<!doctype html>
<html lang="en">

<head>
		<!-- Basic page needs
		============================================ -->
		<title>The medkart | Compare Products</title>
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
						<li>Compare Products</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<h1>Compare Products</h1>

					<div class="table_wrap">
						
						<table class="table_type_1 compare">

							<tbody>

								<tr>
									
									<th class="row_title_col">Product Image</th>

									<td>

										<a href="#"><img src="images/product_thumb_4.jpg" alt=""></a>

									</td>

									<td>

										<a href="#"><img src="images/product_thumb_5.jpg" alt=""></a>

									</td>

									<td>

										<a href="#"><img src="images/product_thumb_6.jpg" alt=""></a>

									</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Product Name</th>

									<td>

										<a href="#">Adipiscing aliquet sed in lacus, Liqui-gels 24</a>

									</td>

									<td>

										<a href="#">Quisque diam lorem, interdum vitae,dapibus ac</a>

									</td>

									<td>

										<a href="#">Interdum vitae dapibus ac quisque diam lorem 160 ea</a>

									</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Rating</th>

									<td>

										<div class="v_baseline">

											<ul class="rating">
												<li class="active"></li>
												<li class="active"></li>
												<li class="active"></li>
												<li class="active"></li>
												<li></li>
											</ul>

											<a href="#" class="small_link">3 Review(s)</a>

										</div>

									</td>

									<td>

										<div class="v_baseline">

											<ul class="rating">
												<li></li>
												<li></li>
												<li></li>
												<li></li>
												<li></li>
											</ul>

											<span class="small_link">0 Review(s)</span>

										</div>

									</td>

									<td>

										<div class="v_baseline">

											<ul class="rating">
												<li class="active"></li>
												<li class="active"></li>
												<li class="active"></li>
												<li></li>
												<li></li>
											</ul>

											<a href="#" class="small_link">5 Review(s)</a>

										</div>

									</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Price</th>

									<td class="total">$5.99</td>

									<td class="total">$8.99</td>

									<td class="total">$76.99</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Description</th>

									<td>
										
										<p>Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna.</p>

									</td>

									<td>
										
										<p>﻿Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros.</p>

									</td>

									<td>
										
										<p>﻿Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel. Cursus eleifend, elit. Aenean auctor wisi et urna.</p>

									</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Manufacturer</th>

									<td>
										
										<a href="#">Chanel</a>

									</td>

									<td>
										
										<a href="#">G&amp;D</a>

									</td>

									<td>
										
										<a href="#">Naiki</a>

									</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Availability</th>

									<td>
										
										<span class="in_stock">in stock</span> 20 item (s)

									</td>

									<td>
										
										<span class="out_of_stock">out of stock</span>

									</td>

									<td>
										
										<span class="in_stock">in stock</span> 28 item (s)

									</td>

								</tr>

								<tr>
									
									<th class="row_title_col">SKU</th>

									<td>PS06</td>

									<td>PS02</td>

									<td>PS23</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Size</th>

									<td>XL</td>

									<td>S</td>

									<td>L</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Color</th>

									<td>Red</td>

									<td>Green</td>

									<td>Blue</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Weight</th>

									<td>0,3 kg</td>

									<td>0,24 kg</td>

									<td>1,460 kg</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Dimensions<br>(L x W x H)</th>

									<td>40x20x74 Cm</td>

									<td>220x12x5 Cm</td>

									<td>140x230x120 Cm</td>

								</tr>

								<tr>
									
									<th class="row_title_col">Action</th>

									<td>

										<div class="buttons_row">
										
											<a href="#" class="button_blue middle_btn">Add to Cart</a>

											<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

											<a href="#" class="button_dark_grey middle_btn icon_btn tooltip_container"><span class="tooltip top">Remove from Compare</span><i class="icon-cancel-2"></i></a>

										</div>

									</td>

									<td>

										<div class="buttons_row">
											
											<a href="#" class="button_blue middle_btn">Add to Cart</a>

											<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

											<a href="#" class="button_dark_grey middle_btn icon_btn tooltip_container"><span class="tooltip top">Remove from Compare</span><i class="icon-cancel-2"></i></a>

										</div>

									</td>

									<td>

										<div class="buttons_row">
										
											<a href="#" class="button_blue middle_btn">Add to Cart</a>

											<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

											<a href="#" class="button_dark_grey middle_btn icon_btn tooltip_container"><span class="tooltip top">Remove from Compare</span><i class="icon-cancel-2"></i></a>

										</div>

									</td>

								</tr>

							</tbody>

						</table>

					</div>

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
