<?php session_start(); error_reporting(0); ?>

<?php include_once 'inc/functions.php' ;

if($_SESSION['email']!=''){

	header("location:myaccount.php");

}

?>

<!doctype html>

<html lang="en">

<head>

<!-- Basic page needs ============================================ -->

<title>Register | The medkart</title>

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



<!--[if lte IE 9]>

			<link rel="stylesheet" type="text/css" href="css/oldie.css">

		<![endif]-->

</head>

<body>

<div class="wide_layout">

  <?php include'inc/header.php' ;?>

  <?php include'class/register.php' ;?>

  <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

  <div class="secondary_page_wrapper">

    <div class="container">



      <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->



      <ul class="breadcrumbs">

        <li><a href="index.html">Home</a></li>

        <li>Register</li>

      </ul>



      <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->

      <section class="section_offset">

        <h3>Create your account</h3>

         <?php if($erromsg!=''){ ?>

           <!-- Alert-->

           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">

            <div class="alert alert-warning alert-dismissable">

                    <i class="fa fa-warning"></i>

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    <b>Alert!</b> <?php echo $erromsg;?>

                </div>

            </div>

            <?php  } if($message!=''){?>

           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">

            <div class="alert alert-success alert-dismissable">

                    <i class="fa fa-check"></i>

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    <b>Success!</b> <?php echo $message;?>

                </div>

            </div>

            <?php } ?>

            <?php if(!isset($_SESSION['post_json'])){ ?>

        <form action="" name="myForm"  method="post" class="type_2" onSubmit="return validateForm()">

          <div class="theme_box">

            <ul>

            	<li class="row">

            		<div class="col-sm-6">

                  <label class="required">Title</label>

                  <div class="custom_select">

                    <select name="title" class="searchskill">

                      <option value="Mr." <?php echo $_POST['title']=='Mr.'?'selected':''; ?> >Mr.</option>

                      <option value="Mrs." <?php echo $_POST['title']=='Mrs.'?'selected':''; ?> >Mrs.</option>

                    </select>

                  </div>

                </div>

                </li>
                <li class="row">

            		<div class="col-sm-6">

                  <label class="required">User or Pharmacist</label>

                  <div class="custom_select">

                    <select name="fix" class="searchskill">

                      <option value="User" <?php echo $_POST['fix']=='TDUID'?'selected':''; ?> >User</option>

                      <option value="Pharmacist" <?php echo $_POST['fix']=='UID'?'selected':''; ?> >Pharmacist</option>

                    </select>

                  </div>

                </div>

                </li>
              <li class="row">

                <div class="col-sm-6">

                <p id="fname"></p>

                  <label for="first_name" class="required">First Name</label>

                  <input class="searchskill" type="text" name="fname" value="<?php echo $_POST['fname']; ?>" id="first_name">

                </div>

                <!--/ [col] -->



                <div class="col-sm-6">

                  <label for="last_name" class="required">Last Name</label>

                  <input type="text" class="searchskill" name="lname"  value="<?php echo $_POST['lname']; ?>" id="last_name">

                </div>

                <!--/ [col] -->



              </li>

              <!--/ .row -->

              <li class="row">

                <div class="col-sm-12">

                  <label for="email_address" class="required">Email Address</label>

                  <input type="text" class="searchskill" name="email"  value="<?php echo $_POST['email']; ?>" id="email_address">

                </div>

                <!--/ [col] -->

              </li>

              <li class="row">

                <div class="col-sm-6">

                  <label for="telephone" class="required">Telephone</label>

                  <input type="text" class="searchskill" name="phone"  value="<?php echo $_POST['phone']; ?>" onKeyPress="return isNumber(event)" id="phone">

                </div>

              </li>

              <!--<li class="row">

              	<div class="col-sm-6">

                  <label for="company_name">Confirm OTP</label>

                  <input type="text" name="otp" id="company_name">

                </div>

              </li>-->

              <li class="row">

                <div class="col-sm-12">

                  <label for="password" class="required">Password</label>

                  <input type="password" class="searchskill" name="pass"   id="pass">

                </div>

                <!--/ [col] -->



                <div class="col-sm-12">

                  <label for="confirm" class="required">Confirm Password</label>

                  <input type="password" class="searchskill" name="cpass" id="cpass">

                  <p id="error_msg" style="color:red;"></p>

                </div>

                 <div class="col-sm-12" onClick="TogglePasswordVisibility()" >

                <input type="checkbox" >Show Password</div>

                <!--/ [col] -->

              </li>

              <li class="row">



                <!--/ [col] -->



                <div class="col-sm-6">

                  <label for="gender">Gender</label>

                   <div class="custom_select">

                  <select name="gender" class="searchskill">

                    <option value="Male" <?php echo $_POST['gender']=='Male'?'selected':''; ?> >Male</option>

                    <option value="Female" <?php echo $_POST['gender']=='Female'?'selected':''; ?> >Female</option>

                  </select>

                  </div>

                </div>

                <!--/ [col] -->

                 <div class="col-sm-6">

                  <label for="age" class="">Age</label>

                  <input type="number"  name="age"  value="<?php echo $_POST['age']; ?>"  onKeyPress="return isNumberAge(event)" id="age">

                </div>



              </li>

              <li class="row">

                <div class="col-xs-12">

                  <label for="address" class="required">Address</label>

                  <input type="text" class="searchskill" name="address"   value="<?php echo $_POST['address']; ?>" >

                </div>

                <div class="col-xs-12">

                 <label for="address" class="required">Street Address</label>

                  <input type="text"  name="street" class="searchskill"  value="<?php echo $_POST['street']; ?>" >

                </div>

                <!--/ [col] -->



              </li>

              <li class="row">

                <div class="col-sm-4">

                  <label for="city" class="required">City</label>

                  <input type="text" class="searchskill"  value="<?php echo $_POST['city']; ?>" name="city" id="city">

                </div>

                <!--/ [col] -->



                <div class="col-sm-4">

                  <label class="required">Country</label>

                  <div class="custom_select">

                    <select name="state" class="searchskill">

                      <option value="Alabama" <?php echo $_POST['state']=='Alabama'?'selected':''; ?> >Alabama</option>

                      <option value="Illinois" <?php echo $_POST['state']=='Illinois'?'selected':''; ?> >Illinois</option>

                      <option value="India" <?php echo $_POST['state']=='India'?'selected':''; ?>>India</option>

                    </select>

                  </div>

                </div>

                <div class="col-sm-4">

                  <label for="postal_code" class="required">Pin Code</label>

                  <input type="text" class="searchskill"  value="<?php echo $_POST['pincode']; ?>" name="pincode" onKeyPress="return isNumberPincode(event)" id="postal_code">

                </div>

                <!--/ [col] -->



              </li>

              <!--/ .row -->



              <?php /*?><li class="row">



                <!--/ [col] -->



                <div class="col-sm-6">

                  <label class="required">Country</label>

                  <div class="custom_select">

                    <select name="">

                      <option value="USA">USA</option>

                      <option value="Australia">Australia</option>

                      <option value="Austria">Austria</option>

                      <option value="Argentina">Argentina</option>

                      <option value="Canada">Canada</option>

                    </select>

                  </div>

                </div>

                <!--/ [col] -->



              </li><?php */?>

              <!--/ .row -->



              <?php /*?><li class="row">

                <div class="col-sm-6">

                  <label for="telephone" class="required">Telephone</label>

                  <input type="text" name="phone" id="telephone">

                </div>

                <!--/ [col] -->



                <div class="col-sm-6">

                  <label for="gender">Gender</label>

                  <input type="text" name="gender" id="fax">

                </div>

                <!--/ [col] -->



              </li><?php */?>

              <!--/ .row -->





              <!--/ .row -->



            </ul>

          </div>

          <footer class="bottom_box on_the_sides">

            <div class="left_side">

              <button type="submit" name="register" class="button_blue middle_btn" value="register">Continue</button>

            </div>

            <div class="right_side"> <span class="prompt">Required Fields</span> </div>

          </footer>

        </form>

        <?php }else{



		?>



        <form action="" name="myForm4"  method="post" class="type_2" onSubmit="return validateForm_otp()">

          <div class="theme_box">

            <ul>

              <li class="row">

                <div class="col-sm-12">

                  <label for="otp" class="required">OTP</label>

                  <input class="searchskill_otp" type="text" name="otp_val" value="" id="otp">

                </div>

              </li>

            </ul>

          </div>

          <footer class="bottom_box on_the_sides">

            <div class="left_side">

              <button type="submit" name="otp" class="button_blue middle_btn" value="otp">Continue</button>

            </div>

          </footer>

            </form>

             <footer class="bottom_box on_the_sides">

            <div class="right_side"><form action="" name="myForm4"  method="post" class="type_2"><button type="submit" name="otp_resend" class="button_blue middle_btn" value="otp_resend">Resend</button></form></div></footer>

        <?php } ?>

      </section>

    </div>

    <!--/ .container-->

  </div>

  <!--/ .page_wrapper-->



  <?php include'inc/footer.php' ;?>

