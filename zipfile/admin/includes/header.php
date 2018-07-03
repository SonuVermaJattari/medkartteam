<?php 

ob_start();

session_start();



if(isset($_SESSION['uname'])=='' && isset($_SESSION['upass'])=='')

{

	echo '<script>window.location.href="login.php"</script>' ;	

}

@extract($_REQUEST);

?>

<header class="header">

	<!--<div style="background-color: #f4f4f4;"  class="logo"></div>-->

	<!-- <a href="index.php" class="logo">Dairy Prime</a>-->

	<!-- Header Navbar: style can be found in header.less -->

	<nav class="navbar navbar-static-top" role="navigation">

		<!-- Sidebar toggle button-->

		

		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>

		<div class="navbar-right">

			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span>
<?php echo $DB->projectname();  ?>
					<?php //if( isset($_SESSION['oname'])!='')

											//{

												//echo $_SESSION['oname'];

											//}else{

								

											//echo "Admin";

											//}?>

					<i class="caret"></i></span> </a>

					<ul class="dropdown-menu">

						<!-- User image -->

						<li class="user-header bg-light-blue"> <!--<img src="<?php echo $DB->logo();  ?>" class="" style="width: 63% !important;border: 0px solid !important;" alt="<?php echo $DB->projectname();  ?>" />-->

							<!--<img src="img/avatar3.png" class="img-circle" alt="User Image" />-->

							<p><?php echo $DB->projectname();  ?>
								<?php //if( isset($_SESSION['oname'])!='')

										//{

										//	echo $_SESSION['oname'];

										//}else{

						

										//echo "Admin";

								//} ?>

								<small>

								<?php //if( isset($_SESSION['uemail'])!='')

									//{

										//echo $_SESSION['uemail'];

									//}else{

				

										//echo "Admin"; }?>

								</small> </p>

						</li>

						<li class="user-footer">

							<div class="pull-left"> <a href="profile.php" class="btn btn-default btn-flat">Profile</a> </div>

							<div class="pull-right"> <a href="logout.php" class="btn btn-default btn-flat">Sign out</a> </div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

</header>

