<?php

include '../inc/functions.php';

error_reporting(0);

date_default_timezone_set("Asia/Kolkata");

$currdate=date('Y-m-d H:i:s');

//@extract($_REQUEST);





?>



<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title><?php echo $DB->projectname();  ?></title>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<!-- bootstrap 3.0.2 -->

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- font Awesome -->

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- Ionicons -->

<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />



<!-- Theme style -->

<link rel="stylesheet" href="css/style.css">

<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />



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

      <h1> Order #<?php echo $_GET['order']; ?></h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Order #<?php echo $_GET['order']; ?></a></li>

        <li class="active">Data tables</li>

      </ol>

    </section>

    

    <!-- Main content -->

    <section class="content">

      <div class="">

        <div class="col-xs-12">

            <main class="col-md-9 col-sm-8" id='PrintElem'>



							



							<!-- - - - - - - - - - - - - - Order table - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								

                                <?php $order_confirm_id=(int)(str_replace("TD-","",$_GET['order'])); ?>

                                <?php //$sql = "SELECT ocf.id,ocf.user_id,ocf.pay,ocf.order_status,DATE_FORMAT(ocf.order_date, '%M %d %Y') as order_date,CONCAT(oad.title,' ',oad.fname,' ',oad.lname) as name,CONCAT(oad.address,', ',oad.street,' ',oad.lname) as address,CONCAT(oad.state,', ',oad.city,' , ',oad.pincode) as state, oad.phone,oad.email,(SELECT SUM(price*product_qty) as price FROM `order_details` WHERE order_confirm_id=ocf.id  GROUP BY order_confirm_id ) as price FROM `order_confirm` ocf LEFT JOIN order_address oad ON oad.order_confirm_id=ocf.id ";

								$sql = $DB->OrdersListQuery('admin');

								 $sql.= " where ocf.id='$order_confirm_id' "; 

								if($DB->numRows($sql)){

									$FetchOrderDetails=$DB->fectchRecord($sql);

									$FetchOrderDetails["pay"]=($FetchOrderDetails["pay"]==0?'Cash On Delivery':'Online paied');

									$FetchOrderDetails["order_status"]=($FetchOrderDetails["order_status"]==1?'Pending':$FetchOrderDetails["order_status"]);

									$table=$DB->OrderDetails($order_confirm_id,$FetchOrderDetails['shippingcharges']);

								?>

    								<div class='table_wrap'>

									<table class='table_type_1 order_table'>

                                      <tbody>

                                        <tr>

                                          <th>Order Number</th>

                                          <td><?php echo $_GET['order']; ?></td>

                                        </tr>

                                        <tr>

                                          <th>Order Date</th>

                                          <td><?php echo $FetchOrderDetails['order_date']; ?></td>

                                        </tr>

                                        <tr>

                                          <th>Product Status</th>

                                          <td><?php echo $FetchOrderDetails['order_status']; ?></td>

                                        </tr>

                                        <tr>

                                          <th>Billing Details</th>

                                          <td><?php echo $FetchOrderDetails["Billing"]; ?></td>

                                        </tr>

                                        <tr>

                                          <th>Shipping Details</th>

                                          <td><?php echo $FetchOrderDetails["Shipping"]; ?></td>

                                        </tr>

                                        <tr>

                                          <th>Payment</th>

                                          <td><?php echo $FetchOrderDetails['pay']; ?></td>

                                        </tr>

                                        <tr>

                                          <th>Total</th>

                                          <td class='total'>Rs<?php echo $FetchOrderDetails['price']; ?></td>

                                        </tr>

                                      </tbody>

                                    </table>

								</div>

							<?php } ?>

							</div>

                            <br>

							<section class="section_offset">

									<?php echo $table; ?>

							</section>



							<!-- - - - - - - - - - - - - - End of items ordered - - - - - - - - - - - - - - - - -->



						</main>

            </div>

          <!-- /.box --> 

      </div>

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

<script src="js/AdminLTE/app.js" type="text/javascript"></script> 

<script>

        function PrintElem(elem)

		{

			var mywindow = window.open('', 'PRINT', 'height=400,width=600');

		

			mywindow.document.write('<html><head><title>' + document.title  + '</title>');

			mywindow.document.write('</head><body >');

			mywindow.document.write('<h1>' + document.title  + '</h1>');

			mywindow.document.write(document.getElementById(elem).innerHTML);

			mywindow.document.write('</body></html>');

		

			mywindow.document.close(); // necessary for IE >= 10

			mywindow.focus(); // necessary for IE >= 10*/

		

			mywindow.print();

			mywindow.close();

		

			return true;

		}

        </script>



</body>

</html>