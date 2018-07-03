<?php
include 'includes/functions.php';
session_start();
ob_start();
@extract($_REQUEST);
$eid=(int)$_GET['eid'];
if(isset($_POST['submit']))
{
	//print_r($_POST);
	list($p_id,$p_menu,$menu_name)=explode('@@',$_POST['p_id']);
	$n=$_POST['input_array']['no'];
	$val='';
	if($p_menu=='2' || $p_menu_name=='Medical Devices' || $p_menu=='3' || $p_menu_name=='OTC'){
		for($i=1;$i<=$n;$i++){
			// 60% of 900= 540 
			// (900/100)*60=540
			// price= (900-540)= 360
			$_POST['input_array']['price'.$i]=($_POST['input_array']['orgprice'.$i]-(($_POST['input_array']['orgprice'.$i]/100)*$_POST['input_array']['price_per'.$i]));
			$val.='('."'".$p_id."',"."'".$_POST['input_array']['name'.$i]."',"."'".$_POST['input_array']['price'.$i]."',"."'".$_POST['input_array']['orgprice'.$i]."',"."'".$_POST['input_array']['price_per'.$i]."',"."'".$p_menu."'".'),';
		}
	}
	if($p_menu=='6' || $p_menu_name=='Personal Care'){
		for($i=1;$i<=$n;$i++){
			$_POST['input_array']['price'.$i]=($_POST['input_array']['orgprice'.$i]-(($_POST['input_array']['orgprice'.$i]/100)*$_POST['input_array']['price_per'.$i]));
			$val.='('."'".$p_id."',"."'".$_POST['input_array']['name'.$i]."',"."'".$_POST['input_array']['price'.$i]."',"."'".$_POST['input_array']['orgprice'.$i]."',"."'".$_POST['input_array']['price_per'.$i]."',"."'".$p_menu."'".'),';
		}
	}
	if($p_menu=='1' || $p_menu_name=='Medicine'){
		for($i=1;$i<=$n;$i++){
			$_POST['input_array']['price'.$i]=($_POST['input_array']['orgprice'.$i]-(($_POST['input_array']['orgprice'.$i]/100)*$_POST['input_array']['price_per'.$i]));
			$val.='('."'".$p_id."',"."'".$_POST['input_array']['name'.$i]."',"."'".$_POST['input_array']['price'.$i]."',"."'".$_POST['input_array']['orgprice'.$i]."',"."'".$_POST['input_array']['price_per'.$i]."',"."'".$p_menu."'".'),';
		}
	}
	if($p_menu=='233'|| $p_menu=='234'|| $p_menu=='235'){
		for($i=1;$i<=$n;$i++){
			$val.='('."'".$p_id."',"."'".$_POST['input_array']['size_l'.$i]."',"."'".$_POST['input_array']['size_b'.$i]."',"."'".''."',"."'".$_POST['input_array']['price'.$i]."',"."'".$p_menu."'".'),';
		}
	}
	
	if($p_menu=='236'){
		for($i=1;$i<=$n;$i++){
			$val.='('."'".$p_id."',"."'".$_POST['input_array']['size_l'.$i]."',"."'".$_POST['input_array']['size_b'.$i]."',"."'".$_POST['input_array']['size_h'.$i]."',"."'".$_POST['input_array']['size_t'.$i]."',"."'".$_POST['input_array']['price'.$i]."',"."'".$p_menu."'".'),';
		}
		
	}
	$t='(`p_id`, `p_b1`, `price`, `orgprice`,price_per,p_menu)';
	//echo $val;
	$val=rtrim($val,",");
	$query="insert into price $t VALUES $val";
	if(mysql_query($query)){
		echo "<script>window.location='list_price.php?q=$p_id';</script>";
		$msg="Price added Successfully";		
	}else{
		$erromsg='Error in add price';
	}
}
$QRY="select id,menu,name,sub_menu,sub_sub_menu,p_b1 from products where id='$eid'";
$web=$DB->fectchRecord($QRY);

