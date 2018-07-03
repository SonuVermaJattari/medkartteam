<?php
include 'includes/functions.php';
session_start();
ob_start();
@extract($_REQUEST);

if(isset($_POST['submit']))
{
	if($_FILES['img1']['tmp_name']!=''){
		$new_image_name=$DB->img($_FILES['img1'],2800,2800,'room');
		$erromsg=$DB->error();
	}
	$facilities=implode(',',$tv);
	$text=$DB->escape($_POST['editor1']);
	$room_name=$DB->escape($_POST['room_name']);
	$sorttext=$DB->escape($_POST['sorttext']);
	if(empty($erromsg)){
		$query="INSERT INTO `room` ( `name`,`type`, `img`,sorttext, `text`, `facilities`, `price`, `status`,home_display) VALUES ( '$room_name', '$room_type', '$new_image_name', '$sorttext','$text','$facilities', '$price', '$r3', '$home_display')";
		$result = mysql_query($query);
		if($result)
			$msg = "Content Insert Successfully";
	}
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
<!--ajax code-->
<!--end ajax code-->
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
			<h1> ROOM DETAIL <small>Control panel</small> </h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="javascript:void(0);">ROOM DETAIL </a></li>
				<li class="active">Data</li>
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
							<h3 class="box-title">ROOM DETAIL</h3><button type="button" name="View" style="float: right;" onClick=" window.location ='room_name_view.php';" class="btn btn-primary">View Room's</button>
						</div>
						<!-- /.box-header -->
						<?php if($erromsg!=''){ ?>
						<!-- Alert-->
						<div class="msg" style="padding:5px 10px 0 10px;">
							<div class="alert alert-warning alert-dismissable"> <i class="fa fa-warning"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b>Alert!</b> <?php echo $erromsg;?> </div>
						</div>
						<?php  } if($msg!=''){?>
						<div class="msg" style="padding:5px 10px 0 10px;">
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
									<label>Type</label>
									<select name="room_type" class="form-control" required >
										<option value="" class="hidden"> ROOM Type</option>
										<option value="DELUXE ROOM">DELUXE</option>
										<option value="SUPER DELUXE ROOM">SUPER DELUXE</option>
										</option>
									</select>
								</div>
								<!--<div class="form-group">
									<label>Name</label>
									<input type="text" name="room_name"  placeholder="Room Name"   class="form-control" />
								</div>-->
								<div class="form-group">
									<label for="exampleInputFile">Image</label>
									<input type="file"  name="img1"  >
								</div>
								<div class="form-group">
									<label>Sort Text</label>
									<textarea name="sorttext" id="sorttext" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea name="editor1" id="editor1" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label>Facilities</label>
									<br />
									<?php $sqlu = "select * from add_our_services where status='1' order by sort ";
									$resultu = mysql_query($sqlu);
									while($drop = mysql_fetch_array($resultu)){ ?>
									<label style="margin: 10px;">
									<input type="checkbox" name="tv[]" value="<?php echo $drop['id']; ?>">
									<img src="../<?php echo $drop['img'];?>" title="<?php echo $drop['service_name']; ?>" width="50px"/> </label>
									<?php }?>
								</div>
                                <div class="form-group">
									<label>Home Display</label>
									<select name="home_display" class="form-control" required >
										<option value="" class="hidden"> Yes/No</option>
										<option value="0"  >No</option>
										<option value="1"  >Yes</option>
										</option>
									</select>
								</div>
								<div class="form-group">
									<label>Price</label>
									<input type="number" name="price" class="form-control" placeholder="Eg: 2000"  required />
								</div>
								<div class="form-group">
									<label>
									<input type="radio" name="r3" class="flat-red" value="1" checked />
									&nbsp;Active </label>
									<label>
									<input type="radio" name="r3" class="flat-red" value="0" />
									&nbsp;Inactive </label>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<script>$(document).ready(function(){$(".message").hide(5000);$(".msg").fadeOut(5000);});</script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
		<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('sorttext');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
</body>
</html>
