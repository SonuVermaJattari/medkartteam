<?php
include 'includes/functions.php';

session_start();
ob_start();
@extract($_REQUEST);
if(isset($_GET['eid'])!=''){ $eid=$_GET['eid']; }
if(isset($_POST['submit']))
{
	if($_FILES['img']['tmp_name']!=''){
		$new_image_name=$DB->img($_FILES['img'],20,20,'icon');
		$erromsg=$DB->error();
	
	}

	

	
	

$name=mysql_real_escape_string($name);
$link=mysql_real_escape_string($link);
$editor1=mysql_real_escape_string($editor1);
	

if($link=='sub menu'){
$link='0';

}
if(empty($erromsg)){

$sqlqry="update menu set menu='$menu', link='$link', text='$editor1'";
	if((isset($new_image_name)!=''))
	{		
		$sqlqry.=",`menu_icon`='$new_image_name'"; 
	}if(isset($image_name)!='')
	{		
		$sqlqry.=",`img`='$image_name'" ;
	}
	$sqlqry.=",sort='$sort', status='$r3' where id='$eid'";
	
	
	
	$successful=$DB->executupdate($sqlqry);
	if($successful)
	{
		$msg="Menu Updated Successfully";	
	}
}
}


$QRY="select * from menu where id='$eid'";
$web=$DB->fectchRecord($QRY);
$restrict=$web['status'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $DB->projectname();  ?> | Dashboard</title>
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
            <?php  include 'includes/left.php'?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Menu Edit 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Menu Edit</li>
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
                                    <h3 class="box-title">Edit</h3>
									<button type="button" name="View" style="float: right;" onClick=" window.location ='menu_view.php';" class="btn btn-primary">View Menu</button>
							<button type="button" name="View" style="float: right;" onClick=" window.location ='menu.php';" class="btn btn-primary">Add Menu</button>
                                </div><!-- /.box-header -->
                                <?php if(!empty($erromsg)){ ?>
                               <!-- Alert-->
                               <div class="msg" style="padding:5px 10px 0 10px;">
                                <div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> <?php echo $erromsg;?>
                                    </div>
                                </div>
                                <?php  } if(!empty($msg)){?>
                               <div class="msg" style="padding:5px 10px 0 10px;">
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
                                    <!-- /.box-body -->
						
                                    
									<div class="box-body" >
                                    <div class="form-group">
                                            <label>Menu Icon</label>
                                            <input type="file"  name="img"  >
                                            
                                            <p class="help-block">*Image dimension  should in jpg format & not greater than 20*20.</p>
                                        </div>
								<!--<div class="form-group">
                                            <label>Menu Icon</label>
                                            <input type="text" name="menu_icon" class="form-control" value="<?php  echo $web['menu_icon'];?>" placeholder="Eg: home,about ...." />
                                        </div>-->
										<div class="form-group">
                                            <label>Menu Name <img src="../<?php  echo $web['menu_icon'];?>" style="background-color: black;" /></label>
                                            <input type="text" name="menu" value="<?php echo $web['menu'];?>" class="form-control" placeholder="Eg: home,about us,service ...." required />
                                        </div>
										 <div class="btn-group form-group">
											  <button type="button" class="btn btn-primary DBview" value="New Page" onClick="display(this)" >New Page (Information page)</button>
											  <!--<button type="button" class="btn btn-primary DBview" value="product-view.php" onClick="display(this)" >product-view</button>-->
											  <!--<button type="button" class="btn btn-primary  foo" value="gallery" onClick="display(this)" >Gallery</button>-->
											  <button type="button" class="btn btn-primary   foo sub_ban" value="product" onClick="display(this)" >product</button>
											  <button type="button" class="btn btn-primary   foo sub_ban" value="sub menu" onClick="display(this)" >sub menu</button>
										</div>
										<div class="form-group">
											<label>Link</label>
											<input id="abc" type="text" name="link" class="form-control"  value="<?php echo $web['link']=='0'?"sub menu":$web['link'];?>" required />
										</div>
										 
										<div id="new_select">
										

										<!--<div class="form-group">
                                            <label>Products name</label>
                                            <input type="text" name="Products_name" value="<?php echo $web['Products_name']; ?>" class="form-control" />
                                        </div>-->
										<!-- <div class="form-group">
                                            <label for="exampleInputFile">Products Image</label>
                                            <input type="file"  name="img1"  >
                                            <p class="help-block">*Image dimension  should in jpg format & not greater than 450*250.</p>
											 <p class="box" style="width:20%" ><img src="../images/info/<?php echo $web['img'];?>" style="width:100%" /></p>
		                                    </div>-->  
											<div class="form-group"> 
												<iframe src="upload_image.php" frameborder="0" style=" width:100%; height:210px;"></iframe>
											</div>
		 
										<div class="form-group">
											<label>Text</label>
										   <textarea name="editor1" id="editor1" class="form-control"> <?php echo $web['text']; ?></textarea>
										</div> 
										
										</div>
                                       
											<div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="sort" class="form-control" value="<?php echo $web['sort'];?>" placeholder="Eg: 1"  required />
                                        </div>
										<div class="form-group">
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="1"  <?php echo $restrict == "1" ? "checked": ''; ?> />&nbsp;Active
                                        </label>
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="0"  <?php echo $restrict == "0" ? "checked": ''; ?> />&nbsp;Inactive
                                        </label>
                                        
                                    </div>
									
										
						   </div>
						   <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary" id="submit">Submit</button>
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
		<script>$(document).ready(function(){$(".message").hide(5000);$(".msg").fadeOut(5000);});</script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	
		<script type="text/javascript">
		function display(el) {
			var id = $(el).attr('value');
			//alert(id);
			 document.getElementById("abc").value=id;
		}
		$(document).ready(function(){
			 $(".DB").click(function(){
				$("#new_select").hide();
				$(".footer").show();
			});
			 $(".foo").click(function(){
			 	$("#new_select").hide();
				$(".ban").show();
				$(".footer").hide();
			});
			$(".DBview").click(function(){
				$(".footer").show();
				$(".ban").show();
				$("#new_select").show();
			});
			$(".sub_ban").click(function(){
				$(".ban").hide();
				//$("#new_select").show();
			});
		$("#new_select").hide();
		$(".ban").hide();
		});
	
	
		</script>
		
		
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