<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $categories = new Category();
        if ($request->search){
            $categories = $categories->where('name', 'like', '%'.$request->search.'%');
        }
        $categories = $categories->get();
        return view('category::index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::all();
        return view('category::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::create($request->except(['token', 'icon', 'banner']));
        if($request->hasFile('icon') && $request->file('icon')->isValid()){
            $category->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        if($request->hasFile('banner') && $request->file('banner')->isValid()){
            $category->addMediaFromRequest('banner')->toMediaCollection('banner');
        }
        return back()->with('success', 'Category Added Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $categories = Category::all();
        $category= Category::find($id);
        return view('category::edit',compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $category->update($request->except('token'));
        $category->save();
        return redirect('/category/all')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $categorydata = Category::find($id);
        $categorydata->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }
}
