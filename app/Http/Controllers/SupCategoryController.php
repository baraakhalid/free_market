<?php

namespace App\Http\Controllers;

// use App\Models\Sup_Category;

use App\Models\Category;
use App\Models\SupCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sup_categories = SupCategory::with('category')->withcount('products')->get();
        return response()->view('cms.sub_categories.index', ['sup_categories' => $sup_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', '=', true)->get();

        return response()->view('cms.sub_categories.create', ['categories' => $categories]);

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
            'category_id'=>'required|numeric|exists:categories,id',
            'name' => 'required|string|min:3',
            'active'=> 'required | boolean',
          
        ]);

        if (!$validator->fails()) {
            $sup_category = new SupCategory();
            $sup_category->name = $request->input('name');
            $sup_category->active = $request->input('active');
            $sup_category->category_id = $request->input('category_id');


          
            // $isSaved = $sup_category->save();
            $category=Category::fideOrFail($request->input('category_id'));
            $isSaved = $category->supcategories()->save($sup_category);

            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sup_category  $sup_category
     * @return \Illuminate\Http\Response
     */
    public function show(SupCategory $sup_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sup_category  $sup_category
     * @return \Illuminate\Http\Response
     */
    public function edit(SupCategory $sup_category)
    {
        $categories = Category::all();

        return response()->view('cms.sub_categories.edit', ['sup_category' => $sup_category,'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sup_category  $sup_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupCategory $sup_category)
    {
        $validator = Validator($request->all(), [
            'category_id'=>'required|numeric|exists:categories,id',
            'name' => 'required|string|min:3',
            'active'=> 'required | boolean',
           


        ]);

        if (!$validator->fails()) {
            $isSaved= $sup_category->update($request->all());
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
     * @param  \App\Models\Sup_category  $sup_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupCategory $sup_category)
    {
        $deleted = $sup_category->delete();
        // if ($deleted) {
        //     Storage::delete($category->image);
        // }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'Category deleted successfully' : 'Category deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
