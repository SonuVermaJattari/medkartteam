<?php

include 'includes/functions.php';

session_start();

ob_start();

@extract($_REQUEST);

$eid=(int)$_GET['eid'];
$fix=$_GET['fix'];
if(isset($_POST['submit'])){
	$true=0;
	if(empty($erromsg)){



$Brand=$_POST['Brand'];

	$Brand=implode(',', $Brand);
		 $sqlqry="update user set `pharmacist_products`='$Brand', productsstatus='$r3' where id='$eid'";

			$successful=$DB->executupdate($sqlqry);

			if($successful)

			{

				$msg="Updated Successfully";	

			}

	}

}


$QRY="select * from user where fix='$fix' AND id='$eid' ";
$web=$DB->fectchRecord($QRY);
$restrict=$web['productsstatus'];



//print_r($web);

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

<script type="text/jscript">



			function fetch_select(val){

			 	//alert(val);

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

      $('#intro select').zelect({ placeholder:'Plz select...' })

    }

	$(setup1)



    function setup1() {

      $('#intro1 select').zelect({ placeholder:'Plz select...' })

    }

  </script>

<style>

#sub_menu,#menu{

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

      <h1><?php if($fix=='MID-'){ echo 'Tie up with manufacturer '; }else{ echo 'pharmacist'; } ?>  <small>Control panel</small> </h1>

      <ol class="breadcrumb">

        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="javascript:void(0);"><?php if($fix=='MID-'){ echo 'Tie up with manufacturer '; }else{ echo 'pharmacist'; } ?> </a></li>

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

              <h3>
<?php echo $web['title'].' '.$web['fname'].' '.$web['lname']; ?>
                 </h3>

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

                        <label>Pharmacist Products</label><br>

                        <?php 

						$brand1=explode(',',$web['pharmacist_products']);

						$sqlu = "select * from products  where status='1' AND prescription='0' order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ 
						$id='@'.$drop['id'].'@';
						
						?>

                        <input type="checkbox" name="Brand[]" value="@<?php echo $drop['id']; ?>@" <?php if(!empty($brand1)){  foreach($brand1 as $key=>$val) {  
							if($val==$id){  echo 'checked';  break;  }else  echo '';  }  } ?> ><?php echo $drop['name']; ?>

                        <?php }?>
                        <hr>
						 <?php 
						$sqlu = "select * from products  where status='1' AND prescription='1' order by sort";

                        $resultu = mysql_query($sqlu);

                        while($drop = mysql_fetch_array($resultu)){ 
						$id='@'.$drop['id'].'@';
						
						?>

                        <input type="checkbox" name="Brand[]" value="@<?php echo $drop['id']; ?>@" <?php if(!empty($brand1)){  foreach($brand1 as $key=>$val) {  
							if($val==$id){  echo 'checked';  break;  }else  echo '';  }  } ?> ><?php echo $drop['name']; ?>

                        <?php }?>
                    </div>
										
<div class="form-group">
                <label>
                    <input type="radio" name="r3" class="flat-red" value="1"  <?php echo $restrict == "1" ? "checked": ''; ?> />&nbsp;Active
                </label>
                <label>
                    <input type="radio" name="r3" class="flat-red" value="0"  <?php echo $restrict == "0" ? "checked": ''; ?> />&nbsp;Inactive
                </label>
                

              </div>

              <!-- /.box-body -->

              

              <div class="box-footer">

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

              </div>
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

function menu(){

	$("#menu").show(1000);

}

		</script> 

<script type="text/javascript">



            $(function() {



                // Replace the <textarea id="editor1"> with a CKEditor



                // instance, using default configuration.



                CKEDITOR.replace('editor1');



                //bootstrap WYSIHTML5 - text editor



                $(".textarea").wysihtml5();



            });



        </script>

<?php include 'includes/lockscreen.php'?>

</body>

</html>