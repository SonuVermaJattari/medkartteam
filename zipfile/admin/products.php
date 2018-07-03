<?php

include 'includes/functions.php';

session_start();

ob_start();

@extract($_REQUEST);

if(isset($_POST['submit'])){

	$link=mysql_real_escape_string($_POST['link']);

	$editor1=mysql_real_escape_string($_REQUEST['editor1']);

	$name=mysql_real_escape_string($_REQUEST['name']);

	if($_FILES['img']['tmp_name']!=''){

		$new_image_name=$DB->img($_FILES['img'],1920,400);

		$erromsg=$DB->error();

	}if($_FILES['img1']['tmp_name']!=''){

		$image_name=$DB->img($_FILES['img1'],1490,1250);

		$erromsg.=$DB->error();

	}/*if(empty($menu)){

		$erromsg.="plz Select menu....<br>";

	}

	if(empty($sub_menu)){

		$erromsg.="plz Enter Sub menu....<br>";

	}

	if(empty($sub_sub_menu)){

		$erromsg.="plz Enter Sub Sub menu....<br>";

	}if(empty($sort)){

		$erromsg.="plz Enter sort orber....<br>";

	}*/

	if(!empty($sub_sub_menu)){

		list($sub_sub_menu,$menu,$sub_menu)=explode('@@',$sub_sub_menu);

		$enum='3';

	}elseif(!empty($sub_menu)){

		list($sub_menu,$menu)=explode('@@',$sub_menu);

		$enum='2';

	}elseif(!empty($menu)){

		list($menu)=explode('@@',$menu);

		$enum='1';

	}else{

		

	}

	$solt=(int)$_POST['solt'];

$Brand=$_POST['Brand'];

$Brand=implode(',', $Brand);

//$Discount;

//$Age;

///$Gender;

$Form=$_POST['Form'];

$Form=implode(',', $Form);

$Uses=$_POST['Uses'];

$Uses=implode(',', $Uses);

$company_name=mysql_real_escape_string($_POST['company_name']);



	if(empty($erromsg)){

		$query="INSERT INTO `products` ( `menu`, `sub_menu`,sub_sub_menu, name, `link`, `text`, `sort`, `status`,enum, `brand`, `discount`, `form`, `uses`, `age`, `gender`,img,company_name,prescription,p_b,p_b1,solt,dis_products,refundable)VALUES ( '$menu', '$sub_menu','$sub_sub_menu','$name','$link','$editor1', '".$_REQUEST['sort']."', '$r3','$enum','$Brand','$Discount','$Form','$Uses','$Age','$Gender','$new_image_name','$company_name','$prescription','$p_b','$p_b1','$solt','$dis_products','$refundable')";
		$result = mysql_query($query);
		$x=mysql_insert_id();
		
		if($result){
			if($tieup==1){
				$x='@'.$x.'@';
				$f=mysql_query("select * from user where `fix`='MID-' AND id='$pharmacist_products'");
				$f1=mysql_fetch_assoc($f);
				
				$arr=explode(',',$f1['pharmacist_products']);
				array_push($arr,$x);
				$x=implode(',', $arr);
				mysql_query("UPDATE `user` SET pharmacist_products='$x', productsstatus='1' where `fix`='MID-' AND id='$pharmacist_products'");
			}
			$msg = "Content Insert Successfully";
		
		
		}
	}

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title><?php echo $DB->projectname();  ?>| Dashboard</title>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />

<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

<link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="js/zelect.js"></script>

 <style>

    section:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }



    #intro .zelect {

      display: inline-block;

      background-color: white;

      min-width: 300px;

      cursor: pointer;

      line-height: 36px;

      border: 1px solid #dbdece;

      border-radius: 6px;

      position: relative;

    }

    #intro .zelected {

      font-weight: bold;

      padding-left: 10px;

    }

    #intro .zelected.placeholder {

      color: #999f82;

    }

    #intro .zelected:hover {

      border-color: #c0c4ab;

      box-shadow: inset 0px 5px 8px -6px #dbdece;

    }

    #intro .zelect.open {

      border-bottom-left-radius: 0;

      border-bottom-right-radius: 0;

    }

    #intro .dropdown {

      background-color: white;

      border-bottom-left-radius: 5px;

      border-bottom-right-radius: 5px;

      border: 1px solid #dbdece;

      border-top: none;

      position: absolute;

      left:-1px;

      right:-1px;

      top: 36px;

      z-index: 2;

      padding: 3px 5px 3px 3px;

    }

    #intro .dropdown input {

      font-family: sans-serif;

      outline: none;

      font-size: 14px;

      border-radius: 4px;

      border: 1px solid #dbdece;

      box-sizing: border-box;

      width: 100%;

      padding: 7px 0 7px 10px;

    }

    #intro .dropdown ol {

      padding: 0;

      margin: 3px 0 0 0;

      list-style-type: none;

      max-height: 150px;

      overflow-y: scroll;

    }

    #intro .dropdown li {

      padding-left: 10px;

    }

    #intro .dropdown li.current {

      background-color: #e9ebe1;

    }

    #intro .dropdown .no-results {

      margin-left: 10px;

    }

  </style>

  <style>

    section:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }



    #intro1 .zelect {

      display: inline-block;

      background-color: white;

      min-width: 300px;

      cursor: pointer;

      line-height: 36px;

      border: 1px solid #dbdece;

      border-radius: 6px;

      position: relative;

    }

    #intro1 .zelected {

      font-weight: bold;

      padding-left: 10px;

    }

    #intro1 .zelected.placeholder {

      color: #999f82;

    }

    #intro1 .zelected:hover {

      border-color: #c0c4ab;

      box-shadow: inset 0px 5px 8px -6px #dbdece;

    }

    #intro1 .zelect.open {

      border-bottom-left-radius: 0;

      border-bottom-right-radius: 0;

    }

    #intro1 .dropdown {

      background-color: white;

      border-bottom-left-radius: 5px;

      border-bottom-right-radius: 5px;

      border: 1px solid #dbdece;

      border-top: none;

      position: absolute;

      left:-1px;

      right:-1px;

      top: 36px;

      z-index: 2;

      padding: 3px 5px 3px 3px;

    }

    #intro1 .dropdown input {

      font-family: sans-serif;

      outline: none;

      font-size: 14px;

      border-radius: 4px;

      border: 1px solid #dbdece;

      box-sizing: border-box;

      width: 100%;

      padding: 7px 0 7px 10px;

    }

    #intro1 .dropdown ol {

      padding: 0;

      margin: 3px 0 0 0;

      list-style-type: none;

      max-height: 150px;

      overflow-y: scroll;

    }

    #intro1 .dropdown li {

      padding-left: 10px;

    }

    #intro1 .dropdown li.current {

      background-color: #e9ebe1;

    }

    #intro1 .dropdown .no-results {

      margin-left: 10px;

    }

  </style>

  <script>

    $(setup)



    function setup() {

      $('#intro select').zelect({ placeholder:'Plz select Company Name...' })

    }

	$(setup1)



    function setup1() {

      $('#intro1 select').zelect({ placeholder:'Plz select Solt Name...' })

    }

  </script>

  

