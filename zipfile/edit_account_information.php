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
	$res_user=mysql_query($fetch);
	$rs_user=mysql_fetch_assoc($res_user);
	if(isset($_POST['Edit'])){

		foreach($_POST as $key=>$val){
			$$key=$DB->escape($val);
		}
		if($DB->executupdate("UPDATE `user` SET `title`='$title',`fname`='$fname',`lname`='$lname',`gender`='$gender',`age`='$age' WHERE id='".$rs_user['id']."'")){
			$message='Update ';
			if($fix=='PID-'){
				echo "<script>window.location='Pharmacist/myaccount.php';</script>";
			}
			if($fix=='TDUID-'){
				echo "<script>window.location='myaccount.php';</script>";
			}

		}else{
			$erromsg='Error for Update';
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

  <?php include'class/register.php' ;?>

  <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

  <div class="secondary_page_wrapper">

    <div class="container">



      <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->



      <ul class="breadcrumbs">

        <li><a href="index.html">Home</a></li>

        <li>Edit Account Information</li>

      </ul>



      <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->

      <section class="section_offset">

        <h3>Edit Account Information</h3>

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

        <form action="" name="myForm"  method="post" class="type_2" onSubmit="return validateForm()">

          <div class="theme_box">

            <ul>

            	<li class="row">

            		<div class="col-sm-6">

                  <label class="required">Title</label>

                  <div class="custom_select">

                    <select name="title" class="searchskill">

                      <option value="Mr." <?php echo $rs_user['title']=='Mr.'?'selected':''; ?> >Mr.</option>

                      <option value="Mrs." <?php echo $rs_user['title']=='Mrs.'?'selected':''; ?> >Mrs.</option>

                    </select>

                  </div>

                </div>

                </li>

              <li class="row">

                <div class="col-sm-6">

                <p id="fname"></p>

                  <label for="first_name" class="required">First Name</label>

                  <input class="searchskill" type="text" name="fname" value="<?php echo $rs_user['fname']; ?>" id="first_name">

                </div>

                <!--/ [col] -->



                <div class="col-sm-6">

                  <label for="last_name" class="required">Last Name</label>

                  <input type="text" class="searchskill" name="lname"  value="<?php echo $rs_user['lname']; ?>" id="last_name">

                </div>

                <!--/ [col] -->



              </li>







              <li class="row">



                <!--/ [col] -->



                <div class="col-sm-6">

                  <label for="gender">Gender</label>

                   <div class="custom_select">

                  <select name="gender" class="searchskill">

                    <option value="Male" <?php echo $rs_user['gender']=='Male'?'selected':''; ?> >Male</option>

                    <option value="Female" <?php echo $rs_user['gender']=='Female'?'selected':''; ?> >Female</option>

                  </select>

                  </div>

                </div>

                <!--/ [col] -->

                 <div class="col-sm-6">

                  <label for="age" class="required">Age</label>

                  <input type="number" name="age"  value="<?php echo $rs_user['age']; ?>"  onKeyPress="return isNumberAge(event)"  id="age">

                </div>



              </li>

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



function validateForm() {

	var flag=0;

    var fname = val('fname');

	var lname = val('lname');

	var gender = val('gender');

	var age = val('age');

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

	if(flag==0){

		return false;

	}

	else{

		return true;

	}

}

</script>

<script src="js/formValidation.js"></script>

</body>

</html>
