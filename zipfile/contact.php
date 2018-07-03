<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
<title>The medkart | Contact</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas
		============================================ -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="images/fav_icon.ico">

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

		<div class="wide_layout">

<?php include'inc/header.php' ;?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li>Contact Us</li>

					</ul>
<h1 class="page_title">Contact Us</h1>
					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<section class="section_offset theme_box">

								<p class="form_caption">Ut tellus dolor dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.</p>

											<ul class="c_info_list">

												<li class="c_info_location">8901 Marmora Road, Glasgow, D04 89GR.</li>
												<li class="c_info_phone">800-599-65-80</li>
												<li class="c_info_mail"><a href="mailto:#">info@companyname.com</a></li>
												<li class="c_info_schedule">

													<ul>

														<li>Monday-Friday: 8.00-20.00</li>
														<li>Saturday: 9.00-15.00</li>
														<li>Sunday: closed</li>

													</ul>

												</li>

											</ul>

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->


							<!-- - - - - - - - - - - - - - End of testimonials - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							

							<section class="section_offset">
								
								

								<div class="theme_box">

									

									<!-- - - - - - - - - - - - - - Contact form - - - - - - - - - - - - - - - - -->

									<form novalidate enctype="multipart/form-data" class="contactform type_2" id="contact_form">

										<ul>
										
											<li class="row">

												<div class="col-sm-6">
												
													<label for="cf_name" class="required">Name</label>
													<input type="text" required name="cf_name" id="cf_name" title="Name">

												</div><!--/ [col]-->

												<div class="col-sm-6">

													<label for="cf_email" class="required">Email Address</label>
													<input type="email" required name="cf_email" id="cf_email" title="Email">

												</div><!--/ [col]-->

											</li><!--/ .row -->

											<li class="row">

												<div class="col-xs-12">

													<label for="cf_order_number">Order number</label>
													<input type="text" name="cf_order_number" id="cf_order_number" title="Order number">

												</div><!--/ [col]-->

											</li><!--/ .row -->

											<li class="row">

												<div class="col-xs-12">

													<label for="cf_message" class="required">Message</label>
													<textarea id="cf_message" required name="cf_message" title="Message" rows="6"></textarea>

												</div><!--/ [col]-->

											</li><!--/ .row -->

										</ul>

									</form><!--/ .contactform -->

									<!-- - - - - - - - - - - - - - End of contact form - - - - - - - - - - - - - - - - -->

								</div><!--/ .theme_box -->

								<footer class="bottom_box on_the_sides">

									<div class="left_side">
									
										<button class="button_dark_grey middle_btn" type="submit" form="contact_form">Submit</button>

									</div>

									<div class="right_side">

										<p class="prompt">Required Fields</p>

									</div>

								</footer>

							</section>

							

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
