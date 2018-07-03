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

						<li>My Products add</li>



					</ul>



					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->



					<div class="row">



						<aside class="col-md-3 col-sm-4">



							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->



							<?php include'inc/left.php' ;?><!--/ .section_offset -->

						</aside><!--/ [col]-->



						<main class="col-md-9 col-sm-8">


							<h1>Add Products</h1>

							<a href="add_product_pharmacy" class="button_blue pull-right">Add Your Products</a>


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
											<th ><input type="checkbox">Select All</th>
											<th class='order_number_col'>Product Number</th>
											<th>Product Name</th>
											<th >Product Img</th>
											<th> Status</th>
										</tr>
									</thead>
								
								@foreach($products as $value)
								<tr>
									  <td><input type="checkbox" name=""></td>
                                      <td ><a href='#'>{{$value->id}}</a></td>
                                      <td ><a href='#'>{{$value->name}}</a></td>
                                      <td ><a href='#'>{{$value->img}}</a></td>
                                      <td ><a href='#'>{{$value->status}}</a></td>
                                </tr>
								@endforeach

								</table>
									
							</div>

							<footer class="bottom_box">



								<a href="index.php" class="button_grey middle_btn">Home</a>

						
                                <div style="clear:both;"></div>

							</footer><?php ?>
                            


                            <!--/ .bottom_box -->



						</main><!--/ [col]-->



					</div><!--/ .row-->



				</div><!--/ .container-->







        
@endsection