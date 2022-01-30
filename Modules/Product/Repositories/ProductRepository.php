<?php

namespace Modules\Product\Repositories;


use Modules\Category\Entities\Category;
use Modules\Product\Entities\Price;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Property;
use Modules\Product\Interfaces\ProductInterface;
use Modules\Warehouse\Entities\Warehouse;
use Auth;
class ProductRepository implements ProductInterface
{
    public function allProduct(){
        $data['products']=Product::all();
        $data['warehouses'] = Warehouse::where('status',1)->get();
        return $data;
    }
    public function createProduct()
    {
        $data['categories'] = Category::all();
        $data['warehouses'] = Warehouse::where('status',1)->get();
        $data['properties'] = Property::all();
        return $data;
    }
    public function storeProduct(array $ProductData){
        $product=new Product();
        $product->name = $ProductData['name'];
        $product->tags = $ProductData['tags'] ?? '';
        $product->description = $ProductData['description'];
        $product->meta_description = $ProductData['meta_description'];
        $product->purchase_price = $ProductData['purchase_price'];
        $product->save();
        if(isset($ProductData['properties']) && count($ProductData['properties'])>0)
            $product->properties()->attach($ProductData['properties']);
        $product->categories()->attach([$ProductData['category_id']]);
        foreach ($ProductData['price'] as $key=>$price){
            $price=Price::create(['qty'=>$key,'value'=>$price,'type'=>'internal']);
            $product->prices()->save($price);
        }
        if($ProductData['thumbnail'] && $ProductData['thumbnail']){
            $product->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        }
        if($ProductData['images'] && $ProductData['images']){
            $product->addMediaFromRequest('images')->toMediaCollection('images');
        }
        if ($product){
            foreach ($ProductData['qty'] as $key => $qty){
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

