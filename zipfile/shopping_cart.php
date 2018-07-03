<?php  session_start();
ob_start();
error_reporting(0);
$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
include_once 'inc/functions.php'; 
if(isset($_SESSION['pemail'])){

	echo "<script>window.location='index.php';</script>";

}
if(isset($_SESSION['email'])){
	$username=$_SESSION['email'];
}else{

	$username=$_SESSION['SessID'];
}

if((isset($_POST['Delete'])) && $_POST['Delete']!="")
{

	list($Delete,$price_id,$products_added_id)=explode(',',$_POST['Delete']);



	$Delete=(int)$Delete;



	$price_id=(int)$price_id;



	$products_added_id=(int)$products_added_id;



	mysql_query("delete from products_added where product_id='".$Delete."' AND username='".$username."' AND id='".$products_added_id."' AND price_id='".$price_id."'");



}



if(isset($_POST['update']) && $_POST['update']=='Update Cart'){



	$ProductId=$_POST['ProductId'];



	for($i=0;$i<count($ProductId);$i++){



		$quantity=$_POST['quantity'];



		if($quantity[$i]<=0){



			$quantity[$i]=1;



		}



		//echo "update products_added set product_qty='".$quantity[$i]."' where product_id='".$ProductId[$i]."' AND username='".$username."'<br>";



		//$amount=(($RUPEES[$i])*($quantity[$i]));



		/*$t_amount=($amount+($amount*($TAX[$i]/100)));*/



		//$t_amount=(($RUPEES[$i])*($quantity[$i]));



	/*	mysql_query("update products_added set quantity='".$quantity[$i]."', amount='".($RUPEES[$i])*($quantity[$i])."' , t_amount='$t_amount' where id='".$ProductId[$i]."'");*/



	



		mysql_query("update products_added set product_qty='".$quantity[$i]."' where product_id='".$ProductId[$i]."' AND username='".$username."'");



	}



}



?>



<!doctype html>



<html lang="en">



        <head>



        <!-- Basic page needs



		============================================ -->



        <title>The Dawakhana | Shopping Cart</title>



        <meta charset="utf-8">



        <meta name="author" content="">



        <meta name="description" content="">



        <meta name="keywords" content="">







        <!-- Mobile specific metas



		============================================ -->



        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">







        <!-- Google web fonts



		============================================ -->



        <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>







        <!-- Libs CSS



		============================================ -->



        <link rel="stylesheet" href="css/animate.css">



        <link rel="stylesheet" href="css/fontello.css">



        <link rel="stylesheet" href="css/bootstrap.min.css">







        <!-- Theme CSS



		============================================ -->



        <link rel="stylesheet" href="js/arcticmodal/jquery.arcticmodal.css">



        <link rel="stylesheet" href="js/owlcarousel/owl.carousel.css">



        <link rel="stylesheet" href="js/colorpicker/colorpicker.css">



        <link rel="stylesheet" href="css/style.css">







        <!-- JS Libs



		============================================ -->



        <script src="js/modernizr.js"></script>



        <script src="js/jquery-2.1.1.min.js"></script>



        <script src="js/queryloader2.min.js"></script>



        <script>







			$(document).ready(function(){







				$("body").queryLoader2({



	    			barHeight : 4,



	    			backgroundColor : '#fff',



	    			barColor : '#018bc8',



	    			minimumTime : 2000,



	    			onComplete : function(){







						// show promo popup



	    				if($.arcticmodal && $('body').hasClass('promo_popup')){



							$.arcticmodal({



								url : "modals/promo.html"



							});



						}







	    			}



	    		});







			});







		</script>







        <!-- Old IE stylesheet



		============================================ -->



        <!--[if lte IE 9]>



			<link rel="stylesheet" type="text/css" href="css/oldie.css">



		<![endif]-->



