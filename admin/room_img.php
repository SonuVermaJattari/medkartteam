<?php

include 'includes/functions.php';
//include('Users.php'); 
// $result = $users->error();
session_start();
ob_start();
@extract($_REQUEST);
$room_id=(int)$_GET['eid'];
if(isset($_POST['submit'])){
	
	$msg=$DB->img_mul($_FILES,'room_img','room_img',$room_id);
	$erromsg=$DB->error();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $DB->projectname();  ?>| Dashboard</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include 'includes/header.php'?>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<?php include 'includes/left.php'?>
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Room Images </h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Room Images</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<!-- left column -->
				<div class="col-lg-9" style=" float:none; margin:0 auto;">
					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title" >Room Images</h3>
							<button type="button" name="View" style="float: right;" onClick=" window.location ='room_name_view.php';" class="btn btn-primary">View Room's</button>
							<button type="button" name="View" style="float: right;" onClick=" window.location ='room_img_view.php?eid=<?php echo $room_id; ?>';" class="btn btn-primary">View Room Images</button>
						</div>
						<!-- /.box-header -->
						<?php if(isset($erromsg)!=''){ ?>
						<!-- Alert-->
						<div style="padding:5px 10px 0 10px;">
							<div class="alert alert-warning alert-dismissable"> <i class="fa fa-warning"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b>Alert!</b> <?php echo $erromsg;?> </div>
						</div>
						<?php  } if(isset($msg)!=''){?>
						<div style="padding:5px 10px 0 10px;">
							<div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b>Success!</b> <?php echo $msg;?> </div>
						</div>
						<?php } ?>
						<!--./Alert-->
						<!-- form start -->
						<form role="form" method="post" name="form" enctype="multipart/form-data">
							<div class="box-body" >
								<div class="form-group">
									<label for="exampleInputFile">Image</label>
									<input type="file"  name="files[]" multiple="multiple" >
								</div>
								
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-primary" id="submit">Submit</button>
							</div>
						</form>
					</div>
					<!-- /.box -->
				</div>
				<!-- /.left column -->
			</div>
			<!-- /.row-->
		</section>
		<!-- /.content -->
	</aside>
	<!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->

<!-- CK Editor -->
<script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

</body>
</html>
