<?php  session_start();
ob_start();
error_reporting(0);
$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
include_once 'inc/functions.php'; 
//print_r($_POST);
$id=(int)$_GET['q'];
$Sql="SELECT * FROM `products` where id='$id'";
$result=$DB->runQuery($Sql);
$p_b1=$result[0]['p_b1'];
$p_b=$result[0]['p_b'];
$result_p_b=$DB->fectch_prices("SELECT name,id FROM `packing` where id IN ('$p_b1','$p_b')");
$result[0]['p_b1']=$result_p_b[$result[0]['p_b1']]['name'];
$result[0]['p_b']=$result_p_b[$result[0]['p_b']]['name'];
$result_company_name=$DB->fectch_prices("SELECT name,id FROM `company_name` where id='".$result[0]['company_name']."'");
$result[0]['company_name']=$result_company_name[$result[0]['company_name']]['name'];
if(isset($_POST['new_price'])){
	$price_post_id=" AND id='".$_POST['new_price']."'";
}else{
	$price_post_id='';
}
//print_r($result);
$price_pro=mysql_query("select * from price where p_id='$id' AND price.price>'0' AND price.status='1' $price_post_id order by price.price asc limit 1 ");
$price_pass=mysql_fetch_assoc($price_pro);
$result[0]['price']=$price_pass['price'];
$result[0]['orgprice']=$price_pass['orgprice'];
$result[0]['price_per']=$price_pass['price_per'];


if ($_POST['form2'] == 'Add to Cart') {
	$price_id=(int)mysql_real_escape_string($_POST['price_pass']);
	$product_id=$result[0]['id'];
	
	$product_qty=(int)mysql_real_escape_string($_POST['quantity']);
	$product_name   = mysql_real_escape_string($result[0]['name']);
	$date     = mysql_real_escape_string(date("d-m-Y"));
	if(isset($_SESSION['email'])){
		$sid      = mysql_real_escape_string($_SESSION["email"]);
	}else{
		$sid      = mysql_real_escape_string($_SESSION["SessID"]);
	}
   	$success_already = mysql_query("select * from products_added where `username`='$sid' AND `product_id`='$product_id' AND `product_name`='$product_name' AND price_id='$price_id'");
		if(mysql_num_rows($success_already)<=0){
			
			$success = mysql_query("insert into `products_added` (`username`, `product_id`, `product_name`, `product_qty`, price_id, `date`) values('$sid','$product_id','$product_name','$product_qty','$price_id',NOW())");
			if ($success) {
				echo "<script>window.location.href='shopping_cart.php'</script>";
			}
		}else{
				$success = mysql_query("UPDATE `products_added` SET `product_qty`= product_qty +1  where `username`='$sid' AND `product_id`='$product_id' AND `product_name`='$product_name' AND price_id='$price_id'");
			echo "<script>window.location.href='shopping_cart.php'</script>";
		}
    
}



?>

