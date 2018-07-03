<?php  session_start();
include 'inc/functions.php';
//print_r($_POST);

error_reporting(0);
if(isset($_POST['brand'])){
	$_SESSION['Lfil_brand']=$_POST['brand'];
	$brand=$DB->lastRemove($_POST['brand'],'brand');
	$_SESSION['fil_brand']=$brand;
}else{
	unset($_SESSION['fil_brand']);
	unset($_SESSION['Lfil_brand']);
}
if(isset($_POST['discount'])){
	$_SESSION['Lfil_discount']=$_POST['discount'];
	$discount=$DB->lastRemove_sin($_POST['discount'],'discount');
	$_SESSION['fil_discount']=$discount;
}else{
	unset($_SESSION['fil_discount']);
	unset($_SESSION['Lfil_discount']);
}
if(isset($_POST['form'])){
	$_SESSION['Lfil_form']=$_POST['form'];
	$form=$DB->lastRemove($_POST['form'],'form');
	$_SESSION['fil_form']=$form;
}else{
	unset($_SESSION['fil_form']);
	unset($_SESSION['Lfil_form']);
}
if(isset($_POST['uses'])){
	$_SESSION['Lfil_uses']=$_POST['uses'];
	$uses=$DB->lastRemove($_POST['uses'],'uses');
	$_SESSION['fil_uses']=$uses;
}else{
	unset($_SESSION['fil_uses']);
	unset($_SESSION['Lfil_uses']);
}
if(isset($_POST['age'])){
	$_SESSION['Lfil_age']=$_POST['age'];
	$age=$DB->lastRemove_sin($_POST['age'],'age');
	$_SESSION['fil_age']=$age;
}else{
	unset($_SESSION['fil_age']);
	unset($_SESSION['Lfil_age']);
}
if(isset($_POST['gender'])){
	$_SESSION['Lfil_gender']=$_POST['gender'];
	$gender=$DB->lastRemove_sin($_POST['gender'],'gender');
	$_SESSION['fil_gender']=$gender;

}else{
	unset($_SESSION['fil_gender']);
	unset($_SESSION['Lfil_gender']);
}


?>
<?php if(isset($_SESSION['menu'])){
		$menu=$_SESSION['menu'];
		$where="products.menu='$menu' ";
	}
	if(isset($_SESSION['sub_menu'])){
		$sub_menu=$_SESSION['sub_menu'];
		$where.="AND products.sub_menu='$sub_menu' ";
	}if(isset($_SESSION['sub_sub_menu'])){
		$sub_sub_menu=$_SESSION['sub_sub_menu'];
		$where.="AND products.sub_sub_menu='$sub_sub_menu'";
	}
	if(isset($_SESSION['fil_brand'])){
		$fil_brand=$_SESSION['fil_brand'];
		$where.="AND $fil_brand ";
	}if(isset($_SESSION['fil_discount'])){
		$fil_discount=$_SESSION['fil_discount'];
		$where.="AND $fil_discount ";
	}if(isset($_SESSION['fil_form'])){
		$fil_form=$_SESSION['fil_form'];
		$where.="AND $fil_form ";
	}if(isset($_SESSION['fil_uses'])){
		$fil_uses=$_SESSION['fil_uses'];
		$where.="AND $fil_uses ";
	}if(isset($_SESSION['fil_age'])){
		$fil_age=$_SESSION['fil_age'];
		$where.="AND $fil_age ";
	}if(isset($_SESSION['fil_gender'])){
		$fil_gender=$_SESSION['fil_gender'];
		$where.="AND $fil_gender ";
	}

	$Sql="SELECT * FROM `products` where ".$where;
	$result=$DB->runQuery($Sql);
	//print_r($result);
	print_r($_SESSION['Lfil_brand']);
	print_r($_SESSION['Lfil_discount']);
	print_r($_SESSION['Lfil_form']);
	print_r($_SESSION['Lfil_uses']);
	print_r($_SESSION['Lfil_age']);
	print_r($_SESSION['Lfil_gender']);
	?>
