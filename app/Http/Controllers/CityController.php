<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 


    public function index()
    {
        $cities = City::all();
        return response()->view('cms.cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.cities.create');    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ($request->all());
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            // 'active' => 'nullable|string|in:on',
            // 'gender'=>'required|string|in:M,F'
        ], [
            'name.required' => 'Enter city english name',
        ]);

        $city = new City();
        $city->name = $request->input('name');
        // $city->active = $request->has('active');
        $isSaved = $city->save();
        if ($isSaved) {
            session()->flash('message', 'City created successfully');
            // return redirect()->back();
            return redirect()->route('cities.index');
        }    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(city $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(city $city)
    {
        return response()->view('cms.cities.edit', ['city' => $city]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, city $city)
    {
        
        // //
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            // 'active' => 'nullable|string|in:on'
        ]);

        $city->name = $request->input('name');
        // $city->active = $request->has('active');
        $isSaved = $city->save();
        if ($isSaved) {
            return redirect()->route('cities.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(city $city)
    {
        $isDeleted = $city->delete();
        return redirect()->back();
    }
}
