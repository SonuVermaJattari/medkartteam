<?php
error_reporting(0);
include_once '../inc/functions.php';
session_start();
$email = $_SESSION['pemail'];
if($_SESSION['pemail']==''){
	echo "<script>window.location='../index.php';</script>";
}

	if(isset($_GET['Delete'])){
		$id=(int)$_GET['del_address'];
		$del=mysql_query("SELECT address.id,user.email FROM `address` INNER JOIN user ON address.u_id = user.id where address.id='$id' && user.email='$email' AND user.fix='PID-'");
		if(mysql_num_rows($del)){
			mysql_query("DELETE FROM `address` WHERE address.id='$id'");
			echo "<script>window.location='myaccount.php';</script>";
		}
	}
	if(isset($_GET['default'])){
		 $id=(int)$_GET['def_address'].'<br>';
		 $resAdd=mysql_query("SELECT address.id,user.email,user.id as user_id,user.address_id FROM `address` INNER JOIN user ON address.u_id = user.id where address.id='$id' && user.email='$email' AND user.fix='PID-'");
		if(mysql_num_rows($resAdd)){
			$rsAdd=mysql_fetch_assoc($resAdd);
			//$address_id=$rsAdd['address_id'];
			//$id=$rsAdd['id'];
			$DB->executupdate("UPDATE `user` SET `address_id`='$id' WHERE id='".$rsAdd['user_id']."' AND fix='PID-'");
			//$DB->executupdate("UPDATE `address` SET `default_address`='0' WHERE id='".$address_id."'");
			//$DB->executupdate("UPDATE `address` SET `default_address`='1' WHERE id='".$id."'");
			echo "<script>window.location='myaccount.php';</script>";
		}

	}

	$fetch="select * from user where email='$email' AND fix='PID-'";
	$res=mysql_query($fetch);
	$rs_Myaccount=mysql_fetch_assoc($res);

?>
<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
		<title>The medkart | My Account</title>
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
		<link rel="stylesheet" href="../css/animate.css">
		<link rel="stylesheet" href="../css/fontello.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css">

		<!-- Theme CSS
		============================================ -->
		<link rel="stylesheet" href="../js/arcticmodal/jquery.arcticmodal.css">
		<link rel="stylesheet" href="../js/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" href="../js/colorpicker/colorpicker.css">
		<link rel="stylesheet" href="../css/style.css">

		<!-- JS Libs
		============================================ -->
		<script src="../js/modernizr.js"></script>
		<script src="../js/jquery-2.1.1.min.js"></script>
		<script src="../js/queryloader2.min.js"></script>

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
			<link rel="stylesheet" type="text/css" href="../css/oldie.css">
		<![endif]-->
	</head>
	<body>

		<!-- - - - - - - - - - - - - - Styleswitcher - - - - - - - - - - - - - - - - -->



