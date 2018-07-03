<?php 
include 'includes/functions.php';
$get=(int)$_POST['get_option'];
$get_menu=(int)$_POST['get_option_menu'];
 //echo  $sqlu = "select * from sub_sub_menu where status='1' AND menu='$get_menu' AND sub_menu='$get' AND (link='0' || link='product') order by sort";
?>
<label>Sub Sub Menu</label>
<select name='sub_sub_menu' class='form-control' id="new_select1" required >
	<option value="">--Select Sub Sub Menu--</option>
	<?php 
     $sqlu = "select * from sub_sub_menu where status='1' AND menu='$get_menu' AND sub_menu='$get' AND (link='0' || link='product') order by sort";
    $resultu = mysql_query($sqlu);
    while($drop = mysql_fetch_array($resultu)){ ?>
    <option value="<?php echo $drop['id']; ?>@@<?php echo $drop['menu']; ?>@@<?php echo $drop['sub_menu']; ?>@@<?php echo $drop['link']; ?>"><?php echo $drop['sub_sub_menu']; ?></option>
    <?php  }?> 
</select>