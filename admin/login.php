<?php 

include 'includes/functions.php';

@extract($_REQUEST);

session_start();

if(isset($_POST['submit']))

{

	$flag=0;

	if($userid=='' || $password=='')

	{

	$msg="Please Provide Username And Password.";	

	$flag=1;

	}

	if($flag=='0')

	{

		

$password=mysql_real_escape_string($password);

$query=mysql_query("select * from admin_login where username='$userid' and password='$password'");

$fetch=mysql_fetch_assoc($query);

if($fetch['username']=="$userid" && $fetch['password']=="$password")

{

	mysql_query("update admin_login set last_login=NOW()");

    $_SESSION['id'] = $fetch['id'];

	$_SESSION['uname']=$fetch['username'];

	$_SESSION['upass']=$fetch['password'];

	$_SESSION['oname']=$fetch['name'];

	$_SESSION['uemail']=$fetch['email'];

	header('location:index.php');

}

else

{

	$msg="Invalid Username or Password.";

	//header('location:login.php?invalid=false');

}

	}

}



?>



<!DOCTYPE html>

<html class="lockscreen" >

    <head>

        <meta charset="UTF-8">

        <title><?php echo $projectname=$DB->projectname();  ?> | Log in</title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- bootstrap 3.0.2 -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- font Awesome -->

        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme style -->

        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- Webtycoons Style-->

          <link href="css/webtycoons/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!--[if lt IE 9]>

          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->

    </head>

    <body >

 

        <div class="form-box" id="login-box" style="text-align: center;">

		

		<?php // echo $_SERVER['PHP_SELF']; ?>

            <div class="header" style="background-color: rgba(234, 234, 236, 0) !important;"><img src="<?php echo $DB->logo();  ?>" style="width: 63% !important;border: 0px solid !important;" alt="<?php echo $projectname;  ?>" /></div>

            <form action="" method="post">

                <div class="body bg-gray" style="background-color: rgba(234, 234, 236, 0) !important;">

                    <div class="form-group">

                        <input type="text" name="userid" class="form-control" placeholder="User ID"/>

                    </div>

                    <div class="form-group">

                        <input type="password" name="password" class="form-control" placeholder="Password"/>

                    </div>          

                    

                </div>

                <div class="footer" style="background:rgba(234, 234, 236, 0) !important;">                                                               

                    <button type="submit" name="submit"  style="background: #3e8df5 !important" class="btn bg-olive btn-block">Sign me in</button>  



                </div>

            </form>


        </div>

        <?php if($_GET['invalid']=="false1") {

			print_r($fetch);

		}

		if($_GET['invalid']=="false"){ ?>

        <div class=" bg-red msg_box ">

            <p class="pad"><i class="fa fa-key" style="font-size:18px ;"></i>&nbsp;Invalid Username or Password </p>

            </div>

        <?php } else if(isset($msg)!=''){ ?>

          <div class=" bg-orange msg_box ">

            <p class="pad"><i class="fa fa-crosshairs" style="font-size:18px ;"></i>&nbsp;<?php echo $msg;?></p>

          </div>

        <?php }else{?>

       <!--  <div class=" bg-aqua msg_box ">

            <p class="pad"><i class="fa fa-lock" style="font-size:18px ;"></i>&nbsp;Secure Admin Panel</p>

         </div>-->

         <?php }?>

        <!-- jQuery 2.0.2 -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

        <!-- Bootstrap -->

        <script src="js/bootstrap.min.js" type="text/javascript"></script>        



    </body>

</html>