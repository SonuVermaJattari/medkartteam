                    
                    <div class="clearfix"></div>
			<footer id="footer" class="">

				<!-- - - - - - - - - - - - - - Footer section- - - - - - - - - - - - - - - - -->
<?php $sqlu = "select * from basic_details where  text='CONTACT US'";
$resultu = mysql_query($sqlu);
$contact = mysql_fetch_assoc($resultu);  ?>
				<div class="footer_section shadow-top">
                <div data-animation="fadeInDown" class="section_offset animated transparent" style="border-bottom:1px solid rgb(7, 37, 71);">
<div class="container" style="padding-top: 30px; padding-bottom:30px;">

<?php  echo $contact['footer_text']; ?>

<?php /*?><div class="row">
<div class="col-lg-12" style="margin-top: 12px;">
<h4 ><i class="fa fa-map"></i> We are Available in </h4>
</div>
<div class="col-lg-12">
<p style="color:white;">Agra, Allahabad, Ahmedabad, Bhopal, Chennai, Delhi - NCR, Durgapur, Faridabad, Ghaziabad, Gurugram, Gwalior, Howrah, Hyderabad, Indore, Jabalpur, Jaipur, Kanpur, Kharagpur, Kolkata, Lucknow, Mumbai, Noida, Pune, Rajkot, Surat, Thane, Vadodara , Varanasi & Major cities of Karnataka</p>
</div></div><?php */?>
</div></div>

                 <div data-animation="fadeInDown" class="section_offset animated transparent" style="border-bottom:1px solid rgb(7, 37, 71); margin-bottom: 25px;"><div class="container" style="padding-top: 24px; padding-bottom: 24px;">

					<!-- - - - - - - - - - - - - - Infoblocks - - - - - - - - - - - - - - - - -->

					<ul class="clearfix infoblocks_wrap section_offset five_items">

						<li>
							<a href="#" class="infoblock type_1">

								<i class="icon-thumbs-up-1"></i>
								<span class="caption"><b>The Highest Product Quality</b></span>

							</a><!--/ .infoblock-->
						</li>

						<li>
							<a href="#" class="infoblock type_1">

								<img src="images/heart.png" /> &nbsp;<span class="caption"><b>Loyalty Program</b></span>

							</a><!--/ .infoblock-->
						</li>

						<li>
							<a href="#" class="infoblock type_1">

								<i class="icon-lock"></i>
								<span class="caption"><b>Safe &amp; Secure Payment</b></span>

							</a><!--/ .infoblock-->
						</li>

						<li>
							<a href="#" class="infoblock type_1">

								<i class="icon-diamond"></i>
								<span class="caption"><b>Get 10% OFF For Reorder</b></span>

							</a><!--/ .infoblock-->
						</li>

						

					</ul><!--/ .infoblocks_wrap.section_offset.clearfix-->
					
					<!-- - - - - - - - - - - - - - End of infoblocks - - - - - - - - - - - - - - - - -->
                    </div></div>

					<div class="container">

						<div class="row">
                        <?php  echo $contact['footer_link']; ?>
                        
							<?php /*?><div class="col-md-3 col-sm-3">
								<!-- - - - - - - - - - - - - - Information widget - - - - - - - - - - - - - - - - -->
								<section class="widget">
									<ul class="list_of_links">
										<li><a href="about.php">About Us</a></li>
										<li><a href="faq.php">FAQs</a></li>
										<li><a href="#">Privacy Policy</a></li>
										<li><a href="#">Terms of Use</a></li>
									</ul>
								</section>
								<!-- - - - - - - - - - - - - - End information widget - - - - - - - - - - - - - - - - -->
							</div>
							<div class="col-md-3 col-sm-3">

								<!-- - - - - - - - - - - - - - Information widget - - - - - - - - - - - - - - - - -->

								<section class="widget">
									<ul class="list_of_links">

                                        <li><a href="#">Newsroom</a></li>
										<li><a href="contact.php">Contact Us</a></li>
                                        <li> <a class="small_link" href="#">Help</a></li>
                                        <li> <a class="small_link" href="#">Track your order</a></li>

									</ul>

								</section>
								
								<!-- - - - - - - - - - - - - - End information widget - - - - - - - - - - - - - - - - -->

							</div><?php */?>
                            
							<!--/ [col]-->
