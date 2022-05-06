<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SupCategory;
use App\Models\Category;

use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class , 'product');
    }
    public function index(Request $request)
    {
 
        if(auth('admin')->check()){
            $products = Product::all();

        }
        else{
            $products=$request->user()->products;
            // $products=Product::where('vendor_id' ,'=' ,$request->user()->id)->get();

        }

        return response()->view('cms.products.index', ['products' => $products]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', '=', true)->get();

        // $sup_categories = SupCategory::where('active', '=', true)->get();
        // $vendors = Vendor::all();

        // 'sup_categories' => $sup_categories,
        return response()->view('cms.products.create', ['categories' => $categories ]);
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
            'name' => 'required|string|min:3',
            'sup_category_id'=>'required|numeric|exists:sup_categories,id',
            // 'vendor_id'=>'required|numeric|exists:vendors,id',
            'description' => 'required|string|min:3',
            'price' => 'required|string|min:3',
            'active'=> 'required | boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',

          
        ]);

        if (!$validator->fails()) {
            $product = new Product();
            $product->name = $request->input('name');
            $product->sup_category_id = $request->input('sup_category_id');
            // $product->vendor_id = $request->input('vendor_id');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->available = $request->input('active');
            if ($request->hasFile('image')) {
                // $file = $request->file('image');
                // $imageName = Carbon::now() . '_product_image.' . $file->getClientOriginalExtension();
                // $request->file('image')->storePubliclyAs('images/products', $imageName);
                // $imagePath = 'images/users/' . $imageName;
                // $product->image = $imagePath;
                $file = $request->file('image');
                $imagetitle =  time().'_product_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/products', $imagetitle);
                $imagePath = 'images/products/' . $imagetitle;
                $product->image = $imagePath;
            }



          
            $isSaved = $request->user()->products()->save($product);
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $sup_categories = SupCategory::where('active', '=', true)->get();
        // $vendors = Vendor::all();


        return response()->view('cms.products.edit', ['product'=>$product , 'sup_categories' => $sup_categories ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'sup_category_id'=>'required|numeric|exists:sup_categories,id',
            // 'vendor_id'=>'required|numeric|exists:vendors,id',
            'active' => 'required|boolean',
            'description' => 'required|string|min:3',
            'price' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->sup_category_id = $request->input('sup_category_id');
            // $product->vendor_id = $request->input('vendor_id');
            $product->available = $request->input('active');
            $product->price = $request->input('price');

            if ($request->hasFile('image')) {
                //Delete category previous image.
                Storage::delete($product->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time() . '_product_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/products', $imageName);
                $imagePath = 'images/products/' . $imageName;
                $product->image = $imagePath;
            }
            $isSaved = $product->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        if ($deleted) {
            Storage::delete($product->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
