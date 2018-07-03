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
$result[0]['solt_id']=$result[0]['solt'];

$SqlSolt="SELECT name FROM `solt` where id='".$result[0]['solt']."'";
$result_Solt=$DB->runQuery($SqlSolt);
$result[0]['solt']=$result_Solt[0]['name'];
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
	$price_id=$price_pass['id'];
	$product_id=$result[0]['id'];
	$product_qty=(int)mysql_real_escape_string($_POST['quantity']);
	$product_name   = mysql_real_escape_string($result[0]['name']);
	$date     = mysql_real_escape_string(date("d-m-Y"));
	if(isset($_SESSION['email'])){
		$sid      = mysql_real_escape_string($_SESSION["email"]);
	}else{
		$sid      = mysql_real_escape_string($_SESSION["SessID"]);
	}
   $success_already = mysql_query("select * from products_added where `username`='$sid' AND `product_id`='$product_id' AND `product_name`='$product_name'  AND price_id='$price_id'");
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
		<!-- ===== Basic page needs ============================================ -->
		<title><?php echo $result[0]['name']; ?>| The medkart</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
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
		<style type="text/css">.def_icon_btn.middle_btn { width: 25px !important; height: 25px !important; font-size: 10px !important;} .stkq {
    font-size: 42px;
    font-weight: normal;
    line-height: 42px;
}</style>
		</head>
		<body>
        <div class="wide_layout">

          <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
          <?php include'inc/header.php' ;?>
          <div class="breadcrumbs-main">
              <div class="container">
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
          </div>
           </div>
          <div class="secondary_page_wrapper">
            <div class="container">
            
              <br>
              <div class="row">
                <main class="col-md-8 col-sm-8">

                  <!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->
                <div class="section_offset">
                    <!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

                    <div class="clearfix">
                      <div class="single_product_description">
                        <div class="row">
                          <div class="col-md-8"><div class="theme_box">  
                            <h3 class="offset_title"><a href="#"><?php echo $result[0]['name']; ?></a></h3>
                            <div class="description_section">
                              <table class="product_info">
                                <tbody>
                                  <tr>
                                    <td><p><a href="#"><?php echo $result[0]['company_name']; ?></a></p></td>
                                  </tr>
                                  <tr>
                                    <td><p>Composition for <?php echo $result[0]['name']; ?><br>
                                        <strong><?php echo $result[0]['solt']; ?></strong></p></td>
                                  </tr>
                                </tbody>
                              </table>
                              <br>
                              <?php //if($result[0]['prescription']){ ?>
                              <p><img src="images/prescr-icon.png" /> Prescription Required</p>
                              <br>
                              <?php //} ?>
                              <p>Primarily used for</p>
                              <h5>Fever, Headache, Dental pain</h5>
                            </div>
                          </div>
                          </div>
                          <div class="col-md-4">
                            <div class="theme_box">
                              <form method="post" action="">
                                <div>
                                  <?php
										$mqry="select * from price where p_id='$id' order by p_b1 ";
										$fetch=mysql_query($mqry);
										$web=mysql_fetch_assoc($fetch); ?>
                                  <!--<p class="product_price"><b class="theme_color">Rs<?php echo $result[0]['price']; ?></b></p>-->
                                  <p class="product_price"><b class="theme_color"><i class="icon-rupee"></i><?php echo $result[0]['price']; ?></b><br>
                                    <s><?php //echo $result[0]['orgprice']>$result[0]['price']?'<i class="icon-rupee"></i>'.$result[0]['orgprice']:''; ?></s> <?php //echo $result[0]['price_per']>0? $result[0]['price_per'].'% Off':''; ?></p>
                                  <p><strong><i class="icon-rupee"></i><?php echo (($result[0]['price'])/$web['p_b1']); ?>/<?php echo $result[0]['p_b1']; ?></strong></p>
                                  <p><?php echo $web['p_b1'] ?> <?php echo $result[0]['p_b1']; ?> in 1 <?php echo $result[0]['p_b']; ?></p>
                                  <br>
                                  <div class="">
                                    <div class="description_section_2 v_centered"> <span class="title"><?php echo $result[0]['p_b']; ?>:</span>
                                      <div class="qty min clearfix">
                                        <button class="theme_button" type="button" data-direction="minus">&#45;</button>
                                        <input type="text" name="quantity" value="1">
                                        <button class="theme_button" type="button" data-direction="plus">&#43;</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div style="padding:5px 10px 0 10px; color: green;" id="wishlist_ret"></div>
                                  <div class="buttons_row">
                                      <button type="submit" class="button_lblue middle_btn" name="form2" value="Add to Cart">Add to Cart</button>
                                  

                                    <?php
		   if(isset($_SESSION['email'])){
			   if(!empty($_SESSION['wishlist'])){  if(!in_array($result[0]["id"], $_SESSION['wishlist'])){ $wishlistTrue=1;  }else{$wishlistTrue=0;} }else{ $wishlistTrue=1; } ?>
                                    <?php if($wishlistTrue){ ?>
                                    <div class="actions_wrap pull-right" id="Hide<?php echo  $result[0]["id"]; ?>"> <a href="javascript:void(0)" onClick="wishlist('<?php echo  $result[0]["id"]; ?>')" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
                                    <?php } ?>
                                    <?php }else{ ?>
                                    <div class="actions_wrap pull-right" > <a href="login.php?login_attempt=2" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
                                    <?php } ?>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

                    </div>
                    <!--/ .section_offset -->
                    <br>
                    <hr>
                    <br>
                   <!--  <div class="section_offset">
                      <div class="tabs type_2">


                        <ul class="tabs_nav clearfix">
                          <li><a href="#tab-1">Description</a></li>
                        </ul>

                   

                        <div class="tab_containers_wrap">

                         

                          <div id="tab-1" class="tab_container">
                            <h6>How Nimulid Tablet works</h6>
                            <p> Nimulid 100mg tablet is a non-steroidal anti-inflammatory drug (NSAID). It works by blocking the release of certain chemical messengers that cause fever, pain and inflammation (redness and swelling).</p>
                          </div>
                        </div>
                       

                      </div>
                     

                    </div> -->
                    
                    
                    <!--/ .section_offset -->
                  </div>
                  
                </main>
                <main class="col-md-4 col-sm-4">
                  <section class="section_offset">
                    <div class="theme_box">
					<?php  $Sql_Substitutes="SELECT id,name,company_name,p_b,p_b1 FROM `products` where solt='".$result[0]['solt_id']."' AND id!='".$result[0]['id']."'";
								$result_Substitutes=$DB->runQuery($Sql_Substitutes); ?>

								<?php if($result_Substitutes!='') { ?>
                      <h4>Substitutes for <?php echo $result[0]['name']; ?></h4>
                      <ul class="products_list_widget">
                        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
                        <?php
								$Substitutes_count=1;
								foreach($result_Substitutes as $key){
									if($Substitutes_count==6) break;
									$id=$key['id'];
									$price_pro=mysql_query("select * from price where p_id='$id' AND price.price>'0' AND price.status='1' order by price.price asc limit 1 ");
									$price_pass=mysql_fetch_assoc($price_pro);
									$key['price']=$price_pass['price'];
									$key['orgprice']=$price_pass['orgprice'];
									$key['price_per']=$price_pass['price_per'];
									$key['p_b1_div']=$price_pass['p_b1'];
									if($key['price']<=$result[0]['price']){
										$result_company_name=$DB->fectch_prices("SELECT name,id FROM `company_name` where id='".$key['company_name']."'");
										$key['company_name']=$result_company_name[$key['company_name']]['name'];
										$p_b=$key['p_b'];
										$p_b1=$key['p_b1'];
										$result_p_b_sub=$DB->fectch_prices("SELECT name,id FROM `packing` where id IN ('$p_b1','$p_b')");
										$key['p_b1']=$result_p_b_sub[$p_b1]['name'];
										$key['p_b']=$result_p_b_sub[$p_b]['name'];
									?>
                                        <li>
                                          <div class="wrapper">
                                            <div class="row">
                                              <div class="col-lg-8"> <a href="product_details-medicine.php?q=<?php echo $key['id']; ?>" class="product_title"><?php echo $key['name']; ?></a>
                                                <p><small><?php echo $key['company_name']; ?></small></p>

                                                <p class="product_price"><s><?php echo $key['orgprice']>$key['price']?'<i class="icon-rupee"></i>'.$key['orgprice']:''; ?></s> <?php echo $key['price_per']>0? $key['price_per'].'% Off':''; ?></p>
                                  <p><strong><i class="icon-rupee"></i><?php echo (($key['price'])/$key['p_b1_div']); ?>/<?php echo $key['p_b1']; ?></strong></p>
                                  <p><?php echo $key['p_b1_div'] ?> <?php echo $key['p_b1']; ?> in 1 <?php echo $key['p_b']; ?></p>

                                              </div>
                                              <div class="col-lg-4">
                                                <div class="clearfix product_info">
                                                  <p class="product_price"><b class="theme_color"><i class="icon-rupee"></i><?php echo $key['price']; ?></b></p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </li>
                                    <?php
									$Substitutes_count++;
									}
									/* End */
								}

						?>

                      </ul>
					  <?php } else { ?>
					 <table><tbody><tr><td style="vertical-align: middle; text-align:right; border: 0; padding: 0;"> <span class="stkq"> No </span></td><td style="vertical-align: middle; border: 0;"> <span class="stock-icon">substitutes<br> available  </span></td></tr></tbody></table>
					  <?php } ?>

                    </div>
                    <!--/ .theme_box -->

                    <br>
                    <br>
                  </section>
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

		</script>
</body>
</html>
