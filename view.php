<div class="row">
<?php 

include 'inc/functions.php';
session_start();

/*set product id*/
if(isset($_POST['pid'])){
	$_SESSION['pid']=$_POST['pid'];
	unset($_SESSION['brand']);
	unset($_SESSION['color']);
	unset($_SESSION['size']);
	unset($_SESSION['pricerange']);
}
if(isset($_POST['uset_pid'])){
/*$_SESSION['pid']=$_POST['uset_pid'];*/
	unset($_SESSION['pid']);
}
$pid=$_SESSION['pid'];
//echo $pid;
/*End product id*/

/*set brand*/
if(isset($_POST['brand'])){
	$_SESSION['brand']=$_POST['brand'];
}
if(isset($_POST['uset_brand'])){
	unset($_SESSION['brand']);
}
$brand=$_SESSION['brand'];
//echo $brand;
/*End brand*/

/*set color*/
if(isset($_POST['color_val'])){
	$_SESSION['color']=$_POST['color_val'];
}
if(isset($_POST['uset_color'])){
	unset($_SESSION['color']);
}
$color_val=$_SESSION['color'];
//echo $color_val;
/*End color*/


/*set size*/
if(isset($_POST['size'])){
	$_SESSION['size']=$_POST['size'];
}
if(isset($_POST['uset_size'])){
	unset($_SESSION['size']);
}
$size=$_SESSION['size'];
//echo $size;
/*End size*/

/*set price*/
if(isset($_POST['mrp'])){
	$_SESSION['pricerange']=$_POST['mrp'];
}
if(isset($_POST['uset_price'])){
	unset($_SESSION['pricerange']);
}
$mrp=$_SESSION['pricerange'];
//echo $mrp;
/*End price*/

/*set Low to high*/
//echo $_POST['dropdown'];
/*End Low to high*/

//echo "<br />";
//print_r($_SESSION);

?>
<?php     
$qur="select * from product where status='1' and ssp='$pid'";
if(!empty($brand))
	$qur.="AND brand='$brand'";
if(!empty($color_val))
	$qur.="AND color='$color_val'";
if(!empty($size))
	$qur.="AND size='$size'";
if(!empty($mrp)){
	$price_mrp=explode(';',$mrp);
	$min_mrp=$price_mrp[0];
	$max_mrp=$price_mrp[1];
	$qur.="AND (mrp BETWEEN '$min_mrp' AND '$max_mrp' )";
}
if(!empty($_POST['dropdown'])){
	$l_to_h=$_POST['dropdown'];
	$qur.="ORDER BY mrp $l_to_h ";
}
$qr= mysql_query($qur);  
$count_p=mysql_num_rows($qr);
if($count_p>0) {   
	while($ft=mysql_fetch_array($qr)){								
?>	
												<div class="ltabs-item col-sm-6 col-md-4 col-lg-4" >
													<div class="item-inner product-thumb transition" data-anijs="if: scroll, on: window, do: fadeInUp animated  , before: $scrollReveal ">
														<div class="image"><a class="block-images" href="add_cart.php?bid=<?php  echo $ft['id']; ?>"  title="">
															<img src="uploaded_tumbnail_product/<?php echo $ft['thumb_pic1'];?>" class="img_1" alt="">
															<!-- <img src="uploaded_tumbnail_product/<?php echo $ft['thumb_pic1'];?>" class="img_0" alt=""> -->
                                                            </a>
														</div>
														<div class="caption">
															<h4><a href="add_cart.php?bid=<?php  echo $ft['id']; ?>" title="" ><?php echo $ft['pname'];?></a></h4>
		<p class="price"><span class="price-new"><i class="fa fa-inr"></i><?php echo number_format($ft['mrp']);?></span> <span class="price-old"><i class="fa fa-inr"></i><?php echo number_format($ft['ndmrp']);?></span> <span class="price-tax">Ex Tax: <i class="fa fa-inr"></i><?php echo number_format($ft['tax']);?></span></p>
                                                            <p>You save: <span style="color: #ea3a3c;"><i class="fa fa-inr"></i><?php echo number_format ($ft['ndmrp']-$ft['mrp']); ?></span>

														</div>
													</div> 
												</div>
												<?php   
													} 
												}else echo "<div style='border: 2px solid #EAEAEA;border-radius: 4px;padding: 10px;text-transform: capitalize;font-size: 20px;color: #e74847;font-weight: 700;box-shadow: 1px 1px 5px #d1d1d1;width: 83%;'>no data found</div>"; ?>
</div>
