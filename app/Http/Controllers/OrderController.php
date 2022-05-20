<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(auth('user')->check()){
            $orders=Order::where('user_id' ,'=' ,$request->user()->id)->get();
            return response()->view('front.order',['orders'=>$orders]);
    }
         else{
            $orders=Order::all();
            return response()->view('cms.orders.index',['orders'=>$orders]);
         }    }

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
            'total' => 'required',
             'address_id' => 'required|numeric|exists:addresses,id',
        ]);

        if (!$validator->fails()) {
            $order = new Order();
            $order->total = $request->total;
            $order->address_id = $request->input('address_id');
            $order->date = Carbon::now()->format('Y-m-d');
            $isSaved = $request->user()->orders()->save($order);
            $cartproducts=Cart::where('user_id' ,'=' , $request->user()->id)->get();
            foreach($cartproducts as $cartproduct){
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_id = $cartproduct->product_id;
                $order_product->quantity = $cartproduct->quantity;
                $isSaved = $order_product->save();
            }

            Cart::destroy($cartproducts);
            return response()->json(
                ['message' => $isSaved ? 'Order Saved successfully' : 'Order Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return response()->view('cms.orders.edit', ['order' => $order]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator($request->all(), [
            'status' => 'required|string|min:3',

        ]);

        if (!$validator->fails()) {
            $order->status = $request->input('status');
            $isSaved = $order->save();
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }    
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $deleted = $order->delete();
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'Order deleted successfully' : 'Order deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );     }
}
