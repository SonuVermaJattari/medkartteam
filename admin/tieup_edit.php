<?php

include 'includes/functions.php';

session_start();

ob_start();

@extract($_REQUEST);

if(isset($_GET['eid'])!=''){ $eid=$_GET['eid']; }

if(isset($_POST['submit'])){
	$flag=1;
	if($flag=='1' ){	
	$sqlqry="update user set `title`='$title', `fname`='$fname', `lname`='$lname', `email`='$email', `phone`='$phone',status='$r3'  where id='$eid' " ;
	$successful=$DB->executupdate($sqlqry);
		if($successful){
			$msg="Updated Successfully";	
		}
	}
}
$QRY="select * from user where id='$eid'";
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

        <script type="text/javascript" src="jscolor/jscolor.js"></script>

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

                        Edit  Tie up with manufacturer

                        <small>Control panel</small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

                       <!--<li><a href="javascript:void(0);"> Tie up with manufacturer Management</a></li>-->

                        <li class="active"> Tie up with manufacturer</li>

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

                                    <h3 class="box-title">Edit  Tie up with manufacturer</h3>

                                </div><!-- /.box-header -->

                                <?php if(isset($erromsg)!=''){ ?>

                               <!-- Alert-->

                               <div style="padding:5px 10px 0 10px;">

                                <div class="alert alert-warning alert-dismissable">

                                        <i class="fa fa-warning"></i>

                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                        <b>Alert!</b> <?php echo $erromsg;?>

                                    </div>

                                </div>

                                <?php  } if(isset($msg)!=''){?>

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
                                          <label>Title</label>
                                          <select name="title" class="form-control" required>
                                            <option value="Mr." <?php echo $web['title']=='Mr.'?'selected':''; ?> >Mr.</option>
                                            <option value="Mrs."  <?php echo $web['title']=='Mrs.'?'selected':''; ?>>Mrs.</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Name</label>
                                            <input type="text" name="fname" value="<?php echo $web['fname'];?>"  class="form-control" placeholder="Enter ..." />
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" value="<?php echo $web['lname'];?>"  name="lname" class="form-control" placeholder="Enter ..." />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control" value="<?php echo $web['email'];?>"  placeholder="Enter ..." />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control" value="<?php echo $web['phone'];?>"  placeholder="Enter ..." />
                                        </div>
										<div class="form-group">
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="1" <?php echo $restrict == "1" ? "checked": ''; ?>  />&nbsp;Active

                                        </label>
                                        <label>
                                            <input type="radio" name="r3" class="flat-red" value="0"  <?php echo $restrict == "0" ? "checked": ''; ?>  />&nbsp;Inactive
                                        </label>
                                    </div>
                                    </div><!-- /.box-body -->
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

        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

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



  <?php include 'includes/lockscreen.php'?>

    </body>

</html>