<script type="text/jscript">



			function fetch_select(val){

			 	

			 	var res = val.split("@@");

			 	if(res[1]==0){

					$.ajax({

						type: 'post',

						url: 'products_filter.php',

						data: {

								get_option:res[0]

						 },

						 success: function (response) {

						   document.getElementById("sub_menu").innerHTML=response; 

						   document.getElementById("sub_sub_menu").innerHTML='';

						    $("#sub_sub_menu").hide(1000);

						   $("#sub_menu").show(1000);

					 	}

				   });

				}else{

					 $("#sub_menu").hide(1000);

					  $("#sub_sub_menu").hide(1000);

					document.getElementById("sub_menu").innerHTML=''; 

					document.getElementById("sub_sub_menu").innerHTML=''; 

				}

				if(res[0]==1){

					$('.allHide').show();

					$('.med_hide').hide();

					$('#solt').show();

					

				}else{

					$('.allHide').show();

					$('.med_hide').show();

					$('#solt').hide();

				}

			}

		

		</script>

        <script type="text/jscript">

			function fetch_select2(val){



			 	var res = val.split("@@");

			 	if(res[2]==0){

					$.ajax({

						type: 'post',

						url: 'products_filter2.php',

						data: {

								get_option:res[0],

								get_option_menu:res[1]

						 },

						 success: function (response) {

						   document.getElementById("sub_sub_menu").innerHTML=response; 

						   $("#sub_sub_menu").show(1000);

					 	}

				   });

				}else{

					// $("#sub_menu").hide(1000);

					  $("#sub_sub_menu").hide(1000);

					//document.getElementById("sub_menu").innerHTML=''; 

					document.getElementById("sub_sub_menu").innerHTML=''; 

				}

			}



		</script>