$QRY321="select name from packing where id='".$web["p_b1"]."'";
$web321=$DB->fectchRecord($QRY321);


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Price | Dashboard</title>
       <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
	    <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		<!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
   <style>
 .ul-text { list-style:none; margin:0px; padding:0px; padding-bottom: 50px;  }
 .ul-text li { list-style:none; margin:0px; }
 .but-title{
 background-color: #3c8dbc;
    border-color: #3c8dbc;
	    color: white;
	}
	.btn.btn-danger:hover{
	
	background-color: #f4543c;
	
	}
	.btn.btn-danger {
		background-color: #f56954;
		border-color: #f4543c;
	}
 </style>
   		 
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php  include 'includes/header.php'?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php  include 'includes/left.php'?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Product Price 
                        <small><?php 
						$menu=$DB->fetch_menu('menu','id,menu','menu');
						echo $menu[$web['menu']]; ?></small>
                       
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Product Management</li>
                        <li class="active">Product Price</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 <div class="row">
                        <!-- left column -->
                        <div class="col-lg-9" style=" float:none; margin:0 auto;">
					 <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                  <h3 class="box-title"> <a href="products_view.php?menu=<?php echo $web['menu'];?>&&sub_menu=<?php echo $web['sub_menu'];?>&&sub_sub_menu=<?php echo $web['sub_sub_menu'];?>" title="<?php echo $web['name']; ?>" style="color:#72afd2;"><?php echo $web['name']; ?></a> </h3>
                                </div><!-- /.box-header -->
                                <?php if(isset($erromsg)!=''){ ?>
                               <!-- Alert-->
                               <div style="padding:5px 10px 0 10px;">
                                <div class="alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alert!</b> <?php echo $erromsg;?>
                                    </div>
                                </div>
                                <?php  } if(isset($msg)!=''){?>
                               <div style="padding:5px 10px 0 10px;">
                                <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> <?php echo $msg;?>
                                    </div>
                                </div>
                                <?php } ?>
                               <!--./Alert-->
                                <!-- form start -->
                                <form role="form" method="post" name="form" enctype="multipart/form-data">
                                    <div class="box-body" >
                                   <?php //print_r($web); ?>
                                        <!--<div class="form-group">
                                            <label>Product Name</label>
                                           <select name="p_id" class="form-control" onchange="getComboA(this)" >
                                           <option value="">-- Select --</option>
                                           <?php 
										   
										
                                            $result=("select * from product where status='1' ");
                                            $res= mysql_query($result);
											while($get=mysql_fetch_assoc($res)){
												if($get['menu']=='submenu'){
													 $abc=$fetch_sub_menu[$get['ssp']];
													 $x=$get['ssp'];
												}if($get['menu']=='sub_sub_menu'){
													$abc=$fetch_sub_menu[$fetch_sub_sub_menu[$get['ssp']]['submenu_id']].'->'.$fetch_sub_sub_menu[$get['ssp']]['sub_sub_menu'];
													$x=$fetch_sub_sub_menu[$get['ssp']]['submenu_id'];
												} 
											?>
                                                <option value="<?php echo $get['id'].'@@'.$x; ?>"><?php echo "($abc) ".$get['pname']; ?></option>
                                             <?php } ?>
 											</select>
											
                                        </div>-->
                                        <input type="hidden" value="<?php echo $web['id']; ?>@@<?php echo $web['menu']; ?>@@<?php echo $menu[$web['menu']]; ?>" name="p_id" />
                                      
										
                                        
                                        
                                       <div class="form-group">
													<input type="hidden" name="input_array[no]" id="input_array-no" placeholder="about_us" class="form-control">
                                                    <div id="plus_min"></div>
													<!--<div class="input-group-btn">
														<button type="button" onClick="input_addFile('add')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button>
														<button type="button" onClick="input_addFile('del')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
													</div>--><br>
													<div id="input_addFile" class="row"></div>
												</div>
                                    	</div><!-- /.box-body -->
						
                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary" id="submit">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
						</div><!-- /.left column -->
                  </div> <!-- /.row-->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


      <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
          <!-- CK Editor -->
        <script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
		var input_Files = 0;
		var input_name = '<?php echo $web321['name']; ?>';
		function getComboA(menu_id,menu_name) {
		//alert(menu_name);
			var menu_id = menu_id; 
			var menu_name = menu_name;   
			//var array=value.split("@@");
			if(menu_id=='2' || menu_name=='Medical Devices' || menu_id=='3' || menu_name=='OTC'  ){ 
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
				var input_Files='<div class="input-group-btn"><button type="button" onClick="input_addFile(\'add\')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" onClick="input_addFile(\'del\')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
				document.getElementById('plus_min').innerHTML=input_Files;
				//input_addFile();
			}else if(menu_id=='6' || menu_name=='Personal Care' ){ 
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
				var input_Files='<div class="input-group-btn"><button type="button" onClick="input_addFile(\'add\')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" onClick="input_addFile(\'del\')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
				document.getElementById('plus_min').innerHTML=input_Files;
				//input_addFile();
			}else if(menu_id=='1' || menu_name=='Medicine' ){ /* Pillows */
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
				input_addFile1('add');
				//var input_Files='<div class="input-group-btn"><button type="button" onClick="input_addFile1(\'add\')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" onClick="input_addFile1(\'del\')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
				//document.getElementById('plus_min').innerHTML=input_Files;
				//input_addFile();
			}else if(array[1]=='234'){ /*  Bedding Supports */
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
				var input_Files='<div class="input-group-btn"><button type="button" onClick="input_addFile2(\'add\')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" onClick="input_addFile2(\'del\')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
				document.getElementById('plus_min').innerHTML=input_Files;
				//input_addFile();
			}else if(array[1]=='235'){ /* Headboards */
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
				var input_Files='<div class="input-group-btn"><button type="button" onClick="input_addFile3(\'add\')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" onClick="input_addFile3(\'del\')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
				document.getElementById('plus_min').innerHTML=input_Files;
				//input_addFile();
			}else if(array[1]=='236'){ /* Platform / Spring Base */
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
				var input_Files='<div class="input-group-btn"><button type="button" onClick="input_addFile4(\'add\')" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" onClick="input_addFile4(\'del\')" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
				document.getElementById('plus_min').innerHTML=input_Files;
				//input_addFile();
			}
			else{
				document.getElementById('plus_min').innerHTML='';
				document.getElementById('input_addFile').innerHTML='';
			}
		}
