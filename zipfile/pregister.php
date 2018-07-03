<?php session_start(); error_reporting(0); ?>

<?php include_once 'inc/functions.php' ;

if($_SESSION['email']!=''){

	header("location:myaccount.php");

}

?>
<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs ============================================ -->
		<title>Register</title>
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

						<li><a href="index.php">Home</a></li>
						<li>Register</li>

					</ul>

					<section class="section_offset">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">	<form class="type_2" method="post" action="">
						<h3 class="text-center">Create your account</h3>

						<div class="theme_box">						

						
								
								<ul>
									
									<li class="row">
										
										<div class="col-sm-6">
											
											<label for="first_name" class="required">First Name</label>
											<input type="text" name="" id="first_name" placeholder="Please enter first name"/>

										</div><!--/ [col] -->

										<div class="col-sm-6">
											
											<label for="last_name" class="required">Last Name</label>
											<input type="text" name="" id="last_name" placeholder="Please enter last name"/>

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row">

										<div class="col-sm-12">
											
											<label for="email_address" class="required">Email Address</label>
											<input type="text" name="" id="email_address" placeholder="Please enter your email id"/>

										</div><!--/ [col] -->

									</li><!--/ .row -->
									<li class="row">

										<div class="col-sm-12">

											<label for="phone" class="required">Phone</label>
											<input type="text" name="" id="phone" placeholder="Please enter your phone no."/>

										</div><!--/ [col] -->									

									</li><!--/ .row -->

<li class="row">

<div class="col-sm-12">

	<label for="cname" class="required">Company Name</label>
	<input type="text" name="" id="cname" placeholder="Please enter your company name"/>

</div><!--/ [col] -->									

</li><!--/ .row -->
									

									<li class="row">

<div class="col-sm-12">

	<label for="dl" class="required">D.L. No.</label>
	<input type="text" name="dl" id="dl" placeholder="Please enter your d.l. no."/>

</div><!--/ [col] -->
</li><!--/ .row -->
<li class="row">

<div class="col-sm-12">

	<label for="phone" class="required">Area of Interested</label>
	<input type="text" name="dl" id="dl" placeholder="Please enter your area of interested"/>

</div><!--/ [col] -->
</li><!--/ .row -->

									<li class="row">

										<div class="col-sm-6">

											<label for="password" class="required">Set Password</label>
											<input type="password" name="" id="password" placeholder="Please enter password"/>

										</div><!--/ [col] -->

										<div class="col-sm-6">

											<label for="confirm" class="required">Retype Password</label>
											<input type="password" name="" id="confirm" placeholder="Please confirm your password"/>

										</div><!--/ [col] -->

									</li><!--/ .row -->
									<li><hr/></li>
									<li class="row">
										

<div class="col-sm-6">
<div class="col-sm-1 col-xs-1 no-padding">
	<input type="checkbox" class="terms-check" name="terms"/ >
</div>
<div class="col-sm-11 col-xs-11 no-padding">
	<p>I accept <a href="">Terms & Conditions</a></p>
</div>
</div><!--/ [col] -->

<div class="col-sm-6">
<div style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;" class="g-recaptcha" data-sitekey="6LcM3VoUAAAAAFYOUFpjBYmQ8qGLs3oxx--0LsD7"></div>
</div><!--/ [col] -->

</li><!--/ .row -->
								</ul>
						</div>
						<footer class="bottom_box on_the_sides">

							<div class="left_side">
							<span class="prompt">Required Fields</span>	
							</div>

							<div class="right_side">
							<button type="submit" value="submit" name="submit" class="button_blue middle_btn">Submit</button>

							</div>

						</footer>
						</form>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-12 text-center">
						<br/>
						<h5>Already have an account? <a href="login.php" class="text-red">Login</a></h5></div>
						</div>
						

					</section>




				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			

			 <?php include'inc/footer.php' ;?>

		</div><!--/ [layout]-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="js/jquery.appear.js"></script>
		<script src="js/owlcarousel/owl.carousel.min.js"></script>
		<script src="twitter/jquery.tweet.min.js"></script>
		<script src="js/arcticmodal/jquery.arcticmodal.js"></script>
		<script src="js/jquery.countdown.plugin.min.js"></script>
		<script src="js/jquery.countdown.min.js"></script>
		<script src="js/colorpicker/colorpicker.js"></script>
		<script src="js/retina.min.js"></script>
		<script src="js/theme.plugins.js"></script>
		<script src="js/theme.core.js"></script>		
	</body>
    </html>