<style>

.allHide{

	display:none;

}

#sub_menu{

	display:none;

}

#sub_sub_menu{

	display:none;

}

</style>

<!--end ajax code-->



</head>



<body class="skin-blue">



<!-- header logo: style can be found in header.less -->



<?php include 'includes/header.php'?>

<div class="wrapper row-offcanvas row-offcanvas-left"> 

  

  <!-- Left side column. contains the logo and sidebar -->

  

  <?php include 'includes/left.php'?>

  

  <!-- Right side column. Contains the navbar and content of the page -->

  

  <aside class="right-side"> 

    

    <!-- Content Header (Page header) -->

    

    <section class="content-header">

      <h1> product <small>Control panel</small> </h1>

      <ol class="breadcrumb">

        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="javascript:void(0);">product</a></li>

        <li class="active">Data</li>

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

              <h3 class="box-title">product</h3>

              <input style="float:right;" action="action" onclick="window.history.go(-1); return false;" class="btn btn-primary" type="button" value="Back" />

            </div>

            

            <!-- /.box-header -->

            

            <?php if($erromsg!=''){ ?>

            

            <!-- Alert-->

            

            <div class="msg" style="padding:5px 10px 0 10px;">

              <div class="alert alert-warning alert-dismissable"> <i class="fa fa-warning"></i>

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <b>Alert!</b> <?php echo $erromsg;?> </div>

            </div>

            <?php  } if($msg!=''){?>

            <div class="msg" style="padding:5px 10px 0 10px;">

              <div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <b>Success!</b> <?php echo $msg;?> </div>

            </div>

            <?php } ?>

            

            <!--./Alert--> 

            

            <!-- form start -->

            

            <form role="form" method="post" name="form" enctype="multipart/form-data">

              <div class="box-body" >

                <div class="form-group">

                  <label>Menu</label>

                  <select name="menu" class="form-control" onChange="fetch_select(this.value);"  required>

                    <option value="">--Select Menu--</option>

                    <?php $sqlu = "select * from menu where status='1' AND (link='0' || link='product') order by sort ";

							$resultu = mysql_query($sqlu);

							while($drop = mysql_fetch_array($resultu)){ 

					?>

                    <option value="<?php echo $drop['id'];?>@@<?php echo $drop['link'];?>"><?php echo $drop['menu'];?></option>

                    <?php }?>

                  </select>

                </div>

                <div class="form-group" id="sub_menu"></div>

                <div class="form-group" id='sub_sub_menu'></div>



 				<div class="form-group allHide">

                  <label>Name</label>

                  <input type="text"  name="name" class="form-control" placeholder="Eg: "  />

                </div>                

                <?php /*?><div class="btn-group form-group">

                  <button type="button" class="btn btn-primary DBview" value="New Page" onClick="display(this)" >New Page (Information page)</button>

                  <!--<button type="button" class="btn btn-primary  foo" value="product" onClick="display(this)" >Product</button>-->                  

                </div><?php */?>

                <!--<div class="form-group">

                  <label>Link</label>

                  <input id="link" type="text"  name="link" class="form-control" placeholder="Eg: about.php,contact.php"  />

                </div>-->

                <div class="form-group med_hide allHide" id="img">

                    <label for="exampleInputFile">Image</label>

                    <input type="file"  name="img" >

                    <p class="help-block">*Image dimension  should in jpg format.</p>

                </div> 

                 

  

                <div class="form-group allHide">

                <label>Company Name</label>

                 <section id="intro">

                <select name="company_name" class="form-control"  required>

                    <option value="">--Company Name--</option>

                     <?php $sqlu = "select * from company_name  where status='1'  order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                     <option value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?></option>

                     <?php } ?>

                  </select>

                  </section>

                </div>

                 <div class="form-group allHide" id="solt">

                <label>Solt Name</label>

                <section id="intro1">

                <select name="solt" class="form-control"  >

                    <option value="">--Solt Name--</option>

                     <?php $sqlu = "select * from solt  where status='1'  order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                     <option value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?></option>

                     <?php } ?>

                  </select>

                  </section>

                </div>

                <div class="form-group allHide"><hr>

                <h2 style="text-align:center">Left Filters</h2>

                <div class="form-group">

                        <label>Brand</label><br>

                        <?php $sqlu = "select * from filter_brand  where status='1' order by sortorder";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                        <input type="checkbox" name="Brand[]" value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?>

                        <?php }?>

                    </div> 

                <div class="form-group">

                    <label>Discount</label>

                   <select class="form-control" name="Discount" >

                         <option value="">Choose Discount</option>

                            <?php $just=mysql_query("select * from filter_discount where status='1' order by sortorder"); while($most=mysql_fetch_array($just)){?>

                            <option value="<?php echo $most['id'];?>"><?php echo $most['name'];?></option>

                            <?php } ?>

                    </select>

                </div> 

                <div class="form-group">

                    <label>Product Form</label><br>

                    <?php $sqlu = "select * from filter_form  where status='1' order by sortorder";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                        <input type="checkbox" name="Form[]" value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?>

                        <?php }?>

                </div>  

                <div class="form-group">

                    <label>Uses</label><br>

                  <?php $sqlu = "select * from filter_uses  where status='1' order by sortorder";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                        <input type="checkbox" name="Uses[]" value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?>

                        <?php }?>

                </div>  

                <div class="form-group">

                    <label>Age</label>

                   <select class="form-control" name="Age" >

                         <option value="">Choose Age</option>

                            <?php $just=mysql_query("select * from filter_age where status='1' order by sortorder"); while($most=mysql_fetch_array($just)){?>

                            <option value="<?php echo $most['id'];?>"><?php echo $most['name'];?></option>

                            <?php } ?>

                    </select>

                </div>  

                <div class="form-group">

                    <label>Gender </label>

                   <select class="form-control" name="Gender" >

                         <option value="">Choose Gender </option>

                            <?php $just=mysql_query("select * from filter_gender  where status='1' order by sortorder"); while($most=mysql_fetch_array($just)){?>

                            <option value="<?php echo $most['id'];?>"><?php echo $most['name'];?></option>

                            <?php } ?>

                    </select>

                </div>  

                </div><hr>

                 <div class="form-group allHide">

                  <label>Prescription</label>

                  <select name="prescription" class="form-control"   required>

                    <option value="0">No</option>

                    <option value="1">Yes</option>

                  </select>

                </div>
                <div class="form-group allHide">

                  <label>Discounted Products</label>

                  <select name="dis_products" class="form-control"   required>

                    <option value="0">No</option>

                    <option value="1">Yes</option>

                  </select>

                </div>
                <div class="form-group allHide">

                  <label>Refundable</label>

                  <select name="refundable" class="form-control"   required>

                    <option value="0">No</option>

                    <option value="1">Yes</option>

                  </select>

                </div>
              

                <div class="form-group allHide">

                <label>Packet/Box</label>

                <select name="p_b" class="form-control"  required>

                    <option value="">--Packet/Box--</option>

                     <?php $sqlu = "select * from packing  where status='1' AND type='2' order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                     <option value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?></option>

                     <?php } ?>

                  </select>

                </div>

                 <div class="form-group allHide" id="type">

                 <label>Packing</label>

                <select name="p_b1" class="form-control" >

                    <option value="">--Select --</option>

                     <?php $sqlu = "select * from packing  where status='1' AND type='1' order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                     <option value="<?php echo $drop['id']; ?>"><?php echo $drop['name']; ?></option>

                     <?php } ?>

                      <!--<option value="Syringes">Syringes</option>

                      <option value="Device">Device</option>

                      <option value="Kit">Kit</option>

                      <option value="Wipes">Wipes</option>

                      <option value="Diapers">Diapers</option>

                      <option value="ml Shampoo">ml Shampoo</option>-->

                  </select>

                </div>

                <div id="new_select"> 

                  <div class="form-group">

                    <iframe src="upload_image.php" frameborder="0" style=" width:100%; height:210px;"></iframe>

                  </div>

                  <div class="form-group">

                    <label>Text</label>

                    <textarea name="editor1" id="editor1" class="form-control"></textarea>

                  </div>

                </div>

                 <div class="form-group allHide">

                  <label>Tie up with manufacturer</label>

                  <select name="tieup" class="form-control" id="tieupID" onChange="tieup1()"   required>

                    <option value="0">No</option>

                    <option value="1">Yes</option>

                  </select>

                </div>
                <div class="form-group Phar_pro"   style="display:none;">

                 <label>Manufacturer Name</label>
 
                <select name="pharmacist_products" class="form-control" >

                    <option value="">--Select --</option>

                     <?php $sqlu = "select * from user where fix='MID-' AND  status='1'";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ ?>

                     <option value="<?php echo $drop['id']; ?>"><?php echo $drop['fname']; ?></option>

                     <?php } ?>

                    

                  </select>

                </div>


                <div class="form-group">

                  <label>

                    <input type="radio" name="r3" class="flat-red" value="1" checked />

                    &nbsp;Active </label>

                  <label>

                    <input type="radio" name="r3" class="flat-red" value="0" />

                    &nbsp;Inactive </label>

                </div>

              </div>

              <!-- /.box-body -->

              

              <div class="box-footer">

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

              </div>

            </form>

          </div>

          <!-- /.box --> 

          

        </div>

        <!-- /.left column --> 

        

      </div>

      <!-- /.row--> 

      

    </section>

    <!-- /.content --> 

    

  </aside>

  <!-- /.right-side --> 

  

