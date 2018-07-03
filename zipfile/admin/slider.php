<?php
include 'includes/functions.php';
session_start();
ob_start();
$res_name="Slider";
@extract($_REQUEST);
if(isset($_POST['submit'])){
	$text11=$DB->escape($_POST['text1']);
	$text21=$DB->escape($_POST['text2']);
	$link1=$_POST['link'];
	$sort1=(int)$_POST['sort'];
	$successflag=0;
	if($_FILES['img']['tmp_name']!=''){
		$new_image_name=$DB->img($_FILES['img'],2800,2800,'slider');
		$erromsg=$DB->error();
	}if($_FILES['img']['tmp_name']==''){
		$erromsg.=' PLZ Enter Image.';
	}
	if(empty($erromsg)){
		$query="INSERT INTO slider ( `text1`, `text2`, `img`, `link`, `sort`, `status`) VALUES ('$text11','$text21','$new_image_name','$link1','$sort1','$r3')";
		$result = mysql_query($query);
		if($result){
			$text11="";
			$text21="";
			$link1="";
			$sort1="";
			$msg = "Insert Successfully";
		}
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

</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<?php include 'includes/left.php';?>
	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> <?php echo $res_name; ?> </h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="javascript:void(0);"><?php echo $res_name; ?></a></li>
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
							<h3 class="box-title"><?php echo $res_name; ?></h3>
							<button type="button" name="View" style="float: right;" onClick=" window.location ='slider_view.php';" class="btn btn-primary">View slider</button>
						</div>
						<!-- /.box-header -->
						<?php if($erromsg!=''){ ?>
						<!-- Alert-->
						<div class="msg" style="padding:5px 10px 0 10px;">
							<div class="alert alert-warning alert-dismissable"> <i class="fa fa-warning"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b>Alert!</b> <?php echo $erromsg;?> </div>
						</div>
						<?php } if($msg!=''){?>
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
									<label>Text 1</label>
									<input type="text" name="text1" class="form-control" value="<?php echo $text11; ?>" placeholder="Enter text1..." required/>
								</div>
								<div class="form-group">
									<label>Text 2</label>
									<input type="text" name="text2" class="form-control" value="<?php echo $text21; ?>"  placeholder="Enter text2..." required/>
								</div>
								<div class="form-group">
									<label for="exampleInputFile">Image</label>
									<input type="file" name="img" id="img" >
									<p class="help-block">*Image dimension should in jpg format & not more than 1920*540.</p>
								</div>
								<!--<div class="form-group">
									<label>Link</label>
									<input type="text" name="link" class="form-control" value="<?php echo $link1; ?>"  placeholder="Enter link..." required/>
								</div>-->
								<div class="form-group">
									<label>Sort Order</label>
									<input type="number" name="sort" class="form-control" min='1' placeholder="Eg: 1" value="<?php echo $sort1; ?>"  required />
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
 <?php include 'includes/lockscreen.php'?>
</body>
</html>