<!-- - - - - - - - - - - - - - end Styleswitcher - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

		<div class="wide_layout">

			<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
			<?php include'../inc/header.php' ;?>

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

							<?php include'./inc/left.php'?><!--/ .section_offset -->





							<!-- - - - - - - - - - - - - - End of compare - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1>My Dashboard</h1>

							<section class="theme_box">

								<h4>Hello, <?php echo $rs_Myaccount['title'].' '.$rs_Myaccount['fname'].' '.$rs_Myaccount['lname']; ?></h4>

								<?php /*?><p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p><?php */?>

							</section><!--/ .theme_box -->

							<!-- - - - - - - - - - - - - - Contact information - - - - - - - - - - - - - - - - -->

							<section class="theme_box">

								<h4>Contact Information</h4>
                                <p>UID-<?php echo $rs_Myaccount['fix'].$rs_Myaccount['prefix'].$rs_Myaccount['post']; ?></p>
								<p><?php echo $rs_Myaccount['title'].' '.$rs_Myaccount['fname'].' '.$rs_Myaccount['lname']; ?><br><a href="#" class="mail_to"><?php echo $rs_Myaccount['email']; ?></a><br><?php echo $rs_Myaccount['gender']; ?>, Age: <?php echo $rs_Myaccount['age']; ?><br><?php echo $rs_Myaccount['phone']; ?><br>Password: <?php echo str_repeat("*",strlen($rs_Myaccount['pass'])); ?><br></p>

								<div class="buttons_row">

									<a href="../edit_account_information.php" class="button_grey middle_btn">Edit Account Information</a>

									<a href="../change_password.php" class="button_grey middle_btn">Change Password</a>

								</div>

							</section><!--/ .theme_box -->

							<!-- - - - - - - - - - - - - - End of contact information - - - - - - - - - - - - - - - - -->

							<div class="table_layout">

								<?php /*?><div class="table_row">

									<div class="table_cell">

										<!-- - - - - - - - - - - - - - Newsletter - - - - - - - - - - - - - - - - -->

										<section>

											<h4>Newsletter</h4>

											<p>You are currently not subscribed to any newsletter.</p>

											<a href="#" class="button_grey middle_btn">Edit Subscription</a>

										</section>

										<!-- - - - - - - - - - - - - - End of newsletter - - - - - - - - - - - - - - - - -->

									</div><!--/ .table_cell -->

									<div class="table_cell">

										<!-- - - - - - - - - - - - - - Address book - - - - - - - - - - - - - - - - -->

										<section>

											<h4>Address Book</h4>

											<a href="#" class="button_grey middle_btn">Manage Addresses</a>

										</section>

										<!-- - - - - - - - - - - - - - End of address book - - - - - - - - - - - - - - - - -->

									</div><!--/ .table_cell -->

								</div><?php */?><!--/ .table_row -->

								<div class="table_row">

									<div class="table_cell">

										<!-- - - - - - - - - - - - - - Default billing address - - - - - - - - - - - - - - - - -->

										<section>

											<h4>Default Address</h4>

											<p><?php

											$res_address=mysql_query("select * from address where id='".$rs_Myaccount['address_id']."'");
											$rs_address=mysql_fetch_assoc($res_address);
											echo $rs_address['title'].' '.$rs_address['fname'].' '.$rs_address['lname'].'<br>';
											echo $rs_address['address'].'<br>';
											echo $rs_address['street'].'<br>';
											echo $rs_address['city'].', ';
											echo $rs_address['state'].'<br>';
											echo 'pincode: '.$rs_address['pincode'].'<br>';
											echo 'Phone number: '.$rs_address['phone'].'<br>';
											?></p>

											<a href="../edit_address.php" class="button_grey middle_btn">Edit Address</a>

										</section>

										<!-- - - - - - - - - - - - - - End of default billing address - - - - - - - - - - - - - - - - -->

									</div><!--/ .table_cell -->

									<div class="table_cell">

										<!-- - - - - - - - - - - - - - Default shipping address - - - - - - - - - - - - - - - - -->

										<section>

											<h4>Shipping Address</h4><a href="../add_address.php" class="button_grey middle_btn">Add Address</a><br>

                                            <?php
											$res_address11=mysql_query("select * from address where id!='".$rs_Myaccount['address_id']."' AND u_id='".$rs_Myaccount['id']."'");
											while($rs_address11=mysql_fetch_assoc($res_address11)){
												$d=$rs_address11['id'];
												echo $rs_address11['title'].' '.$rs_address11['fname'].' '.$rs_address11['lname'].'<br>';
												echo $rs_address11['address'].'<br>';
												echo $rs_address11['street'].'<br>';
												echo $rs_address11['city'].', ';
												echo $rs_address11['state'].'<br>';
												echo 'pincode: '.$rs_address11['pincode'].'<br>';
												echo 'Phone number: '.$rs_address11['phone'].'<br>';
												echo "<a href='myaccount.php?del_address=$d&&Delete=Delete' onClick='return confirm(\"Are you sure you want to delete this Address?\")' class='button_grey middle_btn'>Delete</a>";
												echo "<a href='myaccount.php?def_address=$d&&default=default' onClick='return confirm(\"Are you sure you want to set this address as default address?\")' class='button_grey middle_btn'>Set as default</a>";
												echo '<hr>';
											}
											?>



										</section>

										<!-- - - - - - - - - - - - - - End of default shipping address - - - - - - - - - - - - - - - - -->

									</div><!--/ .table_cell -->

								</div><!--/ .table_row -->

							</div><!--/ .table_layout -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

			<?php include'../inc/footer.php' ;?>

			<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

		</div><!--/ [layout]-->

		<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->



		<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->

		<!-- Include Libs & Plugins
		============================================ -->
	<script src="../js/jquery.appear.js"></script>
		<script src="../js/owlcarousel/owl.carousel.min.js"></script>
		<script src="../twitter/jquery.tweet.min.js"></script>
		<script src="../js/arcticmodal/jquery.arcticmodal.js"></script>
		<script src="../js/colorpicker/colorpicker.js"></script>
		<script src="../js/retina.min.js"></script>

		<!-- Theme files
		============================================ -->
		<script src="../js/theme.styleswitcher.js"></script>
		<script src="../js/theme.plugins.js"></script>
		<script src="../js/theme.core.js"></script>

	</body>
</html>
