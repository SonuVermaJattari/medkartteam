<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
   
                    



				<div class="container">
					<ul class="breadcrumbs">
						<li><a href="index.html">Home</a></li>
						<li>My Products add</li>
					</ul>
					<div class="row">
						<aside class="col-md-3 col-sm-4">
   <!--
                            
                            {{$currentUsers=Auth::user()->role}}
-->
							<?php include'inc/left.php' ;?><!--/ .section_offset -->

						</aside><!--/ [col]-->



						<main class="col-md-9 col-sm-8">


							<h1>Add Products</h1>

					


							<!-- <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div> -->

                            <div class="page-content">

                                <div id="pagination-result">

                                    <input type="hidden" name="rowcount" id="rowcount" />

                                </div>

                            </div>

							<?php ?><div class="table_wrap">

            <form role="form" method="post" action="{{url('add_product_pharmacy_data')}}" name="form" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              
              <div class="box-body" >
                <div class="form-group">
                  <label>Menu</label>
                  <select name="menu" id="menu" class="form-control"   required>
                    <option value="#">--Select Menu--</option>
                    @foreach($menus as $menu)
                    <option value="{{$menu->id}}">{{$menu->menu}}</option>
                    @endforeach                    
				          </select>
                </div>
                <div class="form-group" id="sub_menu"></div>
                <div class="form-group" id='sub_sub_menu'></div>
                <div class="form-group">
                  <label>Sub Menu</label>
                <select name="submenu" id="submenu" class="form-control" required>
                    <option value="#">--Select Sub Menu--</option>
                  </select>
                </div>
 				         <div class="form-group allHide">
                  <label>Name</label>
                  <input type="text"  name="name" class="form-control" placeholder="Eg: "  />
                </div>                
                <div class="form-group med_hide allHide" id="img">
                    <label for="exampleInputFile">Image</label>
                    <input type="file"  name="img" required="">
                    <p class="help-block">*Image dimension  should in jpg format.</p>
                </div> 

                <div class="form-group allHide">
                <label>Company Name</label>
                 <section id="intro">
                <select name="company_name" class="form-control"  required>
                    <option value="">--Company Name--</option>
                    @foreach($companynames as $companyname)
                    <option value="{{$companyname->id}}">{{$companyname->name}}</option>
                    @endforeach                    
                  </select>
                  </section>
                </div>
                 <div class="form-group allHide" id="solt">
                <label>Solt Name</label>
                <section id="intro1">
                <select name="solt" class="form-control">
                    <option value="">--Solt Name--</option>
                    @foreach($solts as $solt)
                    <option value="{{$solt->id}}">{{$solt->name}}</option>
                    @endforeach                    
                </select>
                  </section>
                </div>
                <div class="form-group allHide"><hr>
                <h2 style="text-align:center">Left Filters</h2>
                <div class="form-group">
                        <label>Brand</label><br>
                  @foreach($brands as $value)
                     <!-- <input type="checkbox" name="Brand" value="{{$value->id}}"> -->{{$value->name}}
                  @endforeach  
                       
                    </div> 
                <div class="form-group">
                    <label>Discount</label>
                   <select class="form-control" name="Discount" >
                         <option value="">--Choose Discount--</option>
                         @foreach($discounts as $discount)
                         @endforeach 
                    </select>
                </div> 
                <div class="form-group">
                    <label>Product Form</label><br>
                  @foreach($product_form as $value)
                     <!-- <input type="checkbox" name="Brand" value="{{$value->id}}"> -->{{$value->name}}
                  @endforeach  
                </div>  
                <div class="form-group">
                    <label>Uses</label><br>
                  @foreach($uses as $value)
                     <!-- <input type="checkbox" name="Brand" value="{{$value->id}}"> -->{{$value->name}}
                  @endforeach  
                      
                </div>  
                <div class="form-group">
                    <label>Age</label>
                   <select class="form-control" name="Age" >
                         <option value="">Choose Age</option>
                         @foreach($ages as $age)
                         <option value="{{$age->id}}">{{$age->name}}</option>
                         @endforeach                         
                    </select>
                </div>  
                <div class="form-group">
                    <label>Gender </label>
                   <select class="form-control" name="Gender" >
                         <option value="">--Choose Gender--</option>
                         @foreach($genders as $gender)
                         <option value="{{$gender->id}}">{{$gender->name}}</option>                         
                        @endforeach
                    </select>
                </div>  
                </div><hr>
                 <div class="form-group allHide">
                  <label>Prescription</label>
                  <select name="prescription" class="form-control"   required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
                <div class="form-group allHide">
                  <label>Discounted Products</label>
                  <select name="dis_products" class="form-control"   required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
                <div class="form-group allHide">
                  <label>Refundable</label>
                  <select name="refundable" class="form-control"   required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
                <div class="form-group allHide">
                <label>Packet/Box</label>
                <select name="p_b" class="form-control"  required>
                    <option value="">--Packet/Box--</option>
                    @foreach($packings as $packing)
                    <option value="{{$packing->id}}">{{$packing->name}}</option>
                    @endforeach
                  </select>
                </div>
                 <div class="form-group allHide" id="type">
                 <label>Packing</label>
                <select name="p_b1" class="form-control">
                    <option value="">--Select --</option>
                    @foreach($packings as $packing)
                    <option value="{{$packing->id}}">{{$packing->name}}</option>
                    @endforeach                    
                </select>
                </div>
                <div id=""> 
              
                  <div class="form-group">
                    <label>Text</label>
                    <textarea name="editor1" id="editor1" class="form-control"></textarea>
                  </div>
                </div>
                 <div class="form-group allHide">
                  <label>Tie up with manufacturer</label>
                  <select name="tieup" class="form-control" id="tieupID" onChange="tieup1()"   required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
                <div class="form-group Phar_pro">
                 <label>Manufacturer Name</label>
                <select name="pharmacist_products" class="form-control" >
                    <option value="">--Select --</option>
                    @foreach($users as $manufacturer)
                    <option value="{{$manufacturer->id}}">{{$manufacturer->fname}}</option>                    
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>
                    <input type="radio" name="r3" class="flat-red" value="1" checked />
                    &nbsp;Active </label>
                  <label>
                    <input type="radio" name="r3" class="flat-red" value="0" />
                    &nbsp;Inactive </label>
              </div>
              <div class="box-footer">
                <button type="submit" name="submit" class="button_blue">Submit</button>
              </div>
            </form>
									
							</div>

							<footer class="bottom_box">
								<a href="index.php" class="button_grey middle_btn">Home</a>
                    <div style="clear:both;"></div>
							</footer><?php ?>
                            
                            <!--/ .bottom_box -->
						</main><!--/ [col]-->
					</div><!--/ .row-->
				</div><!--/ .container-->


        <script type="text/javascript">
            $(document).ready(function(){
                $("#menu").on('change', function(){
                    var value = $(this).val();

                    $.ajax({
                         url: '{{URL::to('menuItem')}}',
                         method: 'get',
                         data: {'menu': value}, // country id ki value stored in ajax_country_id
                         dataType: 'text',
                         success:function(data) {
             
                          $("#submenu").html(data);
                          }
                       
                      });
                });
            });

            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>




        
@endsection