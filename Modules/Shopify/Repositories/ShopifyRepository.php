<?php

namespace Modules\Shopify\Repositories;

use Modules\Shopify\Entities\Shopify;
use Modules\Shopify\Interfaces\ShopifyInterface;
use Auth;
class ShopifyRepository implements ShopifyInterface
{
    public function allShopifies(){
        return Shopify::all();
    }
    public function createShopify(array $WoocommerceData)
    {
        $WoocommerceData['user_id']=Auth::user()->id;
        return Shopify::create($WoocommerceData);
    }
    public function deleteShopify($WoocommerceId)
    {
        return Shopify::destroy($WoocommerceId);
    }
    public function myShopifyProducts($storeId){
        return Shopify::allProducts($storeId);
    }

}
