<?php

error_reporting(0);


include 'includes/functions.php';

date_default_timezone_set("Asia/Kolkata");



$currdate=date('Y-m-d H:i:s');



//@extract($_REQUEST);



if(isset($_GET['mode'])){



	if($_GET['mode']=='COD'){



		$mode1='0';	



	}else if($_GET['mode']=='Paied'){



		 $mode1='1';	



	}else{



		$mode1='';



	}



}else{



	$mode1='';



}







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



<style>



/*body{width:600px;font-family:"Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif;font-size:14px;}*/



.link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}



.disabled {cursor:not-allowed;color: #bccfd8;}



.current {background: #bccfd8;}



.first{border-left:#bccfd8 1px solid;}



.question {font-weight:bold;}



.answer{padding-top: 10px;}



#pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}



.dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}



#overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}



#overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}



.page-content {padding: 20px;margin: 0 auto;}



.pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}



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



      <h1><?php echo $_GET['mode']; ?> Order Report</h1>



      <ol class="breadcrumb">



        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>



        <li><a href="#">Order Report</a></li>



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



           <div id="overlay"><div><img src="../loading.gif" width="64px" height="64px"/></div></div>



                <div class="page-content">



                    <div id="pagination-result">



                        <input type="hidden" name="rowcount" id="rowcount" />



                        <!-- list is here -->

                        

                        <table class="table">

                         <thead>

                          <tr>

                          <th>Order Id</th>

                           <th>Name</th>

                           <th>Address</th>

                           <th>Order Status</th>

                           <th>Payment Type</th>

                           <th>Total Price</th>

						   <th>Action</th>

                           <th>Pharmacist</th>

                           <th>Assigned To</th>

                           

                          </tr>

                         </thead>

                         <tbody>

                        <?php 

                        $query=mysql_query("select * from order_confirm JOIN order_address on order_address.order_confirm_id = order_confirm.id order by order_confirm_id DESC");

                        while($result=mysql_fetch_assoc($query)){ 

                        $assign=$result["order_confirm_id"];

                        ?>

                        <tr><td><?php echo $result["order_confirm_id"]; ?></td>

                        <?php

                        // echo "<td>".$result["fname"]." ".$result["lname"]."</td>";

                        // echo "<td>".$result["address"]."</td>";

                      

                        // echo "<td>".$result["order_status"]."</td>";

                        // echo "<td>".$result["PaymentType"]."</td>";

                     // echo "<td>".$result["grand_total"]."</td><td><a href='order_details.php?order_id=<?php echo $result['order_confirm_id'];?>' class='button_grey'>View Orders</a></td><td><form method='POST' action=''><select class='form-control' name='pharma'><option value=''>Select Pharmacist</option>";

                     //    $pharma=mysql_query("select * from user where role='pharmacist' ");

                     //    $selcted="";

                     //    while($select=mysql_fetch_array($pharma)){

                     //      if( $result['assignedto']==$select['id']){

                     //        $selcted="selected=selected";

                     //      }else{

                     //        $selcted="";

                     //      }

                          ?>

                        

                        <option value='<?php echo $select["id"]; ?>' <?php  echo $selcted; ?>  name='<?php echo $select["id"]; ?>' ><?php echo $select["fname"]." ".$select["lname"];?></option>

                        

                        <?php }

                        // echo "</select></td>";

                        // echo "<input type='hidden' name='user' value='$result[order_confirm_id]'>";

                        // echo "<td><button class='btn btn-primary' type='submit' name='Assigned'>Assigned To</button></form></td>";

                        // echo "</tr>";

                        // }

                        ?>

                        </tbody>

                        </table>

                        <?php

        //                 $selectid=$_POST["pharma"];

        //                 $assign=$_POST["user"];

        //                 if(isset($_POST['Assigned'])){

        //                   $updt=mysql_query("UPDATE order_confirm SET assignedto = $selectid where id=$assign ");

						  // $assign_history=mysql_query("INSERT into assign_history (order_id, user_id, date) VALUES("$assign", "$selectid", now())");

						  // header("location://medkart.web-tycoons.com/admin/orders_list.php");

        //                 } 

                        ?>

                    </div>



                </div>



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



<script src="js/AdminLTE/app.js" type="text/javascript"></script> 







<script>



function getresult(url) {



	var mode='<?php echo $mode1; ?>';



	$.ajax({



		url: url,



		type: "GET",



		data:  {rowcount:$("#rowcount").val(),"pagination_setting":'all-links',"mode":mode},



		beforeSend: function(){$("#overlay").show();},



		success: function(data){



		$("#pagination-result").html(data);



		



		//setInterval(function() {$("#overlay").hide(); },5000);



		}, complete: function (data) {



		 $("#overlay").hide();



		 },



		error: function() 



		{} 	        



   });



}



</script>



<script>



getresult("ajax/orders_list_getresult.php");



</script>



</body>



</html>