<!doctype html>
<html lang="en">
<head>
		<!-- Basic page needs
		============================================ -->
		<title><?php echo $result[0]['name']; ?> | The medkart</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas ============================================ -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Google web fonts ============================================ -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

		<!-- Libs CSS
		============================================ -->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<!-- Theme CSS
		============================================ -->
		<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css">
		<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css">
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

 <?php include'inc/header.php' ;?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">
					<?php	//print_r($result); ?>
						<li><a href="index.php">Home</a></li>
                        <?php if((isset($result[0]['menu']))&&($result[0]['menu']!='')){
							$menu=$DB->fectchRecord("SELECT menu FROM `menu` where id='".$result[0]['menu']."'");
							$result[0]['menu']=$menu['menu'];
							 ?>
								<li><a href="<?php echo "product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$result[0]['menu'])); ?>"><?php echo $result[0]['menu']; ?></a></li>                                
							<?php if((isset($result[0]['sub_menu']))&&($result[0]['sub_menu']!='')){ 
								$menu=$DB->fectchRecord("SELECT sub_menu FROM `sub_menu` where id='".$result[0]['sub_menu']."'");
								$result[0]['sub_menu']=$menu['sub_menu'];
							?>
									<li><a href="<?php echo "product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$result[0]['menu'])).'-'.preg_replace('/\s+/', '_', str_replace('&', '@',$result[0]['sub_menu'])); ?>"><?php echo $result[0]['sub_menu']; ?></a></li> 
							<?php if((isset($result[0]['sub_sub_menu']))&&($result[0]['sub_sub_menu']!='')){ 
								$menu=$DB->fectchRecord("SELECT sub_sub_menu FROM `sub_sub_menu` where id='".$result[0]['sub_sub_menu']."'");
								$result[0]['sub_sub_menu']=$menu['sub_sub_menu'];
							?>
										<li><a href="<?php echo "product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$result[0]['menu'])).'-'.preg_replace('/\s+/', '_', str_replace('&', '@',$result[0]['sub_menu'])).'-'.preg_replace('/\s+/', '_', str_replace('&', '@',$result[0]['sub_sub_menu'])); ?>"><?php echo $result[0]['sub_sub_menu']; ?></a></li>
							<?php	}
								}
							} 
						?>
                        <li><?php echo $result[0]['name']; ?></li>
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<main class="col-md-12 col-sm-12">
                        	

							<!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<div class="clearfix">

									<!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

									<div class="single_product">

										<!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

										<div class="image_preview_container">

											<img id="img_zoom" data-zoom-image="<?php echo $result[0]['img']; ?>" src="<?php echo $result[0]['img']; ?>" alt="<?php echo $result[0]['name']; ?>">
											<button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button>
										</div><!--/ .image_preview_container-->
										<!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->
										<!-- - - - - - - - - - - - - - Prodcut thumbs carousel - - - - - - - - - - - - - - - - -->
										<div class="product_preview">

											<div class="owl_carousel" id="thumbnails">
												
												<a href="<?php echo $result[0]['img']; ?>" data-image="<?php echo $result[0]['img']; ?>" data-zoom-image="<?php echo $result[0]['img']; ?>">

													<img src="<?php echo $result[0]['img']; ?>" data-large-image="<?php echo $result[0]['img']; ?>" alt="">

												</a>

												<!--<a href="#" data-image="images/qv_img_2.jpg" data-zoom-image="images/qv_large_2.jpg">

													<img src="images/qv_thumb_2.jpg" data-large-image="images/qv_img_2.jpg" alt="">

												</a>

												<a href="#" data-image="images/qv_img_3.jpg" data-zoom-image="images/qv_large_3.jpg">

													<img src="images/qv_thumb_3.jpg" data-large-image="images/qv_img_3.jpg" alt="">

												</a>

												<a href="#" data-image="images/qv_img_4.jpg" data-zoom-image="images/qv_large_4.JPG">

													<img src="images/qv_thumb_4.jpg" data-large-image="images/qv_img_4.jpg" alt="">

												</a>-->

											</div><!--/ .owl-carousel-->

										</div><!--/ .product_preview-->
										<!-- - - - - - - - - - - - - - End of prodcut thumbs carousel - - - - - - - - - - - - - - - - -->
										<!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->
										<!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->
									</div>
									<!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->
									<!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->
									<div class="single_product_description">

										<h3 class="offset_title"><a href="#"><?php echo $result[0]['name']; ?></a></h3>
										<!-- - - - - - - - - - - - - - Page navigation - - - - - - - - - - - - - - - - -->
										<!-- - - - - - - - - - - - - - End of page navigation - - - - - - - - - - - - - - - - -->
										

										<div class="description_section">
											<table class="product_info">
												<tbody>
													<tr>
														<td>Manufacturer: </td>
														<td><a href="#"><?php echo  $result[0]['company_name']; ?></a></a></td>
													</tr>
													<!--<tr>

														<td>Availability: </td>
														<td><span class="in_stock">in stock</span> 20 item(s)</td>

													</tr>
													<tr>

														<td>Product Code: </td>
														<td>PS06</td>

													</tr>-->
												</tbody>
											</table>
										</div>
										<!--<hr>
										<div class="description_section">
											<p>Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.</p>

										</div>-->

										<hr>

										<p class="product_price"><b class="theme_color"><i class="icon-rupee"></i><?php echo $result[0]['price']; ?></b><br><?php echo $result[0]['orgprice']>$result[0]['price']?'MRP<s><i class="icon-rupee"></i>'.$result[0]['orgprice'].'</s>':''; ?> <?php echo $result[0]['price_per']>0? $result[0]['price_per'].'% Off':''; ?></p>

										<!-- - - - - - - - - - - - - - Product size - - - - - - - - - - - - - - - - -->
										
										<div class="description_section_2 v_centered">
											
											<span class="title"><?php echo $result[0]['p_b1']; ?>:</span>

											

		<form method="post" name="myform_price" action="" >										

    <select name="new_price" onChange="submitForm();">
    <?php 
    $mqry="select * from price where p_id='$id' order by p_b1 ";
    $fetch=mysql_query($mqry);
    while($web=mysql_fetch_assoc($fetch)) {  ?>
    	<option value="<?php echo $web['id'] ?>" <?php echo $web['id']==$price_pass['id']?'selected':''; ?> ><?php echo $web['p_b1'] ?> <?php echo $result[0]['p_b1']; ?></option>
    <?php } ?>
    </select>
 </form>
											

										</div>
                                       
										<!-- - - - - - - - - - - - - - End of product size - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Quantity - - - - - - - - - - - - - - - - -->
                                        <form method="post" action="">
                                        <input type="hidden" name="price_pass" value="<?php echo $price_pass['id']; ?>">
										<div class="description_section_2 v_centered">
											
											<span class="title"><?php echo $result[0]['p_b']; ?>:</span>

											<div class="qty min clearfix">

												<button class="theme_button" type="button" data-direction="minus">&#45;</button>
												<input type="text" name="quantity" value="1">
												<button class="theme_button" type="button" data-direction="plus">&#43;</button>
											</div>

										</div>
										<!-- - - - - - - - - - - - - - End of quantity - - - - - - - - - - - - - - - - -->
										<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
                                        <div style="padding:5px 10px 0 10px; color: green;" id="wishlist_ret"></div>
										<div class="buttons_row">

											<!--<a href="shopping_cart.php" name="form2" value="Add to Cart" >Add to Cart</a>-->
                                            <button type="submit" title="Add to Cart" name="form2" value="Add to Cart" >Add to Cart</button>
											<!--<a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>-->
                                            
                                             <?php 
		   if(isset($_SESSION['email'])){
			   if(!empty($_SESSION['wishlist'])){  if(!in_array($result[0]["id"], $_SESSION['wishlist'])){ $wishlistTrue=1;  }else{$wishlistTrue=0;} }else{ $wishlistTrue=1; } ?>
    	      <?php if($wishlistTrue){ ?><div class="actions_wrap" id="Hide<?php echo  $result[0]["id"]; ?>"> 
              <a href="javascript:void(0)" onClick="wishlist('<?php echo  $result[0]["id"]; ?>')" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> 
            </div> <?php } ?>
            <?php }else{ ?>
            <div class="actions_wrap" > 
              <a href="login.php?login_attempt=2" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> 
            </div>
			
			<?php } ?>

											

										</div>
										</form>
										<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

									</div>

									<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

								</div>

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								<div class="tabs type_2">

									<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->

									<ul class="tabs_nav clearfix">

										<li><a href="#tab-1">Description</a></li>
										<li><a href="#tab-2">Specifications</a></li>
									</ul>
									
									<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->

									<div class="tab_containers_wrap">

										<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

										<div id="tab-1" class="tab_container">

											<p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla.</p>

											<p>Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipisMauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in,auctor ut, ligula. </p>

										</div><!--/ #tab-1-->

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

										<div id="tab-2" class="tab_container">

											<ul class="specifications">

												<li><span>Weight:</span>0.3 Kg</li>
												<li><span>Dimensions:</span>20x10x30 Cm</li>
												<li><span>Material:</span>Plastic</li>
												<li><span>Manufacture:</span>G&amp;D</li>
												<li><span>Guarantee:</span>2 Years</li>

											</ul>

										</div><!--/ #tab-2-->

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

										<!--/ #tab-3-->

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

										<!--/ #tab-4-->

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

									</div><!--/ .tab_containers_wrap -->

									<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

								</div><!--/ .tabs-->

							</div><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of tabs - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Related products - - - - - - - - - - - - - - - - --><br>
