<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;
use Modules\Stock\Entities\Stock;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,LogsActivity;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductFactory::new();
    }
    public function properties(){
        return $this->belongsToMany(Property::class,'products_properties');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'categories_products');
    }
    public function prices()
    {
        return $this->morphMany(Price::class, 'priceable');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}