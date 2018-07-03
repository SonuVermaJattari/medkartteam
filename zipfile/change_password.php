<?php session_start(); error_reporting(0); ?>
<?php include_once 'inc/functions.php' ;
if($_SESSION['email']=='' && $_SESSION['pemail']==''){
	header("location:logout.php");
}

if(isset($_SESSION['pemail'])){
	$email = $_SESSION['pemail'];
	$fix='PID-';
}
if(isset($_SESSION['email'])){
	$email = $_SESSION['email'];
	$fix='TDUID-';
}

	$fetch="select * from user where email='$email' AND fix='$fix'";
	$res=mysql_query($fetch);
	$rs=mysql_fetch_assoc($res);
	if(isset($_POST['Edit'])){
		foreach($_POST as $key=>$val){
			$$key=$DB->escape($val);
		}

		if($rs['pass']==$oldpass){
			if($DB->executupdate("UPDATE `user` SET `pass`='$pass' WHERE id='".$rs['id']."'  AND fix='$fix'")){
				$message='Update ';
				if($fix=='PID-'){
					echo "<script>window.location='logout.php?q=1&&p=1';</script>";
				}
				if($fix=='TDUID-'){
					echo "<script>window.location='logout.php?q=1';</script>";
				}
			}else{
				$erromsg='Error for Update';
			}
		}else{
			$erromsg='Old password incorrect';

		}
	}

	//$fetch="select * from user where email='$email'";
	//$res=mysql_query($fetch);
	//$rs=mysql_fetch_assoc($res);
?>

<!doctype html>

<html lang="en">

<head>

<!-- Basic page needs ============================================ -->

<title>The medkart </title>

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

  <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

  <div class="secondary_page_wrapper">

    <div class="container">



      <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->



      <ul class="breadcrumbs">

        <li><a href="index.html">Home</a></li>

        <li>Change Password</li>

      </ul>



      <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->

      <section class="section_offset">

        <h3>Change Password</h3>

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

            <?php $res_address=mysql_query("select * from address where id='".$rs['address_id']."'");

				$rs_address=mysql_fetch_assoc($res_address);

			?>

        <form action="" name="myForm"  method="post" class="type_2" onSubmit="return validateForm()">

          <div class="theme_box">

            <ul>

              <li class="row">

              	<div class="col-sm-12">

                  <label for="password" class="required">Old Password</label>

                  <input type="password" class="searchskill" name="oldpass"   id="oldpass">

                </div>

                <div class="col-sm-12">

                  <label for="password" class="required">Password</label>

                  <input type="password" class="searchskill" name="pass"   id="pass">

                </div>

                <div class="col-sm-12">

                  <label for="confirm" class="required">Confirm Password</label>

                  <input type="password" class="searchskill" name="cpass" id="cpass">

                  <p id="error_msg" style="color:red;"></p>

                </div>

              </li>

              <div class="col-sm-12" onClick="TogglePasswordVisibility_cp()" >

                <input type="checkbox" >Show Password</div>

            </ul>

          </div>

          <footer class="bottom_box on_the_sides">

            <div class="left_side">

              <button type="submit" name="Edit" class="button_blue middle_btn" value="Edit">Continue</button>

            </div>

            <div class="right_side"> <span class="prompt">Required Fields</span> </div>

          </footer>

        </form>

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

   var oldpass = val('oldpass');

	var pass = val('pass');

	var cpass = val('cpass');





	var filteredList = $('.searchskill').filter(function() {

		if($(this).val()==''){

			$(this).css("border", "1px solid red");

		}else{

			$(this).css("border", "");

		}

    	return $(this).val() == "";

	});

	if (filteredList.length > 0) {

		flag=0;

	}else{

		flag=1;

	}







	if(pass!='' && cpass!=''){

		if(pass != cpass) {

			$('#cpass').css("border", "1px solid red");

            flag=0;

        }else{

			var value =document.getElementById("pass").value;

			if((value.length)>=6){

				var phoneno = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()?{}+-.])[a-zA-Z0-9!@#$%^&*()?{}+-.]{6,}$/;

				if(pass.match(phoneno)){

					//alert('1');

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

				msg='Mininmum password Character 6';

				document.getElementById("error_msg").innerHTML=msg;

				flag=0;

			}

		}

	}

	if(flag==0){

		$('#cpass').css("border", "1px solid red");

		$('#pass').css("border", "1px solid red");

		return false;

	}

	else{

    	$('#cpass').css("border", "");

		$('#pass').css("border", "");

		return true;

	}

}

</script>

<script src="js/formValidation.js"></script>

</body>

</html>
