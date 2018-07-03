<?php session_start(); error_reporting(0); 
include_once 'inc/functions.php' ;
	if($_SESSION['email']!=''){
		header("location:myaccount.php");
	}
?>


<!doctype html>
<html lang="en">
<head>
<!-- Basic page needs ============================================ -->
<title>The medkart </title>
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
  <?php include'class/forgotten.php' ;?>
  <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
  <div class="secondary_page_wrapper">
    <div class="container"> 
      
      <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
      
      <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>Forgot Your Password?</li>
      </ul>
      
      <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->
      <section class="section_offset">
        <h3>Forgot Your Password?</h3>
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
            <?php }  //unset($_SESSION['post_json']); ?>
            <?php if((!isset($post_json))){ ?>
        <form action="" name="myForm"  method="post" class="type_2" onSubmit="return validateForm()">
          <div class="theme_box">
            <ul>
              <li class="row">
              	<div class="col-sm-12">
                  <label for="email" class="required">Email/Phone</label>
                  <input type="text" class="searchskill" name="email">
                </div>
              </li>
            </ul>
          </div>
          <footer class="bottom_box on_the_sides">
            <div class="left_side">
              <button type="submit" name="Edit" class="button_blue middle_btn" value="Edit">Continue</button>
            </div>
            <div class="right_side"> <span class="prompt">Required Fields</span> </div>
          </footer>
        </form>
        <?php }else{ ?>
         
        <form action="" name="myForm4"  method="post" class="type_2" onSubmit="return validateForm_otp()">
          <div class="theme_box">
            <ul>
              <li class="row">
                <div class="col-sm-12">
                  <label for="otp" class="required">OTP</label>
                  <input class="searchskill_otp" type="text" name="otp_val" value="" id="otp">
                </div>
              </li>
            </ul>
          </div>
          <footer class="bottom_box on_the_sides">
            <div class="left_side">
              <button type="submit" name="otp" class="button_blue middle_btn" value="otp">Continue</button>
            </div>
          </footer>
            </form>
             <footer class="bottom_box on_the_sides">
            <div class="right_side"><form action="" name="myForm4"  method="post" class="type_2"><button type="submit" name="otp_resend" class="button_blue middle_btn" value="otp_resend">Resend</button></form></div></footer>
        <?php } ?>
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
function ValidateEmail(mail) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
		return 1;
	}
    //alert("You have entered an invalid email address!")
    return 0;
}
function validateForm() {
	var flag=0;
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
	if(flag==0){
		return false;
	}
	else{
		return true;
	}
}
function validateForm_otp() {
	var value =document.getElementById("otp").value;
	if(value!=''){
		return true;
	}
	$("#otp").css("border", "1px solid red");
	return false;
}
</script>
<script src="js/formValidation.js"></script>
</body>
</html>
