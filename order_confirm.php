<?php

session_start();

ob_start();

error_reporting(0);

$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include_once 'inc/functions.php';

if($_SESSION['email']==''){

	header("location:login.php?login_attempt=2");

}

if(isset($_SESSION['email'])){

	$username=$_SESSION['email'];



	if(!isset($_SESSION['checkout']['Address'])){

		header("location:checkout.php");

	}else{

		$CheckoutAddress=json_decode($_SESSION['checkout']['Address'],TRUE);
		if(isset($_POST['referralCode'])){
			$_POST['referralCode']=str_replace(' ', '', $_POST['referralCode']);
			if(!empty($_POST['referralCode'])){
				$referralCode=$_POST['referralCode'];
			}
		}else{
			$referralCode='';

		}
		if($CheckoutAddress['PaymentType']=='cod'){

			//unset($CheckoutAddress['PaymentType']);

			$mail=$DB->CodOrder($CheckoutAddress,$referralCode);

			//print_r($products_array);

			if($mail){

				$f=1;

				$_SESSION['f']=1;

				unset($_SESSION['checkout']);

			}else{

				$error='Mail not send';

			}

		}



	}

}



?>

<!doctype html>

<html lang="en">

<head>

		<!-- Basic page needs

		============================================ -->

		<title>The medkart | Checkout</title>

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

		<style>

        /*.section_offset{

			display:none;

			}*/

        </style>

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

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>

						<li>Order Place</li>

					</ul>

					<h1 class="page_title">Order Place</h1>



                    <?php

					if(!isset($_SESSION['f'])){



						echo "<script>window.location='index.php';</script>";

					}

					 if($_SESSION['f']=='1'){

						echo 'order place successfully';

						unset($_SESSION['f']);

					}



					?>



				</div>

			</div>

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

		<script>

		function select_address(id,type){

			//alert(id);

			if(type=='New'){

				$('#checkoutShipping').hide(1000);

				$('#checkoutNewShipping').show(1000);

			}

			else if(type=='Old'){

				$('#checkoutShipping').hide(1000);

				$('#checkoutPayment').show(1000);



			}else{



			}

			//select_addressAjax(id,type);

		}

		function select_addressAjax(id,type){

			//alert(id+type);

			if (window.XMLHttpRequest) {

				// code for IE7+, Firefox, Chrome, Opera, Safari

				xmlhttp=new XMLHttpRequest();

			} else {  // code for IE6, IE5

				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

			}

			xmlhttp.onreadystatechange=function() {

				if (this.readyState==4 && this.status==200) {

					alert(this.responseText);

					//document.getElementById("LOAD_MORE").innerHTML='';

					//$('.LOAD_MORE').hide();

					//node.innerHTML = this.responseText;

					//document.getElementById("section_offset").appendChild(node);

				  //document.getElementById("section_offset").value=this.responseText;

				}

			}

			xmlhttp.open("GET","ajax/chechout_ajax.php?id="+id+"&&type="+type,true);

			xmlhttp.send();

		}

		//select_addressAjax();

		</script>

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

		//alert(0);

		return false;



	}

	else{

    	$('#cpass').css("border", "");

		$('#pass').css("border", "");

		//alert(1);

		return true;

	}

}

</script>

<script src="js/formValidation.js"></script>

	</body>

    </html>
