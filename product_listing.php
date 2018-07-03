<?php
session_start();
ob_start();
error_reporting(0);
 $_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<link rel="stylesheet" href="js/arcticmodal/jquery.arcticmodal.css">
		<link rel="stylesheet" href="js/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" href="js/colorpicker/colorpicker.css">
		<link rel="stylesheet" href="css/style.css">
		<style>
        /*body{width:600px;font-family:"Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif;font-size:14px;}*/
        .link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}
        .disabled {cursor:not-allowed;color: #bccfd8;}
        .current {background: #bccfd8;}
        .first{border-left:#bccfd8 1px solid;}
        .question {font-weight:bold;}
        .answer{padding-top: 10px;}
        #pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}
        .dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}
        #overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: fixed;left: 0;top: 0;width: 100%;height: 100%;display: none;}
        #overlay div {position:fixed;z-index:11;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
        .page-content {padding: 20px;margin: 0 auto;}
        .pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}
        </style>
		<!-- JS Libs
		============================================ -->
		<script src="js/modernizr.js"></script>
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/queryloader2.min.js"></script>
		<script>
		function productDisplay() {
			var brand = []; var discount = []; var form = []; var uses = []; var age = []; var gender = []; 
			$('#brand :checked').each(function () {
			brand.push($(this).val());
			});
			//alert(allVals);
			$('#discount :checked').each(function () {
			discount.push($(this).val());
			});
			$('#form :checked').each(function () {
			form.push($(this).val());
			});
			$('#uses :checked').each(function () {
			uses.push($(this).val());
			});
			$('#age :checked').each(function () {
			age.push($(this).val());
			});
			$('#gender :checked').each(function () {
			gender.push($(this).val());
			});
			//alert(brand +'->'+discount+'->'+ form +'->'+ uses +'->'+ age + '->'+gender);
			$.ajax({
				type: 'post',
				url: 'fil_products.php',
				data: {
					//filter:filter,
					brand:brand,
					discount:discount,
					form:form,
					uses:uses,
					age:age,
					gender:gender
				},
				 beforeSend: function() {
					 $("#overlay").show();
				  $('#fil_products').html('<div style="text-align:center; font-weight:600; font-size:16px; color:#ccc;">loading...</div>');
				},
				success: function (data) {
					$('#fil_products').html(data);
				}
			}).done(function() {
			  filter_display();
			});
		}
        function filter_display(){
			$.ajax({
				type: 'post',
				url: 'fil.php',
				beforeSend: function() {
						$("#overlay").show();
					  $('#fil').html('<div style="text-align:center; font-weight:600; font-size:16px; color:#ccc;">loading...</div>');
				},
				success: function (data) {
					$('#fil').html(data);
				}, complete: function (data) {
				 	$("#overlay").hide();
				},
			});
		}
		 function filter_display1(){
			$.ajax({
				type: 'post',
				url: 'fil.php',
				beforeSend: function() {
						$("#overlay").show();
					  $('#fil').html('<div style="text-align:center; font-weight:600; font-size:16px; color:#ccc;">loading...</div>');
				},
				success: function (data) {
					$('#fil').html(data);
				}
			}).done(function() {
			  productDisplay();
			});
		}
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

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
                        <?php	
							$id=$_GET['q'];
							$enum=explode('-',$id);
							$a='';
							$i=1;
							unset($_SESSION['menu']);
							unset($_SESSION['sub_menu']);
							unset($_SESSION['sub_sub_menu']);
							foreach($enum as $val){
								$a.=$val;
								$val=str_replace('_', ' ', str_replace('@', '&',$val));
								echo "<li><a href='product_listing.php?q=$a'>".$val.'</a></li>';
								$a.='-';
								if($i==1){ $menu=$DB->get_ID($val,$i); $name=$val; $_SESSION['menu']=$menu; }
								if($i==2){  $sub_menu=$DB->get_ID($val,$i); $name=$val; $_SESSION['sub_menu']=$sub_menu; }
								if($i==3){  $sub_sub_menu=$DB->get_ID($val,$i); $name=$val; $_SESSION['sub_sub_menu']=$sub_sub_menu; }
								$i++;
							}
							unset($id);unset($enum);unset($a);unset($i);unset($menu);unset($sub_menu);unset($sub_sub_menu);
						?>
                        </a>
						
						
					</ul>

					<div class="row">
                     <div id="overlay"><div><img src="loading.gif" width="100%" height="100%"/></div></div>
                    
						<aside class="col-md-3 col-sm-4 has_mega_menu">

						<?php /*?>
						
						<?php echo $menu; ?><br>
                        <?php echo $sub_menu; ?><br>
                        <?php echo $sub_sub_menu; ?><br>
                        <?php if(isset($menu)){
								$where="menu='$menu' ";
							}
							if(isset($sub_menu)){
								$where.="AND sub_menu='$sub_menu' ";
							}if(isset($sub_sub_menu)){
								$where.="AND sub_sub_menu='$sub_sub_menu'";
							} ?>
                        <?php echo $QRY="select * from products where $where"; ?>
						
						<?php */?>
					<section class="section_offset">
						<h3>Filter</h3>
                        	
                    
                   
							<div class="table_layout list_view">

										<div class="table_row">

											<!-- - - - - - - - - - - - - - Category filter - - - - - - - - - - - - - - - - -->

											<?php /*?><div class="table_cell">

												<label>Category</label>

												<div class="custom_select">

													<select name="">
														
														<option value="Beauty">Beauty</option>
														<option value="Personal Care">Personal Care</option>
														<option value="Diet &amp; Fitness">Diet &amp; Fitness</option>
														<option value="Baby Needs">Baby Needs</option>

													</select>

												</div>

											</div><?php */?>
                                            <!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End of category filter - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->
											<div id="fil"></div>
											<?php /*?><div class="table_cell">

												<fieldset>

													<legend>Manufacturer</legend>

													<ul class="checkboxes_list">

														<li>
															
															<input type="checkbox" checked name="manufacturer" id="manufacturer_1">
															<label for="manufacturer_1">Manufacturer 1</label>

														</li>

														<li>
															
															<input type="checkbox" name="manufacturer" id="manufacturer_2">
															<label for="manufacturer_2">Manufacturer 2</label>

														</li>

														<li>
															
															<input type="checkbox" name="manufacturer" id="manufacturer_3">
															<label for="manufacturer_3">Manufacturer 3</label>

														</li>

													</ul>

												</fieldset>

											</div><?php */?><!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->

											<?php /*?><div class="table_cell">

												<fieldset>

													<legend>Price</legend>

													<div class="range">

														Range : <span class="min_val"></span> - 
														<span class="max_val"></span>

														<input type="hidden" name="" class="min_value">

														<input type="hidden" name="" class="max_value">

													</div>

													<div id="slider"></div>

												</fieldset>

											</div><?php */?><!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->

											<?php /*?><div class="table_cell">

												<fieldset>

													<legend>Color</legend>

													<div class="row">

														<div class="col-sm-6">
															
															<ul class="simple_vertical_list">

																<li>
																	
																	<input type="checkbox" name="" id="color_btn_1">
																	<label for="color_btn_1" class="color_btn green">Green</label>

																</li>

																<li>

																	<input type="checkbox" name="" id="color_btn_2">
																	<label for="color_btn_2" class="color_btn yellow">Yellow</label>

																</li>

																<li>
																	
																	<input type="checkbox" name="" id="color_btn_3">
																	<label for="color_btn_3" class="color_btn red">Red</label>

																</li>

															</ul>

														</div>

														<div class="col-sm-6">
															
															<ul class="simple_vertical_list">

																<li>

																	<input type="checkbox" name="" id="color_btn_4">
																	<label for="color_btn_4" class="color_btn blue">Blue</label>

																</li>

																<li>
																	
																	<input type="checkbox" name="" id="color_btn_5">
																	<label for="color_btn_5" class="color_btn grey">Grey</label>

																</li>

																<li>
																	
																	<input type="checkbox" name="" id="color_btn_6">
																	<label for="color_btn_6" class="color_btn orange">Orange</label>

																</li>

															</ul>

														</div>

													</div>

												</fieldset>

											</div><?php */?><!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->

										</div><!--/ .table_row -->

									</div>
                            <?php /*?><footer class="bottom_box">
                            	<div class="buttons_row">
                            		<button type="submit" class="button_blue middle_btn">Search</button>
                            		<button type="reset" class="button_grey middle_btn filter_reset">Reset</button>
                            	</div>
                            </footer><?php */?>
					</section>
						

						  <!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

						</aside>

						<main class="col-md-9 col-sm-8">

							<section class="section_offset">

								<h1><?php echo $name; ?> </h1>

								<!--<p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante. Donec sagittis euismod purus. Sed ut perspiciatis sit voluptatem accusantim doloremque laudantim.</p>--><br>

							</section>

							<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

							<div id="fil_products"></div>

							<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

						</main>
					
					</div><!--/ .row -->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

<?php include'inc/footer.php' ;?>

		</div><!--/ [layout]-->
		
		<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

		
<!-- Include Libs & Plugins
		============================================ -->
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
		$(function () {
			filter_display1();
			//productDisplay();
			//$('#brand input').click(productDisplay);
			/*$('#discount input').click(productDisplay);
			$('#form input').click(productDisplay);
			$('#uses input').click(productDisplay);
			$('#age input').click(productDisplay);
			$('#gender input').click(productDisplay);*/
		});
       
        </script>
        <script language="javascript">
		function submitForm(){
			var val = document.myform_price.new_price.value;
			if(val!=''){
				document.myform_price.submit();
			}
		}
		</script> 
	</body>
</html>
