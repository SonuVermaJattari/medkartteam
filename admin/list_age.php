<?php 
@extract($_REQUEST);
include 'includes/functions.php';
if(isset($_POST['Deactivate']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysql_query("update filter_age set status='0' where id='$act'");
		}
}

		
if(isset($_POST['Activate']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysql_query("update filter_age set status='1' where id='$act'");
		}
}
		

if(isset($_POST['Delete']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysql_query("delete from filter_age where id='$act'");
		}
}
		
		$mqry="select * from filter_age";
		$mqry.=" order by id desc";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $DB->projectname();  ?> | Data Tables</title>
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
                    <h1>
                     Age  Management
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="javascript:void(0);">Age  Management</a></li>
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
                <select id="columns" onChange="sorter.search('query')"></select>
                <input type="text" id="query" onKeyUp="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div class="btn-reset"><a class="button blue" href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div>
        <section>
        <form name="myform" method="post" action="<?php ?>">
        <div style="float:right;"><input type="Submit" name="Activate" value="Activate" class="btn-sm"> <input type="Submit" name="Deactivate" value="Deactivate" class="btn-sm"> <input type="Submit" name="Delete" value="Delete" class="btn-sm" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }" > </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th class="nosort"><h3 align="center">S.No</h3></th>
                    <th><h3 align="center">Age  Name</h3></th>
                   <!-- <th><h3 align="center">Age  Code</h3></th>-->
                    <th><h3 align="center">Status</h3></th>
                    <th class="nosort"><h3 align="center">Edit</h3></th>
                    <th class="nosort"><h3 align="center">Select&nbsp;</h3></th>
                </tr>
            </thead>
              <tbody>
              <?php $count=1; $fetch=mysql_query($mqry);
			  while($web=mysql_fetch_array($fetch)) { ?>
                <tr>
                    <td><center><?php echo $count;?></center></td>
                    <td><center><?php echo ucfirst($web['name']);?></center></td>
                  <!--  <td><center><?php echo $web['color_code'];?></center></td>
                    
                    <td><center><?php if( $web['images']!="") { ?><img src="../uploaded_client_color/<?php echo $web['images'];?>" width="20" />&nbsp; <?php } echo $web['images'];?></center></td>-->
                    
					 <td><?php if( $web['status']=='1'){echo "Active";} else {echo "Deactive";}?></td>
                     <td><center><a href="edit_age.php?eid=<?php echo $web['id'];?>" title="Edit">Edit</a></center></td>
                    
                   
                   <td align="center"><input type="checkbox" value="<?php echo $web['id']; ?>" name="bb[]" id="bb[]"></td>
                </tr>
               <?php $count++; }?>
            </tbody>
        </table>
        </form>
        </section>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="tiny/images/first.png" width="16" height="16" alt="First Page" onClick="sorter.move(-1,true)" />
                    <img src="tiny/images/previous.png" width="16" height="16" alt="First Page" onClick="sorter.move(-1)" />
                    <img src="tiny/images/next.png" width="16" height="16" alt="First Page" onClick="sorter.move(1)" />
                    <img src="tiny/images/last.png" width="16" height="16" alt="Last Page" onClick="sorter.move(1,true)" />
                </div>
                <div>
                	<select  id="pagedropdown"></select>
				</div>
                <div class="btn-reset"><a class="button blue" href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            <div>
                  <select onChange="sorter.size(this.value)">
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
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
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
	</script>   <?php include 'includes/lockscreen.php'?>
    </body>
</html>
