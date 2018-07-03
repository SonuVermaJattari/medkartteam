
@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
    
@endsection

@section('content')
   
			<style type="text/css">
				.pagination li
				{
					display : inline;
					font-size: 27px;
				}
			</style>


				<div class="container">

					<ul class="breadcrumbs">
						<li><a href="index.html">Home</a></li>

						<li>My Loyality Points</li>
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->
					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<?php include'inc/left.php' ;?><!--/ .section_offset -->

						</aside><!--/ [col]-->


						<main class="col-md-9 col-sm-8">

							<!-- <h3 class="pull-right">Total Loyality Points : 100 </h3> -->
							<h1>My Loyality Points</h1>


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

											<th>Order Number</th>

											<th>Loyality Points</th>

											<th>Status</th>

											<th class='order_total_col'>Date</th>

										</tr>

									</thead>
										<tbody>
											@foreach($loyality_pointsdata as $value)
											<tr>
												<td>{{$value->order_id}}</td>
												<td>{{$value->loyality_points}}</td>
												<td>
													<?php
													  $status = $value->status;

													  if($status == 1)
													  {
													  	 echo "Earned";	
													  }
													  elseif($status == -1)
													  {
													  	echo "Redeem";
													  }
													?>
													</td>
												<td>{{$value->date}}</td>
											</tr>
											@endforeach
										</tbody>
								</table>
									
							</div>

							<footer class="bottom_box">

								<a href="index.php" class="button_grey middle_btn">Home</a>

										<?php echo $loyality_pointsdata->render(); ?>

							</footer><?php ?>

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

        
@endsection