<?php  
session_start();
ob_start();
error_reporting(0);
$mali_URL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/dawa/";
include_once 'inc/functions.php'; 

 //$table.="<div><img src='".$mali_URL.'images/medkart-logo.jpg'."'>";
 $table.="<table class='table_type_1 order_review' style='padding: 0;border: none;border-collapse: collapse;'>
								<thead>
									<tr>
										<th class='product_title_col' style='background: #f8f8f8;'>Product Name</th>
										<th class='product_price_col' style='background: #f8f8f8;'>Price</th>
										<th class='product_qty_col' style='background: #f8f8f8;'>Quantity</th>
										<th class='product_total_col' style='background: #f8f8f8;'>Total</th>
									</tr>
								</thead>
								<tbody>";
                               
									$products_array= array ( 
									'0' => array ( 'product_id' => 10, 'product_qty' => 1, 'price' => 2100 ,'p_b1' => 1 ) ,
									'1' => array ( 'product_id' => 16, 'product_qty' => 2 ,'price' => 122 ,'p_b1' => 10 ) 
									);
										
										$count=sizeof($products_array);
										if($count>0){
											$sumRs=0;
										foreach($products_array as $rs){
											$product_id=$rs['product_id'];
											$product_qty=$rs['product_qty'];
											$price=$rs['price'];
											$sqlproducts="SELECT p.id,p.menu,p.name,cn.name as c_name,pa.name as p_bname, pa1.name as p_b1name,so.name as solt FROM `products` p left JOIN packing pa on p.p_b=pa.id left JOIN packing pa1 on p.p_b1=pa1.id left JOIN company_name cn on p.company_name=cn.id left JOIN solt so on p.solt=so.id where p.id='".$product_id."'";
											$resProducts=$DB->runQuery($sqlproducts);
											$resProducts=$resProducts[0];
											
									
									$table.="<tr>
										<td data-title='Product Name' style='border: 1px solid #eaeaea;padding: 14px 19px;'>";
										 $a_tag= $resProducts['menu']=='1'?$mali_URL.'product_details-medicine.php?q='.$resProducts['id']:$mali_URL.'product_details.php?q='.$resProducts['id'];
										 $resProducts_name=$resProducts['name'];
										 $resProducts_c_name=$resProducts['c_name'];
										 $resProducts_li=$resProducts['solt']!=''?'<li>'.$resProducts['solt'].'</li>':'';
										 $table.="<a href=' $a_tag ' class='product_title'> $resProducts_name </a>"."<ul class='sc_product_info' style='list-style: none;'>
												<li>$resProducts_c_name </li>
                                                $resProducts_li ";
												 $ta=$rs['p_b1'].' '.$resProducts['p_b1name'].'  in 1 '.$resProducts['p_bname']; 
												$rs_price=$rs['price'];
												 	$table.=	"<li>$ta</li>
											</ul>
										</td>
										<td data-title='Price' style='border: 1px solid #eaeaea;padding: 14px 19px; font-size:16px;font-weight: 600;' class='subtotal'>Rs. $rs_price </td>
										<td data-title='Quantity' style='border: 1px solid #eaeaea;padding: 14px 19px;' > $product_qty </td>";
										 $sumRs=$sumRs+($product_qty*$rs['price']); 
										 $sumRs1=$product_qty*$rs['price'];
										$table.="<td style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' data-title='Total' class='total'>Rs.  $sumRs1</td>
									</tr>"; 
									 } }  
                               $table.=" </tbody>
								<tfoot>
									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>
										<td colspan='3' class='bold' style='border: 1px solid #eaeaea;padding: 14px 19px;'>Subtotal</td>
										<td class='total' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $sumRs </td>
									</tr>
									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>
										<td colspan='3' style='border: 1px solid #eaeaea;padding: 14px 19px;' class='grandtotal'>Grand Total</td>
										<td class='grandtotal' style='border: 1px solid #eaeaea;padding: 14px 19px;color: rgb(3, 44, 88);' >Rs. $sumRs </td>
									</tr>
									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>
										<td colspan='4' style='border: 1px solid #eaeaea;padding: 14px 19px;text-align: center;' class='grandtotal'>COD</td>
									</tr>
									<tr style='border: 1px solid #eaeaea;padding: 14px 19px;'>
										<td colspan='4' style='border: 1px solid #eaeaea;padding: 14px 19px;'>
										<p>$title $fname $lname </p>
										<p>$address</p>
										<p>$street</p>
										<p>$phone</p>
										<p>$city</p>
										<p>$state</p>
										<p>$pincode</p>

										</td>
									</tr>
								</tfoot>
							</table>";
							echo $table.'</div>';
                            ?>
