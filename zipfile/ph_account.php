<?php
error_reporting(0);
include_once 'inc/functions.php';
?>
<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
		<title>Pharacist Account</title>
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
						<li>My Account</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<?php include'inc/pleft.php'?><!--/ .section_offset -->



							

							<!-- - - - - - - - - - - - - - End of compare - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1>My Dashboard</h1>

							<section class="theme_box">

								<h4>Hello, John Doe!</h4>

								<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>

							</section><!--/ .theme_box -->

							<!-- - - - - - - - - - - - - - Contact information - - - - - - - - - - - - - - - - -->

							<section class="theme_box">

								<h4>Contact Information</h4>

								<p>Company Name</p> 
								<p>8527458960</p>
								<p><a href="#" class="mail_to">manish.s@thewebtycoons.com</a></p>

								<div class="buttons_row">

									<a href="#" style="font-size: 13px;padding: 3px 10px;" class="button_grey middle_btn">Change Password</a>

								</div>

							</section><!--/ .theme_box -->

							<!-- - - - - - - - - - - - - - End of contact information - - - - - - - - - - - - - - - - -->
							
<!-- - - - - - - - - - - - - - Latest orders - - - - - - - - - - - - - - - - -->
							<section class="theme_box">

								<h4>Latest Orders</h4>

<div class="table_wrap">



								<table class="table_type_1 wishlist_table">
									<thead>
										<tr>
											<th width="10%">S.no.</th>
											<th width="30%">Name</th>
											<th width="20%">Order id</th>
											<th width="20%">Amount</th>
											<th width="10%">Status</th>
											<th width="10%"></th>
										</tr>
									</thead>
									<tbody>
									    <tr>
									   <td>1</td> 
									   <td>Manish Kumar</td>
									   <td>MDO10001-11</td>
									   <td><i class="icon-rupee"></i>300</td>
									   <td>Pending</td>
									   <td><a href="#" style="font-size: 13px;padding: 3px 10px;" class="button_grey middle_btn">View</a></td>
									    </tr>
									      <tr>
									   <td>2</td> 
									   <td>Manish Kumar</td>
									   <td>MDO10002-9</td>
									   <td><i class="icon-rupee"></i>150</td>
									   <td>Pending</td>
									   <td><a href="#" style="font-size: 13px;padding: 3px 10px;" class="button_grey middle_btn">View</a></td>
									    </tr>
									</tbody>
								</table>
</div><br/>
<div class="text-right"><a href="#" class="button_grey middle_btn">View More</a></div>

							</section><!--/ .theme_box -->
<!-- - - - - - - - - - - - - - end Latest orders - - - - - - - - - - - - - - - - -->

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