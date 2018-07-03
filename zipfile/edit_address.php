<?php session_start(); error_reporting(0); ?>

<?php include_once 'inc/functions.php' ;

if($_SESSION['email']=='' && $_SESSION['pemail']==''){
	header("location:logout.php");
}

if(isset($_SESSION['pemail'])){
	$email = $_SESSION['pemail'];
	$fix='PID-';
}
if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	$fix='TDUID-';
}

	$fetch="select * from user where email='$email' AND fix='$fix'";

	$res=mysql_query($fetch);

	$rs_EditAddress=mysql_fetch_assoc($res);

	if(isset($_POST['Edit'])){



		foreach($_POST as $key=>$val){

			$$key=$DB->escape($val);

		}

		if($DB->executupdate("UPDATE `address` SET `title`='$title',`fname`='$fname',`lname`='$lname',`address`='$address',`street`='$street',`city`='$city',`state`='$state',`pincode`='$pincode',`phone`='$phone' WHERE id='".$rs_EditAddress['address_id']."'")){
			$message='Thanks For Updating Your Address... ';
			/*echo "<script>window.location='myaccount.php';</script>";*/
		}else{
			$erromsg='Error for Update';
		}
	}
?>

<!doctype html>

<html lang="en">

<head>

<!-- Basic page needs ============================================ -->

<title>The medkart | Edit Address</title>

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

        <li><a href="index.html">Home</a></li>

        <li>Default Address Edit</li>

      </ul>



      <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->

      <section class="section_offset">

        <h3>Default Address Edit</h3>

         <?php if($erromsg!=''){ ?>

           <!-- Alert-->

           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">

            <div class="alert alert-warning alert-dismissable">

                    <i class="fa fa-warning"></i>

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    <b>Alert!</b> <?php echo $erromsg;?>

                </div>

            </div>

            <?php  } if($message!=''){?>

           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">

            <div class="alert alert-success alert-dismissable">

                    <i class="fa fa-check"></i>

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    <b>Success!</b> <?php echo $message;?>

                </div>

            </div>

            <?php } ?>

            <?php

			$res_address=mysql_query("select * from address where id='".$rs_EditAddress['address_id']."'");

				$rs_address=mysql_fetch_assoc($res_address);

			?>

        <form action="" name="myForm"  method="post" class="type_2" onSubmit="return validateForm()">

          <div class="theme_box">

            <ul>

             	<li class="row">

            		<div class="col-sm-6">

                  <label class="required">Title</label>

                  <div class="custom_select">

                    <select name="title" class="searchskill">

                      <option value="Mr." <?php echo $rs_address['title']=='Mr.'?'selected':''; ?> >Mr.</option>

                      <option value="Mrs." <?php echo $rs_address['title']=='Mrs.'?'selected':''; ?> >Mrs.</option>

                    </select>

                  </div>

                </div>

                </li>

               <li class="row">

                <div class="col-sm-6">

                <p id="fname"></p>

                  <label for="first_name" class="required">First Name</label>

                  <input class="searchskill" type="text" name="fname" value="<?php echo $rs_address['fname']; ?>" id="first_name">

                </div>



                <div class="col-sm-6">

                  <label for="last_name" class="required">Last Name</label>

                  <input type="text" class="searchskill" name="lname"  value="<?php echo $rs_address['lname']; ?>" id="last_name">

                </div>



              </li>

              <!--/ .row -->

             <!--<li class="row">

                <div class="col-sm-12">

                  <label for="email_address" class="required">Email Address</label>

                  <input type="text" class="searchskill" name="email"  value="<?php echo $_POST['email']; ?>" id="email_address">

                </div>

              </li>-->

              <li class="row">

                <div class="col-sm-6">

                  <label for="telephone" class="required">Telephone</label>

                  <input type="text" class="searchskill" name="phone"  value="<?php echo $rs_address['phone']; ?>" onKeyPress="return isNumber(event)" id="phone">

                </div>

              </li>





              <li class="row">

                <div class="col-xs-12">

                  <label for="address" class="required">Address</label>

                  <input type="text" class="searchskill" name="address"   value="<?php echo $rs_address['address']; ?>" >

                </div>

                <div class="col-xs-12">

                 <label for="address" class="required">Street Address</label>

                  <input type="text"  name="street" class="searchskill"  value="<?php echo $rs_address['street']; ?>" >

                </div>

                <!--/ [col] -->



              </li>

              <li class="row">

                <div class="col-sm-4">

                  <label for="city" class="required">City</label>

                  <input type="text" class="searchskill"  value="<?php echo $rs_address['city']; ?>" name="city" id="city">

                </div>

                <!--/ [col] -->



                <div class="col-sm-4">

                  <label class="required">Country</label>

                  <div class="custom_select">

                    <select name="state" class="searchskill">

                      <option value="Alabama" <?php echo $rs_address['state']=='Alabama'?'selected':''; ?> >Alabama</option>

                      <option value="Illinois" <?php echo $rs_address['state']=='Illinois'?'selected':''; ?> >Illinois</option>

                      <option value="India" <?php echo $rs_address['state']=='India'?'selected':''; ?>>India</option>

                    </select>

                  </div>

                </div>

                <div class="col-sm-4">

                  <label for="postal_code" class="required">Pin Code</label>

                  <input type="text" class="searchskill"  value="<?php echo $rs_address['pincode']; ?>" name="pincode" onKeyPress="return isNumberPincode(event)" id="postal_code">

                </div>

                <!--/ [col] -->



              </li>

              <!--/ .row -->





              <!--/ .row -->





              <!--/ .row -->



            </ul>

          </div>

          <footer class="bottom_box on_the_sides">

            <div class="left_side">

              <button type="submit" name="Edit" class="button_blue middle_btn" value="Edit">Continue</button>

            </div>

            <div class="right_side"> <span class="prompt">Required Fields</span> </div>

          </footer>

        </form>

      </section>

    </div>

    <!--/ .container-->

  </div>

  <!--/ .page_wrapper-->



  <?php include'inc/footer.php' ;?>

</div>

<!--/ [layout]-->

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

<script>

function val(v){

	return document.forms["myForm"][v].value;

}



function validateForm() {

	var flag=0;

	var phone = val('phone');

//	var address = val('address');

	var city = val('city');

	var state = val('state');

	var pincode = val('pincode');

	var filteredList = $('.searchskill').filter(function() {

		if($(this).val()==''){

			$(this).css("border", "1px solid red");

		}else{

			$(this).css("border", "");

		}

    	return $(this).val() == "";

	});

	if (filteredList.length > 0) {

		flag=0;

	}else{

		flag=1;

	}



	if(phone!=''){

		if(!phonenumber(phone)){

			$('#phone').css("border", "1px solid red");

			flag=0;

		}else{

			$('#phone').css("border", "");

		}

	}



	if(flag==0){

		$('#cpass').css("border", "1px solid red");

		$('#pass').css("border", "1px solid red");

		return false;

	}

	else{

    	$('#cpass').css("border", "");

		$('#pass').css("border", "");

		return true;

	}

}

</script>

<script src="js/formValidation.js"></script>

</body>

</html>
