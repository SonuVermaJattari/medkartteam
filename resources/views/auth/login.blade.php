<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
   <?php $erromsg="" ; 
         $message="";
$get_email="";
?>
         <div class="secondary_page_wrapper">
    <div class="container">

              <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

              <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>Login</li>
      </ul>
              <h1 class="page_title">Login</h1>

              <!-- - - - - - - - - - - - - - Checkout method - - - - - - - - - - - - - - - - -->

              <section class="section_offset">
        <div class="relative">
                  <div class="table_layout">
            <div class="table_row">
                      <div class="table_cell">
                <section>

                          <h5 class="sub bold">Register and save time!</h5>
                          <p class="subcaption">Register with us for future convenience:</p>
                          <ul class="list_type_7">
                    <li>Fast and easy check out</li>
                    <li>Easy access to your order history and status</li>
                  </ul>
                        </section>
              </div>
                      <!--/ .table_cell -->

                      <div class="table_cell">
                <section>
                          <h4>Login</h4>
                          <?php if($erromsg!=''){ ?>
           <!-- Alert-->
           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">
            <div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Alert!</b><p class="subcaption"> <?php echo $erromsg;?></p>
                </div>
            </div>
            <?php  } if($message!=''){
				unset($_SESSION['msg_newpassword']);
				?>
           <div class="hiddenmsg" style="padding:5px 10px 0 10px;">
            <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> <p class="subcaption"><?php echo $message;?></p>
                </div>
            </div>
            <?php }  ?>

                    
                    

<form method="POST" id="login_form" action="/login" class="type_2">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        
        <button type="submit" form="login_form" class="button_blue middle_btn">Login</button>
    </div>
</form>


                    
                    
                    
                    
                    
                        </section>
              </div>
                      <!--/ .table_cell -->

                    </div>
            <!--/ .table_row -->

            <div class="table_row">
                      <div class="table_cell"> <a href="register.php" class="button_blue middle_btn">Register now</a> </div>
                      <!--/ .table_cell -->

                      <div class="table_cell">
               <!-- <div class="on_the_sides login_with">
                          <div class="left_side">
                    <button type="submit" form="login_form" class="button_blue middle_btn">Login</button>
                  </div>
                        </div>--
              </div>
                      <!--/ .table_cell -->

                    </div>
            <!--/ .table_row -->

          </div>
                  <!--/ .table_layout -->

                </div>
        <!--/ .relative -->

      </section>
              <!--/ .section_offset -->

            </div>
    <!--/ .container-->

  </div>
          <!--/ .page_wrapper-->
    




        
@endsection



