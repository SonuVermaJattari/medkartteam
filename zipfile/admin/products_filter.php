<?php 
include 'includes/functions.php';
$get=(int)$_POST['get_option'];
?>
<label>Sub Menu</label>
<select name='sub_menu' class='form-control' id="new_select1" required onChange="fetch_select2(this.value);">
	<option value="">--Select Sub Menu--</option>
	<?php 
    $sqlu = "select * from sub_menu where status='1' AND menu='$get' AND (link='0' || link='product') order by sort";
    $resultu = mysql_query($sqlu);
    while($drop = mysql_fetch_array($resultu)){ ?>
    <option value="<?php echo $drop['id']; ?>@@<?php echo $drop['menu']; ?>@@<?php echo $drop['link']; ?>"><?php echo $drop['sub_menu']; ?></option>
    <?php  }?> 
</select>