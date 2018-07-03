<?php  session_start();
include 'inc/functions.php'; ?>
		<div id="filter_box"><?php
		if(isset($_SESSION['pid'])!=''){
			$rat=@$_SESSION['pid'];
			$joe=mysql_query("select sub_sub_menu from sub_sub_menu where id='$rat'");
			$den=mysql_fetch_array($joe);
			$sack=$den['sub_sub_menu'];
			echo "<div class='col-lg-3 col-md-3 col-sm-3 mrgb10'><div id='del_pid'><a href='javascript:void(0)' style='background: url(&quot;) no-repeat right center #FFF !important; padding-right: 26px !important;'  class='button delete viw-filter'  onclick='unset_pid()'>".$sack."</a></div></div>";
		}
		if($_SESSION['brand']!=''){
			echo "<div class='col-lg-3 col-md-3 col-sm-3 mrgb10'><div id='del_brand'><a href='javascript:void(0)' style='background: url(&quot;image/close-tag.png&quot;) no-repeat right center #FFF !important; padding-right: 26px !important;'  class='button delete viw-filter'  onclick='unset_brand()'>".$_SESSION['brand']."</a></div></div>";
		}
		if($_SESSION['color']!=''){
		echo "<div class='col-lg-3 col-md-3 col-sm-3 mrgb10'><div id='del_color'><a href='javascript:void(0)' style='background: url(&quot;image/close-tag.png&quot;) no-repeat right center #FFF !important; padding-right: 26px !important;' class='button delete viw-filter'  onclick='unset_color()'>".$_SESSION['color']."</a></div></div>";
		}
		if($_SESSION['size']!=''){echo "<div class='col-lg-3 mrgb10 col-md-3 col-sm-3'><div id='del_size'><a href='javascript:void(0)' style='background: url(&quot;image/close-tag.png&quot;) no-repeat right center #FFF !important; padding-right: 26px !important;' class='button delete viw-filter'  onclick='unset_size()'>".$_SESSION['size']."</a></div></div>";
		}
		if($_SESSION['pricerange']!=''){
			list($RS1,$RS2)=explode(';',$_SESSION['pricerange']);
			echo "<div class='col-lg-3 col-md-3 mrgb10 col-sm-3'><div id='del_price'><a href='javascript:void(0)' style='background: url(&quot;image/close-tag.png&quot;) no-repeat right center #FFF !important; padding-right: 26px !important;' class='button delete viw-filter'  onclick='unset_pricerange()'>".$RS1.'-'.$RS2."</a></div></div>";
		}
		?></div>
        
  
