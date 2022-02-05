<?php

namespace Modules\Category\Repositories;


use Modules\Category\Entities\Category;
use Modules\Category\Interfaces\CategoryInterface;
use Modules\Product\Entities\Price;
class CategoryRepository implements CategoryInterface
{
    public function allCategory(){
        return Category::all();
    }
    public function createCategory(array $categoryData)
    {
        $category=Category::create($categoryData);
        foreach ($categoryData['price'] as $key=>$price){
            $price=Price::create(['qty'=>$key,'value'=>$price,'type'=>$categoryData['price_increment_type']]);
            $category->prices()->save($price);
        }
        return $category;

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
        $price_increment_type=$categoryData['price_increment_type']??'';
        $category=Category::find($categoryId);
         Category::whereId($categoryId)->update(['name'=>$categoryData['name'], 'order_level'=>$categoryData['order_level'],'meta_title'=>$categoryData['meta_title'],'meta_description'=>$categoryData['meta_description']]);
        foreach ($categoryData['price'] as $key=>$price){
            if($category->prices()->where('qty',$key)->first()){
                $category->prices()->where('qty',$key)->first()->update(['value'=>$price]);
            }else{
                $price=Price::create(['qty'=>$key,'value'=>$price,'type'=>$price_increment_type]);
                $category->prices()->save($price);
            }

        }
        return $category;

    }
    public function deleteCategory($categoryId)
    {
        return Category::destroy($categoryId);
    }
}

