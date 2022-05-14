<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $categories=Category::all();
    //    $favorites = $request->user()->products;
       $latestproducts=Product::orderby('created_at','ASC')->take(3)->get();

    $favorites=$request->user()->products;
     
    return response()->view('front.favorites',['favorites'=>$favorites ,'categories'=>$categories,'latestproducts'=> $latestproducts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'product_id' => 'required|numeric|exists:products,id'
                   
        ]);
        if (!$validator->fails()) {
            $product = Product::find($request->product_id);
            if(!is_null($product)) {
                if(! $request->user()->favorites()->where('product_id' , $product->id)->exists()){
                    $isSaved = $request->user()->products()->save($product);
                      if( $isSaved)
                      return response()->json(
                        ['message' =>  'Product added to favorite']);
                    
                }
                    else{
                        $isSaved = $request->user()->products()->detach($product);
                        if( $isSaved)
                        return response()->json(
                            ['message' => 'Product deleted from favorite ']);
                    }
           
                   
               }
                else{
                    return response()->json(
                        ['message' => 'Product not found ']);
                }
            
        }
        else{
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
