<?php 
include 'includes/functions.php';
$get=$_POST['get_option'];
$sub_menu=$_POST['sub_menu'];
?>

<?php 
$sqlu = "select * from sub_menu where status='1' AND menu='$get' AND link='0' order by sort";
$resultu = mysql_query($sqlu);
while($drop = mysql_fetch_array($resultu)){ ?>
<option value="<?php echo $drop['id']; ?>" <?php echo $sub_menu==$drop['id']?'selected':"" ?>><?php echo $drop['sub_menu']; ?></option>

<?php  }?>  
