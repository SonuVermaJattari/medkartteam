<?php include_once 'includes/functions.php'; ?>

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

<!-- Morris chart -->

<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />

<!-- jvectormap -->

<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

<!-- fullCalendar -->

<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />

<!-- Daterange picker -->

<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

<!-- bootstrap wysihtml5 - text editor -->

<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

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

  <aside class="right-side"> 

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> Dashboard <small>Control panel</small> </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Dashboard</li>

      </ol>

    </section>

    <section class="content"> 

      <div class="row">

        <div class="col-lg-3 col-xs-6"> 

          <div class="small-box bg-aqua">

            <div class="inner">

              <h3>

                <?php                                    

					$ress=mysql_query("select count(*) as cot from order_confirm ");

					$rs=mysql_fetch_assoc($ress);

					echo $rs['cot'];

					?>

              </h3>

              <p> Total Orders </p>

            </div>

            <div class="icon"> <i class="ion ion-bag"></i> </div>

            <a href="orders_list.php" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6"> 

          <!-- small box -->

          <div class="small-box bg-green">

            <div class="inner">

              <h3>

               <?php                                    

                                    $rxx=mysql_query("SELECT sum(price) as sale FROM `order_details`");

                                    $rx=mysql_fetch_assoc($rxx);

                                    echo $rx['sale'];

                                    ?>

               

                <!--<sup style="font-size: 20px">%</sup>--> 

              </h3>

              <p>Total Sales</p>

            </div>

            <div class="icon"> <i class="ion ion-stats-bars"></i> </div>

            <a href="#" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6"> 

          <!-- small box -->

          <div class="small-box bg-yellow">

            <div class="inner">

              <h3>

                <?php                                    

                                    $res=mysql_query("select count(*) as cot from user");

                                    $rs=mysql_fetch_assoc($res);

                                    echo $rs['cot'];

                                    ?>

              </h3>

              <p>Total Registeration </p>

            </div>

            <div class="icon"> <i class="ion ion-person-add"></i> </div>

            <a href="registration.php" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6"> 

          <!-- small box -->

          <div class="small-box bg-red">

            <div class="inner">

              <h3>

                <?php                                    

				$resst=mysql_query("select count(*) as cottt from products");

				$rsst=mysql_fetch_assoc($resst);

				echo $rsst['cottt'];

				?>

              </h3>

              <p> Total Products </p>

            </div>

            <div class="icon"> <i class="ion ion-pie-graph"></i> </div>

            <a href="product_view.php" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>

        </div>

      </div>

      <div class="row">

        <div class="col-xs-12 connectedSortable"> </div>

      </div>

      <div class="row"> 

        <section class="col-lg-6 connectedSortable"> 

          <div class="box">

            <div class="box-header">

              <h3 class="box-title">Fresh Registered Customer</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body no-padding">

              <table class="table table-striped">

                <tbody>

                  <tr>

                    <th style="width: 10px">S.No.</th>

                    <th>Name</th>

                    <th>Email Id</th>

                  </tr>

                  <?php                                    

					$cnt=1;                                    

					$ss=mysql_query("select * from user where fix='TDUID-' order By id desc limit 5");

					while($sr=mysql_fetch_array($ss))

					{

					?>

                  <tr>

                    <td><?php echo $cnt++; ?></td>

                    <td><?php echo $sr['title']." ".$sr['fname']." ".$sr['lname']  ;?></td>

                    <td><?php echo $sr['email']; ?></td>

                  </tr>

                  <?php 

					}

					?>

                <td colspan='4' align='right'><a href="registration.php">Read More..</a></td>

                    </tbody>

              </table>

            </div>

            <!-- /.box-body --> 

          </div>
			<div class="box">

            <div class="box-header">

              <h3 class="box-title">Pharmacist Registration</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body no-padding">

              <table class="table table-striped">

                <tbody>

                  <tr>

                    <th style="width: 10px">S.No.</th>

                    <th>Name</th>

                    <th>Email Id</th>

                  </tr>

                  <?php                                    

					$cnt=1;                                    

					$ss=mysql_query("select * from user where fix='PID-' order By id desc limit 5");

					while($sr=mysql_fetch_array($ss))

					{

					?>

                  <tr>

                    <td><?php echo $cnt++; ?></td>

                    <td><?php echo $sr['title']." ".$sr['fname']." ".$sr['lname']  ;?></td>

                    <td><?php echo $sr['email']; ?></td>

                  </tr>

                  <?php 

					}

					?>

                <td colspan='4' align='right'><a href="pharmacist_registration.php">Read More..</a></td>

                    </tbody>

              </table>

            </div>

            <!-- /.box-body --> 

          </div>
          <!-- /.box -->

          

        </section>

        <section class="col-lg-6 connectedSortable"> 

          <div style="padding:50px 10px 0 10px; display:none" id="sending">

            <div class="alert alert-success alert-dismissable"> <i class="fa fa-info" style="top:8px !important;"></i>

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

              <b id="msg"></b> </div>

          </div>

        </section>

      </div>
	
    </section>

  </aside>

</div>

<!-- ./wrapper --> 

<!-- add new calendar event modal --> 

<!-- jQuery 2.0.2 --> 

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>--> 

<script src="js/jquery.min.js" type="text/javascript"></script> 

<!-- Bootstrap --> 

<script src="js/bootstrap.min.js" type="text/javascript"></script> 

<!-- InputMask --> 

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script> 

<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script> 

<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script> 

<!-- date-range-picker --> 

<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script> 

<!-- bootstrap color picker --> 

<!-- bootstrap time picker --> 

<!-- AdminLTE App --> 

<script src="js/AdminLTE/app.js" type="text/javascript"></script> 

<!-- AdminLTE for demo purposes --> 



<!-- Page script --> 

<script type="text/javascript">

            $(function() {

                

               // $('#reservation').daterangepicker();

                $('#reservation').daterangepicker({ format: 'YYYY-MM-DD', separator: ' TO '});

             

            });

        </script>

<?php include 'includes/lockscreen.php'?>

</body>

</html>

