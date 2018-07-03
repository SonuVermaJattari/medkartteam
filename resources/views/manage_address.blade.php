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


							<h1>My Shipping Address</h1>


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
											<th class='order_number_col'>Address Number</th>
											<!--<th>Name</th>-->
											
											<th class="ship_col">Address</th>
                                           
											<th class='order_total_col'>Phone</th>
											<th class='product_action_col'>Update Record</th>
											<th class='product_action_col'>Delete Record</th>
										</tr>
									</thead>
								<tbody>
								@foreach($address as $value)
								<tr>
                                      <td ><a href='#'>{{$value->id}}</a></td>
                                    <!--  <td >{{$value->title}} {{$value->fname}}  {{$value->lname}}</td>-->
                               
                                      <td ><a href='#'>{{$value->address}} {{$value->street}} {{$value->city}} {{$value->state}} {{$value->pincode}}</a></td>
                                    
                                      <td ><a href='#'>{{$value->phone}}</a></td>
                                      <td ><a href='editmanage_address/{{$value->id}}' class="button_blue middle_btn">edit</a></td>
                                      <td ><a href='deletemanage_address/{{$value->id}}' class="button_blue middle_btn">delete</a></td>
                                </tr>
								@endforeach
								</tbody>

								</table>
									
							</div>

							<footer class="bottom_box"></footer>



                            <!--/ .bottom_box -->



						</main><!--/ [col]-->



					</div><!--/ .row-->



				</div><!--/ .container-->




        
@endsection