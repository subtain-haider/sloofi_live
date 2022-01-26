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
        Category::create($request->except('token'));
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
    public function UserImageUpload($query){ // Taking input image as parameter
        $image_name = time();
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'admin/images/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path,$image_full_name);

        return $image_url; // Just return image
    }
    public function form_storeMedia(Request $request)
    {
        $file = $request->file('icon');
        if($request->has('icon')){
            $file = $request->file('icon');
        }elseif($request->has('image')){
            $file = $request->file('image');
        }

        $filePath = $this->UserImageUpload($file); //Passing $data->image as parameter to our created method

        return response()->json([
            'image'          => $filePath,
            'original_image' => $file->getClientOriginalName(),
        ]);
    }

    public function form_removeMedia(Request $request)
    {
        $name =  $request->get('image');
        $filePath = $this->UserImageUpload($name); //Passing $data->image as parameter to our created method

        unlink($filePath);
        return response()->json(["success" =>true , "data" => $name,"msg" => "File has been successfully removed!!"]);
    }
}
