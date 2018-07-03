<?php 
@extract($_REQUEST);
include 'includes/functions.php';
if(isset($_POST['Inactive']) && $bb!='')
{
		foreach($bb as $act)
		{
			
			mysql_query("update price set status='0' where id='$act'");
		}
}

		
if(isset($_POST['Activate']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysql_query("update price set status='1' where id='$act'");
		}
}
		

if(isset($_POST['Delete']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysql_query("delete from price where id='$act'");
		}
}
	$q=(int)$_GET['q'];	
$QRY="select id,menu,name,sub_menu,sub_sub_menu,p_b1 from products where id='$q'";
$web=$DB->fectchRecord($QRY);	
//print_r($web);

$QRY321="select name from packing where id='".$web["p_b1"]."'";
$web321=$DB->fectchRecord($QRY321);
$type=$web321['name'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $DB->projectname();  ?>| Data Tables</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        
      	<script src="tiny/js/modernizr.custom.63321.js" type="text/javascript"></script>   
   	    <link href="tiny/css/styleResp.css" rel="stylesheet" type="text/css" />
   	    <!--Css pannel contact-->
    	<link href="tiny/css/stylesContact.css" rel="stylesheet" type="text/css" />
   	    <!--End Css pannel contact-->
        

       <script type="text/javascript">
           function changeCSS(cssFile, cssLinkIndex) {

               var oldlink = document.getElementsByTagName("link").item(cssLinkIndex);

               var newlink = document.createElement("link")
               newlink.setAttribute("rel", "stylesheet");
               newlink.setAttribute("type", "text/css");
               newlink.setAttribute("href", cssFile);

               document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink);
           }
    	</script>
       <script>
function checkall(objForm){
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
}
				function confirmation()
				{
					if(confirm("Are you sure to delete all selected newletter"))
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				
                </script>
                
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
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
                  <h1> <a href="products_view.php?menu=<?php echo $web['menu'];?>&&sub_menu=<?php echo $web['sub_menu'];?>&&sub_sub_menu=<?php echo $web['sub_sub_menu'];?>" title="<?php echo $web['name']; ?>" style="color:#72afd2;"><?php echo $web['name']; ?></a></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="javascript:void(0);">Price Management</a></li>
                        <li class="active">Data tables</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                           

                            <div class="box" style="padding:10px 10px 20px 10px;">
                                <!--<div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>
                                </div>--><!-- /.box-header -->
                             	   <div id="tablewrapper" >
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div class="btn-reset"><a class="button blue" href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div>
        <section>
        <form name="myform" method="post" action="<?php ?>">
        <div style="float:right;">
			<input type="Submit" name="Activate" value="Activate" class="btn-sm"> 
			<input type="Submit" name="Inactive" value="Inactive" class="btn-sm"> 
			<input type="Submit" name="Delete" class="btn-sm" value="Delete" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }">
			<!--<input class="btn-sm" type="button" onClick="check(this.form.bb)" value="Check All" id="check_all" name="check_all"> -->
		</div>
      	<div class="clearfix"></div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th class="nosort"><h3 align="center">S.no</h3></th>  <th class="nosort" style="display:none;"><h3 align="center">S.no</h3></th>
                    <th><h3 align="center">Type</h3></th>
                     <th><h3 align="center">Selling Price</h3></th>
                     <th><h3 align="center">Non Discounted Price</h3></th>
                     <th><h3 align="center">% Percentage</h3></th>
                     <th class="nosort" style="text-align:center"><h3>Status</h3></th>
                      <th class="nosort" style="text-align:center"><h3>Select</h3></th>
                </tr>
            </thead>
              <tbody>
              <?php
			  $mqry="select * from price where p_id='$q' ";
			  $count=1; $fetch=mysql_query($mqry);
			  while($row=mysql_fetch_array($fetch)) { ?>
                <tr>
                    <td><center><?php echo $count;?></center></td><td style="display:none;" ><center><?php echo $count;?></center></td>
                    <td><center><?php echo $row['p_b1'].' '.$type; ?></center></td>
                    <td><center><?php echo $row['price']; ?></center></td>
                    <td><center><?php echo $row['orgprice']; ?></center></td>
                    <td><center><?php echo $row['price_per'].'%'; ?></center></td>
                    <td style="text-align:center"><?php if( $row['status']=='1'){echo "Active";} else {echo "Inactive";}?></td>
                    <td align="center"><input type="checkbox" value="<?php echo $row['id']; ?>" name="bb[]" id="bb[]"></td>
                </tr>
               <?php $count++; }?>
            </tbody>
        </table>
        </form>
        </section>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="tiny/images/first.png" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="tiny/images/previous.png" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="tiny/images/next.png" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="tiny/images/last.png" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select  id="pagedropdown"></select>
				</div>
                <div class="btn-reset"><a class="button blue" href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            <div>
                  <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="txt-page">Entries Per Page</span>
                </div>

            	
                <div class="page txt-txt">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- page script -->
        <script type="text/javascript" src="tiny/js/script.js"></script>
		<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	});
  </script>
  		 <script src="tiny/js/jquery.reveal.js" type="text/javascript"></script>
    	<script type="text/javascript">
      $(document).ready(function () {
          $('.button-email').click(function (e) { // Button which will activate our modal
              var title = $(this).attr('title');
              var title2 = $('.name').attr('title');
              document.getElementById("email").innerHTML = title.toString();
              $('#modal').reveal({ // The item which will be opened with reveal
                  animation: 'fade',                   // fade, fadeAndPop, none
                  animationspeed: 600,                       // how fast animtions are
                  closeonbackgroundclick: true,              // if you click background will modal close?
                  dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
              });
              return false;
          });
      });
	</script> 

    </body>
</html>
