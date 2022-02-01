<?php

namespace Modules\Woocommerce\Repositories;


use Modules\Woocommerce\Entities\Woocommerce;
use Modules\Woocommerce\Interfaces\WoocommerceInterface;
use Auth;
class WoocommerceRepository implements WoocommerceInterface
{
    public function allWoocommerces(){
        return Woocommerce::all();
    }
    public function createWoocommerce(array $WoocommerceData)
    {
        $WoocommerceData['user_id']=Auth::user()->id;
        return Woocommerce::create($WoocommerceData);
    }
    public function deleteWoocommerce($WoocommerceId)
    {
        return Woocommerce::destroy($WoocommerceId);
    }
    public function myWoocommerceProducts($storeId){
        $data['products'] =Woocommerce::allProducts($storeId);
        $data['allMyStores']=Woocommerce::allMyStores();
        return $data;
    }
}

