<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
		<title>ShopMe | Manufacturer Page</title>
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
						<li><a href="shop_manufacturers.html">Manufacturers</a></li>
						<li>Manufacturer Name 1</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4 has_mega_menu">

							<!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h3>Categories</h3>

								<ul class="theme_menu cats">

									<li class="has_megamenu">

										<a href="#">Medicine &amp; Health (1375)</a>

										<!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

										<div class="mega_menu clearfix">

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">
											
												<ul class="list_of_links">

													<li><a href="#">Allergy &amp; Sinus</a></li>
													<li><a href="#">Children's Healthcare</a></li>
													<li><a href="#">Cough, Cold &amp; Flu</a></li>
													<li><a href="#">Diabetes Management</a></li>
													<li><a href="#">Digestion &amp; Nausea</a></li>
													<li><a href="#">Eye Care</a></li>
													<li><a href="#">First Aid</a></li>
													<li><a href="#">Foot Care</a></li>
													<li><a href="#">Health Clearance</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">

												<ul class="list_of_links">

													<li><a href="#">Home Health Care</a></li>
													<li><a href="#">Home Tests</a></li>
													<li><a href="#">Incontinence Aids</a></li>
													<li><a href="#">Natural &amp; Homeopathic</a></li>
													<li><a href="#">Pain &amp; Fever Relief</a></li>
													<li><a href="#">Skin Condition Treatments</a></li>
													<li><a href="#">Sleep &amp; Snoring aids</a></li>
													<li><a href="#">Stop Smoking Aids</a></li>
													<li><a href="#">Support &amp; Braces</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

										</div><!--/ .mega_menu-->

										<!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

									</li>
									<li class="has_megamenu">

										<a href="#">Beauty (1687)</a>

										<!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

										<div class="mega_menu type_2 clearfix">

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">
											
												<h6><b>By Category</b></h6>
											
												<ul class="list_of_links">

													<li><a href="#">Bath &amp; Spa</a></li>
													<li><a href="#">Beauty Clearance</a></li>
													<li><a href="#">Gift Sets</a></li>
													<li><a href="#">Hair Care</a></li>
													<li><a href="#">Makeup &amp; Accessories</a></li>
													<li><a href="#">Skin Care</a></li>
													<li><a href="#">Tools &amp; Accessories</a></li>
													<li><a href="#" class="all">View All Categories</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">

												<h6><b>By Brand</b></h6>
											
												<ul class="list_of_links">

													<li><a href="#">Abibas</a></li>
													<li><a href="#">Agedir</a></li>
													<li><a href="#">Aldan</a></li>
													<li><a href="#">Biomask</a></li>
													<li><a href="#">Gamman</a></li>
													<li><a href="#">Pallona</a></li>
													<li><a href="#">Pure Care</a></li>
													<li><a href="#" class="all">View All Brands</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">
												
												<a href="#">
													<img src="images/mega_menu_img_1.jpg" alt="">
												</a>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

										</div><!--/ .mega_menu-->

										<!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

									</li>
									<li class="has_megamenu">

										<a href="#">Personal Care (1036)</a>

										<!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

										<div class="mega_menu type_3 clearfix">

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">

												<ul class="list_of_links">

													<li><a href="#">Oral Care</a></li>
													<li><a href="#">Shaving &amp; Hair Removal</a></li>
													<li><a href="#">Men's</a></li>
													<li><a href="#">Sun Care</a></li>
													<li><a href="#">Clearance</a></li>
													<li><a href="#">Feminine Care</a></li>
													<li><a href="#">Gift Sets</a></li>
													<li><a href="#">Soaps &amp; Bodywash</a></li>
													<li><a href="#">Massage &amp; Relaxation</a></li>
													<li><a href="#">Foot Care</a></li>
													<li><a href="#" class="all">View All Categories</a></li>

												</ul>

											</div><!--/ .mega_menu_item -->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item products_in_mega_menu">

												<h6 class="widget_title"><b>Today's Deals</b></h6>

												<div class="row">

													<div class="col-sm-4">

														<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

														<div class="product_item">

															<!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

															<div class="image_wrap">

																<img src="images/product_img_11.jpg" alt="">

															</div><!--/. image_wrap-->

															<!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

															<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

															<div class="label_offer percentage">

																<div>30%</div>OFF

															</div>

															<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

															<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

															<div class="description">

																<p><a href="#">Metus nulla facilisi, Original 24 fl oz</a></p>

																<div class="clearfix product_info">

																	<p class="product_price alignleft"><s>$9.99</s> <b>$5.99</b></p>

																</div><!--/ .clearfix.product_info-->

															</div>

															<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

														</div><!--/ .product_item-->
														
														<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

													</div><!--/ [col]-->

													<div class="col-sm-4">

														<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

														<div class="product_item">

															<!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->
															
															<div class="image_wrap">

																<img src="images/product_img_12.jpg" alt="">

															</div><!--/. image_wrap-->

															<!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

															<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

															<div class="label_offer percentage">

																<div>25%</div>OFF

															</div>

															<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

															<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

															<div class="description">

																<p><a href="#">Donec porta diam eu massa diam lorem 29 ea</a></p>

																<div class="clearfix product_info">

																	<p class="product_price alignleft"><s>$16.99</s> <b>$14.99</b></p>

																</div><!--/ .clearfix.product_info-->

															</div>

															<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

														</div><!--/ .product_item-->
														
														<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

													</div><!--/ [col]-->

													<div class="col-sm-4">

														<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

														<div class="product_item">

															<!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->
															
															<div class="image_wrap">

																<img src="images/product_img_13.jpg" alt="">

															</div><!--/. image_wrap-->

															<!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

															<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

															<div class="label_offer percentage">

																<div>40%</div>OFF

															</div>

															<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

															<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

															<div class="description">

																<p><a href="#">Etiam cursus leo vel metus nulla facilisi...</a></p>

																<div class="clearfix product_info">

																	<p class="product_price alignleft"><s>$103.99</s> <b>$73.99</b></p>

																</div><!--/ .clearfix.product_info-->

															</div>

															<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

														</div><!--/ .product_item-->
														
														<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

													</div><!--/ [col]-->
													
												</div><!--/ .row-->

												<hr>

												<a href="#" class="button_grey">View All Deals</a>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

										</div><!--/ .mega_menu-->

										<!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

									</li>
									<li class="has_megamenu">

										<a href="#">Vitamins &amp; Supplements (202)</a>

										<!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

										<div class="mega_menu type_4 clearfix">

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">

												<h6><b>By Condition</b></h6>
											
												<ul class="list_of_links">

													<li><a href="#">Aches &amp; Pains</a></li>
													<li><a href="#">Acne Solutions</a></li>
													<li><a href="#">Allergy &amp; Sinus</a></li>
													<li><a href="#" class="all">View All</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">

												<h6><b>Multivitamins</b></h6>

												<ul class="list_of_links">

													<li><a href="#">50+ Multivitamins</a></li>
													<li><a href="#">Children's Multivitamins</a></li>
													<li><a href="#">Men's Multivitamins</a></li>
													<li><a href="#" class="all">View All</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_item">

												<h6><b>Herbs</b></h6>

												<ul class="list_of_links">

													<li><a href="#">Aloe Vera</a></li>
													<li><a href="#">Ashwagandha</a></li>
													<li><a href="#">Astragalus</a></li>
													<li><a href="#" class="all">View All</a></li>

												</ul>

											</div><!--/ .mega_menu_item-->

											<!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->

											<div class="mega_menu_banner">

												<a href="#">
													<img src="images/mega_menu_img_2.jpg" alt="">
												</a>

											</div><!--/ .mega_menu_banner-->

											<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

										</div><!--/ .mega_menu-->

										<!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

									</li>
									<li class="has_megamenu"><a href="#">Baby Needs (525)</a></li>
									<li class="has_megamenu"><a href="#">Diet &amp; Fitness (135)</a></li>
									<li class="has_megamenu"><a href="#">Sexuall Well-being (298)</a></li>
									<li class="has_megamenu"><a href="#" class="all"><b>All Categories</b></a></li>

								</ul>

							</section><!--/ .animated.transparent-->

							<!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1>Manufacturer Name 1</h1>

							<div class="theme_box">
								
								<img src="images/manufacturer_img_1.jpg" class="alignleft" alt="">

								<p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.</p>

								<p>Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. </p>

								<ul class="bottombar manufacturer_nav">

									<li><a href="#">Email</a></li>

									<li><a href="#">Manufacturer Page</a></li>

									<li><a href="#">View All Manufacturer Name 1 Products</a></li>

								</ul>

							</div>

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

			<?php include'inc/footer.php' ;?>
			
			<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

		</div><!--/ [layout]-->		
		
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