</div>

<!-- ./wrapper --> 



<!-- jQuery 2.0.2 --> 



<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>--> 



<!-- Bootstrap --> 



<script src="js/bootstrap.min.js" type="text/javascript"></script> 



<!-- AdminLTE App --> 



<script src="js/AdminLTE/app.js" type="text/javascript"></script> 



<!-- AdminLTE for demo purposes --> 



<!-- CK Editor --> 



<script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script> 



<!-- Bootstrap WYSIHTML5 --> 



<script>$(document).ready(function(){$(".message").hide(5000);$(".msg").fadeOut(5000);});</script> 

<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> 

<script type="text/javascript">



		function display(el) {



			var id = $(el).attr('value');



			//alert(id);



			 document.getElementById("abc").value=id;



		



			 	



		



			



		}



			$(document).ready(function(){



			 $(".DB").click(function(){



				$("#new_select").hide();



				$(".footer").show();



			});



			 $(".foo").click(function(){



			 	$("#new_select").hide();



				$(".ban").show();



				$(".footer").hide();



			});



			$(".DBview").click(function(){



				$(".footer").show();



				$(".ban").show();



				$("#new_select").show();



			});



			$(".sub_ban").click(function(){



				$(".ban").hide();



				//$("#new_select").show();



			});



		$("#new_select").hide();



		$(".ban").hide();



		});






		</script> 

<script type="text/javascript">



            $(function() {



                // Replace the <textarea id="editor1"> with a CKEditor



                // instance, using default configuration.



                CKEDITOR.replace('editor1');



                //bootstrap WYSIHTML5 - text editor



                $(".textarea").wysihtml5();



            });

function tieup1(){
	var a=$('#tieupID').val();
	if(a=='1'){
			 $(".Phar_pro").show(2000);
	}else{
		 $(".Phar_pro").hide(2000);
		 
		 
	}

	//Phar_pro
}

        </script>

<?php include 'includes/lockscreen.php'?>

</body>

</html>