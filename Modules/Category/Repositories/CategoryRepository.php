<?php

namespace Modules\Category\Repositories;


use Modules\Category\Entities\Category;
use Modules\Category\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    public function allCategory(){
        return Category::all();
    }
    public function createCategory(array $categoryData)
    {
        return Category::create($categoryData);
//        if($request->hasFile('icon') && $request->file('icon')->isValid()){
//            $category->addMediaFromRequest('icon')->toMediaCollection('icon');
//        }
//        if($request->hasFile('banner') && $request->file('banner')->isValid()){
//            $category->addMediaFromRequest('banner')->toMediaCollection('banner');
//        }
//        return $category;
    }
    public function editCategory($categoryId){
        $data['categories'] = Category::all();
        $data['category']= Category::findOrFail($categoryId);
        return $data;
    }
    public function updateCategory(array $categoryData, $categoryId)
    {
        return Category::whereId($categoryId)->update($categoryData);
    }
    public function deleteCategory($categoryId)
    {
        return Category::destory($categoryId);
    }
}

