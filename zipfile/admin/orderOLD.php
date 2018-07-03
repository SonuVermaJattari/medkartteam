<?php



include '../inc/functions.php';







date_default_timezone_set("Asia/Kolkata");



$currdate=date('Y-m-d H:i:s');



//define('MAX_REC_PER_PAGE', 15);



$msg="";







@extract($_REQUEST);



if(isset($_POST['status_submit'])){

			$mail_email=$_GET['email'];

			$order_id=$_GET['order_id'];

			$order_status=$_POST['order_status'];

			$email_notify=$_POST['email_notify'];

			//print_r($_POST);

			//	$table=$this->CodOrderMailTable($products_array,$post_val);

		//$mailSend=$this->CodOrderMail($email,'Order Placed ',$table);

		/*$poss=mysql_query("UPDATE `delivery_info` SET `delivery_status`='$what' WHERE order_id='$ord_id' ");

		$maili_info=mysql_query("Select * from register where Email='$mail_email'");

		$mail_info=mysql_fetch_assoc($maili_info);

		$m_firstname=$mail_info['FName'];

		$m_lastname=$mail_info['LName'];

		$name=$m_firstname."&nbsp;".$m_lastname;

		$cour="";*/

			if($poss){	

				$su=0;

				if($what=="Pending") {

						$pend=mysql_query("UPDATE `status_date` SET `Order_pending`=NOW() WHERE Order_Id='$ord_id' ");

						mysql_query($pend);

						$su=1;

						$mailer="	<table style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6' width='100%' cellpadding='0' cellspacing='0'>

								<tbody><tr>

									<td style='color:#000;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f3f3f3;padding:20px' valign='top' align='left' bgcolor='#f3f3f3'>

											<p style='padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px'> Hi $name,  </p><br>

											<p style='padding:0;margin:0;color:#000;line-height:22px;font-size:13px'>Your order[$ord_id] is currently in process.</p><br>			

									</td>

								</tr>

							</tbody></table>";

							$next="<table width='100%' cellpadding='0' cellspacing='0'></table>";

					}

				if($what=="Placed") {

						$pla=mysql_query("UPDATE `status_date` SET `Order_placed`=NOW() WHERE Order_Id='$ord_id' ");

						mysql_query($pla);



						$su=1;



						$mailer="	<table style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6' width='100%' cellpadding='0' cellspacing='0'>



								<tbody><tr>



									<td style='color:#000;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f3f3f3;padding:20px' valign='top' align='left' bgcolor='#f3f3f3'>



											<p style='padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px'> Hi $name,  </p><br>



										  



											<p style='padding:0;margin:0;color:#000;line-height:22px;font-size:13px'>



												Your order[$ord_id] is sucessfully Placed.



												



											</p><br>



											



									</td>



								</tr>



							</tbody></table>";



							$next="<table width='100%' cellpadding='0' cellspacing='0'>



											</table>";



					}

				if($what=="Shipped") {



						$shi=mysql_query("UPDATE `status_date` SET `Order_Shipped`=NOW() WHERE Order_Id='$ord_id' ");



						mysql_query($shi);



						$seti=mysql_query("select * from delivery_info where order_id='$ord_id'");



						$deti=mysql_fetch_assoc($seti);



						if($deti['courier_co']!=='' && $deti['awp_no']!=='')



						{



							$cour="Your is shipped by ".$deti['courier_co']." company and your AWP number is ".$deti['awp_no'].".";



						}



						$su=1;



						$mailer="	<table style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6' width='100%' cellpadding='0' cellspacing='0'>



								<tbody><tr>



									<td style='color:#000;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f3f3f3;padding:20px' valign='top' align='left' bgcolor='#f3f3f3'>



											<p style='padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px'> Hi $name,  </p><br>



										  



											<p style='padding:0;margin:0;color:#000;line-height:22px;font-size:13px'>



												Your order[$ord_id] is Shipped.



												



											</p><br>



											 <p style='padding:0;margin:0;color:#000;line-height:22px;font-size:13px'>



											   $cour



												



											</p><br>



									</td>



								</tr>



							</tbody></table>";



							$next="<table width='100%' cellpadding='0' cellspacing='0'>



											<tbody><tr>



												<td style='padding:0 10px 15px 20px;margin:0;border-right:dashed 1px #b3b3b3' valign='top' align='left'>



																					<h3 style='padding:0;margin:0;color:#fff;line-height:20px'>



														You will receive another email once your is shipped.



													</h3>



												</td>



										   </tr>



										</tbody></table>";



					}

				if($what=="Delivered") {



						$de=mysql_query("UPDATE `status_date` SET `Order_Delivered`=NOW() WHERE Order_Id='$ord_id' ");



						mysql_query($de);



						$su=1;



						$mailer="	<table style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6' width='100%' cellpadding='0' cellspacing='0'>



								<tbody><tr>



									<td style='color:#000;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f3f3f3;padding:20px' valign='top' align='left' bgcolor='#f3f3f3'>



											<p style='padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px'> Hi $name,  </p><br>



										  



						<h3 style='padding:0;margin:0;color:#000;line-height:22px;'>



												Your order[$ord_id] is successfully Delivered.



												



											</h3><br>



											 <p style='padding:0;margin:0;color:#fff;line-height:22px;font-size:13px'>



											   $cour



												



											</p><br>



									</td>



								</tr>



							</tbody></table>";



							$next="<table width='100%' cellpadding='0' cellspacing='0'>



											<tbody><tr>



												<td style='padding:0 10px 15px 20px;margin:0;border-right:dashed 1px #b3b3b3' valign='top' align='left'>



													



			<h2 style='padding:0;margin:0; color:#fff;line-height:20px; decoration:none;'>



					Thank you for shopping at www.flyingcakes.in 



													</h2>



												</td>



										   </tr>



										</tbody></table>";



					}

				if($what=="Cancel"){



						$can=mysql_query("UPDATE `status_date` SET `Order_Cancel`=NOW() WHERE Order_Id='$ord_id' ");



						mysql_query($can);



						$su=1;



					}

				if($what=="Return") {  



						$ret=mysql_query("UPDATE `status_date` SET `order_return`=NOW() WHERE Order_Id='$ord_id' ");



						mysql_query($ret);



						$su=1;



					}

				if($su==1 && $choco==1){



						$to=$mail_email;



						//$order=$rs['Order_Id'];



						$subject="flying Cakes order[$ord_id] is $what";







						$body="<div style='width:100%;min-height:100%;margin:10px auto;padding:0;background-color:#ffffff;font-family:Arial,Tahoma,Verdana,sans-serif;font-weight:299px;font-size:13px;text-align:center;' bgcolor='#C3CCD5' align='center'>



							   <div style='margin:0px auto; width:600px; border:1px solid #EBEBEB;'>



	



							  <table style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6' width='100%' cellpadding='0' cellspacing='0'>



								<tbody>



									<tr>



										<td style='width:10px;background:linear-gradient(to bottom,#fff 0%,#fff 89%);background-color:#fff' width='10' bgcolor='#00436d'>&nbsp;</td>



										<td style='background:linear-gradient(to bottom,#fff 0%,#fff 89%);background-color:#fff;padding:0;margin:0' height='60' valign='middle' align='left' bgcolor='#00436d'> <a style='text-decoration:none;outline:none;color:#ffffff;font-size:13px' href='http://www.flyingcakes.in/' target='_blank'>







										<img class='CToWUd' src='http://www.flyingcakes.in/img/logo1.png' alt='Flying Cakes' style='border:none' height='50' border='0'></a></td>







										



										



									</tr>



								</tbody>



							 </table>



					



							



									</td>



									



								</tr>



							</tbody></table>



					



						 



						$mailer



							



					



									</td>



								</tr>



								<tr>



									<td style='background-color:#ffffff;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;padding:0 20px 20px 20px' valign='top' align='left' bgcolor='#ffffff'>



											<p style='margin:0px;padding:0px;line-height:20px;font-size:13px;color:#565656'>FLYING CAKES established in 1st of September 2006 a brain child of Mr. Sunil Vashisht (Founder) and co-founder Mr. Ajay Diwedi.We also have an expertise in delivering photos, ornamental, cartoon, cutout and wedding cakes with no additional delivery charges. </p>



									</td>



								</tr>



								</tbody>



							</table>



					



							<table style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6' width='100%' cellpadding='0' cellspacing='0'>



								<tbody>



								 <tr>



									<td style='border-top:#e6e6e6 solid 1px;border-bottom:#e6e6e6 solid 1px;background-color:#4bb033;display:block;margin:0 auto;clear:both;padding:10px 20px' valign='top' align='center' bgcolor=''>



															   <img class='CToWUd' src='http://www.flyingcakes.in/img/logo1.png' style='min-height:auto;background-color:#f6f2e9;border:none;color:#565656;font-size:9px;width:100%' width='100%' border='0'>



														</td>



								 </tr>



								</tbody>



							</table>



					



					   



							<table style='max-width:600px;border-left:solid 1px #4bb033;border-right:solid 1px #4bb033' width='100%' cellpadding='0' cellspacing='0'>



								<tbody><tr>



									<td style='background-color:#4bb033' valign='top' width='300' align='center'>



										<br>



											$next



										



									</td>



									



								</tr>



							</tbody></table>



					



					



							<table style='max-width:600px;border:solid 1px #4bb033;border-top:none' width='100%' cellpadding='0' cellspacing='0'>



								<tbody>



								 <tr>



									<td style='text-align:center;background-color:#4bb033;display:block;margin:0 auto;clear:both;padding:15px 40px' valign='top' align='center' bgcolor='#4bb033'>



										<p style='padding:0;margin:0 0 7px 0'>



													<a title='flyingcakes.in' style='text-decoration:none;color:#fff' href='http://www.flyingcakes.in/' target='_blank'><span style='color:#fff;font-size:13px'>www.flyingcakes.in</span></a>



										</p>



										<p style='padding:10px 0 0 0;margin:0;border-top:solid 1px #cccccc;font-size:11px;color:#fff'>



										   E-mail: <a href='mailto:sapna2007vashisht@gmail.com' alt='E-mail' style='text-decoration:none; color:#ffffff;'>sapna2007vashisht@gmail.com</a> &nbsp;| Call us:  (+91)9999851306







&nbsp;



									</td>



								 </tr>



								</tbody>



							</table>



					</div>



							



						</div>";



						



						



						$headers = 'From: flyingcakes.in  '."  support@flyingcakes.in" . "\r\n" .



									'Reply-To: '."support@flyingcakes.in" . "\r\n" ;



						$headers .='MIME-Version: 1.0' . "\r\n"; //Please uncomment when sending email with html tags



						$headers .='Content-type: text/html; charset=iso-8859-1' . "\r\n";



							



							



						$sent=mail($to,$subject,$body,$headers);



					}

			}



			



		



	}



