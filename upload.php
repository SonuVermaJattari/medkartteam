<?php
session_start();
error_reporting(0);
include_once 'inc/functions.php'; 
if(!empty($_FILES)) {
	$unq=$_SESSION['phone'];
	$email=$_SESSION['email'];
	$u_id=$_SESSION['username_id'];
	//$u_id=$DB->fectchRecord("SELECT id FROM `user` where email='$email' AND phone='$unq'");
	$u_id=$u_id['id'];
	$name=$DB->escape($_POST['nameImage']);
	$imgReturn=$DB->UploadPrescription($_FILES,'1200','1200','UploadPrescription','userImage',$unq,$u_id,$email,$name);
	if($imgReturn!='0') { ?>
		<img src="<?php echo $imgReturn; ?>" width="50%" height="50%" /> <?php
		echo '<br />Img Name: '.$DB->new_IMG;
		if(isset($_SESSION['shopping'])){
			echo "<script>window.location='shopping_cart.php';</script>";
		}
	}else{ ?>
	<div class="hiddenmsg" style="padding:5px 10px 0 10px;">
            <div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Alert!</b><p class="subcaption"> <?php echo $erromsg=$DB->error();?></p>
                </div>
            </div>
	<?php }
}else{
	echo "<script>window.location='UploadPrescription.php';</script>";
}
?>