</div>

<!--/ [layout]-->

<script src="js/jquery.appear.js"></script>

<script src="js/owlcarousel/owl.carousel.min.js"></script>

<script src="twitter/jquery.tweet.min.js"></script>

<script src="js/arcticmodal/jquery.arcticmodal.js"></script>

<script src="js/jquery.countdown.plugin.min.js"></script>

<script src="js/jquery.countdown.min.js"></script>

<script src="js/colorpicker/colorpicker.js"></script>

<script src="js/retina.min.js"></script>

<script src="js/theme.plugins.js"></script>

<script src="js/theme.core.js"></script>

<script>

function val(v){

	return document.forms["myForm"][v].value;

}

function ValidateEmail(mail) {

	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){

		return 1;

	}

    //alert("You have entered an invalid email address!")

    return 0;

}

function validateForm() {

	var flag=0;

    var fname = val('fname');

	var lname = val('lname');

	var email = val('email');

	var phone = val('phone');

	var pass = val('pass');

	var cpass = val('cpass');

	var gender = val('gender');

	var age = val('age');

//	var address = val('address');

	var city = val('city');

	var state = val('state');

	var pincode = val('pincode');

	var filteredList = $('.searchskill').filter(function() {

		if($(this).val()==''){

			$(this).css("border", "1px solid red");

		}else{

			$(this).css("border", "");

		}

    	return $(this).val() == "";

	});

	if(email!=''){

		if(!ValidateEmail(email)){

			$('#email_address').css("border", "1px solid red");

			flag=0;

		}else{

			$('#email_address').css("border", "");

		}

	}

	if(phone!=''){

		if(!phonenumber(phone)){

			$('#phone').css("border", "1px solid red");

			flag=0;

		}else{

			$('#phone').css("border", "");

		}

	}



	if(pass!='' && cpass!=''){

		//alert('helo');

		if(pass != cpass) {

			$('#cpass').css("border", "1px solid red");

            flag=0;

        }else{

			var value =document.getElementById("pass").value;

			if((value.length)>=6){

				var phoneno = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()?{}+-.])[a-zA-Z0-9!@#$%^&*()?{}+-.]{6,}$/;

				if(pass.match(phoneno)){

					//alert('1');

					$('#cpass').css("border", "");

					$('#pass').css("border", "");

					flag=1;

				}

				else

				{

					var msg='';

					if(pass.search(/[a-z]/) < 0){

						msg+='-At lest 1 Character - Lower Case.<br>';

					}

					if(pass.search(/[A-Z]/) < 0) {

						msg+='-At lest 1 Character - Upper Case.<br>';

					}

					if(pass.search(/[0-9]/) < 0) {

						msg+='-At lest 1 Character - Number.<br>';

					}

					if(pass.search(/[!@#$%^&*()?{}+-.]/) < 0) {

						msg+='-At lest 1 Character - Special Character. (!@#$%^&*()?{}+)<br>';

					}

					if(msg==''){

						msg+='-User only this Special Character. (!@#$%^&*()?{}+-.)<br>';

					}

					flag=0;

					document.getElementById("error_msg").innerHTML=msg;

					//alert(msg);

				}

			}

			else

			{

				alert('Mininmum password Character 6');

				flag=0;

			}

		}

	}

	if (filteredList.length > 0) {

		flag=0;

	}else{

		if(flag==1){

			flag=1;

		}

	}

	if(flag==0){

		return false;

	}

	else{

    	return true;

	}

}

function validateForm_otp() {

	var value =document.getElementById("otp").value;

	if(value!=''){

		return true;

	}

	$("#otp").css("border", "1px solid red");

	return false;

}





</script>

<script src="js/formValidation.js"></script>

</body>

</html>
