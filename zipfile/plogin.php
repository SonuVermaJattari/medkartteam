<?php
session_start();
ob_start();
error_reporting(0);
//print_r($_SESSION);
include_once'inc/functions.php' ;
if($_SESSION['pemail']!=''){
	header("location:Pharmacist/myaccount.php");
}
if(isset($_GET['email'])){
	$get_email=$_GET['email'];
}else{
	$get_email='';
}
if(isset($_POST['email']) && isset($_POST['pass'])){
	$log = preg_replace('/\s+/', '',$_POST['email']);
	$pass = $_POST['pass'];
	$emailchk=mysql_query("select email,phone from user where (email='$log' || phone='$log') AND fix='PID-'");
	if((mysql_num_rows($emailchk))>0){
			$sql="select * from user where (email='$log' || phone='$log') && Pass='$pass' AND fix='PID-'";
			$result=mysql_query($sql);
			if($re=mysql_fetch_assoc($result)){
				$status=$re['status'];
				if($status==1){
					$email=$re['email'];
					$phone=$re['phone'];
					$prefix=$re['title'];
					$firstname=$re['fname'];
					$lastname=$re['lname'];
					$fix=$re['fix'];
					//USE OF SESSION ID FOR UNIQUE ID GENERATION
					if($_SESSION['SessID']==''){
						$SID=session_id();
						$_SESSION['SessID']=$SID;
					}
					else{
						$SID=$_SESSION['SessID'];
					}
					//mysql_query("UPDATE `products_added` SET `username`='$email' WHERE username='$SID'");
					$_SESSION['pemail']=$email;
					$_SESSION['pphone']=$phone;
					$_SESSION['ptitle']=$prefix;
					$_SESSION['pfirstname']=$firstname;
					$_SESSION['plastname']=$lastname;
					$_SESSION['fix']=$fix;
					$url=$_SESSION['url_red'];
					if(isset($url)){
						$_GET['login_attempt']='2';
					}
					//$_SESSION['ssc_code']=$p_id;
					if(isset($SID) && $SID!='' && $_SESSION['pemail']!='')
					{
						if($_POST['login_attempt']=='1')
						{
							echo "<script>window.location='checkout.php';</script>";
						}else if($_GET['login_attempt']=='2'){

							echo "<script>window.location='$url';</script>";
						}else if($_POST['login_attempt']=='3'){
							$selfie_url="selfie/".$_POST['urli'];
							echo "<script>window.location='$selfie_url';</script>";
						}
						else {

							echo "<script>window.location='Pharmacist/myaccount.php';</script>";
						}
					}
				}
				else
				{
				$erromsg="Your id is deactivated,Contact with Administrator!!";
				}
			}else
			{
			$erromsg="Sorry your Email id or Phone no. or may be password is incorrect!!";
			}
		}
	else{
		$erromsg="Please register First and login, Thanks!";
	}

}
if(isset($_SESSION['msg_newpassword'])){ $message=$_SESSION['msg_newpassword']; }

?>
<!doctype html>
<html lang="en">
		<head>
		<!-- Basic page needs
		============================================ -->
		<title>Pharmacist Login | The medkart</title>
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

<!-- - - - - - - - - - - - - - Styleswitcher - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - end Styleswitcher - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

<div class="wide_layout">
          <?php include'inc/header.php' ;?>

          <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

          <div class="secondary_page_wrapper">
    <div class="container">

              <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

              <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>Pharmacist Login</li>
      </ul>
              <h1 class="page_title">Pharmacist Login</h1>

              <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->

              <section class="section_offset">
        <div class="relative">
                  <div class="table_layout">
            <div class="table_row">
                      <div class="table_cell">
                <section>

                          <h5 class="sub bold">Register and save time!</h5>
                          <p class="subcaption">Register with us for future convenience:</p>
                          <ul class="list_type_7">
                    <li>Fast and easy check out</li>
                    <li>Easy access to your order history and status</li>
                  </ul>
                        </section>
              </div>
                      <!--/ .table_cell -->

                      <div class="table_cell">
                <section>
                          <h4>Pharmacist Login</h4>
                          <?php if($erromsg!=''){ ?>
           <!-- Alert-->
           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">
            <div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Alert!</b><p class="subcaption"> <?php echo $erromsg;?></p>
                </div>
            </div>
            <?php  } if($message!=''){
				unset($_SESSION['msg_newpassword']);
				?>
           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">
            <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> <p class="subcaption"><?php echo $message;?></p>
                </div>
            </div>
            <?php }  ?>

                          <form id="login_form" method="post" class="type_2">
                    <ul>
                              <li class="row">
                        <div class="col-xs-12">
                                  <label for="login_email" class="required">Email/Phone</label>
                                  <input type="text" name="email" value="<?php echo $get_email; ?>" required id="login_email">
                                </div>
                      </li>
                              <li class="row">
                        <div class="col-xs-12">
                                  <label for="login_password" class="required">Password</label>
                                  <input type="password" required name="pass" id="login_password">
                                </div>
                      </li>
                              <li class="row">
                        <div class="col-xs-12">
                                  <div class="on_the_sides">
                            <div class="left_side"> <a href="forgotten.php" class="small_link">Forgot your password?</a> </div>
                            <div class="right_side"> <span class="prompt">Required Fields</span> </div>
                          </div>
                                </div>
                      </li>
                            </ul>
                  </form>
                        </section>
              </div>
                      <!--/ .table_cell -->

                    </div>
            <!--/ .table_row -->

            <div class="table_row">
                      <div class="table_cell"> <a href="register.php" class="button_blue middle_btn">Register now</a> </div>
                      <!--/ .table_cell -->

                      <div class="table_cell">
                <div class="on_the_sides login_with">
                          <div class="left_side">
                    <button type="submit" form="login_form" class="button_blue middle_btn">Login</button>
                  </div>
                        </div>
              </div>
                      <!--/ .table_cell -->

                    </div>
            <!--/ .table_row -->

          </div>
                  <!--/ .table_layout -->

                </div>
        <!--/ .relative -->

      </section>
              <!--/ .section_offset -->

            </div>
    <!--/ .container-->

  </div>
          <!--/ .page_wrapper-->

          <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

          <?php include'inc/footer.php' ;?>

          <!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

        </div>
<!--/ [layout]-->

<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->

<!-- Include Libs & Plugins
		============================================ -->
<script src="js/jquery.appear.js"></script>
<script src="js/owlcarousel/owl.carousel.min.js"></script>
<script src="twitter/jquery.tweet.min.js"></script>
<script src="js/arcticmodal/jquery.arcticmodal.js"></script>
<script src="js/jquery.countdown.plugin.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/colorpicker/colorpicker.js"></script>
<script src="js/retina.min.js"></script>
<!-- Theme files
		============================================ -->
<script src="js/theme.styleswitcher.js"></script>
<script src="js/theme.plugins.js"></script>
<script src="js/theme.core.js"></script>
</body>
</html>
