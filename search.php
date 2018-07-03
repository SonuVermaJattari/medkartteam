<?php 
session_start();
ob_start();
error_reporting(0);
$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
include_once 'inc/functions.php'; 
$_GET['search']=trim($_GET['search'], " ");
//print_r($_GET);
//print_r($_SESSION);
include 'class/Search_AddToCart.php';

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
            <h5>Search result for "<?php echo $_GET['search']; ?>" </h5>
          </section>
                  
                  <!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->
                  
                  	<div class="section_offset" id="section_offset">
            			
            		<!--/ .table_layout --> 
          			</div>
    <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->      
<!--<div id="products_container">
                      <?php

	$q=$_POST['search'];
	$search_drop=$_POST["type"];
	if($search_drop=='Salt+name'){
			$search_drop=2;
		}else if($search_drop=='Medicine+Name'){
			$search_drop=1;
		}else{
			$search_drop=0;
		}
	if($search_drop=='1'||$search_drop=='2'){
		$lim=10;	
	}else{
		$lim=5;	
	}
	//LIMIT 0,$lim
	$hint='';
	// SELECT p.id,p.name,s.name as solt FROM `products` p left join solt s ON p.solt=s.id where p.name LIKE '%$q%' 
	if($search_drop=='1' || $search_drop=='0'){
		$menu_fetch=mysql_query("SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id  where  p.name LIKE '%$q%'  ");
		if((mysql_num_rows($menu_fetch))>0){
			while($web=mysql_fetch_assoc($menu_fetch)) {
				$id=$web['id'];
				$price_pro=mysql_query("select * from price where p_id='$id' AND price.price>'0' AND price.status='1' order by price.price asc limit 1 ");
				$price_pass=mysql_fetch_assoc($price_pro);
				  //$hint=$hint . "<br /><a class='search' href='product_details.php?q=" .$web['id'] ."' >" .$web['name'].  print_r($price_pass). "</a>";
			?>
                      <div class="product_item">
                <div class="row">
                          <div class="col-md-8">
                    <div class="description">
                              <h5><a href="product_details.php?q=<?php echo $web['id']; ?>" ><?php echo $web['name']; ?></a></h5>
                              <ul class="seller_stats">
                        <li><strong><?php echo $price_pass['p_b1']; ?> <?php echo $web['p_b1name']; ?></strong></li>
                        <li><?php echo $web['c_name']; ?></li>
                      </ul>
                            </div>
                  </div>
                          <div class="col-md-4">
                    <div class="actions">
                              <h5 class="align_right">Rs. <?php echo $price_pass['price']; ?></h5>
                              <ul class="buttons_col align_right">
                        <li><a href="product_details-medicine.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
                      </ul>
                            </div>
                  </div>
                        </div>
              </div>
                      <?php
			}
		}
		
	}
	if($search_drop=='2' || $search_drop=='0'){
		//echo "SELECT p.id,s.name as solt FROM `products` p left join solt s ON p.solt=s.id where s.name LIKE '%$q%' LIMIT 0,$lim ";
		$menu_fetch=mysql_query("SELECT s.id,s.name as solt,COUNT(p.id) FROM `products` p left join solt s ON p.solt=s.id where s.name LIKE '%$q%' GROUP by s.name ");
		while($web=mysql_fetch_assoc($menu_fetch)) {
			//$hint.='<h1 style="color:#fff;">Solt</h1>';
		?>
                      <div class="product_item">
                <div class="row">
                          <div class="col-md-8">
                    <div class="description">
                              <h5><a href="search_solt.php?q=<?php echo $web['id']; ?>" ><?php echo $web['solt']; ?></a></h5>
                              <ul class="seller_stats">
                        <li><strong>Solt</strong></li>
                      </ul>
                            </div>
                  </div>
                        </div>
              </div>
                      <?php
			 // $hint="<a class='search' href='" . $web['id'] ."' >" .$web['solt'].'(solt1)'. $web['COUNT(p.id)']."</a>";
			
		}
	}

?>
                      <?php /*?><div class="product_item">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="description">
                              <h5><a href="product_details-medicine.php">Nimulid 100mg Tablet</a></h5>
                              <ul class="seller_stats">
                                <li><strong>15 tablets</strong></li>
                                <li>Panacea Biotec Ltd </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="actions">
                              <h5 class="align_right">Rs 76.99</h5>
                              <ul class="buttons_col align_right">
                                <li><a href="product_details-medicine.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="product_item">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="description">
                              <h5><a href="product_details-medicine.php">Nimulid -MD 100mg Tablet</a></h5>
                              <ul class="seller_stats">
                                <li><strong>15 tablets dt</strong></li>
                                <li>Panacea Biotec Ltd </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="actions">
                              <h5 class="align_right">Rs 89.70</h5>
                              <ul class="buttons_col align_right">
                                <li><a href="product_details-medicine.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="product_item">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="description">
                              <h5><a href="product_details-medicine.php">Nimulid HF 100 mg/500 mg Tablet</a></h5>
                              <ul class="seller_stats">
                                <li><strong>10 tablets</strong></li>
                                <li>Panacea Biotec Ltd </li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="actions">
                              <h5 class="align_right">Rs 61.80</h5>
                              <ul class="buttons_col align_right">
                                <li><a href="product_details-medicine.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div><?php */?>
                    </div>-->
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
	var search1='<?php echo $_GET['search']; ?>';
	var type='<?php echo $_GET['type']; ?>';
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
			  xmlhttp.open("GET","ajax/serach_ajax.php?search="+search1+"&&type="+type+"&&limit="+limit,true);
			  xmlhttp.send();
		}
		filter_display1(0);
		
</script>



</body>
</html>
