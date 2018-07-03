<?php
include 'includes/functions.php';
session_start();
ob_start();
@extract($_REQUEST);
if(isset($_POST['submit']))
{
	$flag=1;
	if($_FILES['img']['tmp_name']!=''){
		$new_image_name=$DB->img($_FILES['img'],2800,2800,'Facilities');
		$erromsg=$DB->error();
		if(!empty($erromsg)){
				$flag=0;
		}
	}
	if($flag=='1'){
		if($service_name=='')
		{
		$erromsg="name should not be blank";
		$flag=0;
		}
		else {
			$sqlu = "SELECT * FROM add_our_services where service_name='$service_name' ";
					$resultu = mysql_query($sqlu);
					if(mysql_num_rows($resultu)>0){
					$flag=0;
					$erromsg="already exists";
					//echo "exist"; die;
					}
					else {
					//echo "not exit"; die;
					 $flag=1; }
		}

	}
	if($flag=='1')
	{	
		
		//calling class function for different performance 
		$sqlqry="INSERT INTO `add_our_services` (`id`, img ,`service_name`,sort,status) VALUES (NULL,'$new_image_name', '$service_name','$sort','$r3') ";
		$resultu = mysql_query($sqlqry);
			if($resultu)
			{
			$msg="Add Successfully";	
			}
	}
}

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
                    <h1>
                      ROOM Facilities
                        <small>Control panel</small>
                    </h1>
                   <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="javascript:void(0);">ROOM Facilities</a></li>
                        <li class="active">Data</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 <div class="row">
                        <!-- left column -->
                        <div class="col-lg-7" style=" float:none; margin:0 auto;">
					 <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">ADD Facilities</h3>
									<button type="button" name="View" style="float: right;" onClick=" window.location ='facilities_view.php';" class="btn btn-primary">View Facilities</button>
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
                                    <div class="box-body">
										<div class="form-group">
											<label for="exampleInputFile">Icon*</label> 
											<input type="file" name="img" id="img" >
											<p class="help-block">*Image dimension should in jpg , png format.</p>
											<!--<p class="box" style="width:20%" ><img src="../upload_slide_image/<?php //echo $row['image'];?>" style="width:100%" /></p>-->
										</div>
                                        <div class="form-group">
                                            <label>Facilities</label>
                                            <input type="text" name="service_name" class="form-control" placeholder="Eg: " required />
                                        
										  </div>
										  <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="sort" class="form-control" placeholder="Eg: 1" reqiured />
                                        </div>
										<div class="form-group">
										
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="1" checked />&nbsp;Active
                                        </label>
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="0" />&nbsp;Inactive
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
       

    </body>
</html>