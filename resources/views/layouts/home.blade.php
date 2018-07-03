<?php include_once 'inc/functions.php' ;?>
<!doctype html>
<html lang="en">
<head>
		 <title>medkart - @yield('title')</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<!-- Mobile specific metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!-- Google web fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<!-- Libs CSS -->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/fontello.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Theme CSS -->
	<link rel="stylesheet" href="js/layerslider/css/layerslider.css">
		<link rel="stylesheet" href="js/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" href="js/colorpicker/colorpicker.css">
		<link rel="stylesheet" href="js/arcticmodal/jquery.arcticmodal.css">
		<link rel="stylesheet" href="css/style.css">
        <style>
        .search{
			color: #fff;
			}

/*		.searchA
		{
			background-color: white;
			color: #333;
			padding-left: 16px;
			width: 650px; 
			font-size: 16px;
		}
		.searchA hover
		{
			background-color: blue;
			color: white;
		}*/
#search {
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
}


#myUL li a {
	position: absolute;
    width: 65%;
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding-left: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 15px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */
}

/*#myUL li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
}*/

        </style>
		<!-- JS Libs -->
		<script src="js/modernizr.js"></script>
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/queryloader2.min.js"></script>
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
								url : "index.php"
							});
						}

	    			}
	    		});

			});

		</script>
		<!-- Old IE stylesheet
		============================================ -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="css/oldie.css">
		<![endif]-->
	</head>
	<body class="front_page">


		<div class="wide_layout">
 <?php include'inc/header.php' ;?>
             @yield('content')
            
            
            
<div class="section_offset">

							<div class="animated transparent" data-animation="fadeInDown" data-animation-delay="400">

											<!-- - - - - - - - - - - - - - Royal slider - - - - - - - - - - - - - - - - -->

											<div class="layerslider full_width" style="width:100%; height: 422px;">


				<!-- - - - - - - - - - - - - - Slide 2 - - - - - - - - - - - - - - - - -->
<?php $mqry="select * from slider ORDER BY sort";
					$fetch=mysql_query($mqry);
			  		while($web=mysql_fetch_array($fetch)) {
                        
                    
				?>

<div class="ls-slide" data-ls="transition2d: 10, 27, 63, 67, 69;">

					<img class="ls-bg" src="<?php echo $web['img'];?>" alt="">

					<div class="ls-l layer_8" style="left: 552px; top: 126px;" data-ls="offsetxin: 60; easingin: easeOutBack; durationin: 650;"><?php echo $web['text1'];?></div>
					<div class="ls-l layer_9" style="left: 552px; top: 75px;" data-ls="offsetxin: 60; delayin: 150; easingin: easeOutBack; durationin: 650;"><?php echo $web['text2'];?></div>




				</div>
                 <?php } ?>


				<!-- - - - - - - - - - - - - - End of slide 3 - - - - - - - - - - - - - - - - -->

			</div><!--/ .royalSlider.rsDefault-->

           <div class="container hidden-xs hidden-sm">
           <div class="" style="position:absolute; width:85%; bottom: 40px;padding: 29px 40px 40px 40px; background-color: #032c58;">

    <form class="clearfix search" action="searchData" method="get" onSubmit="return serach();">
               
            <h2 style="margin-bottom:0px; color:#fff;">Search from thousands of products available</h2>

                <input type="text" name="search" id="search" tabindex="1" autocomplete="off" placeholder="Search for Medicines Products" class="alignleft fld">

                <select onChange="showResult_drop()" class="srch" name="type" id="search_drop">
                <option value="All">Please Select Product Type</option>
                <option value="Medicine+Name">Medicine Name / Product Name</option>
                <option value="Salt+name">Salt name</option>
                </select>
                <button type="submit" value="Search" class="homered"><i class="icon-search"></i></button>
                <div id="livesearch"></div>
							
					<ul id="myUL">
						<li ><a href=""  id="display" ></a></li>
					</ul>
				<!-- <span style="" class="pull-left searchA" id="display" ></span>			 -->
               
               </form><!--/ #search-->



                       </div>

					</div>

				</div>


							</div>
                            <div ><div class="container">
							<div class="section_offset animated transparent" data-animation="fadeInDown">

								<div class="row">
								<?php
								   $mqry="select * from afterSlider_view";
								   $fetch=mysql_query($mqry);
								  while($web=mysql_fetch_array($fetch)) {
								  ?>
									<div class="col-sm-4">

										<a href="<?php echo $web['link'];?>" class="banner" style="padding:30px 0 0;">

											<img src="<?php echo $web['img'];?>" alt="">

										</a>

									</div>
                                        <?php } ?>

                             




								</div><!--/ .row-->

							</div></div></div>
                            <div class="clearfix"></div>
			<!--/ .page_wrapper-->
			<div class="hto">

                <div class="container">
            <h2 class="align_center" style="margin-bottom:20px;">How To Order <small><small>Pharmacist? </small></small></h2>

           <div class="row">
           <div class="col-lg-2 align_center circle">
           <p class="circle-how">
          <img src="images/search.png">
           </p>
           <h5>Search Product <br> &nbsp;</h5></div>
            <div class="col-lg-2 align_center circle">
             <p class="circle-how">
          <img src="images/brand-icon.png">
           </p>
            <h5>Enter Brand or Salt Name</h5></div>
             <div class="col-lg-2 align_center circle">
              <p class="circle-how">
          <img src="images/substitute-icon.png">
           </p>
             <h5>Find Cheapest <br>Substitute Available</h5></div>
              <div class="col-lg-2 align_center circle">
               <p class="circle-how">
         <img src="images/add-icon.png">
           </p>
              <h5>Add to Cart <br>
 &nbsp;</h5></div>
               <div class="col-lg-2 align_center circle">
                <p class="circle-how">
          <img src="images/upload-pres.png">
           </p>
               <h5>Attach Prescription <br>&nbsp;</h5></div>
                <div class="col-lg-2 align_center last-circle">
                 <p class="circle-how">
          <img src="images/recieve-icon.png">
           </p>
                <h5>Receive &amp; Use Instantly</h5></div>
           </div>