<br>

							<section class="section_offset">

								<h3 class="offset_title">Related Products</h3>

								<div class="owl_carousel related_products">

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_30.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_new">New</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Leo vel metus nulla facilisi etiam cursus 750mg...</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs44.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_31.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Ut pharetra augue nec augue, 200 ea</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs4.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_32.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_bestseller">Bestseller</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Mauris fermentum dictum magna sed laoreet ...</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs17.99</b></p>

												<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

												<ul class="rating alignright">

													<li class="active"></li>
													<li class="active"></li>
													<li class="active"></li>
													<li></li>
													<li></li>

												</ul>
												
												<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_33.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Vestibulum libero nisl porta vel scelerisque eget...</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs12.59</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_30.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_new">New</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Leo vel metus nulla facilisi etiam cursus 750mg...</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs44.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_31.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Ut pharetra augue nec augue, 200 ea</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs4.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_32.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_bestseller">Bestseller</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Mauris fermentum dictum magna sed laoreet ...</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs17.99</b></p>

												<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

												<ul class="rating alignright">

													<li class="active"></li>
													<li class="active"></li>
													<li class="active"></li>
													<li></li>
													<li></li>

												</ul>
												
												<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_33.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="wishlist.php" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Vestibulum libero nisl porta vel scelerisque eget...</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs12.59</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

								</div><!--/ .owl_carousel -->

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of related products - - - - - - - - - - - - - - - - -->
<br>
<br>

							<section class="section_offset">

								<h3 class="offset_title">Recomended Products</h3>

								<div class="owl_carousel other_products">

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_6.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Enzymatic Therapy CoQ10, 100mg, Softgels 120 ea</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs75.39</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_14.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container">
                                               
                                                <span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Nisl porta vel scelerisque eget libero, Vcaps 60 ea</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs79.99</b></p>

												<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

												<ul class="rating alignright">

													<li class="active"></li>
													<li class="active"></li>
													<li class="active"></li>
													<li class="active"></li>
													<li></li>

												</ul>
												
												<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/product_img_15.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_hot">Hot</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Lorem ipsum dolor sit amet consectetuer adipis mauris 12 ea</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs24.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/tabs_img_1.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_new">New</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Leo vel metus nulla facilisi etiam cursus 750mg, Softgels 120 ea</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs44.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/tabs_img_2.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .centered_btns-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Vestibulum libero nisl, porta vel 30</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs44.99</b></p>

												<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

												<ul class="rating alignright">

													<li class="active"></li>
													<li class="active"></li>
													<li class="active"></li>
													<li class="active"></li>
													<li></li>

												</ul>
												
												<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

											<img src="images/tabs_img_3.jpg" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<!--/ .centered_buttons -->

												<a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

												

											</div><!--/ .centered_btns-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

										<div class="label_hot">Hot</div>

										<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

											<a href="#">Amet consectetuer adipis mauris lorem ipsum dolor sit  fl oz (75ml)</a>

											<div class="clearfix product_info">

												<p class="product_price alignleft"><b>Rs44.99</b></p>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

								</div><!--/ .owl_carousel -->

							</section><!--/ .section_offset -->

						</main><!--/ [col]-->

						<aside class="col-md-3 col-sm-4 hidden">

							<!-- - - - - - - - - - - - - - Seller Information - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h4>Seller Information</h4>

								<div class="theme_box">

									<div class="seller_info clearfix">

										<a href="#" class="alignleft photo">

											<img src="images/seller_photo_1.jpg" alt="">

										</a>

										<div class="wrapper">

											<a href="#"><b>John Smith</b></a>

											<p class="seller_category">Member since Mar 2013</p>

										</div>

									</div><!--/ .seller_info-->

									<ul class="seller_stats">

										<li>
											
											<ul class="topbar">
												
												<li>China (Mainland)</li>

												<li><a href="#">Contact Details</a></li>

											</ul>

										</li>

										<li><span class="bold">99.8%</span> Positive Feedback</li>

										<li><span class="bold">7606</span> Transactions</li>

									</ul>

									<div class="v_centered">

										<a href="#" class="button_blue mini_btn">Contact Seller</a>

										<a href="#" class="small_link">Chat Now</a>

									</div>

								</div><!--/ .theme_box -->

								<footer class="bottom_box">
									
									<a href="#" class="button_grey middle_btn">View This Seller's Products</a>

								</footer>

							</section>

							<!-- - - - - - - - - - - - - - End of seller information - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - You might also like - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h4 class="offset_title">You Might Also Like</h4>

								<div class="owl_carousel widgets_carousel">

									<ul class="products_list_widget">

										<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

										<li>
											
											<a href="#" class="product_thumb">
												
												<img src="images/product_thumb_4.jpg" alt="">

											</a>

											<div class="wrapper">

												<a href="#" class="product_title">Adipiscing aliquet sed in lacus...</a>

												<div class="clearfix product_info">

													<p class="product_price alignleft"><b>Rs5.99</b></p>

													<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

													<ul class="rating alignright">

														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li></li>

													</ul>
													
													<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

												</div>

											</div>

										</li>

										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

										<li>
											
											<a href="#" class="product_thumb">
												
												<img src="images/product_thumb_5.jpg" alt="">

											</a>

											<div class="wrapper">

												<a href="#" class="product_title">Adipis mauris lorem ipsum dolor...</a>

												<div class="clearfix product_info">

													<p class="product_price alignleft"><b>Rs8.99</b></p>

													<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

													<ul class="rating alignright">

														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>

													</ul>
													
													<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

												</div>

											</div>

										</li>

										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

										<li>
											
											<a href="#" class="product_thumb">
												
												<img src="images/product_thumb_6.jpg" alt="">

											</a>

											<div class="wrapper">

												<a href="#" class="product_title">Donec porta diam eu massa quisque...</a>

												<div class="clearfix product_info">

													<p class="product_price alignleft"><b>Rs76.99</b></p>

													<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

													<ul class="rating alignright">

														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>

													</ul>
													
													<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

												</div>

											</div>

										</li>

										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

									</ul><!--/ .list_of_products-->

									<ul class="products_list_widget">

										<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

										<li>
											
											<a href="#" class="product_thumb">
												
												<img src="images/product_thumb_7.jpg" alt="">

											</a>

											<div class="wrapper">

												<a href="#" class="product_title">Diam eu massa quisque donec...</a>

												<div class="clearfix product_info">

													<p class="product_price alignleft"><b>Rs5.99</b></p>

													<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

													<ul class="rating alignright">

														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li></li>

													</ul>
													
													<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

												</div>

											</div>

										</li>

										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

										<li>
											
											<a href="#" class="product_thumb">
												
												<img src="images/product_thumb_8.jpg" alt="">

											</a>

											<div class="wrapper">

												<a href="#" class="product_title">Ut pharetra augue nec augue...</a>

												<div class="clearfix product_info">

													<p class="product_price alignleft"><b>Rs8.99</b></p>

													<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

													<ul class="rating alignright">

														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>

													</ul>
													
													<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

												</div>

											</div>

										</li>

										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

										<li>
											
											<a href="#" class="product_thumb">
												
												<img src="images/product_thumb_9.jpg" alt="">

											</a>

											<div class="wrapper">

												<a href="#" class="product_title">Donec porta diam eu massa...</a>

												<div class="clearfix product_info">

													<p class="product_price alignleft"><b>Rs76.99</b></p>

													<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

													<ul class="rating alignright">

														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>
														<li class="active"></li>

													</ul>
													
													<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

												</div>

											</div>

										</li>

										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

									</ul><!--/ .list_of_products-->

								</div>

							</section>

							<!-- - - - - - - - - - - - - - End of you might also like - - - - - - - - - - - - - - - - -->


						</aside><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
 <?php include'inc/footer.php' ;?>

		</div><!--/ [layout]-->
		
		
		
		<!-- Include Libs & Plugins
		============================================ -->
		<script src="js/jquery.elevateZoom-3.0.8.min.js"></script>
		<script src="js/fancybox/source/jquery.fancybox.pack.js"></script>
		<script src="js/fancybox/source/helpers/jquery.fancybox-media.js"></script>
		<script src="js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
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
		
         <script language="javascript">
		function wishlist(val){
			//alert(val);
			$.ajax({
				type: 'post',
				url: 'ajax/ajax_wishlist.php',
				data: {
					val: val
				},
				beforeSend: function() {
					 // $('#fil').html('<div style="text-align:center; font-weight:600; font-size:16px; color:#ccc;">loading...</div>');
				},
				success: function (data) {
					$('#Hide'+val).hide(1000);
					$('#wishlist_ret').show(1000);
					$('#wishlist_ret').html(data);
					$('#wishlist_ret').hide(3000);
					//$("#open_shopping_cart").attr("data-amount", parseInt(data));
				}
			});
		}
		function submitForm(){
			var val = document.myform_price.new_price.value;
			if(val!=''){
				document.myform_price.submit();
			}
		}
		</script> 
	</body>
</html>
