<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 

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

						<li>My Orders</li>
					</ul>


					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">
						<aside class="col-md-3 col-sm-4">
							<?php include'inc/left.php' ;?><!--/ .section_offset -->
						</aside><!--/ [col]-->
						<main class="col-md-9 col-sm-8">
							<h1>My Address</h1>


							<!-- <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div> -->

                            <div class="page-content">

                                <div id="pagination-result">

                                    <input type="hidden" name="rowcount" id="rowcount" />

                                </div>

                            </div>

								<form method="post" action="manage_address">

								  <div class="row">
								    <div class="form-group col-md-9">
								      <label >Title:</label>
								     <input type="text" name="" placeholder="Enter Title">
								    </div>

								   <div class="form-group col-md-9">
								      <label>First-Name:</label>
								     <input type="text" name="fname" placeholder="Enter First-Name">
								    </div>
								    
								    <div class="form-group col-md-9">
								      <label >Last-Name</label>
								      <input type="text" name="lname" placeholder="Enter Last-Name">
								    </div>

								    <div class="form-group col-md-9">
								      <label >Address:</label>
								     <input type="text" name="address" placeholder="Enter Address">
								    </div>

								    <div class="form-group col-md-9">
								      <label >Street:</label>
								    <input type="text" name="street" placeholder="Enter Street">
								    </div>

								    <div class="form-group col-md-9">
								      <label>City:</label>
								     <input type="text" name="city" placeholder="Enter City">
								    </div>

								    <div class="form-group col-md-9">
								      <label>State:</label>
								      <input type="text" name="state" placeholder="Enter State">
								    </div>

								    <div class="form-group col-md-9">
								      <label>Pin-Code:</label>
								     <input type="text" name="pin_code" placeholder="Enter Pin-Code">
								    </div>

								      <div class="form-group col-md-9">
								      <label>Phone-Number:</label>
								      <input type="text" name="phone_number" placeholder="Enter Phone-Number">
								    </div>
									</div>

								     <div class="col-md-3">
								        <input type="submit" class="btn btn-success">
								    </div>
								  </form>

			<!-- 				<footer class="bottom_box">



							</footer><?php ?> -->

                            <!--/ .bottom_box -->


						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->


        
@endsection