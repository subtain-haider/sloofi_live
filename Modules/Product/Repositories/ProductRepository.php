<?php

namespace Modules\Product\Repositories;


use Modules\Category\Entities\Category;
use Modules\Product\Entities\Price;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductColor;
use Modules\Product\Entities\ProductSize;
use Modules\Product\Entities\Section;
use Modules\Product\Interfaces\ProductInterface;
use Modules\Shopify\Entities\Shopify;
use Modules\Stock\Entities\StockRequest;
use Modules\Warehouse\Entities\Warehouse;
use Auth;
use Modules\Woocommerce\Entities\Woocommerce;

class ProductRepository implements ProductInterface
{
    public function allProduct(){
        if(in_array('super_admin',Auth::user()->getRoleNames()->toArray())){
            $data['products']=Product::all();
        }else{
            $data['products']=Product::where('user_id',Auth::user()->id)->get();
        }

        $data['warehouses'] = Warehouse::where('status',1)->get();

        return $data;
    }
    public function createProduct()
    {
        $data['categories'] = Category::all();
        $data['warehouses'] = Warehouse::where('status',1)->get();
        $data['sections'] = Section::all();
        return $data;
    }
    public function storeProduct(array $ProductData){
        $product=new Product();
        $product->name = $ProductData['name'];
        $product->tags = $ProductData['tags'] ?? '';
        $product->user_id=Auth::user()->id;
        $product->description = $ProductData['description'];
        $product->meta_description = $ProductData['meta_description'];
        $product->purchase_price = $ProductData['purchase_price'];
        $product->meta_title = $ProductData['meta_title'];
        $product->save();
        if(isset($ProductData['colors'])&& count($ProductData['colors'])>0){
            foreach ($ProductData['colors'] as $color){
                ProductColor::create(['color'=>$color,'product_id'=>$product->id]);
            }
        }
        if(isset($ProductData['sizes'])&& count($ProductData['sizes'])>0){
            foreach ($ProductData['sizes'] as $size){
                ProductSize::create(['size'=>$size,'product_id'=>$product->id]);
            }
        }
        if(isset($ProductData['sections']) && count($ProductData['sections'])>0)
            $product->sections()->attach($ProductData['sections']);
        $product->categories()->attach([$ProductData['category_id']]);
        foreach ($ProductData['price'] as $key=>$price){
            $price=Price::create(['qty'=>$key,'value'=>$price,'type'=>'amount']);
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
    public function storeExternalProduct(array $ProductData){
        $product=new Product();
        $product->name = $ProductData['Title'];
        $product->tags =  '';
        $product->user_id=Auth::user()->id;
        $product->description = '';
        $product->meta_description = '';
        $product->purchase_price = 0;
        $product->meta_title = '';
        $product->external_id = $ProductData['Id'];
        $product->save();

        if(count($ProductData['ConfiguredItems']) > 0){
            $first = $ProductData['ConfiguredItems'][0];
            $f_price = $first['Price']['ConvertedPriceList']['Internal']['Price'];
        }else{
            $f_price = $ProductData['Price']['ConvertedPriceList']['Internal']['Price'];
        }

        $price=Price::create(['qty'=>'1','value'=>$f_price,'type'=>'amount']);
        $product->prices()->save($price);

        if($ProductData['MainPictureUrl']){
            $product->addMediaFromUrl($ProductData['MainPictureUrl'])->toMediaCollection('thumbnail');
        }
        if($ProductData['Pictures']){
            foreach($ProductData['Pictures'] as $image){
                $product->addMediaFromUrl($image['Url'])->toMediaCollection('images');
            }
        }
        return $product;
    }
    public function editProduct($ProductId){
        $data['categories'] = Category::all();
        $data['product']= Product::findOrFail($ProductId);
        $data['sections']=Section::all();
        $data['warehouses']=Warehouse::all();
        return $data;
    }
    public function updateProduct(array $ProductData, $ProductId)
    {
//        dd($ProductData);
        $product=Product::find($ProductId);
        $product->name = $ProductData['name'];
        $product->tags = $ProductData['tags'] ?? '';
        $product->description = $ProductData['description'];
        $product->meta_description = $ProductData['meta_description'];
        $product->purchase_price = $ProductData['purchase_price'];
        $product->meta_title = $ProductData['meta_title'];
        $product->save();
        if(isset($ProductData['properties']) && count($ProductData['properties'])>0)
            $product->properties()->sync($ProductData['properties']);
        if(isset($ProductData['category_id']) && count($ProductData['category_id'])>0){
            $product->categories()->sync([$ProductData['category_id']]);
        }
        foreach ($ProductData['price'] as $key=>$price){
            $temp = $product->prices->where('qty',$key)->first();
            if ($temp){
                $product->prices->where('qty',$key)->first()->update(['value'=>$price]);
            }else{
                $price=Price::create(['qty'=>$key,'value'=>$price,'type'=>'amount']);
                $product->prices()->save($price);
            }
        }
        $product->colors()->delete();
        $product->sizes()->delete();
        if(isset($ProductData['colors'])&& count($ProductData['colors'])>0){
            foreach ($ProductData['colors'] as $color){
                ProductColor::create(['color'=>$color,'product_id'=>$product->id]);
            }
        }
        if(isset($ProductData['sizes'])&& count($ProductData['sizes'])>0){
            foreach ($ProductData['sizes'] as $size){
                ProductSize::create(['size'=>$size,'product_id'=>$product->id]);
            }
        }
        if(isset($ProductData['thumbnail']) && $ProductData['thumbnail']){
            $product->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        }
        if(isset($ProductData['images']) && $ProductData['images']){
            $product->addMediaFromRequest('images')->toMediaCollection('images');
        }
        return $product;
    }
    public function deleteProduct($ProductId)
    {
        return Product::destroy($ProductId);
    }
    public function addStock(array $stockData){
        $product = Product::find($stockData['product_id']);
        $user = Auth::user();
        if($stockData['quantity']<100){
            $price=$product->prices->where('qty',1)->first();
        }elseif($stockData['quantity'] >= 100 && $stockData['quantity']<1000){
            $price=$product->prices->where('qty',100)->first();
            if(count($price)==0)
                $price=$product->prices->where('qty',1)->first();

        }elseif ($stockData['quantity'] >= 1000){
            $price=$product->prices->where('qty',1000)->first();
            if(count($price)==0)
                $price=$product->prices->where('qty',100)->first();
            if(count($price)==0)
                $price=$product->prices->where('qty',1)->first();
        }
        $price=$price->value;
        $total = $price *  $stockData['quantity'];

        $stock = StockRequest::where('status', 'pending')->where('product_id', $stockData['product_id'])->where('warehouse_id', $stockData['warehouse_id'])->first();
        if (!$stock){
            StockRequest::create([
                'user_id' => $user->id,
                'type' => 'internal',
                'product_id' => $stockData['product_id'],
                'quantity' => $stockData['quantity'],
                'warehouse_id' => $stockData['warehouse_id'],
                'amount' => $total,
            ]);
        }else{
            $stock->increment('quantity', $stockData['quantity']);
        }
        return redirect()->route('product.all')->with('success', 'Stock Request Generated Successfully, Please wait for admin approval');
    }

}

