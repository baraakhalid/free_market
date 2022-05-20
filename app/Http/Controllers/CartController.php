<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('user')->check()){
            $carts=Cart::with('product')->where('user_id' ,'=' ,$request->user()->id)->get();
            return response()->view('front.cart',['carts'=>$carts ]);    }
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
            'product_id' =>'required|numeric|exists:products,id',
            'price' => 'required',
            'quantity' => 'required|integer|between:1,100',
            

        ]);

        if (!$validator->fails()) {
            $product = Product::find($request->product_id);
            if (!is_null($product)) {
                if (!$request->user()->carts()->where('product_id', $product->id)->exists()) {
                    $cart = new Cart();
                    $cart->product_id= $request->product_id;
                    $cart->user_id= $request->user()->id;
                    $cart->price= $request->price;
                    $cart->quantity= $request->quantity;


                    $isSaved = $cart->save();
                    if ($isSaved)
                    return response()->json(['message' => 'Product cart added']);
            
            } else {
                return response()->json(['message' => 'Product already added']);
        }}
        else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
        }    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $validator = Validator($request->all(), [
            'quantity' => 'required|integer|between:1,100',
           
        ]);

        if (!$validator->fails()) {
        
            $cart->quantity = $request->input('quantity');

            $isSaved = $cart->save();
            return response()->json(
                ['message' => $isSaved ? 'quantity Updated successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Cart $cart)
    {
        $product = $cart->product;
        if (!is_null($product)) {
    $deleted = $request->user()->productscart()->detach($product);
    return response()->json(
        [
            'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
            'text' => $deleted ? 'Product deleted successfully' : 'Product deleting failed!',
            'icon' => $deleted ? 'success' : 'error'
        ],
        $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    
    );  
}    }
}
