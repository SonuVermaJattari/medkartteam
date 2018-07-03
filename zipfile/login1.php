<?php 
error_reporting(0);
//print_r($_SESSION);
include_once'inc/functions.php' ;
?>
<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
		<title>Login | The Dawakhana</title>
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

     <?php include'inc/header.php' ;?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.php">Home</a></li>
						<li>Login</li>

					</ul>

					<section class="section_offset">

					
					<div class="row">
					
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="relative">

							

							<div class="table_layout">

								<div class="table_row">

								

									<div class="table_cell">

										<section>

											<h4 class="text-center">Login</h4>

											<p class="subcaption text-center">Already registered? Please log in below:</p>

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
<span class="prompt">Required Fields</span>
</div>

																<div class="right_side">

																	<button type="submit" form="login_form" class="button_blue middle_btn">Login</button>

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
									<a href="#" class="small_link">Forgot your password?</a>
										

									</div><!--/ .table_cell -->

								</div><!--/ .table_row -->

							</div><!--/ .table_layout -->

						</div><!--/ .relative -->

						</div></div>

						<div class="col-md-3"></div>
						<div class="col-md-12 text-center">
						<br/>
						<h5>Already have an account? <a href="login.php" class="text-red">Login</a></h5></div>
						</div>
					</section><!--/ .section_offset -->

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
		
	</body>
    </html>