<?php

namespace Modules\Product\Interfaces;

interface ProductInterface
{
    public function allProduct();
    public function createProduct();
    public function storeProduct(array $ProductData);
    public function editProduct($ProductId);
    public function updateProduct(array $ProductData,$ProductId);
    public function deleteProduct($ProductId);
}
