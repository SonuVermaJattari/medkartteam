<?php
session_start();
error_reporting(0);
$_SESSION['url_red'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
include_once 'inc/functions.php';
if($_SESSION['email']==''){
	header("location:login.php?login_attempt=2");
}
$username = $_SESSION['email'];
$username_id=$DB->fectchRecord("SELECT id from user where email='$username'");
$_SESSION['username_id']=$username_id['id'];
if(isset($_GET['shopping'])){
	$shopping=(int)$_GET['shopping'];
	$_SESSION['shopping']=$shopping;
}else{
	$shopping=0;
	unset($_SESSION['shopping']);
}
$DB->TwoYearsPrescriptionDelete($username);
?>
<!doctype html>
<html lang="en">
		<head>
		<!-- Basic page needs
		============================================ -->
		<title>The medkart | My Account</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas
		============================================ -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Google web fonts
		============================================ -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

		<!-- Libs CSS
		============================================ -->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<!-- Theme CSS
		============================================ -->
		<link rel="stylesheet" href="js/arcticmodal/jquery.arcticmodal.css">
		<link rel="stylesheet" href="js/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" href="js/colorpicker/colorpicker.css">
		<link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/UploadPrescription.css">
        <link rel="stylesheet" href="css/pagination.css">
		<!-- JS Libs
		============================================ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


		<script src="js/modernizr.js"></script>
		<!--<script src="js/jquery-2.1.1.min.js"></script>-->
		<script src="js/queryloader2.min.js"></script>
        <script src="js/UploadPrescription.min.js"></script>

		<script>

			$(document).ready(function(){
				$("body").queryLoader2({
	    			barHeight : 4,
	    			backgroundColor : '#fff',
	    			barColor : '#018bc8',
	    			minimumTime : 2000,
	    			onComplete : function(){

						// show promo popup
	    				if($.arcticmodal && $('body').hasClass('promo_popup')){
							$.arcticmodal({
								url : "modals/promo.html"
							});
						}

	    			}
	    		});

			});

		</script>
<script>
function getresult(url) {
	$.ajax({
		url: url,
		type: "GET",
		data:  {rowcount:$("#rowcount").val(),"pagination_setting":'all-links'},
		beforeSend: function(){$("#overlay").show();},
		success: function(data){
			$("#pagination-result").html(data);
			//setInterval(function() {$("#overlay").hide(); },500);
		},complete: function (data) {
			$("#overlay").hide();
		}
   });
}

function Save_UP(val,name) {


	var Editname=$('#EditModalName'+name).val();
	//alert(name);
	$.ajax({
		url: 'ajax/Save_up.php',
		type: "GET",
		data:  {"val":val,"name":Editname},
		beforeSend: function(){

			$("#overlay").show();

		},
		success: function(data){
		//$('#EditModal1').modal("hide");
			//alert(data);
			$('#EditModal'+name).modal('toggle');
				/*$("#delete_UP").show();
				$("#overlay").hide();
				$("#delete_UP").html(data);
				$("#delete_UP").hide(5000);*/
		},complete: function (data) {
			getresult("ajax/UploadPrescription.php");

		}
   });
}
function delete_UP(val,name) {
	if(confirm("You wants to delete this prescription!")){
		$.ajax({
			url: 'ajax/Delete_up.php',
			type: "GET",
			data:  {"val":val,"name":name},
			beforeSend: function(){$("#overlay").show();},
			success: function(data){
					$("#delete_UP").show();
					$("#overlay").hide();
					$("#delete_UP").html(data);
					$("#delete_UP").hide(5000);
			},complete: function (data) {
				getresult("ajax/UploadPrescription.php");
			}
	   });
	}
}
</script>
		<!-- Old IE stylesheet
		============================================ -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="css/oldie.css">
		<![endif]-->
		</head>
		<body>

<!-- - - - - - - - - - - - - - Styleswitcher - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - end Styleswitcher - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

<div class="wide_layout">

          <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
          <?php include'inc/header.php' ;?>

          <!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

          <div class="secondary_page_wrapper">
    <div class="container">

              <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

              <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>Upload Prescription</li>
      </ul>

              <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

              <div class="row">
        <aside class="col-md-3 col-sm-4">

                  <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

                  <?php include'inc/left.php'?>
                  <!--/ .section_offset -->

                  <!-- - - - - - - - - - - - - - End of compare - - - - - - - - - - - - - - - - -->

                </aside>
        <!--/ [col]-->
        <?php if($erromsg!=''){ ?>
           <!-- Alert-->
           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">
            <div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Alert!</b><p class="subcaption"> <?php echo $erromsg;?></p>
                </div>
            </div>
            <?php  } ?>

        <main class="col-md-9 col-sm-8">
                  <h1>Upload Prescription</h1>
                  <section class="theme_box">
                  <form id="uploadForm" action="upload.php" method="post">
                    <label>Upload Image File:</label>
                    <input name="userImage" id="userImage" type="file" class="demoInputBox" />
                    <input name="nameImage" id="nameImage" value="Prescription<?php echo date('d-m-y'); ?>" type="text" required class="demoInputBox" />
                    <input type="submit" id="btnSubmit" value="Submit" class="btnSubmit" />
                    <div id="progress-div" style="display:none;"><div id="progress-bar"></div></div>
                    <div id="targetLayer"></div>
                    </form>
                  <div id="loader-icon" style="display:none;"><img src="loading.gif" /></div>
                  <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div>
                  <div id="delete_UP"></div>
                  <div class="page-content">
                    <div id="pagination-result">
                        <input type="hidden" name="rowcount" id="rowcount" />
                    </div>
                </div>
                  </section>
                  <!--/ .theme_box -->
                </main>
        <!--/ [col]-->

      </div>
              <!--/ .row-->

            </div>
    <!--/ .container-->

  </div>
          <!--/ .page_wrapper-->

          <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

          <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

          <?php include'inc/footer.php' ;?>

          <!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

        </div>
<!--/ [layout]-->

<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->

<!-- Include Libs & Plugins
		============================================ -->
<script src="js/jquery.appear.js"></script>
<script src="js/owlcarousel/owl.carousel.min.js"></script>
<script src="twitter/jquery.tweet.min.js"></script>
<script src="js/arcticmodal/jquery.arcticmodal.js"></script>
<script src="js/colorpicker/colorpicker.js"></script>
<script src="js/retina.min.js"></script>

<!-- Theme files============================================ -->
<script src="js/theme.styleswitcher.js"></script>
<script src="js/theme.plugins.js"></script>
<script src="js/theme.core.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	 $('#uploadForm').submit(function(e) {
		if($('#userImage').val()) {
			e.preventDefault();
			$('#loader-icon').show();
			$(this).ajaxSubmit({
				target:   '#targetLayer',
				beforeSubmit: function() {
					$("#progress-div").show();
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function (){
					$("#progress-div").hide();
					$('#loader-icon').hide();
					$("#progress-bar").width('0%');
				},complete: function (data) {
				 	getresult("ajax/UploadPrescription.php");

				 },
				resetForm: true
			});
			return false;
		}
	});
});

</script>
<script>
getresult("ajax/UploadPrescription.php");
</script>

</body>
</html>
