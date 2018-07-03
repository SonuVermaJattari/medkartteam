<?php include_once 'inc/functions.php'; ?>
<?php 
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
session_start();
if($_SESSION['SessID']=='')
	{
	$SID=session_id();
	$_SESSION['SessID']=$SID;
	}
if(isset($_SESSION['email'])){
	$username=$_SESSION['email'];
}else{
	$username=$_SESSION['SessID'];
}
ob_start();
?>
<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

<header id="header">
  
  <!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->
  
  <div class="bottom_part">
    <div class="sticky_part">
      <div class="top-strip">
        <p>Flat 20% off on Medicines + Extra 10% MobiKwik SuperCash + Rs.50 Cash Up For Grab Know More <span id="hide" class="pull-right" style="color: #032c58;font-size: 15px; cursor:pointer"><b>X</b></span></p>
      </div>
      <div class="container">
        <div class="row">
          <div class="main_header_row">
            <div class="col-md-4"> 
              
              <!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - --> 
              
              <a href="index.php" class="logo"> <img src="images/medkart-logo.jpg" alt=""> </a> 
              
              <!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - --> 
              
            </div>
            <!--/ [col]-->
            
            <div class="col-lg-6 col-sm-6" style="border-right:1px solid #ddd;">
              <div class="align_right" style="margin-top: 20px; margin-bottom: 20px;"> 
                
                <!-- - - - - - - - - - - - - - Login / register - - - - - - - - - - - - - - - - -->
                
                <div class="login" style="font-size: 18px;">
                  <?php  if(empty($_SESSION['email'])) {  ?>
                  <a  href="login.php">Login</a> | <a  href="register.php">Register</a>
                  <?php }else{  ?>
                  <a  href="myaccount.php"><?php echo $_SESSION['title'].' '.$_SESSION['firstname'].' '.$_SESSION['lastname']; ?></a> | <a  href="logout.php">Sign Out</a>
                  <?php } ?>
                </div>
                <!--/ .login--> 
                
                <!-- - - - - - - - - - - - - - End of Login / register - - - - - - - - - - - - - - - - --> 
                
                <!-- - - - - - - - - - - - - - Shopping cart - - - - - - - - - - - - - - - - -->
                
                <div class="shopping_cart_wrap">
                <?php
					$ctr=0;
					$sql="select * from products_added where username='".$username."' order by id desc";
					$res=mysql_query($sql);
					$count=mysql_num_rows($res); ?>
                  <button id="open_shopping_cart" class="open_button" data-amount="<?php echo $count; ?>"> <!--<b class="total_price">Rs.999.00</b>--> <b class="title"></b> </button>
                  
                  <!-- - - - - - - - - - - - - - Products list - - - - - - - - - - - - - - - - -->
                  
                  <div class="shopping_cart dropdown">
                    <div class="animated_item">
                      <p class="title">Recently added item(s)</p>
                       </div>
                       <?php if($count>0){
						   	$sumRs=0;
						while($rs=mysql_fetch_assoc($res)){
						$product_id=$rs['product_id'];
						$product_qty=$rs['product_qty'];
						$price_id=$rs['price_id'];
						$sqlproducts="SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id  where p.id='".$product_id."'";
						$resProducts=$DB->runQuery($sqlproducts);
						$resProducts=$resProducts[0];
						$sqlprice="SELECT * FROM `price`  where id='".$price_id."'";
						$resprice=$DB->runQuery($sqlprice);
						$resprice=$resprice[0];
						?>
                      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
                    <div class="animated_item">    
                      <div class="clearfix sc_product"> <a href="<?php echo $resProducts['menu']=='1'?'product_details-medicine.php?q='.$resProducts['id']:'product_details.php?q='.$resProducts['id']; ?>" class="product_name"><?php echo $resProducts['name']; ?></a>
                        <p><?php $sumRs=$sumRs+($product_qty*$resprice['price']); ?><?php echo 'Qty: '.$product_qty; ?> *<?php echo ' Rs. '.$resprice['price']; ?>= Rs. <?php echo $product_qty*$resprice['price']; ?></p>
                        <!--<button class="close"></button>-->
                      </div>
                      <!--/ .clearfix.sc_product--> 
                      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - --> 
                    </div>
                   <?php /*?> <!--/ .animated_item-->
                    <div class="animated_item"> 
                      
                      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
                      
                      <div class="clearfix sc_product"> <a href="#" class="product_thumb"><img src="images/sc_img_2.jpg" alt=""></a> <a href="#" class="product_name">Lorem Ipsum Dolor Sit Amet...</a>
                        <p>1 x Rs.499.00</p>
                        <button class="close"></button>
                      </div>
                      <!--/ .clearfix.sc_product--> 
                      
                      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - --> 
                      
                    </div>
                    <!--/ .animated_item-->
                    <div class="animated_item"> 
                      
                      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
                      
                      <div class="clearfix sc_product"> <a href="#" class="product_thumb"><img src="images/sc_img_3.jpg" alt=""></a> <a href="#" class="product_name">Nemo Enim Ipsam <br>
                        Voluptatem 30 ea</a>
                        <p>1 x Rs.499.00</p>
                        <button class="close"></button>
                      </div>
                      <!--/ .clearfix.sc_product--> 
                      
                      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - --> 
                      
                    </div>
                    <!--/ .animated_item--><?php */?>
					<?php } ?>
                    <div class="animated_item"> 
                      
                      <!-- - - - - - - - - - - - - - Total info - - - - - - - - - - - - - - - - -->
                      
                      <ul class="total_info">
                        <!--<li><span class="price">Tax:</span> Rs.0.00</li>
                        <li><span class="price">Discount:</span> Rs.37.00</li>-->
                        <li class="total"><b><span class="price">Total:</span> Rs.<?php echo $sumRs; ?></b></li>
                      </ul>
                      
                      <!-- - - - - - - - - - - - - - End of total info - - - - - - - - - - - - - - - - --> 
                      
                    </div>
                    <div class="animated_item"> <a href="shopping_cart.php" class="button_grey">View Cart</a> <a href="checkout.php" class="button_blue">Checkout</a> </div>
                    <!--/ .animated_item--> 
                  <?php  }else{ ?>
                    <div class="animated_item">
			<p class="title">Empty..</p></div>
			<?php	} ?>
                  </div>
                  <!--/ .shopping_cart.dropdown--> 
                  
                  <!-- - - - - - - - - - - - - - End of products list - - - - - - - - - - - - - - - - --> 
                  
                </div>
                <!--/ .shopping_cart_wrap.align_left--> 
                
                <!-- - - - - - - - - - - - - - End of shopping cart - - - - - - - - - - - - - - - - --> 
                
              </div>
              <!--/ .align_right--> 
              
            </div>
            <div class="col-lg-2 col-sm-2 col-xs-12 align_center">
              <p style="background-color: #032c58; color: #fff; margin-top: 17px;border-radius: ; border: 1px solid #eaeaea; padding: 8px 10px 8px 12px; width: 100%; border-radius: 3px;" >Upload <br/> Prescription</p>
            </div>
          </div>
          <!--/ .main_header_row--> 
        </div>
        
        <!--/ .row--> 
      </div>
      <!--/ .container-->
      
      <div class="nav_item clearfix" style="margin-top: 15px;">