if(isset($_GET['order_id'])!='')



	{



		$order_id=$_GET['order_id'];



	 	$order_confirm_id=(int)(str_replace("TD-","",$_GET['order_id']));



		$order_confirm=$DB->fectchRecord("SELECT *,DATE_FORMAT(order_date, '%M %d %Y') as order_date FROM `order_confirm` where id='$order_confirm_id'");



		$user_info=$DB->fectchRecord("SELECT CONCAT(fix,prefix,post)as user_uid,CONCAT_ws(' ',title,fname,lname) as name,email,phone,title,address_id,id FROM `user` where id='".$order_confirm['user_id']."'");



		$BillingAddress=$DB->fectchRecord("SELECT CONCAT_ws(' ',title,fname,lname) as name,CONCAT(address,' ',street,'<br>',state,', ',city,'-',pincode) as address,phone FROM `address` where id='".$user_info['address_id']."' AND u_id='".$user_info['id']."'");



		$ShippingAddress=$DB->fectchRecord("SELECT CONCAT_ws(' ',title,fname,lname) as name,CONCAT(address,' ',street,'<br>',state,', ',city,'-',pincode) as address,phone FROM `order_address` where order_confirm_id='".$order_confirm['id']."'");



		$table=$DB->OrderDetails($order_confirm['id'],$order_confirm['shippingcharges']);



	}



	else



	{



		$msg="Sorry something is wrong somewhere";



	}







