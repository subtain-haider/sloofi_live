<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Price;
use Modules\Product\Entities\Product;
use Modules\ThirdPartyApi\Entities\ApiCategory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $fillable = ['name','parent_category','order_level','meta_title','meta_description'];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getParentCategory(){
        return Category::find($this->parent_category);
    }
    public function getSubCategory(){
        return Category::where('parent_category',$this->id)->get();
    }
    public function prices()
    {
        return $this->morphMany(Price::class, 'priceable');
    }

    public function api_categories()
    {
        return $this->hasMany(ApiCategory::class);
    }
}