<div class="container">
										
                                        <nav class="main_navigation clearfix">

                                            <?php /*?><ul class="clearfix">

												<li class="has_submenu"><a href="product_listing.php"><img src="images/medicinei.png"/> Medicine</a>
                                                <ul class="theme_menu submenu">														
														<li>
															<a href="product_listing.php">Product 1</a>														
															<ul>
																<li><a href="product_listing.php">Product 1- 1</a></li>
																<li><a href="product_listing.php">Product 1- 2</a></li>
																<li><a href="product_listing.php">Product 1- 3</a></li>		
															</ul>
                                                            </li>
														<li><a href="product_listing.php">Product 2</a></li>							
													</ul>
                                                </li>
												<li><a href="product_listing.php"><img src="images/devicesi.png" /> Medical Devices</a></li>
												<li class="has_submenu"><a href="product_listing.php"><img src="images/otci.png" /> OTC</a>                                                <ul class="theme_menu submenu">														
														<li>
															<a href="product_listing.php">Contraceptives</a></li>
														<li><a href="product_listing.php">Pain Relief</a></li>							
													</ul>
                                                </li>
                                                <li><a href="product_listing.php"><img src="images/insurancei.png"/> Insurance</a></li>
												<li><a href="product_listing.php"><img src="images/blogi.png" /> Blogs</a></li>
												<li class="hidden"><a href="#">Calculator</a></li>
											</ul><?php */?>
   <ul class="clearfix">
