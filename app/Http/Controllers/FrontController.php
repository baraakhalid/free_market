<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Favorite;


use App\Models\SupCategory;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
 
     
            $categories = Category::all();
            $latestproducts=Product::orderby('created_at','ASC')->take(3)->get();
            $products=Product::withcount('favorites')->get();
            return response()->view('front.parent', ['categories' => $categories ,'latestproducts'=>$latestproducts, 'products'=>$products]);    

    }
    public function showproduct(Request $request)
    {
        $categories = Category::all();

     
           $latestproducts=Product::orderby('created_at','ASC')->take(6)->get();
            return response()->view('front.index', ['latestproducts' => $latestproducts ,'categories' => $categories]);    

    }

}
