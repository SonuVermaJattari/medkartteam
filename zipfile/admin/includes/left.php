<aside class="left-side sidebar-offcanvas">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		
		<a href="../index.php" >
		<div class="user-panel">
			<div class="pull-left image" style="text-align: center;margin-top: -47px;/* background-color: #f4f4f4; */"> <img src="<?php echo $DB->logo();  ?>" style="width: 87%;height: 100%;border: 0px !important;" class="" alt="<?php echo $DB->projectname();  ?>" /> </div>
		</div>
		</a>
		<ul class="sidebar-menu">
			<li class="active"> <a href="index.php"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
			<li class="treeview"><a href="#"> <i class="fa fa-home" aria-hidden="true"></i> <span>Home</span> <i class="fa fa-angle-left pull-right"></i> </a>
				<ul class="treeview-menu">
					<li> <a href="contact_address.php"> <i class="fa fa-mobile-phone"></i>Contact Us</a></li>
					<li> <a href="home_text.php"> <i class="fa fa-edit"></i>Home Text</a></li>
					<li><a href="slider_view.php"><i class="fa fa-picture-o"></i>Slider</a></li>
                    <li><a href="afterSlider_view.php"><i class="fa fa-picture-o"></i>After Slider view</a></li>
				</ul>
			</li>
            <li class="treeview"> <a href="#"> <i class="fa fa-bars"></i> <span>Menu/Sub menus</span> <i class="fa fa-angle-left pull-right"></i> </a>
				<ul class="treeview-menu">
					<li><a href="menu_view.php"><i class="fa fa-angle-double-right"></i>Menu</a></li>
					<li class="treeview"> <a href="#"> <i class="fa fa-bars"></i> <span>Sub menu</span> <i class="fa fa-angle-left pull-right"></i> </a>
				<ul class="treeview-menu">
					<li><a href="sub_menu.php"><i class="fa fa-angle-double-right"></i>ADD Sub Menu</a></li>
					<?php 

							  	$array=array();

							  	$resultu_menu = mysql_query("select * from menu where link='0' OR link='products.php'");

								while($menu_res = mysql_fetch_array($resultu_menu)){

									$key=$menu_res['id'];

									$array[$key]=$menu_res['menu'];

								}
							 // print_r($array);
								$sqlu = "select DISTINCT menu from sub_menu where status='1' ";
								$resultu = mysql_query($sqlu);
								while($menu = mysql_fetch_array($resultu)){ 
									$id=$menu['menu'];
									$array[$id];
									//echo $menu_res['menu'];
									//echo $menu['menu'];
								?>
					<li><a href="sub_menu_view.php?q=<?php echo $menu['menu']; ?>"><i class="fa fa-angle-double-right"></i><?php echo $array[$id];?> View/Edit</a></li>
					<?php }?>
                    <li class="treeview">

                            <a href="#">

                                <i class="fa fa-bars"></i>

                                <span>Sub Sub Menu</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li><a href="sub_sub_menu.php"><i class="fa fa-angle-double-right"></i>ADD Sub Sub Menu</a></li>

							  <?php 

							  

							  $array_sub=array();

							  	$resultu_sub_menu = mysql_query("select * from sub_menu where link='0' OR link='products.php'");

								while($sub_menu_res = mysql_fetch_array($resultu_sub_menu)){

									$key1=$sub_menu_res['id'];

									//$key2=$sub_menu_res['menu'];

									$array_sub[$key1]['sub_menu']=$sub_menu_res['sub_menu'];

									$array_sub[$key1]['menu']=$sub_menu_res['menu'];

								}

							  

							  

							  

								$sqlu = "select DISTINCT sub_menu from sub_sub_menu where status='1' ";

								$resultu = mysql_query($sqlu);

								while($menu = mysql_fetch_array($resultu)){ 

								//print_r($array_sub);

								//echo $array_sub[$menu['sub_menu']]['sub_menu'].$array[$array_sub[$menu['sub_menu']]['menu']];

								//echo $array_sub[$menu['sub_menu']];

								$xyz= $array[$array_sub[$menu['sub_menu']]['menu']].'('.$array_sub[$menu['sub_menu']]['sub_menu'].')';

								?>

								<li><a href="sub_sub_menu_view.php?q=<?php echo $menu['sub_menu']; ?>"><i class="fa fa-angle-double-right"></i>

								<?php echo $array[$array_sub[$menu['sub_menu']]['menu']].' ('.$array_sub[$menu['sub_menu']]['sub_menu'].')<br>'.str_repeat('&nbsp;', 10); ?>View/Edit</a></li>

							 	<?php }?>

                            </ul>

                      </li>
				</ul>
			</li>
				</ul>
			</li>
           
            <li class="treeview">
                           <a href="#">
                               <i class="fa fa-pencil-square-o"></i>
                               <span>Shipping Charges</span>
                               <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                               <li><a href="add_shippingcharges.php"><i class="fa fa-angle-double-right"></i>Add Shipping Charges</a></li>
                               <li><a href="list_shippingcharges.php"><i class="fa fa-angle-double-right"></i>View/Edit Shipping Charges</a></li>
                           </ul>
                       	</li>
             <li class="treeview">
                            <a href="#">
                                <i class="fa fa-wrench"></i>
                                <span>Filter Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               	<li class="treeview">
                           <a href="#">
                               <i class="fa fa-pencil-square-o"></i>
                               <span>Brand Management</span>
                               <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                               <li><a href="add_brand.php"><i class="fa fa-angle-double-right"></i>Add Brand</a></li>
                               <li><a href="list_brand.php"><i class="fa fa-angle-double-right"></i>View/Edit Brand</a></li>
                           </ul>
                       	</li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Discount Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_discount.php"><i class="fa fa-angle-double-right"></i>Add Discount</a></li>
                                       <li><a href="list_discount.php"><i class="fa fa-angle-double-right"></i>View/Edit Discount</a></li>
                                   </ul>
                                </li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Product Form Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_form.php"><i class="fa fa-angle-double-right"></i>Add Product Form</a></li>
                                       <li><a href="list_form.php"><i class="fa fa-angle-double-right"></i>View/Edit Product Form</a></li>
                                   </ul>
                                </li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>uses  Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_uses.php"><i class="fa fa-angle-double-right"></i>Add uses</a></li>
                                       <li><a href="list_uses.php"><i class="fa fa-angle-double-right"></i>View/Edit uses</a></li>
                                   </ul>
                               </li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Age Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_age.php"><i class="fa fa-angle-double-right"></i>Add Age</a></li>
                                       <li><a href="list_age.php"><i class="fa fa-angle-double-right"></i>View/Edit Age</a></li>
                                   </ul>
                               </li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Gender Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_gender.php"><i class="fa fa-angle-double-right"></i>Add Gender</a></li>
                                       <li><a href="list_gender.php"><i class="fa fa-angle-double-right"></i>View/Edit Gender</a></li>
                                   </ul>
                               </li>
                              
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Packing Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_pack.php"><i class="fa fa-angle-double-right"></i>Add Packing</a></li>
                                       <li><a href="list_pack.php?q=1"><i class="fa fa-angle-double-right"></i>Packing</a></li>
                                       <li><a href="list_pack.php?q=2"><i class="fa fa-angle-double-right"></i> Packet/Box</a></li>
                                   </ul>
                                </li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Company Name</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_company_name.php"><i class="fa fa-angle-double-right"></i>Add Company Name</a></li>
                                       <li><a href="list_company_name.php"><i class="fa fa-angle-double-right"></i>Company Name</a></li>
                                   </ul>
                                </li>
                                <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-pencil-square-o"></i>
                                       <span>Solt Management</span>
                                       <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <li><a href="add_solt.php"><i class="fa fa-angle-double-right"></i>Add Solt</a></li>
                                       <li><a href="list_solt.php"><i class="fa fa-angle-double-right"></i>Solt</a></li>
                                   </ul>
                                </li>
                            </ul>
                        </li>
            <li class="treeview">

                            <a href="#">

                                <i class="fa fa-bars"></i>

                                <span>Products</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li><a href="products.php"><i class="fa fa-angle-double-right"></i>ADD Products</a></li>
                                <li><a href="product_view.php"><i class="fa fa-angle-double-right"></i>View Products</a></li>
                               <!-- <li class="treeview"><a href="#"> <i class="fa fa-bars" aria-hidden="true"></i> <span>View Products</span> <i class="fa fa-angle-left pull-right"></i> </a>
                        <ul class="treeview-menu">
							  <?php 
							  	$menu_array=$DB->fetch_menu('menu','id,menu','menu');
								$submenu_array=$DB->fetch_menu('sub_menu','id,sub_menu','sub_menu');
								$subsubmenu_array=$DB->fetch_menu('sub_sub_menu','id,sub_sub_menu','sub_sub_menu');
								$sqlu = "SELECT *, count(id) FROM `products` GROUP BY menu,sub_menu,sub_sub_menu ORDER by products.enum";
								$resultu = mysql_query($sqlu);
								while($menu = mysql_fetch_array($resultu)){ 
								//$xyz= $array[$array_sub[$menu['sub_menu']]['menu']].'('.$array_sub[$menu['sub_menu']]['sub_menu'].')';
								?>

								<li><a href="products_view.php?menu=<?php echo $menu['menu']; ?>&&sub_menu=<?php echo $menu['sub_menu']; ?>&&sub_sub_menu=<?php echo $menu['sub_sub_menu']; ?>"><i class="fa fa-angle-double-right"></i>
								<?php 
								if(!empty($menu['sub_sub_menu'])){
										echo $menu_array[$menu['menu']].'('.$submenu_array[$menu['sub_menu']].')'.'('.$subsubmenu_array[$menu['sub_sub_menu']].')';
									}elseif(!empty($menu['sub_menu'])){
										echo $menu_array[$menu['menu']].'('.$submenu_array[$menu['sub_menu']].')';
									}elseif(!empty($menu['menu'])){
										echo $menu_array[$menu['menu']];
									}
								 ?> <?php echo '('.$menu['count(id)'].')'; ?></a></li>

							 	<?php }?>
                                
                                 </ul>
                    			</li> -->
                            </ul>

                      </li>
                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-wrench"></i>
                                <span>Price</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                                
                                <li><a href="price_view.php"><i class="fa fa-angle-double-right"></i> Price View</a></li>
                            </ul>
                        </li>
                            
                       
            <li class="treeview">

                            <a href="#">

                                <i class="fa fa-bars"></i>

                                <span>Blog</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

							

								<li><a href="blog_ctgry_view.php"><i class="fa fa-angle-double-right"></i>Blog categories</a></li>

							   

							   

							<?php 

								$page = mysql_query("select * from `blog_id` where status='1' order by sort");

								while($pg = mysql_fetch_array($page)){

							?>

							 <li><a href="blog_add.php?q=<?php echo $pg['id'].'&&name='.$pg['title']; ?>"><i class="fa fa-angle-double-right"></i><?php echo $pg['title']; ?></a></li>

							<?php 

								}

							?>

                            </ul>

                      </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sun-o"></i>
                    <span>Pages Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li><a href="add_pages.php"><i class="fa fa-angle-double-right"></i>Add pages</a></li>
                 <li><a href="list_pages.php"><i class="fa fa-angle-double-right"></i>view pages</a></li>
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-sun-o"></i>
                    <span>Tie up with manufacturer</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li><a href="add_tieup.php"><i class="fa fa-angle-double-right"></i>Add Tie up with manufacturer</a></li>
                 <li><a href="list_tieup.php"><i class="fa fa-angle-double-right"></i>view Tie up</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-quote-left"></i>
                    <span>Testimonials</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <li><a href="testimonials_menu.php"><i class="fa fa-angle-double-right"></i>Testimonials </a></li>
                </ul>
          </li>
            <li class="treeview">

                            <a href="#">

                                <i class="fa fa-bars"></i>

                                <span>Slider</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li><a href="slider.php"><i class="fa fa-angle-double-right"></i>ADD Slider</a></li>

							   <li><a href="slider_view.php"><i class="fa fa-angle-double-right"></i>Slider View/Edit</a></li>

                            </ul>

                      </li>
            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share-square-o"></i>
                                <span>Registration</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li><a href="registration.php"><i class="fa fa-angle-double-right"></i>Registered Usre's</a></li>
                            </ul>
                      </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share-square-o"></i>
                                <span>Pharmacist Registration</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li><a href="pharmacist_registration.php"><i class="fa fa-angle-double-right"></i>Pharmacist Registered </a></li>
                            </ul>
                      </li>
                      <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Newsletter Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                 <li><a href="list_newsletter.php"><i class="fa fa-angle-double-right"></i>List User Newsletter</a></li>
                                 
                                
                                
                                

                              
                                
                            </ul>
                        </li>
                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-suitcase"></i>
                                <span>Order Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <li><a href="orders_list.php"><i class="fa fa-angle-double-right"></i>All Order's </a></li>
                                <li><a href="orders_list.php?mode=COD"><i class="fa fa-angle-double-right"></i> COD Report</a></li>
                                <li><a href="orders_list.php?mode=Paied"><i class="fa fa-angle-double-right"></i>Online Payment Report</a></li>
                            

                              
                                
                            </ul>
                        </li>
		<?php /*?>	<li class="treeview"><a href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> <span>Rooms</span> <i class="fa fa-angle-left pull-right"></i> </a>
				<ul class="treeview-menu">
					<li><a href="facilities_view.php"><i class="fa fa-cutlery"></i>Facilities</a></li>
					<li><a href="room_name_view.php"><i class="fa fa-building-o"></i>Room's</a></li>
				</ul>
			</li>
			<li class="treeview"><a href="#"> <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Gallery</span> <i class="fa fa-angle-left pull-right"></i> </a>
				<ul class="treeview-menu">
					<li><a href="gallery_view.php"><i class="fa fa-picture-o"></i>Gallery</a></li>
				</ul>
			</li>
			
			
					  <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share-square-o"></i>
                                <span>Social Links</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
							   <li><a href="list_socialicons.php"><i class="fa fa-angle-double-right"></i>Social Links</a></li>
                            </ul>
                      </li>
                      <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share-square-o"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
							   <li><a href="Booked_users.php"><i class="fa fa-angle-double-right"></i>Booked</a></li>
                            </ul>
                      </li><?php */?>
                      
                      
		</ul>
	</section>
</aside>
