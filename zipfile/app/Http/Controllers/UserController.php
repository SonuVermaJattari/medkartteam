<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use Input;
use DB;
use App\OrderConfirm;
use IlluminateSupportFacadesValidator;
use IlluminateFoundationBusDispatchesJobs;
use IlluminateRoutingController;
use IlluminateFoundationValidationValidatesRequests;
use IlluminateFoundationAuthAccessAuthorizesRequests;
use IlluminateFoundationAuthAccessAuthorizesResources;
use IlluminateHtmlHtmlServiceProvider;
use Illuminate\Http\Request;

class UserController  extends Controller
	{
	public function showLogin()
	{
        if (Auth::check()) {
           $user = Auth::user();
          return Redirect::to('/myaccount.php');
        }
		return view('auth.login');
	}

	public function doLogout()
	{
      session_start();
        unset($_SESSION['email']) ;
        unset($_SESSION['phone']) ;
        unset($_SESSION['title']) ;
        unset($_SESSION['firstname']) ;
        unset($_SESSION['lastname']) ;
        session_destroy();
    
        Auth::logout(); // logging out user
        return Redirect::to('/'); // redirection to login screen
	}

	public function doLogin()
	{
		      $userdata = array(
					'email' => Input::get('email') ,
					'password' => Input::get('password')
				);
        
        $user = DB::table('user')->whereEmailAndPass(Input::get('email'), Input::get('password'))->first();

        

        if($user){
            
           Auth::loginUsingId($user->id);
            //let us set session 
             $user = Auth::user();
                    session_start();
                    $_SESSION['email']=$user->email;
                    $_SESSION['phone']=$user->phone;
                    $_SESSION['title']=$user->title;
                    $_SESSION['firstname']=$user->firstname;
                    $_SESSION['lastname']=$user->lastname;
             return Redirect::to('/myaccount.php');
        }
	}
        
    public function orders_list(){

         $user = Auth::user()->id;
        $orders  = OrderConfirm:: join('order_address', 'order_confirm.id', '=', 'order_address.order_confirm_id')->where('user_id', '=', $user)->paginate(4);
        
        return view('orders_list',compact("orders"));
    }
    
    public function order_details($slug)
    {
        $user = Auth::user()->id;
        $userAddressId = Auth::user()->address_id;

        $orders  = OrderConfirm:: join('order_address', 'order_confirm.id', '=', 'order_address.order_confirm_id')
                                  ->where('user_id', '=', $user)->paginate(4);

        $orderConfirmPayment = DB::table('order_confirm')->select()->where('id', $slug)->get();

        $orderAddress = DB::table('order_address')->select()->where('order_confirm_id', $slug)->get();

        $shippingAddress = DB::table('address')->select()->where('u_id', '=', $slug)
                                               ->where('id', '!=', $userAddressId)->get();

        $orderDetails = DB::table('order_details')->select()->where('order_confirm_id', $slug)->get();

        foreach ($orderDetails as $key => $value) 
        {
            $product_id = $value->product_id;
           
        }
        $productDetails = DB::table('products')->select()->where('id', $product_id)->get();
        

        $priceDetails = DB::table('price')->select()->where('p_id', $product_id)->get();

        return view('order_details',compact("orders", 'orderAddress', 'orderDetails', 'productDetails', 'priceDetails', 'shippingAddress', 'orderConfirmPayment'));
    }

    public function my_account()
    {
        return "my account";
    }

    public function upload_prescription()
    {
        return "my account";
    }

    public function product_reviews()
    {
        return "my account";
    }

    public function wishlist()
    {
        return "my account";
    }

    public function newsletter_subscription()
    {
        return "my account";
    }

    public function loyality_points()
    {
        $user = Auth::user()->id;
         $data = DB::table('order_confirm')->where('user_id', '=', $user)->where('order_status', '!=', -1)->sum('grand_total');
          
            $result = number_format($data/100, 2 , '.' , '');

            if ($result > 100) {
                $message =  "No Points Available";
            }
            else {
                $message = $result;
            }
       
       $loyality_pointsdata = DB::table('loyality_points')->where('user_id', '=', $user)->paginate(2);

        return view('loyality_points', compact($message, 'loyality_pointsdata'));
    }

    public function manage_address()
    {
        $user = Auth::user()->id;
        $address  = DB::table('address')->where('u_id', '=', $user)->paginate(10);

        return view('manage_address', compact('address'));
    }
    
    public function add_address()
    {
        $user = Auth::user()->id;
        $address  = DB::table('address')->where('u_id', '=', $user)->paginate(10);

        return view('add_address', compact('address'));
    }

    public function editmanage_address($id)
    {
        $user = Auth::user();
        $single_address  = DB::table('address')->where('id', '=', $id)->get();
       
        return view('editmanage_address', compact('single_address'));
    }

    public function updatemanage_address($id)
    {
        $user = Auth::user();
        $single_address  = DB::table('address')->where('id', '=', $id)->get();
       
        return view('editmanage_address', compact('single_address'));
    }

    public function deletemanage_address($id)
    {
        DB::table('address')->where('id', '=', $id)->delete();

        $user = Auth::user()->id;

        $address  = DB::table('address')->where('u_id', '=', $user)->paginate(10);

        return view('manage_address', compact('address'));
    }

}