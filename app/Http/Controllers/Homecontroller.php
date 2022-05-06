<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SupCategory;

use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Homecontroller extends Controller
{
   public function index(){
      $categories=Category::all();
      $products=Product::all();
    //   $supcategories = Category::with('supcategories')->get();

    return response()->view('front.index', ['categories' => $categories ,'products'=>$products ]);


}


}