<style>
.total,  .subtotal {
	font-size: 12px;
	font-weight: 600;
}
table th, table td {
padding:9px !important;
}
.cart-table td, .cart-table th { border-width:0px;}
.cart-table th { background-color:#8a1617; color:#fff;}
</style>



        </head>



        <body>







<!-- - - - - - - - - - - - - - Styleswitcher - - - - - - - - - - - - - - - - --> 







<!-- - - - - - - - - - - - - - end Styleswitcher - - - - - - - - - - - - - - - - --> 







<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->







<div class="wide_layout"> 



          



          <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->



          



          <?php include'inc/header.php' ;?>



          



          <!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - --> 



          



          <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->



          



          <div class="secondary_page_wrapper">



    <div class="container"> 



              



              <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->



              



              <section class="section_offset">



        <h4>My Cart</h4>



        <h5 style="    color: red;">



        <?php 



		if(isset($_SESSION['prescription_error'])){



			echo $_SESSION['prescription_error'];



			unset($_SESSION['prescription_error']);



			} ?>



            </h5>



        <!-- - - - - - - - - - - - - - Shopping cart table - - - - - - - - - - - - - - - - -->



        <div class="row">



                  <div class="col-md-12">



            <div class="table_wrap">



                      <table class="cart-table">



                <thead>



                  <tr>



                    <th width="20%">Item Name</th>



                    <th>Manufacturer</th>



                    <th>Packaging</th>



                    <th class="align_center">Price</th>



                    <th>Quantity</th>



                    <th class="align_center">Subtotal</th>



                    <th class="align_center"></th>



                  </tr>



                </thead>



                <form action="" method="post" enctype="multipart/form-data">



                  <tbody>



                <?php



					$ctr=0;



					$sql="select * from products_added where username='".$username."' order by id desc";



					$res=mysql_query($sql);



					$count=mysql_num_rows($res);



					if($count>0){



						$sumRs=0;



						$p=1;



					while($rs=mysql_fetch_assoc($res)){



						$product_id=$rs['product_id'];

						
						
						$product_qty=$rs['product_qty'];



						$price_id=$rs['price_id'];



						$sqlproducts="SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name,p.prescription,p.dis_products FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id  where p.id='".$product_id."'  ";



						$resProducts=$DB->runQuery($sqlproducts);



						$resProducts=$resProducts[0];



						$sqlprice="SELECT * FROM `price`  where id='".$price_id."'";



						$resprice=$DB->runQuery($sqlprice);



						$resprice=$resprice[0];



						



				?>



                <tr class="cart-pro"> 



                    <td data-title="Product Name"><p><a href="<?php echo $resProducts['menu']=='1'?'product_details-medicine.php?q='.$resProducts['id']:'product_details.php?q='.$resProducts['id']; ?>"><?php echo $resProducts['name']; ?></a><br>



					<?php



					if($resProducts['prescription']=='1'){



						 echo '<img src="images/prescr-icon.png" style="width: 15px;">Prescription Required<br>';



						 echo 'Select Prescription<br>'; 



						 if(isset($_SESSION['email'])){



					?>



                    



                            <select class="searchskill" id="select_prescription_Id<?php echo $p; ?>" onChange="SelectPrescription(`<?php echo $rs['id']; ?>`,this.value,`<?php echo $p; ?>`)" >



                            <option value="">Select Prescription</option>



                            <?php 



                            $upload_prescriptionmqry="SELECT id,name,DATE_FORMAT(upload_date, '%M %d %Y') as upload_date FROM `upload_prescription` where status='1' AND email='$username' order by upload_date ";



                            $upload_prescriptionfetch=mysql_query($upload_prescriptionmqry);



                            while($upload_prescriptionweb=mysql_fetch_assoc($upload_prescriptionfetch)) {  ?>



                                <option value="<?php echo $upload_prescriptionweb['id']; ?>" <?php echo $upload_prescriptionweb['id']==$rs['prescription_id']?'selected':''; ?> >



									<?php echo $upload_prescriptionweb['name']; ?> <?php echo $upload_prescriptionweb['upload_date']; ?>



                                </option>



                            <?php } ?>



                             <option value="new">New Prescription</option>

								 <option value="whatsapp" <?php echo $rs['prescription_id']=='whatsapp'?'selected':''; ?> >whatsapp</option>

                            </select>



                            



                    <?php



						$p++;



						}else{



							echo 'Upload Prescription login';	 



						} 



					}



					?>



                    



                    </p></td>



                    <td><p><?php echo $resProducts['c_name']; ?></p></td>



                    <td><p><?php echo $resprice['p_b1'].' '.$resProducts['p_b1name']; ?></p></td>



                    <td class="subtota align_center"><p><i class="icon-rupee"></i><?php echo $resprice['price']; ?></p></td>



                    <td data-title="Quantity">



                    <?php //echo $resProducts['p_bname']; ?> 



                     <input type="hidden" name="ProductId[]" value="<?php echo $resProducts['id']; ?>">



                    <div class="qty min clearfix">



                        <button type="button" class="theme_button" data-direction="minus">&#45;</button>



                       	<input type="text" name="quantity[]" value="<?php echo $product_qty; ?>">



                        <button type="button" class="theme_button" data-direction="plus">&#43;</button>



                      </div>



                    </td>



                    



                    <?php $sumRs=$sumRs+($product_qty*$resprice['price']); ?>



                    <td class="subtota align_center"><p><i class="icon-rupee"></i><?php echo $product_qty*$resprice['price']; ?></p></td>



                    <td style="text-align:center;"><button  type="submit" name="Delete" value="<?php echo $resProducts['id'].','.$resprice['id'].','.$rs['id']; ?>" class="cart-bttn">X</button> </td>



                </tr>



                <?php   }
				
				 }else{ ?>



			<tr>



			   <td class="text-center"colspan="5"><h4>There are no items in your Basket...</h4></td>



			</tr>











				<?php	} ?>



                <?php if($count>0){ ?>



              <tr>



              <td colspan="7"> 



              <div class="pull-left"><button type="submit" name="update" value="Update Cart" class="cart-bttn">Update Shopping Cart</button> &nbsp; &nbsp;<a href="javascript:void(0);" class="cart-bttn" onClick="deleteOne('<?php echo $username; ?>');">Empty Cart</a>



                </div></td>



              </tr>



			<?php } ?>



                </tbody>
					
                


                </form>



              </table>



                    </div>

			

            <!--/ .table_wrap --> 



            



            <!--/ .bottom_box --></div>

     <?php if($count>0){ ?>
<div class="col-md-9"><a href="index.php" class="button_blue middle_btn">Continue Shopping</a></div>
                  <section class="col-md-3">



            <div class="theme_box">



                      <p class="form_caption">Enter your coupon code if you have one.</p>
                      <form id="discount_code">



                <ul>



                          <li class="row">



                    <div class="col-xs-12">



                              <div style="position:relative">



                        <input type="text" name="">



                        <button type="submit" form="discount_code" class="button_grey" style="position:absolute; right:0; padding: 8px;">Apply</button>



                      </div>



                            </div>



                  </li>



                        </ul>



              </form>



                    </div>



            <!--/ .theme_box -->



            



            <div class="table_wrap">



                      <table class="">



                <tfoot>



                          <tr class="subtotal">



                    <td>Subtotal</td>



                    <td><i class="icon-rupee"></i><?php echo $sumRs; ?></td>



                  </tr>



                         <!-- <tr class="subtotal">



                    <td>Shipping Charge</td>



                    <td><i class="icon-rupee"></i>50</td>



                  </tr>-->



                          <tr class="subtotal">



                    <td>Delivery</td>



                    <td><!-- <i class="icon-rupee"></i>5.78 --> --</td>



                  </tr>



                          <tr class="total">



                    <td><h3>Total</h3></td>



                    <td><h3><i class="icon-rupee"></i><?php echo $sumRs; ?></h3></td>
</tr>



                        </tfoot>



              </table>



                    </div>
            <footer class="bottom_box align_center"><form name="checkout" action="checkout.php" method="post" onSubmit="return checkPrescription()"><button type="submit" id="ProceedtoCheckoutId" class="button_blue middle_btn" title="Proceed to Checkout">Proceed to Checkout</button></form>
            <p>** Actual delivery charges computed at Checkout time</p>
            </footer>
          </section>

<?php } ?>

                </div>



        <!-- - - - - - - - - - - - - - End of shopping cart table - - - - - - - - - - - - - - - - --> 



        



      </section>



              <!--/ .section_offset --> 



              



            </div>



    <!--/ .container--> 



    



  </div>



          <!--/ .page_wrapper--> 



          



          <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - --> 



          



          <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->



          



          <?php include'inc/footer.php' ;?>



          



          <!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - --> 



          



        </div>



<!--/ [layout]--> 







<!-- Include Libs & Plugins



		============================================ --> 



<script src="js/jquery.appear.js"></script> 



<script src="js/owlcarousel/owl.carousel.min.js"></script> 



<script src="js/theme.plugins.js"></script> 



<script src="js/theme.core.js"></script>



	<script>



	function deleteOne(delId)



	{	



		if(confirm("Are you sure you want to remove all items from your cart!!") == true)



		{



			window.location="delete.php?delId=" + delId;



		}	



	}



	function SelectPrescription(pId,upId,select_prescription_Id){



		



		 $("#ProceedtoCheckoutId").attr("disabled", true);



		//alert();



		if((upId!='' || upId=='whatsapp') && upId!='new'){



			var select_prescription_Id='#select_prescription_Id'+select_prescription_Id;



			if(window.XMLHttpRequest) {



				xmlhttp=new XMLHttpRequest();



			}else{  



				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");



			}



			xmlhttp.onreadystatechange=function() {



				if(this.readyState==4 && this.status==200) {



					var json=$.parseJSON(this.responseText);



					if((json.status)=='ok'){



						alert(json.msg);



						$("#ProceedtoCheckoutId").attr("disabled", false);



						//$('ProceedtoCheckoutId').disabled = false;



						$(select_prescription_Id).css("border", "");



					}else{



						$(select_prescription_Id).val('');



					}



				}



			}



			xmlhttp.open("GET","ajax/SelectPrescription.php?pId="+pId+"&&upId="+upId,true);



			xmlhttp.setRequestHeader("Content-type", "application/json")



			xmlhttp.send();



			//prescription_id



		}else if(upId=='new'){



			window.location='UploadPrescription.php?shopping=1';



		}else{



			$(select_prescription_Id).css("border", "1px solid red");



		}



	}



	function checkPrescription(){



		var flag=0;



		var filteredList = $('.searchskill').filter(function() {



			if($(this).val()==''){



				$(this).css("border", "1px solid red");



			}else{



				$(this).css("border", "");



			}



			return $(this).val() == "";



		});	



		if (filteredList.length > 0) {



			flag=0;



		}else{



			flag=1;	



		}



		//alert(flag);



		if(flag==0){



			return false;



		}



		else{



			



			return true;



		}



	}



	</script>







</body>



</html>