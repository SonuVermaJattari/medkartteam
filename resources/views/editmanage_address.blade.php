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

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<?php include'inc/left.php' ;?><!--/ .section_offset -->

						</aside><!--/ [col]-->




						<main class="col-md-9 col-sm-8">


							<h1>Update Address</h1>


							<!-- <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div> -->

                            <div class="page-content">

                                <div id="pagination-result">

                                    <input type="hidden" name="rowcount" id="rowcount" />

                                </div>

                            </div>
                            
						@foreach($single_address as $value)
								<form method="post" action="updatemanage_address/{{$value->id}}">

								  <div class="row pull-right">
								    <div class="form-group col-md-9">
								      <label >Tittle:</label>
								     <input type="text" name="" value="{{$value->title}}">
								    </div>

								   <div class="form-group col-md-9">
								      <label>First-Name:</label>
								     <input type="text" name="fname" value="{{$value->fname}}">
								    </div>
								    
								    <div class="form-group col-md-9">
								      <label >Last-Name</label>
								      <input type="text" name="lname" value="{{$value->lname}}">
								    </div>

								    <div class="form-group col-md-9">
								      <label >Address:</label>
								     <input type="text" name="address" value="{{$value->address}}">
								    </div>

								    <div class="form-group col-md-9">
								      <label >Street:</label>
								    <input type="text" name="street" value="{{$value->street}}">
								    </div>

								    <div class="form-group col-md-9">
								      <label>City:</label>
								     <input type="text" name="city" value="{{$value->city}}">
								    </div>

								    <div class="form-group col-md-9">
								      <label>State:</label>
								      <input type="text" name="state" value="{{$value->state}}">
								    </div>

								    <div class="form-group col-md-9">
								      <label>Pin-Code:</label>
								     <input type="text" name="pin_code" value="{{$value->pincode}}">
								    </div>

								      <div class="form-group col-md-9">
								      <label>Phone-Number:</label>
								      <input type="text" name="phone_number" value="{{$value->phone}}">
								    </div>

								     <div class="col-md-4">
								    <input type="submit" class="btn btn-default" value="Update">
								   
								    </div>
								    </div>

								  </form>
								@endforeach

			<!-- 				<footer class="bottom_box">



							</footer><?php ?> -->

                            <!--/ .bottom_box -->


						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->
@endsection