</div>
</div>
<div class="clearfix"></div>
            <section class="section_offset shadow-top" style="padding: 30px 0;">

							<div class="container">	<h1 style="position: relative; z-index:1; margin-bottom: 17px;" class="align_center">Testimonials</h1>

								<!-- - - - - - - - - - - - - - Carousel of testimonials - - - - - - - - - - - - - - - - -->

								<div class="owl_carousel widgets_carousel align_center">

									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->


									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->
<?php 	$mqry="select name,msg from testimonials where status='1' order by sort";


								 ?>
                                 <?php $count=1; $fetch=mysql_query($mqry);
			 					 while($web=mysql_fetch_array($fetch)) { ?>
									<blockquote>
										<?php echo $web['msg'];?>


										<?php /*?><p>Donec sit amet eros. Lorem ipsum dolor sit amet elit. Mauris amet fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</p><?php */?>
<div class="author_info"><b><?php echo $web['name'];?></b></div>
									</blockquote>
<?php } ?>
								
								</div><!--/ .widgets_carousel--><br>
<br></div>

						

							</section>

			<!-- - - - - - - - - - - - - - End Page Wrapper style="background-color:#fbfbfb;" - - - - - - - - - - - - - - - - -->
             <div class="clearfix"></div>

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->
            <div class="hidden" style="background-image:url(images/bg.png); background-repeat:repeat-x; padding:60px 0; background-position: center bottom;">

            <div class="container align_center hidden">
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5" style="padding-bottom:50px;">
<h2 style="margin-top:30px">Download</h2>
<h1><strong>Mobile Application</strong></h1><br>

                   <img src="images/app-android.png" />
                  <img src="images/app-ios.png"/>
					<!-- - - - - - - - - - - - - - End of infoblocks - - - - - - - - - - - - - - - - -->
     </div>
<div class="col-md-5">
<img src="images/app.png" />
</div>

      <div class="col-md-1"></div>
     </div>
                    </div>

                    </div>


            
            <?php include'inc/footer.php' ;?>
		</div><!--/ [layout]-->

		<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->
		<!-- Include Libs & Plugins
		============================================ -->
        		<script src="js/layerslider/js/greensock.js"></script>
		<script src="js/layerslider/js/layerslider.transitions.js"></script>
		<script src="js/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
	    <script src="js/jquery.appear.js"></script>
		<script src="js/royalslider/jquery.royalslider.min.js"></script>
		<script src="js/owlcarousel/owl.carousel.min.js"></script>

		<script src="js/theme.plugins.js"></script>
		<script src="js/theme.core.js"></script>
			<script>
	 $("#hide").click(function(){
    $(".top-strip").hide();
});		</script>
	<script>
    function showResult(str) {
		var search_drop=$('#search_drop').val();
		if(search_drop=='Salt+name'){
			search_drop=2;
		}else if(search_drop=='Medicine+Name'){
			search_drop=1;
		}else{
			search_drop=0;
		}
      if (str.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
      }
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch").innerHTML=this.responseText;
          document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
      }
      xmlhttp.open("GET","ajax/livesearch.php?q="+str+"&&search_drop="+search_drop,true);
      xmlhttp.send();
    }
	 function showResult_drop(){
		 $('#search').val('');
		 $( "#search" ).focus();
		document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
	}
	function serach(){
		var myString = $('#search').val();
    	var withoutSpace = myString.replace(/ /g,"");
   		var length = withoutSpace.length;
		if(length>0){ return true; }
		else{ $( "#search" ).focus(); return false;}
	}
    </script>
    
        <script type="text/javascript">
            $('#search').on('keyup',function(){
                var id=$(this).val();
                var type = $('#search_drop').val();
                    $.ajax({
                        type : 'get',
                        url : '{{URL::to('search')}}',
                        data:{'id':id, 'type':type}, 
                        success:function(data){
                        $('#display').html(data);
                    }
                });
            })
        </script>

        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>

	</body>
</html>
