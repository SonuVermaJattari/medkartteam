<?php 
session_start();
ob_start();
error_reporting(0);
$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
include_once 'inc/functions.php'; 
$_GET['search']=(int)trim($_GET['q'], " ");

//print_r($_GET);
//print_r($_SESSION);
include 'class/Search_AddToCart.php'
?>
<!doctype html>
<html lang="en">
		<head>
		<!-- Basic page needs
		============================================ -->
		<title>The medkart</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
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
		<link rel="stylesheet" href="css/jquery-ui.min.css">
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
          
          <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
          <?php include'inc/header.php' ;?>
          <div class="secondary_page_wrapper">
    <div class="container">
              <div class="row">
        <main class="col-md-8 col-sm-8"><br>
                  <section class="section_offset">
            <h5>Search result for "<?php echo $_GET['solt']; ?>" </h5>
          </section>
                  
                  <!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->
                  
                  	<div class="section_offset" id="section_offset">
            			
            		<!--/ .table_layout --> 
          			</div>
    <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->      

 <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->      

                </main>
      </div>
              <!--/ .row --> 
            </div>
    <!--/ .container--> 
  </div>
          <!--/ .page_wrapper-->
          <?php include'inc/footer.php' ;?>
        </div>
<!--/ [layout]--> 
<script src="js/jquery-ui.min.js"></script> 
<script src="js/jquery.appear.js"></script> 
<script src="js/jquery.countdown.plugin.min.js"></script> 
<script src="js/jquery.countdown.min.js"></script> 
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
<script>
function filter_display1(limit){
	var search1='<?php echo $_GET['q']; ?>';
	var type='Medicine Name';
	//alert(limit);
	
	var node = document.createElement("div");
			  if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			  } else {  // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					//document.getElementById("LOAD_MORE").innerHTML='';
					$('.LOAD_MORE').hide();
					node.innerHTML = this.responseText;
					document.getElementById("section_offset").appendChild(node);	
				  //document.getElementById("section_offset").value=this.responseText;
				}
				
			  }
			  xmlhttp.open("GET","ajax/serach_solt_ajax.php?search="+search1+"&&type="+type+"&&limit="+limit,true);
			  xmlhttp.send();
		}
		filter_display1(0);
		
</script>



</body>
</html>