<?php 	

	$menu_fetch=mysql_query("select * from menu where status='1' ORDER BY sort");
	while($web=mysql_fetch_assoc($menu_fetch)) { ?>
		<li class="<?php echo $web['link']=='0'?'has_submenu':'';?>">
        <a href="<?php echo $web['link']=='New Page'?'about.php?q='.$web['id'].'&&menu='.$web['enum']:($web['link']=='0'?"product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@', $web['menu'])):($web['link']=='gallery'?'gallery.php?q='.$web['id'].'&&menu='.$web['enum']:($web['link']=='product'?"product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$web['menu'])):$web['link']))); ?>"><img src="<?php echo $web['menu_icon']; ?>" /><?php echo $web['menu']; ?></a>
       		<?php  if(($web['link']=='0')){ ?>
           	<ul class="theme_menu submenu">			
                <?php 
				$menu_id=$web['id'];
                $sub_menu_fetch=mysql_query("select * from sub_menu where status='1' AND menu='$menu_id' ORDER BY sort");
                while($sub_web=mysql_fetch_assoc($sub_menu_fetch)) { 
				?>
           		<li class="<?php echo $sub_web['link']=='0'?'has_submenu':'';?>"><a href="<?php echo $sub_web['link']=='New Page'?'about.php?q='.$sub_web['id'].'&&menu='.$sub_web['enum']:($sub_web['link']=='0'?"product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$web['menu'])).'-'.preg_replace('/\s+/', '_', str_replace('&', '@',$sub_web['sub_menu'])):($sub_web['link']=='gallery'?'gallery.php?q='.$sub_web['id'].'&&menu='.$sub_web['enum']:($sub_web['link']=='product'?"product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$web['menu'])).'-'.preg_replace('/\s+/', '_',str_replace('&', '@',$sub_web['sub_menu'])):$sub_web['link']))); ?>"><?php echo $sub_web['sub_menu']; ?></a>
                <?php if($sub_web['link']=='0'){ ?>
                 <ul class="theme_menu submenu">
					<?php $sub_menu_id=$sub_web['id'];
						$sub_sub_menu_fetch=mysql_query("select * from sub_sub_menu where status='1' AND sub_menu='$sub_menu_id' ORDER BY sort");
						while($sub_sub_web=mysql_fetch_array($sub_sub_menu_fetch)) { 
		  			?>
					<li><a href="<?php echo $sub_sub_web['link']=='New Page'?'about.php?q='.$sub_sub_web['id'].'&&menu='.$sub_sub_web['enum']:
					($sub_sub_web['link']=='0'?"javascript:void(0);":($sub_sub_web['link']=='gallery'?'gallery.php?q='.$sub_sub_web['id'].'&&menu='.$sub_sub_web['enum']:($sub_sub_web['link']=='product'?"product_listing.php?q=".preg_replace('/\s+/', '_', str_replace('&', '@',$web['menu'])).'-'.preg_replace('/\s+/', '_', str_replace('&', '@',$sub_web['sub_menu'])).'-'.preg_replace('/\s+/', '_', str_replace('&', '@',$sub_sub_web['sub_sub_menu'])):
					$sub_sub_web['link']))); ?>"><?php echo $sub_sub_web['sub_sub_menu']; ?></a></li>
					<?php } ?>
				</ul>
				<?php } ?>
              </li>
			<?php } ?>
			</ul>
			<?php } ?>
			</li>
<?php 	} ?>                  
</ul>
										</nav><!--/ .main_navigation-->
									</div>
                                    </div>
    </div>
  </div>
  <!--/ .bottom_part --> 
  
  <!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - 

<div class="menudiv"><div class="container"></div></div> -->
  
  </header>
  <div class="clearfix"></div>