<div class="section_offset">
<div style="padding:5px 10px 0 10px; color: green;" id="wishlist_ret"></div>
  <header class="top_box on_the_sides">
    <div class="left_side clearfix v_centered">

      <!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->

      <div class="v_centered"> <span>Sort by:</span>
        <div class="custom_select sort_select">
          <select name="">
            <option value="Default">Default</option>
            <option value="Price">Price</option>
            <option value="Name">Name</option>
            <option value="Date">Date</option>
          </select>
        </div>
      </div>

      <!-- - - - - - - - - - - - - - End of sort by - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Number of products shown - - - - - - - - - - - - - - - - -->

      <div class="v_centered"> <span>Show:</span>
        <div class="custom_select">
          <select name="">
            <option value="15">15</option>
            <option value="12">12</option>
            <option value="9">9</option>
            <option value="6">6</option>
            <option value="3">3</option>
          </select>
        </div>
      </div>

      <!-- - - - - - - - - - - - - - End of number of products shown - - - - - - - - - - - - - - - - -->

    </div>
  </header>



  <div class="table_layout" id="products_container">
 <?php $output = ''; $i=0;
foreach($result as $k=>$v) {
		$key=$result[$k]["id"];

		if($result[$k]["menu"]=='1'){
			$u='product_details-medicine';
		}else{
			$u='product_details';
		}
   $price_prore=mysql_query("select * from price where p_id='$key' AND price.price>'0' AND price.status='1'  order by price.price asc limit 1 ");
	$price_pass_re=mysql_fetch_assoc($price_prore);
	$mrp=$price_pass_re['price'];
	$orgmrp=$price_pass_re['orgprice'];
	if($mrp>0){

	if($i==0){echo '<div class="table_row"> ';}
	 ?>


      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">
        <div class="product_item">
          <div class="image_wrap"> <a href="<?php echo $u; ?>.php?q=<?php echo  $result[$k]["id"]; ?>"> <img src="<?php echo  $result[$k]["img"]; ?>" alt=""></a>
          <?php
		   if(isset($_SESSION['email'])){
			   if(!empty($_SESSION['wishlist'])){  if(!in_array($result[$k]["id"], $_SESSION['wishlist'])){ $wishlistTrue=1;  }else{$wishlistTrue=0;} }else{ $wishlistTrue=1; } ?>
    	      <?php if($wishlistTrue){ ?><div class="actions_wrap" id="Hide<?php echo  $result[$k]["id"]; ?>">
              <a href="javascript:void(0)" onclick="wishlist('<?php echo  $result[$k]["id"]; ?>')" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>
            </div> <?php } ?>
            <?php }else{ ?>
            <div class="actions_wrap" >
              <a href="login.php?login_attempt=2" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>
            </div>

			<?php } ?>
          </div>


          <div class="description"> <a href="<?php echo $u; ?>.php?q=<?php echo  $result[$k]["id"]; ?>"><?php echo $DB->limitText($result[$k]["name"],40); ?></a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><b><i class="icon-rupee"></i><?php echo $mrp; ?></b></p>
              <?php /*?><ul class="rating alignright">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li></li>
              </ul><?php */?>
            </div>
          </div>
        </div>
      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <?php /*?><div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/product_img_8.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_bestseller">Bestseller</div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Nemo enim ipsam voluptatem quia, 4.25 fl oz (126ml)</a>
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

          <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Nemo enim ipsam voluptatem quia, 4.25 fl oz (126ml)</a> <a href="#" class="product_category">Bath &amp; Spa</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

              <ul class="rating">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li><a href="#">3 Review(s)</a></li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs8.99</p>
            <ul class="seller_stats">
              <li>Shipping: Rs11.24/piece</li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="product_details.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div><?php */?>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <?php /*?><div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/product_img_9.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Quis autem vel eum iure reing elit, 2mg</a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><b>Rs76.99</b></p>
            </div>
          </div>

          <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Quis autem vel eum iure reing elit, 2mg</a> <a href="#" class="product_category">Beauty Clearance</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li>0 Review(s)</li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs76.99</p>
            <ul class="seller_stats">
              <li>Shipping: <span class="success">Free Shipping</span></li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="product_details.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div><?php */?>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->



 <?php
 if($i==2){echo '</div>'; $i=-1;}

 $i++; } } ?>
    <!--/ .table_row -->

    <?php /*?><div class="table_row">

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">

        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/product_img_6.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_new">New</div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Aliquam congue fermentum nisl, 100mg, Softgels 120 ea</a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><b>Rs75.39</b></p>
            </div>
          </div>

          <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Aliquam congue fermentum nisl, 100mg, Softgels 120 ea</a> <a href="#" class="product_category">Beauty Clearance</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li>0 Review(s)</li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs75.39</p>
            <ul class="seller_stats">
              <li>Shipping: Rs16.63/piece</li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="product_details.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

        <!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/product_img_14.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_offer percentage">
              <div>30%</div>
              OFF </div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Praesent justo dolor, Vcaps 60 ea</a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><s>Rs99.99</s> <b>Rs79.99</b></p>

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

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Praesent justo dolor, Vcaps 60 ea</a> <a href="#" class="product_category">Gift Sets</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

              <ul class="rating">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li>0 Review(s)</li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold"><s>Rs99.99</s> Rs79.99</p>
            <ul class="seller_stats">
              <li>Shipping: <span class="success">Free Shipping</span></li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="product_details.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/product_img_15.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_new">New</div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Donec sagittis euismod purus, 12 ea</a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><b>Rs24.99</b></p>
            </div>
          </div>

          <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Donec sagittis euismod purus, 12 ea</a> <a href="#" class="product_category">Hair Care</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li>0 Review(s)</li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs24.99</p>
            <ul class="seller_stats">
              <li>Shipping: <span class="success">Free Shipping</span></li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="product_details.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

    </div><?php */?>
    <!--/ .table_row -->

    <?php /*?><div class="table_row">

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <img src="images/tabs_img_1.jpg" alt="">

            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_new">New</div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Suspendisse sollicitudin velit sed leo, Softgels 120 ea</a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><b>Rs44.99</b></p>
            </div>
          </div>

          <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Suspendisse sollicitudin velit sed leo, Softgels 120 ea</a> <a href="#" class="product_category">Hair Care</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li>0 Review(s)</li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs44.99</p>
            <ul class="seller_stats">
              <li>Shipping: Rs5.00/piece</li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="product_details.php" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/tabs_img_2.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_soldout">Sold Out</div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Quisque diam lorem, interdum vitae</a>
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

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Quisque diam lorem, interdum vitae</a> <a href="#" class="product_category">Beauty Clearance</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

              <ul class="rating">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li><a href="#">5 Review(s)</a></li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs39.39</p>
            <ul class="seller_stats">
              <li>Shipping: <span class="success">Free Shipping</span></li>
              <li>Availability: <span class="out_of_stock">out of stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

      <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

      <div class="table_cell">
        <div class="product_item">

          <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

          <div class="image_wrap"> <a href="product_details.php"> <img src="images/tabs_img_3.jpg" alt=""> </a>
            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

              <!--/ .centered_buttons -->

              <a href="wishlist.php" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a> </div>
            <!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

            <div class="label_hot">Hot</div>

            <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

          </div>
          <!--/. image_wrap-->

          <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

          <div class="description"> <a href="#">Vestibulum iaculis lacinia est, 2.5 fl oz (75ml)</a>
            <div class="clearfix product_info">
              <p class="product_price alignleft"><b>Rs44.99</b></p>
            </div>
          </div>

          <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="full_description"> <a href="#" class="product_title">Vestibulum iaculis lacinia est, 2.5 fl oz (75ml)</a> <a href="#" class="product_category">Makeup &amp; Accessories</a>
            <div class="v_centered product_reviews">

              <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

              <ul class="topbar">
                <li>5 Review(s)</li>
                <li><a href="#">Add Your Review</a></li>
              </ul>

              <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>
            <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula.</p>
            <a href="#" class="learn_more">Learn More</a> </div>

          <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

          <div class="actions">
            <p class="product_price bold">Rs44.99</p>
            <ul class="seller_stats">
              <li>Shipping: <span class="success">Free Shipping</span></li>
              <li>Availability: <span class="success">in stock</span></li>
              <li class="seller_info_wrap"> Seller: <span class="seller_name">johnsmith</span>
                <div class="seller_info_dropdown">
                  <ul class="seller_stats">
                    <li>
                      <ul class="topbar">
                        <li>China (Mainland)</li>
                        <li><a href="#">Contact Details</a></li>
                      </ul>
                    </li>
                    <li><span class="bold">99.8%</span> Positive Feedback</li>
                  </ul>
                  <div class="v_centered"> <a href="#" class="button_blue mini_btn">Contact Seller</a> <a href="#" class="small_link">Chat Now</a> </div>
                </div>
              </li>
            </ul>
            <ul class="buttons_col">
              <li><a href="#" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>
            </ul>
          </div>

          <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        </div>
        <!--/ .product_item-->

      </div>

      <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

    </div><?php */?>
    <!--/ .table_row -->

  </div>
  <!--/ .table_layout -->

</div>
<footer class="bottom_box on_the_sides">
    <div class="left_side">
      <p>Showing 1 to 3 of 45 (15 Pages)</p>
    </div>
    <div class="right_side">
      <ul class="pags">
        <li><a href="#"></a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#"></a></li>
      </ul>
    </div>
  </footer>
