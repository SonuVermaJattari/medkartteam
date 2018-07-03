<?php
include 'includes/functions.php';
session_start();
ob_start();
@extract($_REQUEST);
if(isset($_GET['client_id'])!=''){ $client_id=$_GET['client_id']; }
if(isset($_POST['submit'])){
	$date_start=$DB->escape($_POST['date_start']);
	$date_end=$DB->escape($_POST['date_end']);
	$no_days=$DB->date_diff($_POST['date_start'],$_POST['date_end']);	
	if($no_days>0){
		$user_id=$client_id;
		$fectchRecord=$DB->fectchRecord("SELECT * FROM `user` where id='$user_id'");
		if($date_start!=$fectchRecord['date_start'] || $date_end!=$fectchRecord['date_end'] ){
			$fetch_room=json_decode($fectchRecord['room'],true);
			$pre_price=$fectchRecord['total_price'];
			foreach($fetch_room as $key=>$val){
				if($DB->roomsAvalible_datechange($key,$date_start,$date_end,$val,$user_id)){
					$c=1;
				}else{
					$c=0;
					break;	
				}
			}
			
			if($c){
				$total_price=0;
				$fectch_prices=$DB->fectch_prices('SELECT id,type,price FROM `room`');
				foreach($fetch_room as $key=>$val){ 
					$price=$fectch_prices[$key]['price']*$val;
					$total_price=$total_price+$price;
				}
				$total_price=$total_price*$no_days;
				$prev['price']=$pre_price;
				$prev['date']=$fectchRecord['date_start'].'TO'.$fectchRecord['date_end'];
				$prev=json_encode($prev);
				$successful=$DB->executupdate("UPDATE `approve` SET start='$date_start' , end='$date_end' where client_id='$client_id'");
				$successful=$DB->executupdate("UPDATE `user` SET date_start='$date_start' , date_end='$date_end' , total_price='$total_price',  edit_date = NOW(), prev='$prev' WHERE `user`.`id` = '$user_id'");
				if($successful){
					$msg="Updated Successfully";
				}
			}else{
				$erromsg= 'Sorry, All Rooms Booked Now...';	 	
			}
		}else{
			$erromsg= 'no change';	
		}
	}else{
		$erromsg="Invalide Date";
	}
}

$mqry="SELECT * FROM `user` where id='$client_id' AND active='1' ";
$web=$DB->fectchRecord($mqry);
$restrict=$web['active'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Date Change| Dashboard</title>
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
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <style>
		.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 8px;
    line-height: 1.428571429;
    vertical-align: top;
    border-top: 0px;
}
        </style>
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
                      Date Change
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Date Change</li>
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
                                    <h3 class="box-title"></h3>
                        <!--<button type="button" name="View" style="float: right;" onClick=" window.location ='testimonials_menu.php';" class="btn btn-primary">View Testimonials</button>
                            <button type="button" name="View" style="float: right;" onClick=" window.location ='testimonials.php';" class="btn btn-primary">Add Testimonials</button>-->
                                </div><!-- /.box-header -->
                                <?php if(isset($erromsg)!=''){ ?>
                               <!-- Alert-->
                               <div class="msg" style="padding:5px 10px 0 10px;">
                                <div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> <?php echo $erromsg;?>
                                    </div>
                                </div>
                                <?php  } if(isset($msg)!=''){?>
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
                                 <?php $room_type=$DB->fectch_prices('SELECT id,type FROM `room`');?>
                                    <table class="table table-bordered">
                                    	<tr class="room_table">
                                            <td class=""><?php echo $web['fname']; ?> <?php echo $web['lname']; ?></td>
                                            <td class=""><?php echo $web['email']; ?> , <?php echo $web['phone']; ?></td>
                                        </tr>
                                        <tr class="tax_table">
                                        	<td class=""><?php echo $web['address']; ?></td>
                                        	<td class="" colspan="3"><?php echo $web['exta']; ?></td>
                                        </tr>
										<?php 
										$no_days=$DB->date_diff($web['date_start'],$web['date_end']);					
										$i=1;
										$_SESSION['room_admin']=json_decode($web['room'],true);
										foreach(json_decode($web['room'],true) as $key=>$val){
                                        ?>
                                    	<tr class="room_table">
                                            <td class=""><span class="imp_table_text">Room : <?php echo $i; ?><?php echo $room_type[$key]['type']; ?></span></td>
                                            <td class=""><?php echo $val; ?></td>
                                        </tr>
                                    	<?php $i++; } ?>
                                    	<tr class="tax_table">
                                    		<td class=""><span class="imp_table_text">Booking Date : </span><br><?php if($display){ ?><a href="date_change1.php?client_id=<?php echo $web['id']; ?>" title="Edit"><?php } ?><?php echo $DB->date_format1($web['date_start']); ?>  TO  <?php echo $DB->date_format1($web['date_end']); ?> <?php if($display){ ?></a><?php } ?><br />
                                    	<span class="imp_table_text">Adult : <?php echo $web['adult']; ?></span> <span class="imp_table_text">Children : <?php echo $web['child']; ?></span><br></td>
                                    		<td class=""><span class="imp_table_text"><?php echo $web['total_room'];?> Rooms, <?php echo $no_days; ?> Days</span></td>
                                    	</tr>
                                        <tr class="tax_table">
                                        <?php if(!empty($web['prev'])){
												$prev_array=json_decode($web['prev'],true);
												echo "<td>Previous price</td>";
												echo '<td><i class="fa fa-inr"></i> '.$prev_array['price']."</td>";
												} ?>
                                         </tr>
                                        <tr class="tax_table">
                                        	<td class="">Total</td>
                                        	<td class="" colspan="3"><span class="imp_table_text"><i class="fa fa-inr"></i> <?php echo $web['total_price'];?></span></td>
                                        </tr>
                                        
                                    </table>
                  
                                <form role="form" method="post" name="form" enctype="multipart/form-data">
                                    <div class="box-body" >
								        <div class="form-group">
											<label>Start Date</label>
										   <input type="text" name="date_start" id="datepicker" class="form-control"  value="<?php echo $web['date_start'];?>" required/>
										</div> 
                                        <div class="form-group">
											<label>End Date</label>
										   <input type="text" name="date_end" id="datepicker1" class="form-control" value="<?php echo $web['date_end'];?>" required/>
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
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
<script>
$(function() {
$( "#datepicker" ).datepicker({ minDate: 0,dateFormat: 'yy-mm-dd' });
});
</script>
<script>
$(function() {
$( "#datepicker1" ).datepicker({ minDate: 0,dateFormat: 'yy-mm-dd' });
});
</script>
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
                                                            <!--date picker--> 
                                    

    </body>
</html>