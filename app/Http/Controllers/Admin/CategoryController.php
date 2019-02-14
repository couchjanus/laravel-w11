<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "Category controller";
        // $categories = Category::all();

        $categories = Category::paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Создание нового экземпляра
        // $category = new Category;
        // $category->name = $request->name;
        // $category->description = $request->description;
        // $category->save();
        
        // $category->fill(['name' => $request->name, 'description' => $request->description]);

        // $category = App\Category::create(['name' =>$request->name, ‘description’ => $request->description]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
        ]);
        if ($validator->fails())  {
            return redirect(route('categories.create'))
                         ->withErrors($validator)
                         ->withInput();
        }
 
        Category::create($request->all());
        
        return redirect(route('categories.index'))->with('success',
        'Category has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // $category = Category::find($id);
        return view('admin.categories.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $request->validate(['name' => 'required',]);
        $category->update($request->all());
        return redirect()->route('categories.index');
            // ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
