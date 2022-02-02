<?php

namespace Modules\Woocommerce\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Automattic\WooCommerce\Client as Client;
use Illuminate\Support\Facades\Artisan;
use Modules\Woocommerce\Entities\WoocommerceProduct;
use Auth;
class Woocommerce extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function woocommerce_products()
    {
        return $this->hasMany(WoocommerceProduct::class);
    }

    public function external_orders()
    {
        return $this->morphMany(ExternalOrder::class, 'external_orderable');
    }

    protected static function newFactory()
    {
        return \Modules\Woocommerce\Database\factories\WoocommerceFactory::new();
    }
    public static function connect($id){
        $woocommerce_data = Woocommerce::where('id',$id)->first();

        $woocommerce = new Client(
            $woocommerce_data->url, // Your store URL
            $woocommerce_data->consumer_key, // Your consumer key
            $woocommerce_data->consumer_secret, // Your consumer secret
            [
                'wp_api' => true, // Enable the WP REST API integration
                'version' => 'wc/v3' // WooCommerce WP REST API version
            ]
        );
        return $woocommerce;
    }
    public static function synProducts($products,$id){
        $woocommerce=Woocommerce::find($id);
        if(count($products) > 0){
            foreach ($products as $product){
                $images = $product->images;
                $tags = '';
                foreach ($product->tags as $tag){
                    $tags = $tag->name .', ';
                }
                $product_exist = WoocommerceProduct::where('title', $product->name)->first();
                if (!$product_exist){
                    $woocommerce->woocommerce_products()->create(['image'=> $images[0]->src, 'title' => $product->name, 'description' => $product->description, 'product_type' => $product->type, 'status' => $product->status, 'tags' => $tags]);
                }

            }
        }
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return 1;
    }
    public function allProducts($store=''){
        $user = Auth::user();
        $products = array();
        $woocommerces = Woocommerce::allMyStores();
        if ($store != null){
            $stores = $user->woocommerce()->where('id',$store)->get();
        }else{
            $stores = $user->woocommerce()->get();
        }
        foreach ($stores as $woocommerce){
            $products = $woocommerce->woocommerce_products;
            // Get response
        }
        return $products;
    }
    public static function allMyStores(){
        $user = Auth::user();
        return  $user->woocommerce()->get();
    }
}