?>







<!DOCTYPE html>



<html>



<head>



<title><?php echo $DB->projectname(); ?></title>



<meta charset="UTF-8">



<meta http-equiv="Content-Script-Type" content="text/javascript">



<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>



<!-- bootstrap 3.0.2 -->



<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />



<!-- font Awesome -->



<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />



<!-- Ionicons -->



<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />



<!-- DATA TABLES -->



<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />



<!-- Theme style -->



<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>



<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>



<link type="text/css" rel="stylesheet" href="css/mystyle.css" />



<link href="new-page-order/order-1.css" rel="stylesheet" type="text/css">



<style>



.oderAdmin{



   display: none;}



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



      <h1> Order Details</h1>



      <ol class="breadcrumb">



        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>



        <li><a href="#">Order Management</a></li>



        <li class="active">Data tables</li>



      </ol>



    </section>



    



    <!-- Main content -->



    <section class="content">



      <div class="row">



        <div class="col-xs-12">



          <div class="box">



            <div class="box-header"> 



              <!--<h3 class="box-title">Data Table With Full Features</h3>--> 



            </div>



            <!-- /.box-header -->



            



            <div class="main-col" id="content">



              <div class="main-col-inner">



                <div id="messages"></div>



                <div class="content-header">



                  <h3 class="icon-head head-sales-order">Order # <?php echo $order_id; ?> | <?php echo $order_confirm['order_date']; ?></h3>



                  <p class="form-buttons"> <a href="delivery_status.php">



                    <button title="Back" type="button" class="scalable back"><span><span><span>Back</span></span></span></button>



                    </a> <a href="invoice.php?order_id=<?php echo $order_id; ?> "target="_blank">



                    <button title="Invoice" type="button" class="scalable go"><span><span><span>Invoice</span></span></span></button>



                    </a> 



                </div>



                <div class="entry-edit" id="sales_order_view">



                  <div id="sales_order_view_tabs_order_info_content" style="">



                    <div>



                      <div id="order-messages"> </div>



                      <div class="box-left"> 



                        <!--Order Information-->



                        <div class="entry-edit">



                          <div class="entry-edit-head">



                            <h4 class="icon-head head-account">Order # <?php echo $order_id; ?> </h4>



                          </div>



                          <div class="fieldset">



                            <table class="form-list" cellspacing="0">



                              <tbody>



                                <tr>



                                  <td class="label"><label>Order Date</label></td>



                                  <td class="value"><strong><?php echo $order_confirm['order_date']; ?></strong></td>



                                </tr>



                                <tr>



                                  <td class="label"><label>Order Status</label></td>



                                 <?php 

								 if($order_confirm['order_status']==1){

										$order_confirm['order_statusMSG']='Pending';

									}

									else if($order_confirm['order_status']==-1){

										$order_confirm['order_statusMSG']='order is cancelled. ('.$order_confirm["reason"].' )';

										

									}

									

								 ?>



                                  <td> <div class="value"><strong><span id="order_status"><?php echo $order_confirm['order_statusMSG']; ?></span></strong></div></td>



                                </tr>



                              </tbody>



                            </table>



                          </div>



                        </div>



                      </div>



                      <div class="box-right"> 



                        <!--Account Information-->



                        <div class="entry-edit">



                          <div class="entry-edit-head">



                            <h4 class="icon-head head-account">Account Information: </h4>



                            <div class="tools"><strong ><?php echo $user_info['user_uid']; ?></strong></div>



                          </div>



                          <div class="fieldset">



                            <div class="hor-scroll">



                              <table class="form-list" cellspacing="0">



                                <tbody>



                                  <tr>



                                    <td class="label"><label>Customer Name</label></td>



                                    <td class="value"><a href="javascript:void(0);"><strong><?php echo $user_info['name']; ?></strong></a></td>



                                  </tr>



                                  <tr>



                                    <td class="label"><label>Email</label></td>



                                    <td class="value"><a href="mailto:<?php echo $user_info['email'];?>"><strong><?php echo $user_info['email'];?></strong></a></td>



                                  </tr>



                                  <tr>



                                    <td class="label"><label>Phone</label></td>



                                    <td class="value"><a href="phone:<?php echo $user_info['phone'];?>"><strong><?php echo $user_info['phone'];?></strong></a></td>



                                  </tr>



                                  <tr>



                                    <td class="label"><label>Gender</label></td>



                                    <td class="value"><strong>



                                      <?php if($user_info['title']=="Mr."){ echo "Male";}else{ echo "Female".$r_title; }?>



                                      </strong></td>



                                  </tr>



                                </tbody>



                              </table>



                            </div>



                          </div>



                        </div>



                      </div>



                      <div class="clear"></div>



                      <div class="box-left"> 



                        <!--Billing Address-->



                        <div class="entry-edit">



                          <div class="entry-edit-head">



                            <h4 class="icon-head head-billing-address">Billing Address</h4>



                            <div class="tools"></div>



                          </div>



                          <fieldset>



                            <address>



                            <?php echo $BillingAddress['name']; ?><br>



                            <?php echo $BillingAddress['address']; ?><br>



                            Contact: <?php echo $BillingAddress['phone'];?>



                            </address>



                          </fieldset>



                        </div>



                      </div>



                      <div class="box-right"> 



                        <!--Shipping Address-->



                        <div class="entry-edit">



                          <div class="entry-edit-head">



                            <h4 class="icon-head head-shipping-address">Shipping Address</h4>



                            <div class="tools"><a href="edit_address.php">Edit</a></div>



                          </div>



                          <fieldset>



                           <address>



                            <?php echo $ShippingAddress['name']; ?><br>



                            <?php echo $ShippingAddress['address']; ?><br>



                            Contact: <?php echo $ShippingAddress['phone'];?>



                            </address>



                          </fieldset>



                        </div>



                      </div>



                      <div class="clear"></div>



                      <input name="order_id" value="190" type="hidden">



                      <div class="box-left"> 



                        <!--Payment Method-->



                        <div class="entry-edit">



                          <div class="entry-edit-head">



                            <h4 class="icon-head head-payment-method">Payment Information(Prepaid / Cash On Delivery)</h4>



                          </div>



                          <fieldset>



                            <h1><?php echo $order_confirm["pay"]==0?'Cash On Delivery':'Online paied'; ?></h1>



                          </fieldset>



                        </div>



                      </div>



                      <!--<div class="box-right"> 



                        <div class="entry-edit">



                          <div class="entry-edit-head">



                            <h4 class="icon-head head-shipping-method">Shipping &amp; Handling Information</h4>



                            <div class="tools"><a href="edit_address.php">Edit</a></div>



                          </div>



                          <fieldset>



                            <strong>Send by <?php echo $deliv_awp_no ;?></strong><br />



                            <strong>Track id <?php echo $deliv_courier;?></strong><br />



                            <span class="price">&nbsp;Rs. <?php echo $shipping_charge; ?> </span>



                          </fieldset>



                        </div>



                      </div>-->



                      <div class="clear"></div>



                      <div class="clear"></div>



                      <div class="entry-edit">



                        <div class="entry-edit-head">



                          <h4 class="icon-head head-products">Items Ordered</h4>



                        </div>



                      </div>



                      <div class="grid np">



                        <div class="hor-scroll">



                         <div class="clear"></div> <div class="clear"></div>



                          <?php echo $table; ?>



                        </div>



                      </div>



                      <br>



                      <div class="clear"></div>



                      



                      <div class="box-right entry-edit">



                        <div class="entry-edit-head">



                          <h4>Order status Update</h4>



                        </div>



                         <form id="status_change" name="status_change" method="post" enctype="multipart/form-data" action="order.php?order_id=<?php echo $order_id;?>&email=<?php echo $user_info['email'];?>">



                        <fieldset>



                              <div id="order_history_block">



                                <div id="history_form" class="order-history-form">



                                  <div>Update Status</div>



                                  <span class="field-row">



                                  <label class="normal" for="history_status">Status</label>



                                  <br>



                                  <select name="order_status"  id="history_status">



                                    <option value="1" <?php echo $order_confirm['order_status']=='1'?'Selected':$order_confirm['order_status'] ?>>Pending</option>



                                     <option value="2" <?php echo $order_confirm['order_status']=='2'?'Selected':$order_confirm['order_status'] ?>>Placed</option>



                                     <option value="3" <?php echo $order_confirm['order_status']=='3'?'Selected':$order_confirm['order_status'] ?>>Packed</option>



                                     <option value="4" <?php echo $order_confirm['order_status']=='4'?'Selected':$order_confirm['order_status'] ?>>Shipped</option>



                                      <option value="5" <?php echo $order_confirm['order_status']=='5'?'Selected':$order_confirm['order_status'] ?>>Delivered</option>



                                     <option value="-1" <?php echo $order_confirm['order_status']=='-1'?'Selected':$order_confirm['order_status'] ?>>Cancelled</option>



                                     <option value="7" <?php echo $order_confirm['order_status']=='7'?'Selected':$order_confirm['order_status'] ?>>Returned</option>



                                  </select>



                                  </span><br>



                                  <div class="f-left">



                                    <input name="email_notify" id="history_notify" value="1" type="checkbox">



                                    <label class="normal" for="history_notify"> Notify Customer by Email</label>



                                    <br>



                                  </div>



                                  <div class="f-right" style="float:right;">



                                    <button  title="Submit Comment" type="submit" name="status_submit" class="scalable save"><span><span><span>Submit Status</span></span></span></button>



                                  </div>



                                  <div class="clear"></div>



                                </div>



                                <div class="divider"></div>



                              </div>



                            </fieldset>



                            </form>



                      </div>



                      <div class="clear"></div>



                    </div>



                  </div>



                </div>



              </div>



            </div>



            



            <!-- /.box-body --> 



          </div>



          <!-- /.box --> 



        </div>



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



<!-- DATA TABES SCRIPT --> 



<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> 



<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> 



<!-- AdminLTE App --> 



<script src="js/AdminLTE/app.js" type="text/javascript"></script> 



<!-- AdminLTE for demo purposes --> 



<!-- page script --> 



<script type="text/javascript">



            $(function() {



                $("#example1").dataTable();



                $('#example2').dataTable({



                    "bPaginate": true,



                    "bLengthChange": false,



                    "bFilter": false,



                    "bSort": true,



                    "bInfo": true,



                    "bAutoWidth": false



                });



            });



        </script>



</body>



</html>