<!-- Stored in resources/views/child.blade.php -->
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




							<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->



						</aside><!--/ [col]-->



						<main class="col-md-9 col-sm-8">


							<h1>Order Details </h1>


							<!-- <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div> -->

                            <div class="page-content">

                                <div id="pagination-result">

                                    <input type="hidden" name="rowcount" id="rowcount" />

                                </div>

                            </div>

							<?php ?><div class="table_wrap">

									
							</div>

	<!-- MAIN CONTENT SECTION -->
     <section class="mainContent clearfix userProfile">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="innerWrapper singleOrder">
                <div class="row">
                  <div class="col-sm-6 col-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h1 class="panel-title" ">Order Address</h1>
                      </div>
                      <div class="panel-body">
                      		@foreach($orderAddress as $value)
                                  <address >
                                  	  <h5>Order Number :: {{$value->id}}</h5>
			                          <h5>Name :: {{$value->title}} {{$value->fname}}  {{$value->lname}}</h5>
			                          <h5>Address :: {{$value->address}} {{$value->street}} <br>
			                          				 {{$value->city}} {{$value->state}} </h5>
			                          <h5>PinCode :: {{$value->pincode}}</h5>
			                          <h5>Phone :: {{$value->phone}}</h5>

		                        </address>
							@endforeach
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-12"  style="margin-left: -97px; width: 35%;">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h1 class="panel-title">Shipping Address</h1>
                      </div>
                      <div class="panel-body">
                      		@foreach($shippingAddress as $value)
                                  <address >
			                          <h5>Name :: {{$value->title}} {{$value->fname}}  {{$value->lname}}</h5>
			                          <h5>Address :: {{$value->address}}  {{$value->street}} 
			                          				 {{$value->city}} {{$value->state}} </h5>
			                          <h5>PinCode :: {{$value->pincode}}</h5>
			                          <h5>Phone :: {{$value->phone}}</h5>
			                     
		                        </address>
							@endforeach
                      </div>
                    </div>
                  </div>
              </div>

              	<br><hr><br>

              <div class="row">
                  <div class="col-sm-6 col-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h1 class="panel-title">Payment Type</h1>
                      </div>
                      <div class="panel-body">
                      		@foreach($orderConfirmPayment as $value)
                                <address >
		                          <h5>Payment Type :: {{$value->PaymentType}}</h5>
		                        </address>
							@endforeach
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-12"  style="margin-left: -97px;">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                         <h1 class="panel-title">Product Details</h1>
                      </div>
                      <div class="panel-body">
                      		@foreach($productDetails as $value)
                                <address >
		                          <h5>Product Name :: {{$value->name}}</h5>
		                          <h5>Brand Name :: {{$value->brand}}</h5>
		                          <h5>Product  :: {{$value->img}}</h5>
		                        </address>
							@endforeach
                      </div>
                    </div>
                  </div>
                </div>

                 	<br><hr><br>

              <div class="row">
                  <div class="col-sm-6 col-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h1 class="panel-title">Payment Status</h1>
                      </div>
                      <div class="panel-body">
						  <form action="status" method="get">
						  	<select name="status" id="product_status">
						  		<option>Status</option>
                      @foreach($product_status as $value)
    						  		  <option<?php if($value->status == $value->status):?> selected="selected"
                      <?php endif;?> value="{{$value->status}}">{{$value->status}}
                        </option>
    						  		@endforeach 
						  	</select>
						      <label>Comment:</label>
						      <textarea name="comment" id="comment" rows="6" cols="20"></textarea>
						    <input type="submit">Submit
						  </form>
                      </div>
                    </div>
                  </div>
              </div>
             <!--    <div class="row">
                  <div class="col-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Order Details</h4>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-sm-4 col-12">
                            <address>
                              <a href="#">Email: adamsmith@bigbag.com</a> <br>
                              <span>Phone: +884 5452 6432</span>
                            </address>
                          </div>
                          <div class="col-sm-8 col-12">
                            <address>
                              <span>Additional Information: </span><br>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </address>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-default">Print</button>
                      <button type="button" class="btn btn-default">Save to pdf</button>
                      <button type="button" class="btn btn-danger">cancel order</button>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </section>


							<footer class="bottom_box">
								<a href="index.php" class="button_grey middle_btn">Home</a>
							</footer><?php ?>
						</main><!--/ [col]-->
					</div><!--/ .row-->
				</div><!--/ .container-->




		<script type="text/javascript">
		$(document).ready(function(){
			$('#product_status').on('change',function(){
                var update_status=$(this).val();
                var comment = $('#comment').val();
                console.log(comment)
                    $.ajax({
                        type : 'get',
                        url : '{{URL::to('status')}}',
                        data:{'update_status':update_status, 'comment':comment}, 
                        success:function(data){
                        $('#display').html(data);
                    }
                });
            });
		});


    

        </script>



        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
        
@endsection