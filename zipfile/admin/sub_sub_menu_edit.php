 <?php

include 'includes/functions.php';

session_start();

ob_start();

@extract($_REQUEST);

$eid=$_REQUEST['eid'];

$e_menu=$_REQUEST['menu'];

if(isset($_POST['submit']))

{

	if($_FILES['img']['tmp_name']!=''){

		$new_image_name=$DB->img($_FILES['img'],1920,400);

		$erromsg=$DB->error();

	

	}

	if($_FILES['img1']['tmp_name']!=''){

		$image_name=$DB->img($_FILES['img1'],1490,1250);

		$erromsg.=$DB->error();

	

	}  	

$name=mysql_real_escape_string($name);

$link=mysql_real_escape_string($link);

$Products_name=mysql_real_escape_string($Products_name);

	





if(empty($erromsg)){



$sqlqry="update sub_sub_menu set sub_menu='$sub_menu',sub_sub_menu='$sub_sub_menu',link='$link',Products_name='$Products_name',text='".$_REQUEST['editor1']."'";

	if((isset($new_image_name)!=''))

	{		

		$sqlqry.=",`ban_img`='$new_image_name'"; 

	}if(isset($image_name)!='')

	{		

		$sqlqry.=",`img`='$image_name'" ;

	}

	$sqlqry.=",sort='$sort', status='$r3' where id='$eid'";

	

	

	

	$successful=$DB->executupdate($sqlqry);

	if($successful)

	{

		$msg=" Updated Successfully";	

	}

}





}







$QRY="select * from sub_sub_menu where id='$eid'";

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

         <!--ajax code-->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

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

                   Sub Sub Menu Edit 

                        <small>Control panel</small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

                        <li><a href="javascript:void(0);">Sub Sub Menu</a></li>

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

                                    <h3 class="box-title">Sub Sub Menu</h3>

                                </div><!-- /.box-header -->

                                <?php if($erromsg!=''){ ?>

                               <!-- Alert-->

                               <div class="msg" style="padding:5px 10px 0 10px;">

                                <div class="alert alert-warning alert-dismissable">

                                        <i class="fa fa-warning"></i>

                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                        <b>Alert!</b> <?php echo $erromsg;?>

                                    </div>

                                </div>

                                <?php  } if($msg!=''){?>

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

                                    <div class="box-body" >

								<!--	<div class="form-group">

                                            <label>Menu</label>

                                            <input type="text" name="menu" readonly class="form-control" value="<?php echo $array[$web['menu']]; ?>">

                                        </div> -->

										

										<div class="form-group">

										<label>Menu</label>

										<select name="menu" class="form-control" onChange="fetch_select(this.value);"  required>

										<?php $sqlu = "select * from menu where status='1' AND link='0' order by sort ";

										$resultu = mysql_query($sqlu);

										while($drop = mysql_fetch_array($resultu)){ ?>

										<option value="<?php echo $drop['id'];?>" <?php echo $e_menu==$drop['id']?'selected':"" ?> ><?php echo $drop['menu'];?></option>

										<?php }?>

										

										</select>

									</div> 

									 <div class="form-group">

                                            <label>Sub Main </label>

											<select name="sub_menu" class="form-control" id="new_select1" required>

												<!--<option ><?php echo $web['sub_menu']; ?></option>-->

												

												

                                             

 											</select>

                                        </div> 

									<div class="form-group">

                                            <label>Sub Sub Menu</label>

                                            <input type="text" name="sub_sub_menu" class="form-control" placeholder="Eg: " value="<?php echo $web['sub_sub_menu']; ?>"required/>

                                        </div> 

									<div class="btn-group form-group">

											  <button type="button" class="btn btn-primary DBview" value="New Page" onClick="display(this)" >New Page (Information page)</button>
<button type="button" class="btn btn-primary  foo" value="product" onClick="display(this)" >Product</button>
											 <!-- <button type="button" class="btn btn-primary DBview" value="product-view.php" onClick="display(this)" >product-view</button>-->

											  <!--<button type="button" class="btn btn-primary  foo" value="gallery" onClick="display(this)" >Gallery</button>-->

											 

										</div>

										<div class="form-group">

											<label>Link</label>

											<input id="abc" type="text" name="link" class="form-control"  value="<?php echo $web['link'];?>"  />

										</div>

										<?php /*?><div class="form-group ban">

                                            <label for="exampleInputFile">Banner Image</label>

                                            <input type="file"  name="img" >

                                            <p class="help-block">*Image dimension  should in jpg format & not greater than 1920* 400.</p>

                                            <p class="box" style="width:20%" ><img src="../images/info/<?php echo $web['ban_img'];?>" style="width:100%" /></p>

                                      </div> <?php */?>

										<div id="new_select">

										   



										<!--<div class="form-group">

                                            <label>Products name</label>

                                            <input type="text" name="Products_name" value="<?php echo $web['Products_name']; ?>" class="form-control" />

                                        </div>

										 <div class="form-group">

                                            <label for="exampleInputFile">Products Image</label>

                                            <input type="file"  name="img1"  >

											 <p class="box" style="width:20%" ><img src="../images/info/<?php echo $web['img'];?>" style="width:100%" /></p>

		                                    </div> --> 

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

       <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->

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



		<script type="text/jscript">

			function fetch_select(val,sub_menu){

			
			// alert(val+' '+sub_menu);

			   $.ajax({

				 type: 'post',

			  	 url: 'sub_sub_menu_filter_edit.php',

				 data: {

				   get_option:val,

				   sub_menu:sub_menu

				 },

				 success: function (response) {

				   document.getElementById("new_select1").innerHTML=response; 

				 }

			   });

			}

			fetch_select('<?php echo $e_menu; ?>','<?php echo $web['sub_menu']; ?>');

		</script> 
 <?php include 'includes/lockscreen.php'?>

    </body>

</html>