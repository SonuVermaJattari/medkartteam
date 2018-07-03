<?php
session_start();
require_once("../../inc/functions.php");
require_once("../class/orders_listpagination.class.php");

$perPage = new PerPage();
$username_id = $_SESSION['username_id'];
$sql = $DB->OrdersListQuery('admin');
//where user_id='$username_id'


if(!empty($_GET["mode"])) {
	$mode=(int)$_GET["mode"];
	$sql.= " where pay='$mode' ";
}

$sql.= "  order BY ocf.order_date DESC ";
$paginationlink = "ajax/orders_list_getresult.php?page=";	
$pagination_setting = $_GET["pagination_setting"];
				
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

 $query =  $sql . " limit " . $start . "," . $perPage->perpage; 
$faq = $DB->runQuery_OrderList($query);

if(empty($_GET["rowcount"])) {
 $_GET["rowcount"] = $DB->numRows($sql);
}
if($_GET["rowcount"]>0){

if($pagination_setting == "prev-next") {
	$perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting);	
} else {
	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	
}
$output ='';
if(!empty($perpageresult)) {
	$output .= "<header class='top_box on_the_sides'><div class='right_side'>".'<div id="pagination">' . $perpageresult . '<div style=\'float:  right;\' >Total Orders: '.$_GET["rowcount"].'</div></div></header>';
}
$i=$start;
$output .= "<div class='table_wrap'>
  <table class='table_type_1 orders_table'>
    <thead>
      <tr>
	  <th class='order_number_col'>S.NO</th>
        <th class='order_number_col'>Order Number</th>
        <th >Order Date</th>
		<th class='ship_col'>Billing Details</th>
        <th class='ship_col'>Shipping Details</th>
        <th>Order Status</th>
        <th>Payment Type</th>
        <th class='order_total_col'>Total</th>
        <th class='product_action_col'>Action</th>
      </tr>
    </thead>
    <tbody>
     ";
foreach($faq as $k=>$v) {
	$orderNumber='TD-'.str_pad($faq[$k]["id"], 5, "0", STR_PAD_LEFT);
	$faq[$k]["pay"]=($faq[$k]["pay"]==0?'COD':'Online paied');
	$faq[$k]["order_status"]=($faq[$k]["order_status"]==1?'Pending':$faq[$k]["order_status"]);
		$output .="<tr><td>".++$i."</td>";
		$output .="<td data-title='Order Number'>".$orderNumber."</td>";
		$output .=" <td data-title='Order Date'>".$faq[$k]["order_date"]."</td>";
		$output .="<td data-title='Ship To'>".$faq[$k]["Billing"]."</td>";
		$output .="<td data-title='Ship To'>".$faq[$k]["Shipping"]."</td>";
		$output .="<td data-title='Order Status'>".$faq[$k]["order_status"]."</td>";
		$output .="<td data-title='Order Status'>".$faq[$k]["pay"]."</td>";
		$output .="<td data-title='Total' class='total'>Rs.".$faq[$k]["price"]."</td>";
		$output .="<td data-title='Action'>
        	<ul class='buttons_col'>
           		<li> <a href='order_details.php?order=".$orderNumber."' class='button_grey'>View Order</a> | <a href='order.php?order_id=".$orderNumber."' class='button_grey'>Update status</a></li>
          	</ul>
        </td></tr>";
 //$output .= '<div class="question"><input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />' . $faq[$k]["id"] . '</div>';
 //$output .= '<div class="answer">' . $faq[$k]["order_date"] . '</div>';
}
if(!empty($perpageresult)) {
$output .= " </tr>
    </tbody>
  </table>
</div>
<footer class='bottom_box'>".'<div id="pagination">' . $perpageresult . '</div></footer>';
}
print $output;
}else{
	
echo 'empty';	
}
?>
