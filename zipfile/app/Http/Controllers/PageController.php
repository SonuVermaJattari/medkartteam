<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Flight;
use App\Http\Controllers\Controller;
use DB;
use Request;
/*use App\Category;
use App\Subcategory;
use App\Brand;
use App\User;
*/
class PageController extends Controller
{
    public function homepage()
    {
        /*$categorys = Category::select()->get();*/
       
        $slider = Slider::all();
        $categorys = array(); 
        
        $subcategorys = array();
        $products = array();
        $productsSix = array();
   

    	return view('welcome', compact('categorys', 'slider', 'subcategorys', 'productsSix'));
    }

        public function search(Request $request)
        {   
              $request = Request::all();
              $name =  $request['id'];
              $type =  $request['type'];

                $output="";

                $char = strlen($name);
            
            if($char >= 3)
            {
                $products=DB::table('products')->select()->where('name', 'like', '%'.$name.'%')->paginate(5);
                if($products)
                {
                    foreach ($products as $key => $product) 
                    {
                    $output.=
                    '<span>'.'<a href="'.$product->name.'">'.$product->name.'</a>'.'</span>'.'<br>';
                    }
                    return Response($output);
                } 
            }
        }

        public function searchSelectData($slug)
        {
            $products=DB::table('products')->select()->where('name', $slug)->get();

            return view('search', compact('products'));
            
        }

        public function status(Request $request)
        {
            return "yes";
                $request = Request::all();

                 echo $name =  $request['status'];
                echo $type =  $request['comment'];
            // $products=DB::table('products')->select()->where('name', $slug)->get();

            // return view('search', compact('products'));
            
        }
}
