<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getParentCategory(){
        return Category::find($this->parent_category);
    }
    public function getSubCategory(){
        return Category::where('parent_category',$this->id)->get();
    }

    public function api_categories()
    {
        return $this->hasMany(ApiCategory::class);
    }
}
