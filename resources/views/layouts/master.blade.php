<?php

session_start();

ob_start();

error_reporting(0);

include_once 'inc/functions.php';

$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


if(isset($_SESSION['email'])){

	$username=$_SESSION['email'];

}

$username_id=$DB->fectchRecord("SELECT id from user where email='$username'");

$_SESSION['username_id']=$username_id['id'];

if(isset($_POST['Orderagain'])){
	$order_confirm_id=(int)(str_replace("TD-","",$_POST['Orderagain_Id']));
	if($fetchOrderAgain=$DB->OrderAgain($username,$order_confirm_id)){
		header("location:checkout.php");
	}else{
		die('Error to Re-order..');
	}

	//print_r($fetchOrderAgain);
}

//let us find all orders of this usee

?>

<!doctype html>

<html lang="en">

<head>

		<!-- Basic page needs

		============================================ -->

		<title>The medkart | My Orders</title>

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

		<link rel="stylesheet" href="{{asset('/')}}css/animate.css">

		<link rel="stylesheet" href="{{asset('/')}}css/fontello.css">

		<link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">



		<!-- Theme CSS

		============================================ -->

		<link rel="stylesheet" href="{{asset('/')}}js/arcticmodal/jquery.arcticmodal.css">

		<link rel="stylesheet" href="{{asset('/')}}js/owlcarousel/owl.carousel.css">

		<link rel="stylesheet" href="{{asset('/')}}js/colorpicker/colorpicker.css">

		<link rel="stylesheet" href="{{asset('/')}}css/style.css">

		<link rel="stylesheet" href="{{asset('/')}}css/pagination.css">

		<!-- JS Libs

		============================================ -->

		<script src="{{asset('/')}}js/modernizr.js"></script>

		<script src="{{asset('/')}}js/jquery-2.1.1.min.js"></script>

		<script src="{{asset('/')}}js/queryloader2.min.js"></script>



		<script>





		</script>

<script>

function getresult(url) {

	$.ajax({

		url: url,

		type: "GET",

		data:  {rowcount:$("#rowcount").val(),"pagination_setting":'all-links'},

		beforeSend: function(){$("#overlay").show();},

		success: function(data){

		$("#pagination-result").html(data);

		//setInterval(function() {$("#overlay").hide(); },500);

		}, complete: function (data) {

		 $("#overlay").hide();



		 }

   });

}

    
    
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



     @yield('content')



			<?php include'inc/footer.php' ;?>



		


		</div><!--/ [layout]-->




		<!-- Include Libs & Plugins

		============================================ -->

		<script src="{{asset('/')}}js/jquery.appear.js"></script>

		<script src="{{asset('/')}}js/owlcarousel/owl.carousel.min.js"></script>

		<script src="{{asset('/')}}twitter/jquery.tweet.min.js"></script>

		<script src="{{asset('/')}}js/arcticmodal/jquery.arcticmodal.js"></script>

		<script src="{{asset('/')}}js/colorpicker/colorpicker.js"></script>

		<script src="{{asset('/')}}js/retina.min.js"></script>



		<!-- Theme files

		============================================ -->

		<script src="{{asset('/')}}js/theme.styleswitcher.js"></script>

		<script src="{{asset('/')}}js/theme.plugins.js"></script>

		<script src="{{asset('/')}}js/theme.core.js"></script>

		<script>

getresult("ajax/orders_list_getresult.php");

</script>

	</body>



</html>
