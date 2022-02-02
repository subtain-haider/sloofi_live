<?php

namespace Modules\Shopify\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopifyProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Shopify\Database\factories\ShopifyProductFactory::new();
    }
}
