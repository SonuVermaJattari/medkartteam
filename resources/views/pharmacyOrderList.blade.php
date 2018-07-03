<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
   
                    



				<div class="container">



					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->



					<ul class="breadcrumbs">



						<li><a href="index.html">Home</a></li>

						<li>My Orders</li>



					</ul>



					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->



					<div class="row">



						<aside class="col-md-3 col-sm-4">



							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->



							<?php include'inc/left.php' ;?><!--/ .section_offset -->



							<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->



							<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->







							<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->



						</aside><!--/ [col]-->



						<main class="col-md-9 col-sm-8">


							<h1>My Orders</h1>


							<!-- <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div> -->

                            <div class="page-content">

                                <div id="pagination-result">

                                    <input type="hidden" name="rowcount" id="rowcount" />

                                </div>

                            </div>

							<?php ?><div class="table_wrap">

								<table class='table_type_1 orders_table'>

									<thead>
										<tr>
											<th class='order_number_col'>Order Number</th>

											<th>Order Date</th>

											<th class='ship_col'>Address</th>

											<th>Order Status</th>

                                            <th>Payment Type</th>

											<th class='order_total_col'>Total</th>

											<th class='product_action_col'>Action</th>

										</tr>

									</thead>
								
								@foreach($orders as $value)
								<tr>
                                      <td data-title='Order Number'><a href='#'>{{$value->id}}</a></td>
                                      <td data-title='Order Number'><a href='#'>
                                      	 <?php
                                      	  $phpdate = strtotime($value->order_date);
                                          $formatedDate = date("d/m/Y", $phpdate);
                                          echo $formatedDate;
                                      ?>
                                      </a></td>
                                      <td data-title='Order Number'><a href='#'>{{$value->address}}</a></td>
                                      <td data-title='Order Number'><a href='#'>{{$value->order_status}}</a></td>
                                      <td data-title='Order Number'><a href='#'>{{$value->PaymentType}}</a></td>
                                      <td data-title='Order Number'><a href='#'>{{$value->grand_total}}</a></td>
                                      <td data-title='Order Number'><a href='/orders_Details_pharmacist/{{$value->id}}'>View Order</a></td>
                                </tr>
								@endforeach

								</table>
									
							</div>

							<footer class="bottom_box">



								<a href="index.php" class="button_grey middle_btn">Home</a>

									<div style="margin-top:15px;">    <?php echo $orders->render(); ?> </div>
                                <div style="clear:both;"></div>

							</footer><?php ?>
                            


                            <!--/ .bottom_box -->



						</main><!--/ [col]-->



					</div><!--/ .row-->



				</div><!--/ .container-->

        
@endsection