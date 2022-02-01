<?php

namespace Modules\Woocommerce\Interfaces;

interface WoocommerceInterface
{
    public function allWoocommerces();
    public function createWoocommerce(array $WoocommerceData);
    public function deleteWoocommerce($WoocommerceId);
    public function myWoocommerceProducts($storeId);
}
