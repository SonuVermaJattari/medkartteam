<?php  session_start();
include 'inc/functions.php'; 

?>
	<?php 
	if(isset($_SESSION['menu'])){
		$menu=$_SESSION['menu'];
		$where="products.menu='$menu' ";
	}
	if(isset($_SESSION['sub_menu'])){
		$sub_menu=$_SESSION['sub_menu'];
		$where.="AND products.sub_menu='$sub_menu' ";
	}if(isset($_SESSION['sub_sub_menu'])){
		$sub_sub_menu=$_SESSION['sub_sub_menu'];
		$where.="AND products.sub_sub_menu='$sub_sub_menu'";
	}
	if(isset($_SESSION['fil_brand'])){
		$fil_brand=$_SESSION['fil_brand'];
		$where.="AND $fil_brand ";
		$Lfil_brand=$_SESSION['Lfil_brand'];
	}if(isset($_SESSION['fil_discount'])){
		$fil_discount=$_SESSION['fil_discount'];
		$where.="AND $fil_discount ";
		$Lfil_discount=$_SESSION['Lfil_discount'];
	}if(isset($_SESSION['fil_form'])){
		$fil_form=$_SESSION['fil_form'];
		$where.="AND $fil_form ";
		$Lfil_form=$_SESSION['Lfil_form'];
	}if(isset($_SESSION['fil_uses'])){
		$fil_uses=$_SESSION['fil_uses'];
		$where.="AND $fil_uses ";
		$Lfil_uses=$_SESSION['Lfil_uses'];
	}if(isset($_SESSION['fil_age'])){
		$fil_age=$_SESSION['fil_age'];
		$where.="AND $fil_age ";
		$Lfil_age=$_SESSION['Lfil_age'];
	}if(isset($_SESSION['fil_gender'])){
		$fil_gender=$_SESSION['fil_gender'];
		$where.="AND $fil_gender ";
		$Lfil_gender=$_SESSION['Lfil_gender'];
	}
	//print_r($Lfil_brand=$_SESSION['Lfil_brand']);
		//echo "SELECT * FROM `products` where ".$where;
	?>
     <?php $filter_brand=$DB->filter_Fil_mult('products',$where,'brand');
	//print_r($filter_brand);
	if((sizeof($filter_brand))>0){ ?>
		<div id="brand" class="table_cell" >
            <fieldset>
                <legend>Brand</legend>
                <ul class="checkboxes_list">
                <?php 
				$filter_discount_key='';
                foreach($filter_brand as $filter_discount_key){ 
                ?>
                <li>
                    
                    <input onclick="productDisplay();"  type="checkbox" id="<?php echo $filter_discount_key['name']; ?>" name="tv_brand[]" value="<?php echo $filter_discount_key['brand']; ?>"  <?php  if(!empty($Lfil_brand)){ foreach($Lfil_brand as $key=>$val){echo $val==$filter_discount_key['brand']?'checked':'';}} ?> /> <label for="<?php echo $filter_discount_key['name']; ?>"><?php echo $filter_discount_key['name']; ?> (<?php echo $filter_discount_key['COUNT(products.id)'] ?>)</label>						
                </li>
                <?php 
                } ?>
                </ul>
            </fieldset>
        </div>
	<?php }	?>
	<?php
	$filter_discount=$DB->filter_Fil_singal('products',$where,'discount');
	//print_r($filter_discount);
	if((sizeof($filter_discount))>0){ ?>
		<div id="discount" class="table_cell">
            <fieldset>
                <legend>Discount</legend>
                <ul class="checkboxes_list">
                <?php 
                foreach($filter_discount as $filter_discount_key){ 
                ?>
                <li>
                    
                    <input onclick="productDisplay();" type="checkbox" id="<?php echo $filter_discount_key['name']; ?>" name="tv_dis[]" value="<?php echo $filter_discount_key['discount']; ?>"  <?php  if(!empty($Lfil_discount)){ foreach($Lfil_discount as $key=>$val){echo $val==$filter_discount_key['discount']?'checked':'';}} ?> /> <label  for="<?php echo $filter_discount_key['name']; ?>"><?php echo $filter_discount_key['name']; ?> (<?php echo $filter_discount_key['COUNT(products.id)'] ?>)</label>						
                </li>
                <?php 
                } ?>
                </ul>
            </fieldset>
        </div>
	<?php }	?>
    <?php $filter_form=$DB->filter_Fil_mult('products',$where,'form');
	//print_r($filter_brand);
	if((sizeof($filter_form))>0){ ?>
		<div id="form" class="table_cell">
            <fieldset>
                <legend>Product Form</legend>
                <ul class="checkboxes_list">
                <?php 
				$filter_discount_key='';
                foreach($filter_form as $filter_discount_key){ 
                ?>
                <li>
                    
                    <input onclick="productDisplay();" type="checkbox" id="<?php echo $filter_discount_key['name']; ?>" name="tv_form[]" value="<?php echo $filter_discount_key['form']; ?>"  <?php  if(!empty($Lfil_form)){ foreach($Lfil_form as $key=>$val){echo $val==$filter_discount_key['form']?'checked':'';}} ?> /> <label  for="<?php echo $filter_discount_key['name']; ?>"><?php echo $filter_discount_key['name']; ?> (<?php echo $filter_discount_key['COUNT(products.id)'] ?>)</label>						
                </li>
                <?php 
                } ?>
                </ul>
            </fieldset>
        </div>
	<?php }	?>
     <?php $filter_uses=$DB->filter_Fil_mult('products',$where,'uses');
	//print_r($filter_brand);
	if((sizeof($filter_uses))>0){ ?>
		<div id="uses" class="table_cell">
            <fieldset>
                <legend>Uses</legend>
                <ul class="checkboxes_list">
                <?php 
				$filter_discount_key='';
                foreach($filter_uses as $filter_discount_key){ 
                ?>
                <li>
                    
                    <input onclick="productDisplay();" type="checkbox" id="<?php echo $filter_discount_key['name']; ?>" name="tv_uses[]" value="<?php echo $filter_discount_key['uses']; ?>"  <?php  if(!empty($Lfil_uses)){ foreach($Lfil_uses as $key=>$val){echo $val==$filter_discount_key['uses']?'checked':'';}} ?> /> <label  for="<?php echo $filter_discount_key['name']; ?>"><?php echo $filter_discount_key['name']; ?> (<?php echo $filter_discount_key['COUNT(products.id)'] ?>)</label>						
                </li>
                <?php 
                } ?>
                </ul>
            </fieldset>
        </div>
	<?php }	?>
    <?php $filter_age=$DB->filter_Fil_singal('products',$where,'age');
	//print_r($filter_age);
	if((sizeof($filter_age))>0){ ?>
		<div id="age" class="table_cell">
            <fieldset>
                <legend>Age</legend>
                <ul class="checkboxes_list">
                <?php 
				$filter_discount_key='';
                foreach($filter_age as $filter_discount_key){ 
                ?>
                <li>
                    
                    <input onclick="productDisplay();" type="checkbox" id="<?php echo $filter_discount_key['name']; ?>" name="tv_age[]" value="<?php echo $filter_discount_key['age']; ?>"  <?php  if(!empty($Lfil_age)){ foreach($Lfil_age as $key=>$val){echo $val==$filter_discount_key['age']?'checked':'';}} ?> /> <label  for="<?php echo $filter_discount_key['name']; ?>"><?php echo $filter_discount_key['name']; ?> (<?php echo $filter_discount_key['COUNT(products.id)'] ?>)</label>						
                </li>
                <?php 
                } ?>
                </ul>
            </fieldset>
        </div>
	<?php }	?>
 <?php $filter_gender=$DB->filter_Fil_singal('products',$where,'gender');
	//print_r($filter_gender);
	if((sizeof($filter_gender))>0){ ?>
		<div id="gender" class="table_cell">
            <fieldset>
                <legend>Gender</legend>
                <ul class="checkboxes_list">
                <?php 
				$filter_discount_key='';
                foreach($filter_gender as $filter_discount_key){ 
                ?>
                <li>
                    
                    <input onclick="productDisplay();" type="checkbox" id="<?php echo $filter_discount_key['name']; ?>" name="tv_gender[]" value="<?php echo $filter_discount_key['gender']; ?>" <?php  if(!empty($Lfil_gender)){ foreach($Lfil_gender as $key=>$val){echo $val==$filter_discount_key['gender']?'checked':'';}} ?> /> <label  for="<?php echo $filter_discount_key['name']; ?>"><?php echo $filter_discount_key['name']; ?> (<?php echo $filter_discount_key['COUNT(products.id)'] ?>)</label>						
                </li>
                <?php 
                } ?>
                </ul>
            </fieldset>
        </div>
	<?php }	?>