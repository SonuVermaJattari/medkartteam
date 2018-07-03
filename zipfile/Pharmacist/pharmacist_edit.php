<?php session_start(); error_reporting(0); ?>
<?php include_once '../inc/functions.php' ;
if($_SESSION['email']=='' && $_SESSION['pemail']==''){
	header("location:logout.php");
}

if(isset($_SESSION['pemail'])){
	$email = $_SESSION['pemail'];
	$fix='PID-';
}
if(isset($_SESSION['email'])){
	header("location: ../logout.php");
}


if(isset($_POST['submit'])){
	$true=0;
	if(empty($erromsg)){



$Brand=$_POST['Brand'];

	$Brand=implode(',', $Brand);
		 $sqlqry="update user set `pharmacist_products`='$Brand', productsstatus='0',editDate=NOW() where  fix='PID-' AND email='$email' ";

			$successful=$DB->executupdate($sqlqry);

			if($successful)

			{

				$msg="Updated Successfully";

			}

	}

}

	if(isset($_POST['Edit'])){

		foreach($_POST as $key=>$val){
			$$key=$DB->escape($val);
		}
		if($DB->executupdate("UPDATE `user` SET `title`='$title',`fname`='$fname',`lname`='$lname',`gender`='$gender',`age`='$age' WHERE id='".$rs_user['id']."'")){
			$message='Update ';
			if($fix=='PID-'){
				echo "<script>window.location='Pharmacist/myaccount.php';</script>";
			}
			if($fix=='TDUID-'){
				echo "<script>window.location='myaccount.php';</script>";
			}

		}else{
			$erromsg='Error for Update';
		}
	}


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
						<li>Add Products</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<?php include'./inc/left.php'?><!--/ .section_offset -->





							<!-- - - - - - - - - - - - - - End of compare - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1>Add Products</h1>

							<section class="theme_box">

            <?php if($erromsg!=''){ ?>



            <!-- Alert-->



            <div class="msg" style="padding:5px 10px 0 10px;">

              <div class="alert alert-warning alert-dismissable"> <i class="fa fa-warning"></i>

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <b>Alert!</b> <?php echo $erromsg;?> </div>

            </div>

            <?php  } if($msg!=''){?>

            <div class="msg" style="padding:5px 10px 0 10px;">

              <div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <b>Success!</b> <?php echo $msg;?> </div>

            </div>

            <?php } ?>
								<form role="form" method="post" name="form" class="type_2"  enctype="multipart/form-data">



<div class="theme_box">
  <ul>


            	<li class="row">

            		<div class="col-sm-6">

                  <label >Products Add</label><br>


                        <?php

 $QRY="select * from user where fix='PID-' AND email='$email' ";
 $res_user=mysql_query($QRY);
$web=mysql_fetch_assoc($res_user);
$restrict=$web['productsstatus'];
						$brand1=explode(',',$web['pharmacist_products']);

						$sqlu = "select * from products  where status='1' AND prescription='0' order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_assoc($resultu)){
						$id123='@'.$drop['id'].'@';

						?>

                        <input type="checkbox" name="Brand[]" value="@<?php echo $drop['id']; ?>@" <?php if(!empty($brand1)){  foreach($brand1 as $key=>$val) {
							if($val==$id123){  echo 'checked';  break;  }else  echo '';  }  } ?> ><?php echo $drop['name']; ?><br>

                        <?php }?>
                        <hr>
						 <?php
						 $brand1=explode(',',$web['pharmacist_products']);
						$sqlu = "select * from products  where status='1' AND prescription='1' order by sort";

                        $resultu = mysql_query($sqlu);
						$id123='';
                        while($drop = mysql_fetch_array($resultu)){
						$id123='@'.$drop['id'].'@';

						?>

                        <input type="checkbox" name="Brand[]" value="@<?php echo $drop['id']; ?>@" <?php if(!empty($brand1)){  foreach($brand1 as $key=>$val) {
							if($val==$id){  echo 'checked';  break;  }else  echo '';  }  } ?> ><?php echo $drop['name']; ?><br>

                        <?php }?>
                        </div>
                        </li>
                        </ul>


                    </div>



              <!-- /.box-body -->

              <footer class="bottom_box on_the_sides">

            <div class="left_side">

            <button type="submit" name="submit" class="button_blue middle_btn" value="Submit">Submit</button>

            </div>

            <div class="right_side"> <span class="prompt">Required Fields</span> </div>

          </footer>


            </form>

							</section><!--/ .theme_box -->


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
