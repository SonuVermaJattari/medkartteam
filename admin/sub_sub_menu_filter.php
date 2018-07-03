<?php 
include 'includes/functions.php';
$get=$_POST['get_option'];
?>

<?php 
$sqlu = "select * from sub_menu where status='1' AND menu='$get' AND link='0' order by sort";
$resultu = mysql_query($sqlu);
while($drop = mysql_fetch_array($resultu)){ ?>
<option value="<?php echo $drop['id']; ?>"><?php echo $drop['sub_menu']; ?></option>

<?php  }?>  
