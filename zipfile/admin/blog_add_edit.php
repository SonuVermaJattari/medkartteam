<?php
include 'includes/functions.php';
session_start();
ob_start();
@extract($_REQUEST);
if(isset($_POST['submit']))
{
	
	$service_id=$_GET['q'];
	$successflag=0;
	if($_FILES['img']['tmp_name']!=''){
		$new_image_name=$DB->img($_FILES['img'],19200,4000,'blog');
		$erromsg=$DB->error();
	
	}
	$name=mysql_real_escape_string($name);
	if(empty($erromsg)){
		$editor1=mysql_real_escape_string($editor1);
		$query="update blog set msg='$editor1'";
		if($new_image_name!=''){
		
			unlink("../images/blog/".$_POST['img_hidden']);	
			
			$query.=",img='$new_image_name'";
		}
	//	$date=date("M-d");
	$date=mysql_real_escape_string($date);
	
	
	$new_date=explode('/',$date);
		list($m,$d,$y)=$new_date;
		$date= $y.'-'.$m.'-'.$d;
		$query.=",status='$r3',sort='$sort',blog_id='$service_id',title='$name',date='$date' where id='$eid'";
		$result = mysql_query($query);
		if($result)
			$msg = "Content Update Successfully";
	}
}



$eid=$_GET['eid'];


$QRY="select * from blog where id='$eid'";
$web=$DB->fectchRecord($QRY);
$restrict=$web['status'];
$date_fetch=$web['date'];


$new_date=explode('-',$date_fetch);
list($y,$m,$d)=$new_date;
$date1= $m.'/'.$d.'/'.$y;

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>blogs ADD | Dashboard</title>
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
                    <h1>
                      <?php echo $_GET['name']; ?> Edit
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                        <li><a href="javascript:void(0);"> <?php echo $_GET['name']; ?> Edit</a></li>
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
                                    <h3 class="box-title">Update  <?php echo $_GET['name']; ?> Edit</h3>
									<div  style="float: right;">
										<button type="button" class="btn btn-primary" value="blog_add.php?q=<?php echo $_GET['q'].'&&name='.$_GET['name']; ?>" onClick="display(this.value)" >ADD   <?php echo $_GET['name']; ?></button>
										<button type="button" class="btn btn-primary" value="blog_add_view.php?q=<?php echo $_GET['q'].'&&name='.$_GET['name']; ?>" onClick="display(this.value)"  >View  <?php echo $_GET['name']; ?></button>
									</div>
                                </div><!-- /.box-header -->
                                <?php if($erromsg!=''){ ?>
                               <!-- Alert-->
                               <div style="padding:5px 10px 0 10px;">
                                <div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> <?php echo $erromsg;?>
                                    </div>
                                </div>
                                <?php  } if($msg!=''){?>
                               <div style="padding:5px 10px 0 10px;">
                                <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> <?php echo $msg;?>
                                    </div>
                                </div>
                                <?php } ?>
                               <!--./Alert-->
                                <!-- form start -->
                                <form role="form" method="post" name="form" enctype="multipart/form-data">
                                    <div class="box-body" >
											<div class="form-group">
												<label> Name</label>
												<input type="text" name="name" class="form-control"  value="<?php echo $web['title']; ?>">
											</div>
                                           	<div class="form-group">
												 <label> Description</label>
												 <textarea id="editor1" name="editor1" rows="10"  cols="80"><?php echo $web['msg']; ?></textarea>
                  		          			</div>
                                       		<div class="form-group">
												<label for="exampleInputFile">Image</label>
												<input type="file"  name="img" id="img" >
												<!--<p class="help-block">*Image dimension  should in jpg format .</p>-->
												<input type="hidden" name="img_hidden" value="<?php echo $web['img'];?>">	
                                           <p class="box" style="width:20%" ><img src="../<?php echo $web['img'];?>" style="width:100%" /></p>
                                        </div>
										
										<div class="form-group">
											<label> Date (Month/Day/year)</label>
											<input type="text" name="date" id="datepicker"  class="form-control" value="<?php echo $date1; ?>" placeholder="Eg: Month/Day/year"  >
										</div>
											<!--<div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="sort" class="form-control" placeholder="Eg: 1"  value="<?php echo $web['sort']; ?>"  required />
                                        </div> --> 
										<div class="form-group">
										
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="1" <?php echo $restrict == "1" ? "checked": ''; ?> />&nbsp;Active
                                        </label>
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="0" <?php echo $restrict == "0" ? "checked": ''; ?> />&nbsp;Inactive
                                        </label>
                                        
                                    </div>                        			   
                                      </div><!-- /.box-body -->
						
                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
										
                                    </div>
								
                                </form>
                            </div><!-- /.box -->
						</div><!-- /.left column -->
                  </div> <!-- /.row-->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


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
		function display(el) {
		//alert(el);
			window.open(el, "_self");
		}
		</script>
				  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
   <?php include 'includes/lockscreen.php'?>
    </body>
</html>