/* menu_id=='2' || menu_name=='Medical Devices'  */
function input_addFile(x) {
	var x;
	if(x=='add'){
		input_Files++;
		var tr = document.createElement('ul');
		tr.setAttribute('id', 'input-' + input_Files);
		tr.setAttribute('class', 'ul-text');
		tr.innerHTML = '<li class="col-md-4"><div class="input-group"><span class="input-group-addon">'+input_name+'</span><input type="text" name="input_array[name'+input_Files+']" placeholder=" '+input_Files+'"  class="form-control"></div></li><li class="col-md-4"><div class="input-group"><span class="input-group-addon">Rs.</span><input type="text" name="input_array[orgprice'+input_Files+']" placeholder="MRP Price '+input_Files+'"  class="form-control"></div></li><li class="col-md-4"><div class="input-group"><span class="input-group-addon">%</span><input type="text" name="input_array[price_per'+input_Files+']" placeholder="% Percentage '+input_Files+'"  class="form-control"></div></li>';
		document.getElementById('input_addFile').appendChild(tr);
	}if(x=='del'){
		if(input_Files>0){
			var obj = document.getElementById('input-' + input_Files);
    		obj.parentNode.removeChild(obj);
			input_Files--;
		}
	}
	//input_array-no
	//alert(input_Files);
	document.getElementById('input_array-no').value=input_Files;
}
/* Pillows */
function input_addFile1(x) {
	
	var x;
	if(x=='add'){
	var x;
	if(x=='add'){
		input_Files++;
		var tr = document.createElement('ul');
		tr.setAttribute('id', 'input-' + input_Files);
		tr.setAttribute('class', 'ul-text');
		tr.innerHTML = '<li class="col-md-4"><div class="input-group"><span class="input-group-addon">'+input_name+'</span><input type="text" name="input_array[name'+input_Files+']" placeholder=" '+input_Files+'"  class="form-control"></div></li><li class="col-md-4"><div class="input-group"><span class="input-group-addon">Rs.</span><input type="text" name="input_array[orgprice'+input_Files+']" placeholder="MRP Price '+input_Files+'"  class="form-control"></div></li><li class="col-md-4"><div class="input-group"><span class="input-group-addon">%</span><input type="text" name="input_array[price_per'+input_Files+']" placeholder="% Percentage '+input_Files+'"  class="form-control"></div></li>';
		document.getElementById('input_addFile').appendChild(tr);
	}if(x=='del'){
		if(input_Files>0){
			var obj = document.getElementById('input-' + input_Files);
    		obj.parentNode.removeChild(obj);
			input_Files--;
		}
	}
	//input_array-no
	//alert(input_Files);
	document.getElementById('input_array-no').value=input_Files;
	}if(x=='del'){
		if(input_Files>0){
			var obj = document.getElementById('input-' + input_Files);
    		obj.parentNode.removeChild(obj);
			input_Files--;
		}
	}
	//input_array-no
	//alert(input_Files);
	document.getElementById('input_array-no').value=input_Files;
}/* Bedding Supports */
function input_addFile2(x) {
	var x;
	if(x=='add'){
		input_Files++;
		var tr = document.createElement('ul');
		tr.setAttribute('id', 'input-' + input_Files);
		tr.setAttribute('class', 'ul-text');
		tr.innerHTML = '<li class="col-md-6"><div class="form-group"><select name="input_array[size_l'+input_Files+']" class="form-control" ><option value="5" >5</option><option value="10" >10</option></select></div></li><li class="col-md-6"><div class="input-group"><span class="input-group-addon">Rs.</span><input type="text" name="input_array[price'+input_Files+']" placeholder="Price '+input_Files+'"  class="form-control"></div></li>';
		document.getElementById('input_addFile').appendChild(tr);
	}if(x=='del'){
		if(input_Files>0){
			var obj = document.getElementById('input-' + input_Files);
    		obj.parentNode.removeChild(obj);
			input_Files--;
		}
	}
	//input_array-no
	//alert(input_Files);
	document.getElementById('input_array-no').value=input_Files;
}/* Headboards */
function input_addFile3(x) {
	var x;
	if(x=='add'){
		input_Files++;
		var tr = document.createElement('ul');
		tr.setAttribute('id', 'input-' + input_Files);
		tr.setAttribute('class', 'ul-text');
		tr.innerHTML = '<li class="col-md-4"><div class="form-group"><select name="input_array[size_l'+input_Files+']" class="form-control" ><option value="5" >5</option><option value="10" >10</option></select></div></li><li class="col-md-4"><div class="form-group"><select name="input_array[size_b'+input_Files+']" class="form-control" ><option value="5" >5</option><option value="10" >10</option></select></div></li><li class="col-md-4"><div class="input-group"><span class="input-group-addon">Rs.</span><input type="text" name="input_array[price'+input_Files+']" placeholder="Price '+input_Files+'"  class="form-control"></div></li>';
		document.getElementById('input_addFile').appendChild(tr);
	}if(x=='del'){
		if(input_Files>0){
			var obj = document.getElementById('input-' + input_Files);
    		obj.parentNode.removeChild(obj);
			input_Files--;
		}
	}
	//input_array-no
	//alert(input_Files);
	document.getElementById('input_array-no').value=input_Files;
}/*  Platform / Spring Base */
function input_addFile4(x) {
	var x;
	if(x=='add'){
		input_Files++;
		var tr = document.createElement('ul');
		tr.setAttribute('id', 'input-' + input_Files);
		tr.setAttribute('class', 'ul-text');
		tr.innerHTML = '<li class="col-md-3"><div class="form-group"><select name="input_array[size_l'+input_Files+']" class="form-control" ><option value="72" >72</option></select></div></li><li class="col-md-3"><div class="form-group"><select name="input_array[size_b'+input_Files+']" class="form-control" ><option value="75" >75</option></select></div></li><li class="col-md-3"><div class="form-group"><select name="input_array[size_h'+input_Files+']" class="form-control" ><option value="78 x 30" >78 x 30</option><option value="78 x 36" >78 x 36</option><option value="78 x 48" >78 x 48</option></select></div></li><li class="col-md-3"><div class="form-group"><select name="input_array[size_t'+input_Files+']" class="form-control" ><option value="Fabric" >Fabric</option><option value="Leatherite" >Leatherite</option></select></div></li><li class="col-md-12"><div class="input-group"><span class="input-group-addon">Rs.</span><input type="text" name="input_array[price'+input_Files+']" placeholder="Price '+input_Files+'"  class="form-control"></div></li>';
		document.getElementById('input_addFile').appendChild(tr);
	}if(x=='del'){
		if(input_Files>0){
			var obj = document.getElementById('input-' + input_Files);
    		obj.parentNode.removeChild(obj);
			input_Files--;
		}
	}
	//input_array-no
	//alert(input_Files);
	document.getElementById('input_array-no').value=input_Files;
}
	getComboA('<?php echo $web['menu']; ?>','<?php echo $menu[$web['menu']]; ?>');
</script>
<?php include 'includes/lockscreen.php'?>
    </body>
</html>