<div class="col-md-3 col-sm-3">
<section class="streamlined" style="margin-top:50px;">
								
									<h4 class="streamlined_title right_side hidden">Follow Us</h4>

									<!-- - - - - - - - - - - - - - Social icon's list - - - - - - - - - - - - - - - - -->
 <?php $social_links=$DB->social_links("select * from social_links where status='1'"); //print_r($social_links); ?>
 <ul class="social_btns">
								<?php if($social_links['facebook']!=''){ ?>
                                <li><a href="<?php echo $social_links['facebook']; ?>" class="icon_btn middle_btn social_facebook tooltip_container"><i class="icon-facebook-1"></i><span class="tooltip top">Facebook</span></a></li>
								<?php } ?>
								<?php if($social_links['twitter']!=''){ ?>
                                <li><a href="<?php echo $social_links['twitter']; ?>" class="icon_btn middle_btn social_twitter tooltip_container"><i class="icon-twitter"></i><span class="tooltip top">Twitter</span></a></li>
								<?php } ?>
								<?php if($social_links['Youtube']!=''){ ?>
                                <li><a href="<?php echo $social_links['Youtube']; ?>" class="icon_btn middle_btn social_youtube tooltip_container"><i class="icon-youtube"></i><span class="tooltip top">Youtube</span></a></li>
								<?php } ?>
								<?php if($social_links['linkedin']!=''){ ?>
                                <li><a href="<?php echo $social_links['linkedin']; ?>" class="icon_btn middle_btn social_linkedin tooltip_container"><i class="icon-linkedin-5"></i><span class="tooltip top">LinkedIn</span></a></li>
								<?php } ?>
                                
                            </ul>
									
									
									<!-- - - - - - - - - - - - - - End social icon's list - - - - - - - - - - - - - - - - -->

								</section>
</div>
<?php 
				   function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
                            $mess="";
				  if(isset($_POST['is_subscribed'])){
					if((!empty($_POST['email']))&&(empty($_POST['Subscribe_hid']))){
						$email = test_input($_POST["email"]);
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							/*$select="select * from is_subscribed where Email='$email'";
							$myres=mysql_query($select);
							if($rs=mysql_fetch_assoc($myres))
							{
								$mess="You are already subscribed..";
							}else{
								$insert=mysql_query("INSERT INTO `is_subscribed` (email,date) VALUES ('$email',now())");
								if($insert){
									$mess="Your subscription request send successfully";
								}
							}
                            */
						}
					}
				}
				  ?>
							<div class="col-md-3 col-sm-3">

								<!-- - - - - - - - - - - - - - Account's links widget - - - - - - - - - - - - - - - - -->
                                <span class=reder style="color:green"><?php  echo $mess;  ?></span>
								<section class="streamlined_type_2" style="display: table;width: 100%;">
								
									<h4 class="streamlined_title">Sign up to our newsletter</h4>

									<form class="newsletter " novalidate method="post" action="#is_subscribed">
										<input type="hidden" value="" name="Subscribe_hid" ?/>
										<input type="email" name="email" placeholder="Enter your email address">

										<button name="is_subscribed" type="submit" class="button_blue def_icon_btn"></button>

									</form>

								</section>
                                
								<!--/ .streamlined--><!--/ .widget-->
								
								<!-- - - - - - - - - - - - - - End of account's links widget - - - - - - - - - - - - - - - - -->

							</div><!--/ [col]-->

						</div><!--/ .row-->

					</div><!--/ .container-->

				</div><!--/ .footer_section-->

				<!-- - - - - - - - - - - - - - End footer section- - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Footer section - - - - - - - - - - - - - - - - -->

				<div class="footer_section_3 ">

					<div class="container">

						<!-- - - - - - - - - - - - - - Payments - - - - - - - - - - - - - - - - -->

						<ul class="payments hidden">

							<li><img src="images/payment_1.png" alt=""></li>
							<li><img src="images/payment_2.png" alt=""></li>
							<li><img src="images/payment_3.png" alt=""></li>
							<li><img src="images/payment_4.png" alt=""></li>
							<li><img src="images/payment_5.png" alt=""></li>
							<li><img src="images/payment_6.png" alt=""></li>
							<li><img src="images/payment_7.png" alt=""></li>
							<li><img src="images/payment_8.png" alt=""></li>

						</ul>
						
						<!-- - - - - - - - - - - - - - End of payments - - - - - - - - - - - - - - - - -->

						<!-- - - - - - - - - - - - - - Footer navigation - - - - - - - - - - - - - - - - -->

						<nav class="footer_nav hidden">

							<ul class="bottombar">

								<li><a href="#">Medicine &amp; Health</a></li>
								<li><a href="#">Beauty</a></li>
								<li><a href="#">Personal Care</a></li>
								<li><a href="#">Vitamins &amp; Supplements</a></li>
								<li><a href="#">Baby Needs</a></li>
								<li><a href="#">Diet &amp; Fitness</a></li>
								<li><a href="#">Sexual Well-being</a></li>

							</ul>

						</nav>
						
						<!-- - - - - - - - - - - - - - End of footer navigation - - - - - - - - - - - - - - - - -->

						<div class="row">
                        <div class="col-md-6"><p style="color:#fff;">&copy; 2017 The medkart. All Rights Reserved.</p></div>
                        <div class="col-md-6 align_right"><p style="color:#fff;">Design By <a href="http://thewebtycoons.com/index.php" target="_blank"><img src="thewebtycoons.png" style="margin-top: -3px;"/></a></p></div></div>
					</div><!--/ .container-->
				</div><!--/ .footer_section-->
				<!-- - - - - - - - - - - - - - End footer section - - - - - - - - - - - - - - - - -->
			</footer>			
			<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->
