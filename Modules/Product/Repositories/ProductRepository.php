<?php

namespace Modules\Product\Repositories;


use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Interfaces\ProductInterface;
use Modules\Warehouse\Entities\Warehouse;
use Auth;
class ProductRepository implements ProductInterface
{
    public function allProduct(){
        return Product::all();
    }
    public function createProduct()
    {
        $data['categories'] = Category::all();
        $data['warehouses'] = Warehouse::where('status',1)->get();
        return $data;
    }
    public function storeProduct(array $ProductData){
//        $product = new Product();
//        if($request->thumbnail){
//            $filePath =$request->thumbnail; //Passing $data->image as parameter to our created method
//            $product->thumbnail = $filePath;
//        }
//        if($request->images){
//            $images = '';
//            foreach ($request->images as $image){
//                $filePath = $image; //Passing $data->image as parameter to our created method
//                $images = $images. ','.$filePath;
//            }
//            $product->images = trim($images,",");
//
//        }
//        $product->name = $request->name;
//        $product->user_id = $user->id;
//        $product->category_id = $request->category_id;
//        $product->tags = $request->tags ?? '';
//        $product->description = $request->description;
//        $product->published = $request->published;
//        $product->featured = $request->featured;
//        $product->cod = $request->cod;
//        $product->min_qty = $request->min_qty;
//        $product->shipping_type = $request->shipping_type;
//        $product->shipping_cost = $request->shipping_cost ?? 0;
//        $product->shipping_days = $request->shipping_days;
//        $product->meta_title = $request->meta_title;
//        $product->meta_description = $request->meta_description;
//        $product->price_1 = $request->price_1;
//        $product->price_100 = $request->price_100;
//        $product->price_1000 = $request->price_1000;
//        $product->purchase_price = $request->purchase_price;
//        $product->discount = $request->discount;
//        $product->save();
        $product=Product::create($ProductData);
        if ($product){
            foreach ($ProductData->qty as $key => $qty){
                Auth::user()->stocks()->create([
                    'type' => 'internal',
                    'product_id' => $product->id,
                    'quantity' => $qty[0],
                    'warehouse_id' => $key,
                ]);
            }
        }
        return $product;
    }
    public function editProduct($ProductId){
        $data['categories'] = Product::all();
        $data['Product']= Product::findOrFail($ProductId);
        return $data;
    }
    public function updateProduct(array $ProductData, $ProductId)
    {
        return Product::whereId($ProductId)->update($ProductData);
    }
    public function deleteProduct($ProductId)
    {
        return Product::destory($ProductId);
    }
}

