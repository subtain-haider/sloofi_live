<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\Interfaces\CategoryInterface;
use Modules\Category\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $categoryRepository;

   public function __construct(CategoryInterface $categoryRepository)
   {
       $this->categoryRepository = $categoryRepository;
   }
    public function index()
    {
        $categories= $this->categoryRepository->allCategory();
        return view('category::index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories= $this->categoryRepository->allCategory();
        return view('category::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->createCategory($request->except('_token'));
        return redirect('/category/all')->with('success', 'Category Added Successfully');
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
    public function editCategory($id)
    {
        $data=$this->categoryRepository->edit($id);
        return view('category::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepository->updateCategory($request->except('_token'),$id);
        return redirect('/category/all')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);
        return redirect('/category/all')->with('success', 'Category Deleted Successfully');
    }
}
