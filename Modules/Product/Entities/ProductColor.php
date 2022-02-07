<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductColor extends Model
{
    use HasFactory;
    protected $table='product_color';
    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductColorFactory::new();
    }
}
