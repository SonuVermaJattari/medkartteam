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

        $status = $user->status;

        if($user){
        

           Auth::loginUsingId($user->id);
            //let us set session 
      
             $user = Auth::user();
                    session_start();
                    $_SESSION['email']=$user->email;
                    $_SESSION['phone']=$user->phone;
                    $_SESSION['title']=$user->title;
                    $_SESSION['firstname']=$user->fname;
                    $_SESSION['lastname']=$user->lname;
             return Redirect::to('/myaccount.php');
        }
	}
        
    public function orders_list(){

         $user = Auth::user()->id;
        $orders  = OrderConfirm:: join('order_address', 'order_confirm.id', '=', 'order_address.order_confirm_id')->where('user_id', '=', $user)->orderBy('order_confirm.id', 'desc')->paginate(4);
        
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

        $product_status = DB::table('product_status')->select()->where('order_id', $slug)->get();

        return view('order_details',compact("orders", 'orderAddress', 'orderDetails', 'productDetails', 'priceDetails', 'shippingAddress', 'orderConfirmPayment', 'product_status'));
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

    public function editmanage_address($id="")
    {
        $user = Auth::user();
        $single_address  = DB::table('address')->where('id', '=', $id)->get();
       if($id!=""){
            return view('editmanage_address', compact('single_address'));
       }else{
            return view('addeditmanage_address', compact('single_address'));
       }
       
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

    public function orders_list_pharmacist()
    {
        $user = Auth::user()->id;
        $orders  = OrderConfirm:: join('order_address', 'order_confirm.id', '=', 'order_address.order_confirm_id')->where('assignedto', '=', $user)->orderBy('order_confirm.id', 'desc')->paginate(4);
        
        return view('pharmacyOrderList',compact("orders"));
    }

    public function orders_Details_pharmacist($slug)
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

        // $product_status = DB::table('product_status')->where('order_id', $product_id)->get();
// return $product_status;
        return view('ordersDetailspharmacist',compact("orders", 'orderAddress', 'orderDetails', 'productDetails', 'priceDetails', 'shippingAddress', 'orderConfirmPayment'));
    }

    public function addProductPharmacy()
    {
         $pharmacist_id = Auth::user()->id;
         $myProductsAr = DB::table('pharmacist_products') ->where('pharmacist_id', $pharmacist_id)->value('p_id');
        $myProducts=unserialize($myProductsAr);
        $products = DB::table('products')->get();
        
        // return $products;
        return view('addproduct_pharmacy_list',compact('products','myProducts'));
    }
    

    public function add_product_pharmacy()
    {
        
        $menus = DB::table('menu')->get();

        $companynames = DB::table('company_name')->get();
       
        $solts = DB::table('solt')->get();

        $discounts = DB::table('filter_discount')->where('status',1)->get();

        $ages = DB::table('filter_age')->where('status',1)->get();
        
        $genders = DB::table('filter_gender')->where('status',1)->get();

        $packets = DB::table('packing')->where('status',1)->where('type',2)->get();

        $packings = DB::table('packing')->where('status',1)->where('type',1)->get();

        $users = DB::table('user')->where('fix',"MID-")->where('status',1)->get();

        $brands = DB::table('filter_brand')->select()->where('status',1)->get();

        $product_form = DB::table('filter_form')->select()->where('status',1)->get();

        $uses = DB::table('filter_uses')->select()->where('status',1)->get();

        return view('add_product_pharmacy',compact('menus', 'companynames','solts','discounts',
                    'ages','genders','packets','packings','users', 'brands', 'product_form', 'uses'));
    
    }
    
    public function addProductPharmacyData(Request $r)
    {
        $productdata = DB::table('products')->insert([
            'menu'              =>$r['menu'],
            'submenu'           =>$r['submenu'],
            'name'              =>$r['name'],
            'company_name'      =>$r['company_name'],
            'img'               =>$r['img'],
            'brand'             =>$r['Brand'],
            'discount'          =>$r['Discount'],
            'form'              =>$r['Form'],
            'age'               =>$r['Age'],
            'gender'            =>$r['Gender'],
            'prescription'      =>$r['prescription'],
            'dis_products'      =>$r['dis_products'],
            'refundable'        =>$r['refundable'],
            'p_b'               =>$r['p_b'],
            'p_b1'              =>$r['p_b1'],
            'solt'              =>$r['solt'],
            'product_user_id'   =>$r['pharmacist_products']
        ]);

        $pharmacist_id = Auth::user()->id;
        $myProductsAr = DB::table('pharmacist_products') ->where('pharmacist_id', $pharmacist_id)->value('p_id');
        $myProducts=unserialize($myProductsAr);
        $products = DB::table('products')->get();
        
        // return $products;
        return view('addproduct_pharmacy_list',compact('products','myProducts'));
    }
    
     public function addProductPharmacy_process(Request $request)
    {
         
         $prarray=$request->input("myprdsel");
         
         
         
         $role=Auth::user()->role;
          $pharmacist_id = Auth::user()->id;
         
        
         
         if(!empty($prarray)){
             
      $prarrayStrng= json_encode($prarray);
                   
         //letus check if data exists if yes then update else insert 
         $userChk = DB::table('pharmacist_products')->where('pharmacist_id', $pharmacist_id)->value('id');
             
               if($userChk){

                   DB::table('pharmacist_products')
                    ->where('id', $userChk)
                    ->update(['p_id' => serialize($prarray)]);

               }else{
           
                    //save data in pharmasist table 
        
         
                         DB::table('pharmacist_products')->insert([
                           ['pharmacist_id' => $pharmacist_id, 'p_id' => serialize($prarray)]
                       ]);
           
           
               }

             
         }
         
         //get pharmasist arrays and selct them 
         
  
          $myProductsAr = DB::table('pharmacist_products') ->where('pharmacist_id', $pharmacist_id)->value('p_id');
        $myProducts=unserialize($myProductsAr);
        $products = DB::table('products')->get();
         
        // return $products;
        return view('addproduct_pharmacy',compact('products','myProducts'));
    }
    
    public function menuItem(Request $request)
    {
            $menu = $request->all();

            $output=""; 

            $menu_id = $menu['menu'];

            $submenu = DB::table('sub_menu')->select()->where('menu', $menu_id)->get();

            foreach ($submenu as $key => $value) 
            {
                $output .= '<option value="'.$value->id.'">'.$value->sub_menu.'</option>';
            }
            
            return Response($output);

    }
    
}

