<?php

namespace Modules\Shopify\Interfaces;

interface ShopifyInterface
{
    public function allShopifies();
    public function createShopify(array $shopifyData);
    public function deleteShopify($shopifyId);
    public function myShopifyProducts($storeId);

}
